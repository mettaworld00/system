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

        $warehouseID = $_SESSION['identity']->warehouse_id;

        $query = "SELECT * FROM products p 
                INNER JOIN status s ON p.status_id = s.status_id
                INNER JOIN warehouses w on p.warehouse_id = w.warehouse_id
                WHERE w.warehouse_id = '$warehouseID'";

        return $this->db->query($query);
    }
   

}
