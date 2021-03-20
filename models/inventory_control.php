<?php

require_once 'modelo.php';

class Inventory_control extends ModeloBase {

    public function __construct()
    {
        parent::__construct();
    }

    public function showInventory_control(){
        
        $query = "SELECT w.warehouse_name, i.* from item_settings i 
        INNER JOIN warehouses w ON i.warehouse_id = w.warehouse_id";

        return $this->db->query($query);
    }

    public function inventory()
    {
        $warehouseID = $_SESSION['identity']->warehouse_id;

        $query = "SELECT p.price_in, p.product_code, p.product_name, p.quantity,
                w.warehouse_name, u.unit_id, u.unit_name, s.status_name
                FROM products p 
                INNER JOIN status s ON p.status_id = s.status_id
                INNER JOIN units u ON p.unit_id = u.unit_id
                INNER JOIN warehouses w on p.warehouse_id = w.warehouse_id
                WHERE w.warehouse_id = '$warehouseID'";

        return $this->db->query($query);
    }
    

    public function InventoryValue()
    {
        $warehouseID = $_SESSION['identity']->warehouse_id;

        $query = "SELECT sum(p.quantity * p.price_in) as 'total' FROM products p 
                INNER JOIN warehouses w on p.warehouse_id = w.warehouse_id
                WHERE w.warehouse_id = '$warehouseID'";

        return $this->db->query($query);
    }

}