<?php

require_once './models/inventory_control.php';

class Inventory_controlController{

    public function index()
    {
      $symbol = "DOP";

      $method = new Inventory_control();
      $settings = $method->showInventory_control();
      
      require_once './views/inventory_control/index.php';
    }

    public function inventory()
    {
        $symbol = "DOP";

        $model = new Inventory_control();

        $products = $model->inventory();

        // Calcular el total del inventario

        $inventoryValue = $model->InventoryValue();
        $data = $inventoryValue->fetch_object();

        $result = number_format($data->total,2);
        

        require_once './views/inventory_control/inventory.php';
    }

    public function add()
    {
      require_once './views/inventory_control/add.php';
    }
}