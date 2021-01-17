<?php 

require_once 'modelo.php';

class Contacts extends ModeloBase {


    public function __construct()
    {
        parent::__construct();
    }
 

    public function showCustomers(){

        $query = "SELECT * from customers";

        $datos = $this->db->query($query);
        return $datos;
    }

    
}