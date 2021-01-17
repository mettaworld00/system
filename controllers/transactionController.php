<?php

require_once './models/transaction.php';

class TransactionController 
{
    public function in()
    {
          $number = $_POST['number'];
        require_once './views/transaction/in.php';
    }
}