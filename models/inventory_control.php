<?php

require_once 'modelo.php';

class Inventory_control extends ModeloBase {

    public function __construct()
    {
        parent::__construct();
    }

    public function showInventory_control(){
        
        $query = "SELECT *from item_settings";

        return $this->db->query($query);
    }

}