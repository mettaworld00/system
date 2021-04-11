<?php

require_once 'modelo.php';

class Inventory_control extends ModeloBase {

    public function __construct()
    {
        parent::__construct();
    }

    public function showInventory_control(){
        
        $query = "SELECT  *from item_settings";

        return $this->db->query($query);
    }

    public function inventory()
    {

        $query = "SELECT p.price_in, p.product_code, p.product_name, p.quantity,
                 u.unit_id, u.unit_name, s.status_name
                FROM products p 
                INNER JOIN status s ON p.status_id = s.status_id
                INNER JOIN units u ON p.unit_id = u.unit_id";

        return $this->db->query($query);
    }
    

    public function InventoryValue()
    {

        $query = "SELECT sum(quantity * price_in) as 'total' FROM products";

        return $this->db->query($query);
    }

}