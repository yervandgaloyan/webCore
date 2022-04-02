<?php
include_once __DIR__.'/users.php';

class UsersApi extends Users{
    
    // TODO add other endpoints & security checks

    public function __construct() {
        parent::__construct();
        if (isset($_GET['isSignIn']))
        {
            echo parent::isSignIn();
        }elseif (isset($_GET['signIn']) && isset($_GET['username']) && isset($_GET['password']))
        {
            $rememberMe = (isset($_GET['rememberMe']) && $_GET['rememberMe'] == 'on') ? true : false;
            $error = (parent::signIn($_GET['username'], $_GET['password'], $rememberMe) != 1) ? '?error' : '';

            header("Location: $__DIR__/../../signIn.php$error", TRUE, 302);

        }elseif (isset($_GET['signOut'])) {
            echo parent::signOut();
            header("Location: $__DIR__/../../signIn.php");

        }
    }
}

new UsersApi();