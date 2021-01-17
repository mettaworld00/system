<?php

require_once './models/users.php';

class UsersController {

    public function index(){

        $method = new Users;
        $users = $method->showUsers();
        
        require_once './views/users/index.php';
    }

    public function login()
    {
        
        require_once './views/login/login.php';
    }
}