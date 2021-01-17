<?php

require_once './models/invoices.php';

class InvoicesController
{

    public function addpurchase()
    {

        $modelo = new Invoices();

       
        $detalle = $modelo->show_detalle_temp(); // Datos detalle temporar
        $num_rows = $detalle->num_rows;
       
        require_once './views/invoices/addpurchase.php';
    }

    public function index()
    {

        $method = new Invoices();
        $invoices = $method->showInvoices();

        require_once './views/invoices/index.php';

    }

    public function purchase()
    {
        require_once './views/invoices/purchase.php';
    }

    public function edit()
    {
        require_once './views/invoices/edit.php';

    }
    

}
