<?php

require_once '../config/db.php';
session_start();

//  Eliminar producto

if ($_POST['action'] == "eliminar_servicio") {

  $id = $_POST['service_id'];

  $db = Database::connect();

  $query = "DELETE FROM service_detail WHERE service_id = '$id';";
  $query .= "DELETE FROM services WHERE service_id = '$id';";

  if ($db->multi_query($query) === TRUE) {

    echo "ready";

  } else {

    echo "Error: " . $db->error;
  }
}

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

// Buscar servicio

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

  $status = 4; // 4 = Pagado
  $customer_id = $_POST['customer_id'];
  $user_id = $_SESSION['identity']->user_id;
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


/**
 * Agregar productos al detalle de la factura
 * 
 */

if ($_POST['action'] == "agregarCompra") {

  $invoice_id = $_POST['invoice_id'];
  $service_id = $_POST['service_id'];
  $total_price = $_POST['total_price'];
  $quantity = $_POST['quantity'];
  $discount = $_POST['discount'];
  $user_id = $_POST['userID'];


  $db = Database::connect();

  $query = "INSERT INTO service_detail VALUES (null,'$user_id','$service_id','$invoice_id','$quantity','$total_price','$discount',curdate())";
  if ($db->query($query) === TRUE) {
    echo "listo";
  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Eliminar item del detalle
 -----------------------------------------------------------*/

 if ($_POST['action'] == 'eliminarDetalle') {

  $id = $_POST['service_detail_id'];

  $db = Database::connect();

  $query = "DELETE FROM service_detail WHERE service_detail_id = '$id'";
  if ($db->query($query) === TRUE) {

    echo 1;
  } else {

    echo "Error: " . $db->error;
  }
}


/**
 * Actualizar precio de factura
 ----------------------------------------------*/

 if ($_POST['action'] == "actualizarFactura") {
  $db = Database::connect();

  $invoice_id = $_POST['invoice_id'];

  $query1 = "SELECT sum(total_price) as 'total_invoice' FROM service_detail WHERE service_invoice_id = '$invoice_id'";
  $datos1 = $db->query($query1);

  $element = $datos1->fetch_object();
  $total_invoice = $element->total_invoice; // Total de la factura
  

 $query2 = "SELECT  *FROM service_invoices WHERE service_invoice_id = '$invoice_id'";
 $datos2 = $db->query($query2);
 
 $element2 = $datos2->fetch_object();

 $money_received = $element2->money_received; // Total recibido
 $pending = $total_invoice - $money_received; // Total pendiente


  $query3 = "UPDATE service_invoices SET total_invoice = $total_invoice, pending = $pending 
  WHERE service_invoice_id = '$invoice_id'";
  if ($db->query($query3) === TRUE) {
    echo "ready";
    
    deleteInvoiceNull($invoice_id);

  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Encontrar coincidencia en las compras para evital que se agreguen dos servicios iguales al detalle
 */

if ($_POST['action'] == "buscarCoincidencia") {

  $db = Database::connect();

  $service_id = $_POST['service_id'];
  $invoice_id = $_POST['invoice_id'];

  // Verificar si existe el servicio en el detalle 

    $query = "SELECT *FROM service_detail WHERE service_invoice_id = '$invoice_id' AND service_id = '$service_id'";
    $datos = $db->query($query);

    $result = $datos->fetch_assoc();
    echo $result['service_id'];
  
};

/**
 * Eliminar factura cuanto su detalle este vacío
 ----------------------------------------------------------*/

function deleteInvoiceNull($invoice_id)
{

  $db = Database::connect();

  $query = "SELECT count(service_invoice_id) as 'quantity_detail' FROM service_detail WHERE service_invoice_id = '$invoice_id'";
  $datos = $db->query($query);

  $result = $datos->fetch_object();
  $quantity = $result->quantity_detail;

  if ($quantity < 1) {

    $query = "DELETE FROM service_invoices WHERE service_invoice_id = '$invoice_id'";
    $datos = $db->query($query);
  }


}


/**
 * Desactivar Factura
 ----------------------------------------------*/

 if ($_POST['action'] == "desactivarFactura") {
  $db = Database::connect();

  $invoice_id = $_POST['invoiceID'];

  $query = "SELECT * FROM status WHERE status_name = 'Anulada'";
  $datos = $db->query($query);

  $element = $datos->fetch_object();
  $statusID = $element->status_id;

  $query2 = "UPDATE service_invoices SET status_id = $statusID WHERE service_invoice_id = '$invoice_id'";
  if ($db->query($query2) === TRUE) {

    // Restaurar items de la factura sin borrarlos
      $query3 .= "UPDATE service_invoices SET money_received = '0', pending = '0' WHERE service_invoice_id = '$invoice_id'";
      if ($db->multi_query($query3) === TRUE) {

        echo "Actualizado";

      } else {

        echo "Error: " . $db->error;
      }
  
  } else {

    echo "Error: " . $db->error;
  }
}


/**
 * Desactivar servicio
 ----------------------------------------------*/

 if ($_POST['action'] == "desactivar-servicio") {
  $db = Database::connect();

  $service_id = $_POST['service_id'];

  $query = "SELECT * FROM status WHERE status_name = 'Inactivo'";
  $datos = $db->query($query);

  $element = $datos->fetch_object();
  $statusID = $element->status_id;

  $query2 = "UPDATE services SET status_id = $statusID WHERE service_id = '$service_id'";
  if ($db->query($query2) === TRUE) {

    echo "listo";
  
  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Activar servicio
 ----------------------------------------------*/

 if ($_POST['action'] == "activar-servicio") {
  $db = Database::connect();

  $service_id = $_POST['service_id'];

  $query = "SELECT * FROM status WHERE status_name = 'Activo'";
  $datos = $db->query($query);

  $element = $datos->fetch_object();
  $statusID = $element->status_id;

  $query2 = "UPDATE services SET status_id = $statusID WHERE service_id = '$service_id'";
  if ($db->query($query2) === TRUE) {

    echo "listo";
  
  } else {

    echo "Error: " . $db->error;
  }
}