<?php

require_once './models/price_list.php';

class Price_listController{

    public function index(){

        $modelo = new Price_list();
        $price_list = $modelo->showPrice_list();

        require_once './views/price_list/index.php';
        
    }

    public function add(){

        require_once './views/price_list/add.php';
        
    }

    public function edit(){

        require_once './views/price_list/edit.php';
        
    }


}