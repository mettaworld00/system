<?php

require_once 'modelo.php';

class Users extends ModeloBase {

    public function __construct()
    {
        parent::__construct();
    }

    public function showUsers(){

        $query = "SELECT * FROM users";
        return $this->db->query($query);
    }

   
}