<?php 

require_once './models/credits.php';

class CreditsController {

    public function index()
    {
        // $method = new Billing();
        // $invoices = $method->showInvoicesCredits();

        require_once './views/credits/index.php';
    }

    public function payment(){
        require_once './views/credits/payment.php';
    }

}