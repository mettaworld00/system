<?php

require_once '../config/db.php';
session_start();


// Agregar pago

if ($_POST['action'] == 'agregarPago') {

    $db = Database::connect();

    $warehouseID = $_SESSION['identity']->warehouse_id;
    $userID = $_SESSION['identity']->user_id;
    $customer_id = $_POST['debtor_id'];
    $invoice_id = $_POST['invoice_id'];
    $payment_method = $_POST['payment_method'];
    $note = $_POST['note'];
    $date = $_POST['date'];
    $value = $_POST['value'];

    $query1 = "SELECT pending FROM invoices 
               WHERE invoice_id = '$invoice_id' AND warehouse_id = '$warehouseID'";

    $query2 = "SELECT *FROM invoices WHERE invoice_id = '$invoice_id'";

    $data1 = $db->query($query1);
    $data2 = $db->query($query2);

    $verify = $data1->fetch_object();
    $element = $data2->fetch_object();

    // Verificación

    if ($verify->pending > 0) {
        if ($value <= $element->pending) {

            // Instrucciónes 

            $query = "INSERT INTO payments 
                  VALUES (null,'$userID','$customer_id','$invoice_id','$payment_method','$warehouseID','$value','$note','$date')";

            if ($db->query($query) === TRUE) {

                // Cambios en la factura

                function UPDATE($value, $pending, $status, $id)
                {
                    $db = Database::connect();

                    $query = "UPDATE invoices 
                    SET money_received = $value, pending = $pending, status_id = $status
                    WHERE invoice_id = $id";

                    if ($db->query($query) === TRUE) {

                        echo 1;
                    } else {
                        echo "Error: " . $db->error;
                    }
                }


                $new_value = $element->money_received + $value;
                $new_pending = $element->pending - $value;

                if($new_pending == 0) {

                    $status = 4; //pagada
                    UPDATE($new_value,$new_pending,$status,$invoice_id);

                } else if ($new_pending > 0) {

                    $status = 5; // Por cobrar
                    UPDATE($new_value,$new_pending,$status,$invoice_id);
                }


            } else {
                echo "Error: " . $db->error;
            }

        } else {
            echo "El valor introducido es más alto que la deuda";
        }
    } else {
        echo "error no existe deudor";
    }
}
