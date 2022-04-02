<?php

    class Logs
    {
        public $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function addLog(
            string $user_id = null, string $log_level = null, 
            string $service = null, string $message = null
        )
        {
            if(is_null($user_id) || is_null($log_level) || is_null($service) || is_null($message)) return -1;

            $log_id = $this->db->generateId();
            $date = time();
            return ($this->db->insertIntoDB("INSERT INTO `logs` (`log_id`, `user_id`, `log_level`, `service`, `message`, `date`) VALUES ('$log_id', '$user_id', '$log_level', '$service', '$message', '$date');")) ? $log_id : 0;
        }

        public function getAllLogs()
        {
            return $this->db->selectAllFromDB('logs');
        }

        public function getLogsWhere(string $condition = null)
        {
            if(is_null($condition)) return -1;
            return $this->db->selectFromDB('logs', '*', $condition);
        }

        public function __destruct(){
            unset($this->db);
        }
    }
    