<?php

require_once './models/inventory_control.php';

class Inventory_controlController{

    public function index()
    {
      $method = new Inventory_control();
      $settings = $method->showInventory_control();
      
      require_once './views/inventory_control/index.php';
    }

    public function add()
    {
      require_once './views/inventory_control/add.php';
    }
}