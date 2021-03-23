<?php

require_once '../config/db.php';
session_start();

/**
 * Generar No. factura
 ----------------------------------*/

if ($_POST['action'] == "generarNoFactura") {

  $query = "SELECT invoice_id FROM invoices order by invoice_id desc LIMIT 1;";
  $db = Database::connect();

  $datos = $db->query($query);
  $result = $datos->fetch_object();

  if ($datos->num_rows < 1) {

    $nofactura = 1;
    echo $nofactura;
  } else {

    $nofactura = $result->invoice_id + 1;
    echo $nofactura;
  }
}

/**
 * Buscar producto por nombre
 ---------------------------------------------*/

if ($_POST['action'] == "buscarItemPorNombre") {

  $q = $_POST['product_name'];
  $db = Database::connect();

  $query1 = "SELECT *FROM products WHERE product_name = '$q'";

  $query2 = "SELECT d.discount_value, t.tax_value, t.tax_name FROM products p 
             LEFT JOIN products_discounts pd ON p.product_id = pd.product_id
             LEFT JOIN discounts d ON pd.discount_id = d.discount_id 
             LEFT JOIN products_taxes pt ON p.product_id = pt.product_id
             LEFT JOIN taxes t ON pt.tax_id = t.tax_id
             WHERE p.product_name = '$q'";

  $datos1 = $db->query($query1);
  $datos2 = $db->query($query2);
  $result1 = $datos1->fetch_assoc();
  $result2 = $datos2->fetch_assoc();

  $arr = [$result1, $result2];

  echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  exit;
}

/**
 * Buscar producto por código
 ----------------------------------------*/

if ($_POST['action'] == "buscarItem") {

  $q = $_POST['product_code'];
  $db = Database::connect();

  $warehouseID = $_SESSION['identity']->warehouse_id;
  $query1 = "SELECT *FROM products WHERE product_code LIKE '%$q%' AND warehouse_id = $warehouseID";

  $query2 = "SELECT d.discount_value, t.tax_value, t.tax_name FROM products p 
             INNER JOIN warehouses w on p.warehouse_id = w.warehouse_id
             LEFT JOIN products_discounts pd ON p.product_id = pd.product_id
             LEFT JOIN discounts d ON pd.discount_id = d.discount_id 
             LEFT JOIN products_taxes pt ON p.product_id = pt.product_id
             LEFT JOIN taxes t ON pt.tax_id = t.tax_id
             WHERE p.product_code LIKE '%$q%' AND w.warehouse_id = $warehouseID";

  $datos1 = $db->query($query1);
  $datos2 = $db->query($query2);
  $result1 = $datos1->fetch_assoc();
  $result2 = $datos2->fetch_assoc();

  $arr = [$result1, $result2];

  echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  exit;
}

/**
 * Agregar al detalle temporar
 ---------------------------------------------*/

