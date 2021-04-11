<?php

require_once './models/taxes.php';

class TaxesController
{


    public function index()
    {

        $method = new Taxes();
        $taxes = $method->showTaxes();

        require_once './views/taxes/index.php';
    }

    public function add(){

        require_once './views/taxes/add.php';
    }

    public function edit(){

        require_once './views/taxes/edit.php';
    }
  
}
