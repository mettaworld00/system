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
        $query = "SELECT * FROM products p 
                INNER JOIN status s ON p.status_id = s.status_id
                INNER JOIN warehouses w on p.warehouse_id = w.warehouse_id
                LEFT JOIN products_categories pc ON p.product_id = pc.product_id
                LEFT JOIN categories c ON pc.category_id = c.category_id";

        return $this->db->query($query);
    }
   

}
