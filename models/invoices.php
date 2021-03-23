<?php

require_once 'modelo.php';


class Invoices extends ModeloBase
{
    private $id;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function show_detalle_temp()
    {

        $userID = $_SESSION['identity']->user_id;
        $query = "SELECT *FROM temp_detail d INNER JOIN products p ON d.product_id = p.product_id WHERE d.user_id = '$userID' ";

        return $this->db->query($query);
    }

    public function showInvoices(){

        $warehouseID = $_SESSION['identity']->warehouse_id;
        
        $query = "SELECT 
        i.invoice_id, i.noinvoice, i.total_invoice, i.money_received, i.pending, i.expiration, i.warehouse_id, i.created_at as 'date',
        c.customer_name, s.status_name
        FROM invoices i 
        INNER JOIN customers c ON i.customer_id = c.customer_id
        INNER JOIN status s ON i.status_id = s.status_id 
        INNER JOIN payment_methods p ON i.payment_method_id = p.payment_method_id
        WHERE i.warehouse_id = '$warehouseID'";

        return $this->db->query($query);
    }

   
}
