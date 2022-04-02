<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once(__DIR__."/../users/users.php");
    $user = new Users;
    if(!$user->isSignIn()){
        header("Location: $__DIR__/../signIn.php", TRUE , 302);
    }   
    $role = $user->getRole($_COOKIE['username']);
    $user_id = (isset($_COOKIE['user_id'])) ? $_COOKIE['user_id'] : '000000';
    $username = (isset($_COOKIE['username'])) ? $_COOKIE['username'] : '000000';
    
?>