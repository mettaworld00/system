<?php

require_once 'modelo.php';

class Services extends ModeloBase {


    public function __construct()
    {
        parent::__construct();
    }

    public function showServices()
    {

        $query = "SELECT * from services se INNER JOIN status s ON se.status_id = s.status_id ";
        return $this->db->query($query);
    }

}