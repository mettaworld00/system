<?php
require_once './models/home.php';

class HomeController 
{

    public function index()
    {
        $symbol = "DOP";
        
        $model = new Home(); 

        $sales = $model->showListSalesOfTheDay(); // Lista de facturas del día
        $salesValue = $model->SalesOfTheDay(); // Datos total vendido

        $data = $salesValue->fetch_object(); // Loop

        $result = number_format($data->total,2); // Total vendido

        require_once './views/layout/home.php';
    }
}