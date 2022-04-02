<?php

include_once 'language.php';

class Translate extends Language
{

    public function __construct() {
        parent::__construct();
        $this->translationsFolder = $this->configs->getConfigByName('translationsFolder');
        $this->translationFileType = $this->configs->getConfigByName('translationFileType');

    }
    // Get translation keys from file
    public function getTranslationKeysFromFile(string $fileName = null)
    {
        if(is_null($fileName)) return -1;
        if(!file_exists($fileName)) return 0;
        $regexp =  '/t\\((?:\'|")[a-zA-Z0-9_-]*(?:\'|")\\)/i';

        preg_match_all($regexp, file_get_contents($fileName), $keys, PREG_PATTERN_ORDER);
        $keys = $keys[0];
        foreach($keys as &$value){
            $value = substr($value, 3, -2);
        }
        $keys = array_unique($keys);
        return $keys;
    }
    
    public function getTranslationsFromDB(string $fileName = null, string $language = null)
    {
        if(is_null($fileName) || is_null($language)) return -1;
        if(!file_exists(__dir__ . '/../' . $this->translationsFolder . $language . '/' . $fileName . $this->translationFileType)) return array(); 
        $json = json_decode(file_get_contents(__dir__ . '/../' . $this->translationsFolder . $language . '/'. $fileName . $this->translationFileType), true);
        return $json;
    }

    public function setTranslationsToDB(string $fileName = null, array $translations = null, string $language = null) : int 
    {
        if(is_null($fileName) || is_null($translations) || is_null($language)) return -1;
        
        if (!file_exists(__dir__ . '/../' . $this->translationsFolder . $language)) mkdir(__dir__ . '/../' . $this->translationsFolder . $language, 0755, true);
        $translations += array('lastUpdate' => time());

        file_put_contents(__dir__ . '/../' . $this->translationsFolder . $language . '/'. $fileName . $this->translationFileType, json_encode($translations));
        return 1;
    }

    public function compareTranslationsWithDB(array $translations = null, array $db = null)
    {
        if(is_null($translations) || is_null($db)) return -1;
        $newTranslations = array();
        foreach($translations as $value)
        {
            $newTranslations += array($value => array_key_exists($value, $db) ? $db[$value] : '');
            
        }
        return $newTranslations;
    }

    public function addTranslatedFile(string $fileName = null) : int
    {
        if(is_null($fileName)) return -1;
        $translatedFiles = $this->configs->getConfigByName('translatedFiles');
        if(!in_array($fileName, $translatedFiles)) {
            array_push($translatedFiles, $fileName);
            $this->configs->setConfig('translatedFiles', $translatedFiles);
        }
        $availableLanguages = parent::getAvailableLanguages();
        $translationKeys = $this->getTranslationKeysFromFile($fileName);
        foreach ($availableLanguages as $key => $value) 
        {
            $this->setTranslationsToDB(
                pathinfo($fileName, PATHINFO_FILENAME),
                $this->compareTranslationsWithDB(
                    $translationKeys == 0 ? array() : $translationKeys,
                    $this->getTranslationsFromDB(pathinfo(
                        $fileName, PATHINFO_FILENAME), 
                        $key
                    )
                ),
                $key 
            );
        }
        
        return 1;
    }    

    public function removeTranslatedFile(string $fileName = null) : int
    {
        if(is_null($fileName)) return -1;
        $translatedFiles = $this->configs->getConfigByName('translatedFiles');
        if(!in_array($fileName, $translatedFiles)) return 0;
        
        $availableLanguages = parent::getAvailableLanguages();
        foreach ($availableLanguages as $key => $value) 
        {
            if(file_exists(__dir__ . '/../' . $this->translationsFolder . $key . '/' .pathinfo($fileName, PATHINFO_FILENAME) . $this->translationFileType)) 
            {
                unlink(__dir__ . '/../' . $this->translationsFolder . $key . '/' . pathinfo($fileName, PATHINFO_FILENAME) . $this->translationFileType);
            }
        }
        array_splice($translatedFiles, array_search($fileName, $translatedFiles), 1);
        
        $this->configs->setConfig('translatedFiles', $translatedFiles);
        return 1;    
    }    
    
    public function getTranslatedFiles(){
        return $this->configs->getConfigByName('translatedFiles');
    }

    public function updateLanguageFiles() : int{
        foreach ($this->getTranslatedFiles() as $key => $value) {
            $this->addTranslatedFile($value);
        }  
        return 1;
    }

    public function updateAndGetTranslationFile($fileName, $langCode){
        $this->setTranslationsToDB(pathinfo($fileName, PATHINFO_FILENAME),$this->compareTranslationsWithDB($this->getTranslationKeysFromFile($fileName), $this->getTranslationsFromDB(pathinfo($fileName, PATHINFO_FILENAME), $langCode)), $langCode);
        return $this->getTranslationsFromDB(pathinfo($fileName, PATHINFO_FILENAME), $langCode);
    }

    public function getTranslationFileAllLanguages($fileName){
        $availableLanguages = parent::getAvailableLanguages();
        $translations = array();
        foreach ($availableLanguages as $key => $value) {
            
            $translations = array_merge($translations, array($key => $this->updateAndGetTranslationFile($fileName, $key)));
        }
        return $translations;
    }

    public function updateTranslationByKey($fileName, $langCode, $key, $value){
        $trans = $this->getTranslationsFromDB(pathinfo($fileName, PATHINFO_FILENAME), $langCode);
        $trans[$key] = $value;
        $this->setTranslationsToDB(pathinfo($fileName, PATHINFO_FILENAME), $trans, $langCode);
        return 1;
    }
    
    public function __destruct()
    {
        parent::__destruct();
    }
}