if ($_POST['action'] == "agregarItem") {

  $user_id = $_POST['userID'];
  $product_id = $_POST['product_id'];
  $total_price = $_POST['total_price'];
  $quantity = $_POST['quantity'];
  $discount = $_POST['discount'];
  $tax = $_POST['tax'];

  $db = Database::connect();

  $query = "INSERT INTO temp_detail VALUES (null,'$product_id','$user_id','$quantity','$total_price','$discount','$tax')";

  if ($db->query($query) === TRUE) {
    echo 1;
  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Obtener datos del detalle temporar
 ----------------------------------------*/

if ($_POST['action'] == "obtenerDetalleTemp") {

  $db = Database::connect();

  $user_id = $_POST['userID'];

  $query = "SELECT sum(total_price) AS 'total', sum(discount) AS 'total_discount', sum(tax) AS 'tax' ,user_id FROM temp_detail WHERE user_id = '$user_id'";

  $datos = $db->query($query);
  $result = $datos->fetch_assoc();

  echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

/**
 * Obtener datos del detalle
 ----------------------------------------*/

if ($_POST['action'] == "obtenerDetalle") {

  $db = Database::connect();

  $invoice_id = $_POST['invoice_id'];

  $query = "SELECT sum(total_price) AS 'total', sum(discount) AS 'total_discount', sum(tax) AS 'tax', invoice_id FROM invoice_detail WHERE invoice_id = '$invoice_id'";

  $datos = $db->query($query);
  $result = $datos->fetch_assoc();

  echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

/**
 * Eliminar item del detalle
 *------------------------------------- */

if ($_POST['action'] == 'eliminarItem') {

  $id = $_POST['idItem'];

  $db = Database::connect();

  $query = "DELETE FROM temp_detail WHERE temp_detail_id = '$id'";
  $datos = $db->query($query);

  echo 1;
}

/**
 * Reducir stock
 -------------------------------------------------------*/

if ($_POST['action'] == 'reducirStock') {

  $reduce = $_POST['reduce'];
  $product_id = $_POST['product_id'];

  $db = Database::connect();

  $query = "UPDATE products SET quantity = '$reduce' WHERE product_id = '$product_id'";

  if ($db->query($query) === TRUE) {
    echo 1;
  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Recuperar stock
 ------------------------------*/

if ($_POST['action'] == 'recoveryStock') {

  $recovery = $_POST['recovery'];
  $product_id = $_POST['product_id'];

  $db = Database::connect();

  $query = "UPDATE products SET quantity = '$recovery' WHERE product_id = '$product_id'";
  $datos = $db->query($query);


  $result = $datos->fetch_assoc();

  echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

/**
 * Encontrar coincidencia en los detalles para evital que se agreguen dos productos iguales al detalle
 */

if ($_POST['action'] == "buscarCoincidencia") {

  $product_id = $_POST['product_id'];
  $invoice_id = $_POST['invoice_id'];


  $db = Database::connect();

  // Verificar si existe en el detalle temporar

  if ($invoice_id < 1) {

    $user_id = $_POST['userID'];

    $query = "SELECT *FROM temp_detail WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $datos = $db->query($query);

    if ($datos->num_rows > 0) {

      $result = $datos->fetch_assoc();
      echo $result['product_id'];

    }

    
    // verificar si existe en el detalle de la factura

  } else if ($invoice_id > 0) {

    $query = "SELECT *FROM invoice_detail WHERE invoice_id = '$invoice_id' AND product_id = '$product_id'";
    $datos = $db->query($query);

    $result = $datos->fetch_assoc();
    echo $result['product_id'];
  }
};

/**
 * Procesar venta
 -------------------------------------*/

if ($_POST['action'] == 'procesarVenta') {

  $db = Database::connect();

  $status = 4; // 3 = Pagada
  $warehouseID = $_SESSION['identity']->warehouse_id;
  $customer_id = $_POST['customer_id'];
  $user_id = $_POST['user_id'];
  $payment_method = $_POST['payment_method'];
  $total_invoice = $_POST['purchase'];
  $noInvoice = $_POST['noinvoice'];
  $created_at = $_POST['created_at'];
  $expiration = $_POST['expiration'];

  $query = "INSERT INTO invoices VALUES (null,'$noInvoice','$warehouseID','$payment_method',$status,'$customer_id','$user_id','$total_invoice','$total_invoice',null,'$expiration','$created_at')";

  if ($db->query($query) === TRUE) {

    $INVOICE_ID = $db->insert_id;

    // Crear Detalle de factura

    $query1 = "SELECT * FROM temp_detail ";
    $datos = $db->query($query1);

    while ($element = $datos->fetch_object()) {

      $product_id = $element->product_id;
      $total_price = $element->total_price;
      $discount = $element->discount;
      $total_quantity = $element->total_quantity;
      $tax = $element->tax;

      $query2 = "INSERT INTO invoice_detail VALUES (null,$product_id,$INVOICE_ID,$user_id,$total_quantity,$total_price,$discount,$tax,curdate())";
      if ($db->query($query2) === TRUE) {

        echo $INVOICE_ID; // ID de la factura

      } else {

        echo "Error: " . $db->error;
      }
    }
  } else {

    echo "Error: " . $db->error;
  }

  $query3 = "DELETE FROM temp_detail WHERE user_id = '$user_id'";
  $db->query($query3);
}




/** 
 *  Anular venta 
 ------------------------------------------------------------------- */

if ($_POST['action'] == "anularVenta") {

  $db = Database::connect();

  $user_id = $_POST['userID'];

  $query = "SELECT * FROM temp_detail";
  $datos = $db->query($query);


  while ($result = $datos->fetch_object()) {

    $product_id = $result->product_id;
    $total_quantity = $result->total_quantity;

    restoreItems($product_id, $total_quantity); // Proceso
  }

  $query1 = "DELETE FROM temp_detail WHERE user_id = '$user_id'";
  $db->query($query1);


  echo "listo";
}

/**
 * Restaurar item del detalle 
 ----------------------------------------------- */

function restoreItems($product_id, $quantity)
{
  $db = Database::connect();

  $query = "SELECT *FROM products WHERE product_id = $product_id";
  $datos = $db->query($query);

  while ($product = $datos->fetch_object()) {

    $detail_quantity = $quantity;
    $stock = $product->quantity;

    $recovery = $stock + $detail_quantity;


    $query = "UPDATE products SET quantity = $recovery WHERE product_id = $product_id";
    $db->query($query);
  }

  return true;
}

/**
 * Eliminar item del detalle
 -----------------------------------------------------------*/

if ($_POST['action'] == 'eliminarDetalle') {

  $id = $_POST['invoice_detail_id'];

  $db = Database::connect();

  $query = "DELETE FROM invoice_detail WHERE invoice_detail_id = '$id'";
  if ($db->query($query) === TRUE) {

    echo 1;
  } else {

    echo "Error: " . $db->error;
  }
}




/**
 * Agregar productos al detalle de la factura
 * 
 */

if ($_POST['action'] == "agregarCompra") {

  $invoice_id = $_POST['invoice_id'];
  $product_id = $_POST['product_id'];
  $total_price = $_POST['total_price'];
  $quantity = $_POST['quantity'];
  $discount = $_POST['discount'];
  $user_id = $_POST['userID'];
  $tax = $_POST['tax'];

  $db = Database::connect();

  $query = "INSERT INTO invoice_detail VALUES (null,'$product_id','$invoice_id','$user_id','$quantity','$total_price','$discount','$tax',curdate())";
  if ($db->query($query) === TRUE) {
    echo "listo";
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

  $query1 = "SELECT sum(total_price) as 'total_invoice' FROM invoice_detail WHERE invoice_id = '$invoice_id'";
  $datos1 = $db->query($query1);

  $element = $datos1->fetch_object();
  $total_invoice = $element->total_invoice; // Total de la factura
  

 $query2 = "SELECT  *FROM invoices WHERE invoice_id = '$invoice_id'";
 $datos2 = $db->query($query2);
 $element2 = $datos2->fetch_object();

 $money_received = $element2->money_received; // Total recibido
 $pending = $total_invoice - $money_received; // Total pendiente


  $query3 = "UPDATE invoices SET total_invoice = $total_invoice, pending = $pending 
  WHERE invoice_id = '$invoice_id'";
  if ($db->query($query3) === TRUE) {
    
    deleteInvoiceNull($invoice_id);

  } else {

    echo "Error: " . $db->error;
  }

 
}

/**
 * Eliminar factura cuanto su detalle este vacío
 ----------------------------------------------------------*/

function deleteInvoiceNull($invoice_id)
{

  $db = Database::connect();

  $query = "SELECT count(invoice_id) as 'quantity_detail' FROM invoice_detail WHERE invoice_id = '$invoice_id'";
  $datos = $db->query($query);

  $result = $datos->fetch_object();
  $quantity = $result->quantity_detail;

  if ($quantity < 1) {

    $query = "DELETE FROM invoices WHERE invoice_id = '$invoice_id'";
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

  $query2 = "UPDATE invoices SET status_id = $statusID WHERE invoice_id = '$invoice_id'";
  if ($db->query($query2) === TRUE) {

    // Restaurar items de la factura sin borrarlos

    $query3 = "SELECT * FROM invoice_detail i 
    INNER JOIN products p ON i.product_id = p.product_id
    WHERE invoice_id = '$invoice_id'";

    $datos2 = $db->query($query3);
    while ($element2 = $datos2->fetch_object()) {

      $total_quantity = $element2->total_quantity; // Cantidad agregada
      $quantity = $element2->quantity; // Cantidad real del producto
      $product_id = $element2->product_id; // Id producto

      $sum =  $quantity + $total_quantity; // Suma

      $query4 = "UPDATE products SET quantity = $sum WHERE product_id = $product_id;";
      $query4 .= "UPDATE invoices SET money_received = '0', pending = '0' WHERE invoice_id = '$invoice_id'";
      if ($db->multi_query($query4) === TRUE) {

        echo "Actualizado";

      } else {

        echo "Error: " . $db->error;
      }
    }
  } else {

    echo "Error: " . $db->error;
  }
}

