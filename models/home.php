<?php

require_once 'modelo.php';

class Home extends ModeloBase {


    public function __construct()
    {
        parent::__construct();
    }

    public function showListSalesOfTheDay()
    {

        $warehouseID = $_SESSION['identity']->warehouse_id;

        $query = "SELECT 
        i.invoice_id, i.noinvoice, i.total_invoice, i.money_received, i.pending, i.expiration, i.created_at as 'date',
        c.customer_name, s.status_name
        FROM invoices i 
        INNER JOIN users u on u.user_id = i.user_id
        INNER JOIN customers c ON i.customer_id = c.customer_id
        INNER JOIN status s ON i.status_id = s.status_id 
        INNER JOIN payment_methods p ON i.payment_id = p.payment_id
        WHERE i.created_at = CURDATE() AND u.warehouse_id = '$warehouseID'";

        return $this->db->query($query);
    }

    public function SalesOfTheDay()
    {
        $warehouseID = $_SESSION['identity']->warehouse_id;

        $query = "SELECT sum(i.money_received) as 'total' FROM invoices i 
                        INNER JOIN users u on u.user_id = i.user_id
                        INNER JOIN status s on s.status_id = i.status_id
                        WHERE u.warehouse_id = '$warehouseID' AND i.created_at = CURDATE() 
                        OR s.status_name = 'Pagada' AND s.status_name = 'Por cobrar'";

        return $this->db->query($query);
    }

    
} 