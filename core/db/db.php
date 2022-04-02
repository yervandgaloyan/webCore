<?php
    
    class DB{

        public $db;

        public function __construct(string $servername, string $username, string $password, $dbname) {
            // Create connection
            $this->db = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            } 
        }

        public function selectAllFromDB($tablename){
            $sql = "SELECT * FROM `$tablename`";
            $result = $this->db->query($sql);
            $out = [];
            if ($result->num_rows > 0) {
                // output data of each row
                
                while($row = $result->fetch_assoc()) {
                    array_push($out, $row);
                }
            }
            return $out;
        }

        public function selectFromDB($tablename, $fields ,$conditions){
            $sql = "SELECT $fields FROM `$tablename` WHERE $conditions";
            $result = $this->db->query($sql);
            $out = [];
            if ($result->num_rows > 0) {              
                while($row = $result->fetch_assoc()) {
                    array_push($out, $row);
                }
            }
            return $out;
        }

        public function insertIntoDB($sql){
            return ($this->db->query($sql) === TRUE) ? 1 : 0;
        }

        public function generateId(int $length = 6) : string
        {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public function __destruct(){
            $this->db->close();
            unset($this->db);
        }
    }
    

// $db = new DB();
// echo $db->insertIntoDB("INSERT INTO `users` (`user_id`, `full_name`, `email`, `pass`, `role`, `disabled`, `created`) VALUES ('', '', '', '', '', '0', '');");
// var_dump($db->selectAllFromDB('users'));
// var_dump($db->selectFromDB('users', 'user_id', '`email` = "yervandgaloyan26@gmail.com"'));