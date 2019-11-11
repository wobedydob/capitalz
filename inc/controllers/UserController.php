<?php

class UserController extends UserModel {

    public function __construct( int $userId = 0, string $email = '', string $password = '' )
    {
        if (!empty($userId)) $this->set_userId($userId);
        if (!empty($email)) $this->set_email($email);
        if (!empty($password)) $this->set_password($password);
    }

    public function register()
    {
        
    }

    public function login()
    {

    }

}