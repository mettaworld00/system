<?php

require_once './models/categories.php';

class CategoriesController
{


    public function index()
    {

        $method = new Categories();
        $categories = $method->showCategories();

        require_once './views/categories/index.php';
    }

    public function add(){

        require_once './views/categories/add.php';
    }
  
    public function edit(){

        require_once './views/categories/edit.php';
    }
  
}
