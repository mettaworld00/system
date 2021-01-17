<?php

require_once 'modelo.php';


class Product extends ModeloBase
{

    public function __construct()
    {
        parent::__construct();
    }

    public function showProducts()
    {

        $query = "SELECT * from products";

        return $this->db->query($query);
    }

    

   

}
