<?php

require_once './models/payments.php';

class PaymentsController 
{
    public function view()
    {
        $symbol = "DOP";
        require_once './views/payments/view.php';
    }

    public function index()
    {
 
        $model = new Payments();
        $payments = $model->showPayments();

        require_once './views/payments/index.php';
    }

}