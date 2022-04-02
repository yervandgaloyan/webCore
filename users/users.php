<?php

include_once __DIR__.'/../core/core.php';

class Users extends Core{
    
    function __construct() 
    {
        parent::__construct();
    }

    public function isSignIn() : int
    {
        if(!isset($_COOKIE['username']) || !isset($_COOKIE['session']) || !isset($_COOKIE['user_id']) ) return 0;
        return $this->checkSession($_COOKIE['session'], $_COOKIE['user_id']);
        
    }
    public function getRole(string $username = null)
    {
        if(is_null($username)) return -1;
        $user = $this->getUserByUsername($username);

        return (isset($user['role'])) ? $user['role'] : '';
    }
    
    public function signIn(string $username = null, string $password = null, bool $rememberMe = false) : int
    {
        if(is_null($username) || is_null($password)) return -1;
        if(!($user = $this->getUserByUsername($username))) return 0;
        if(!password_verify($password, $user['pass'])) return 0;

        $session_id = $this->db->generateId();
        if(!$this->addSession($session_id, $user['user_id'], $rememberMe)) return 0;
        setcookie("username", $username, 2147483647, "/");
        setcookie("fullName", $user['full_name'], 2147483647, "/");
        setcookie("session", $session_id, 2147483647, "/");
        setcookie("user_id", $user['user_id'], 2147483647, "/");
        return 1;
        
    }

    public function signOut() : int
    {
        setcookie("username", "", time() - 3600, "/");
        setcookie("fullName", "", time() - 3600, "/");
        setcookie("session", "", time() - 3600, "/");
        setcookie("user_id", "", time() - 3600, "/");
        return 1;
    }

    public function addUser(string $username = null, string $password = null, string $fullName = null) : int
    {
        if(is_null($username) || is_null($password) || is_null($fullName)) return -1;
        return $this->db->insertIntoDB("INSERT INTO `users` (`user_id`, `full_name`, `email`, `pass`, `role`, `disabled`, `created`) VALUES ('".$this->db->generateId()."', '$fullName', '$username', '".password_hash($password, PASSWORD_DEFAULT)."', '', '0', '".time()."');");
    }
    
    public function getUserByUsername(string $username = null)
    {
        if(is_null($username)) return -1;
        $user = $this->db->selectFromDB('users', '*', "`email` = '$username'");
        return array_key_exists(0, $user) ? $user[0] : 0;
       
    }
    
    // Return all users
    public function getAllUsers()
    {
        return $this->db->selectAllFromDB('users');
    }


    // ----------------SESSIONS--------------- //

    // Return session by session_id
    public function getSessionBySessionId(string $session_id = null)
    {
        if(is_null($session_id)) return -1;
        $session = $this->db->selectFromDB('sessions', '*', "`session_id` = '$session_id'");
        return array_key_exists(0, $session) ? $session[0] : 0;
    }
    
    // Add session
    public function addSession(string $session_id = null, $user_id = null, bool $rememberMe = false)
    {
        
        if(is_null($session_id) || is_null($user_id)) return -1;
        $expireDate = ($rememberMe) ? strval(time()+30*24*60*60) : strval(time()+intval($this->configs->getConfigByName('sessionExpire')));
        
        return $this->db->insertIntoDB("INSERT INTO `sessions` (`session_id`, `user_id`, `sign_in_date`, `expire_date`) VALUES ('$session_id','$user_id', '".strval(time())."', '".$expireDate."');");
    }

    public function checkSession(string $session_id = null, string $user_id) : int
    {
        if(is_null($session_id) || is_null($user_id)) return -1;
        $session = $this->getSessionBySessionId($session_id);
        if($session == -1 && $session == 0) return -2;
        if($session['user_id'] == $user_id && $session['expire_date'] > time()) return 1;
        return 0;
    }

    function __destruct()
    {
        parent::__destruct();
    }

}

// $users = new Users;
// print_r($users->getAllUsers());
// print_r($users->addSession($users->generateId(),$users->generateId()));
// print_r($users->getSessionBySessionId('3NXFQL'));

// print_r($users->addUser('test@gmail.com', 'pass', 'Test Test'));
// print_r($users->getUserByUsername('test@gmail.com'));
?>