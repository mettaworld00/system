<?php

require_once '../config/db.php';

/**
 * Generar No. Servicio
 ----------------------------------*/

if ($_POST['action'] == "generarNoServicio") {

  $query = "SELECT service_invoice_id FROM service_invoices order by service_invoice_id desc LIMIT 1;";
  $db = Database::connect();

  $datos = $db->query($query);
  $result = $datos->fetch_object();

  if ($datos->num_rows < 1) {

    $nofactura = 1;
    echo $nofactura;
  } else {

    $nofactura = $result->service_invoice_id + 1;
    echo $nofactura;
  }
}


if ($_POST['action'] == "buscarServicio") {

  $id = $_POST['service_id'];
  $db = Database::connect();

  $query = "SELECT *FROM services WHERE service_id = '$id'";
  $datos = $db->query($query);

  $result = $datos->fetch_assoc();

  echo json_encode($result, JSON_UNESCAPED_UNICODE);
  exit;
}

// Agregar servicios

if ($_POST['action'] == "agregarServicio") {

  $name = $_POST['name'];
  $price = $_POST['price'];
  $status = 1; // Activo
  $userID = 1;

  $db = Database::connect();

  $query = "INSERT INTO services VALUES (null,$userID,$status,'$name','$price',null)";

  if ($db->query($query) === TRUE) {


    echo "listo";
  } else {

    echo "Error : " . $db->error;
  }
}

/**
 * Procesar venta
 * ----------------------------------------------------------------*/ 

if ($_POST['action'] == "procesarVenta") {

  $status = 3; // 3 = Pagado
  $customer_id = $_POST['customer_id'];
  $user_id = $_POST['user_id'];
  $payment_method = $_POST['payment_method'];
  $total_invoice = $_POST['purchase'];
  $noInvoice = $_POST['noinvoice'];
  $created_at = $_POST['created_at'];
  $expiration = $_POST['expiration'];

  $db = Database::connect();

  $query = "INSERT INTO service_invoices VALUES (null,'$noInvoice','$payment_method',$status,'$customer_id',
    '$user_id','$total_invoice','$total_invoice',null,'$expiration','$created_at')";

  if ($db->query($query) === TRUE) {

    $INVOICE_ID = $db->insert_id;
    echo $INVOICE_ID;

  } else {

    echo "Error: " . $db->error;
  }


}

// Crear detalle

if ($_POST['action'] == "crearDetalle") {

  $userID = $_POST['user_id'];
  $serviceID = $_POST['serviceID'];
  $noInvoice = $_POST['noinvoice'];
  $quantity = $_POST['total_quantity'];
  $total_price = $_POST['total_price'];
  $discount = $_POST['discount'];
  $created_at = $_POST['created_at'];

  $db = Database::connect();

  $query = "INSERT INTO service_detail VALUES (null,$userID,'$serviceID','$noInvoice','$quantity','$total_price','$discount',CURDATE())";

  if ($db->query($query) === TRUE) {

    echo "listo";

  } else {

    echo "Error : " . $db->error;
  }
}