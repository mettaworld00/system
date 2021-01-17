<?php

require_once './models/services.php';

class ServicesController {

    public function index()
    {
      $model = new Services();

      $services = $model->showServices();
      require_once './views/services/index.php';

    }

    public function addpurchase()
    {

        require_once './views/services/addpurchase.php';
        
      }
}