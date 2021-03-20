<?php

require_once './models/product.php';

class ProductController
{

    public function index()
    {
        $symbol = "DOP";
        
        $model = new Product();

        $products = $model->showProducts();
        require_once './views/product/index.php';
    }

    public function add()
    {
        require_once './views/product/add.php';
    }


    public function edit()
    {
        require_once './views/product/edit.php';
    }

    public function view()
    {
        require_once './views/product/view.php';
    }

    

    
}
