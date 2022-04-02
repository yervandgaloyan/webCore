<?php

class Settings
{

    // Get & update configs
    private function getConfigsFromFile() : bool
    {
        $this->config = include __DIR__.'/config.php';
        return true;
    }

    // Return all configs
    public function getAllConfigs()
    {
        $this->getConfigsFromFile();
        return $this->config;
    }

    // Return config by name
    public function getConfigByName(string $confName = null)
    {
        if(is_null($confName)) return -1;
        $this->getConfigsFromFile();
        if(!array_key_exists($confName, $this->config)) return 0;
        return $this->config[$confName];
    }

    // Set OR update config
    public function setConfig(string $name = null, $value = null) : int
    {
        if(is_null($name) || is_null($value)) return -1;
        $this->getConfigsFromFile();
        $this->config[$name] = $value;
        if(file_put_contents(__DIR__.'/config.php', '<?php return ' . var_export($this->config, true) . ';')) return 1;
        return 0;
    }
}

?>