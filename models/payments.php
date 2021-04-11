<?php

require_once 'modelo.php';

class Payments extends ModeloBase {


    public function __construct()
    {
        parent::__construct();
    }

    public function showPayments()
    {

        $query = "SELECT p.payment_id, p.created_at, p.note, p.received, c.customer_name, u.username, pm.payment_name, i.noinvoice
                  FROM payments p 
                  INNER JOIN users u ON p.user_id = u.user_id                 
                  INNER JOIN customers c ON p.customer_id = c.customer_id
                  INNER JOIN invoices i ON p.invoice_id = i.invoice_id
                  INNER JOIN payment_methods pm ON p.payment_method_id = pm.payment_method_id";

        return $this->db->query($query);
    }
   
    
} 