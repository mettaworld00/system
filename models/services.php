<?php

require_once 'modelo.php';

class Services extends ModeloBase {


    public function __construct()
    {
        parent::__construct();
    }

    public function showServices()
    {

        $query = "SELECT * from services se INNER JOIN status s ON se.status_id = s.status_id ";
        return $this->db->query($query);
    }

    public function showInvoices()
    {

        $query = "SELECT si.service_invoice_id, si.noinvoice, si.total_invoice, si.money_received, si.pending, si.expiration, si.created_at as 'date',
        c.customer_name, s.status_name from service_invoices si 
        INNER JOIN status s ON si.status_id = s.status_id 
        INNER JOIN customers c ON si.customer_id = c.customer_id
        INNER JOIN payment_methods p ON si.payment_id = p.payment_id";

        return $this->db->query($query);
    }

}