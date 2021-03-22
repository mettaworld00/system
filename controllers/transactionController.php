<?php

require_once './models/transaction.php';

class TransactionController 
{
    public function view()
    {
        $symbol = "DOP";
        require_once './views/transactions/view.php';
    }
}