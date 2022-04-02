<?php
    require_once __DIR__."/configs/settings.php";
    require_once __DIR__."/db/db.php";
    require_once __DIR__."/logs/logs.php";

    class Core
    {
        public $configs;
        public $db;
        public $logs;

        public function __construct()
        {
            $this->configs = new Settings();

            $servername = $this->configs->getConfigByName('DB_server');
            $username = $this->configs->getConfigByName('DB_user');
            $password = $this->configs->getConfigByName('DB_pass');
            $dbname = $this->configs->getConfigByName('DB_name');
            
            $this->db = new DB($servername, $username, $password, $dbname);
            
            $this->logs = new Logs($this->db);
        }

        public function __destruct()
        {
            unset($this->configs);
            unset($this->logs);
            unset($this->db);
        }
       
    }
    