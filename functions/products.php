<?php

require_once '../config/db.php';


//  Eliminar producto

if ($_POST['action'] == "eliminarProducto") {

  $id = $_POST['product_id'];

  $db = Database::connect();

  $query = "DELETE FROM products WHERE product_id = '$id'";
  if ($db->query($query) === TRUE) {
    echo 1;
  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Agregar producto
------------------------------------------- */

if ($_POST['action'] == "agregarProducto") {

  $db = Database::connect();

  $getStatus = "SELECT * FROM status WHERE status_name = 'Activo'";
  $datos = $db->query($getStatus);

  $element = $datos->fetch_object();

  $statusID = $element->status_id;
  $userID = $_POST['userID'];
  $product_code = $_POST['product_code'];
  $name = $_POST['name'];
  $price_in = $_POST['price_in'];
  $price_out = $_POST['price_out'];
  $quantity = $_POST['quantity'];
  $min_quantity = $_POST['min_quantity'];
  $expiration = $_POST['expiration'];
  $tax_id = $_POST['tax'];
  $unit_id = $_POST['unit'];
  $category_id = $_POST['category'];
  $warehouse_id = $_POST['warehouse'];

  $query = "INSERT INTO products VALUES (null,'$userID','$warehouse_id','$unit_id',$statusID,'$product_code','$name','$price_in','$price_out','$quantity','$min_quantity','$expiration',CURDATE())";

  if ($db->query($query) === TRUE) {

    $LAST_ID = $db->insert_id;
    echo $LAST_ID;

    function insertIntoDB($query)
    {

      $db = Database::connect();

      if ($db->query($query) === TRUE) {
      } else {

        echo "Error: " . $db->error;
      }
    }


    if ($_POST['tax'] != "") {
      $query = "INSERT INTO products_taxes VALUES ($LAST_ID,'$tax_id');";
      insertIntoDB($query);
    }

    if ($_POST['category'] != "") {
      $query = "INSERT INTO products_categories VALUES ($LAST_ID,'$category_id');";
      insertIntoDB($query);
    }

  } else {

    echo "Error: " . $db->error;
  }
}


if ($_POST['action'] == 'agregarPreciosAlProducto') {

  $product_id = $_POST['product_id'];
  $list_id = $_POST['list_id'];

  $db = Database::connect();

  $query = "INSERT INTO products_price_lists VALUES ('$list_id','$product_id');";

  if ($db->query($query) === TRUE) {
    echo 1;
  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Actualizar producto
 -------------------------------------*/

if ($_POST['action'] == "actualizarProducto") {

  $userID = 1;
  $product_id = $_POST['product_id'];
  $product_code = $_POST['product_code'];
  $name = $_POST['name'];
  $price_in = $_POST['price_in'];
  $price_out = $_POST['price_out'];
  $quantity = $_POST['quantity'];
  $min_quantity = $_POST['min_quantity'];
  $tax_id = $_POST['tax'];
  $unit_id = $_POST['unit'];
  $category_id = $_POST['category'];
  $warehouse_id = $_POST['warehouse'];
  $status_id = 1; // activo

  $db = Database::connect();

  $query = "UPDATE products SET 
  user_id = $userID, status_id = '$status_id', product_code = '$product_code',
  product_name = '$name', price_in = '$price_in',
  price_out = '$price_out', quantity = '$quantity',
  inventary_min = '$min_quantity' WHERE product_id = '$product_id';";

  $query .= "UPDATE products_categories SET category_id = '$category_id' WHERE product_id = '$product_id';";
  $query .= "UPDATE products_taxes SET tax_id = '$tax_id' WHERE product_id = '$product_id';";
  $query .= "UPDATE products_warehouses SET warehouse_id = '$warehouse_id' WHERE product_id = '$product_id';";

  if ($db->multi_query($query) === TRUE) {
    echo 1;
  } else {

    echo "Error: " . $db->error;
  }
}


/**
 * Buscar Impuesto
 -------------------------------*/

if ($_POST['action'] == 'buscarImpuesto') {

  $tax_name = $_POST['tax'];

  $db = Database::connect();

  $query = "SELECT *FROM taxes WHERE tax_name = '$tax_name'";
  $data = $db->query($query);

  $element = $data->fetch_assoc();
  echo json_encode($element, JSON_UNESCAPED_UNICODE);
}


/**
 * Desactivar Factura
 ----------------------------------------------*/

 if ($_POST['action'] == "desactivarProducto") {
  $db = Database::connect();

  $product_id = $_POST['productID'];

  $query = "SELECT * FROM status WHERE status_name = 'Inactivo'";
  $datos = $db->query($query);

  $element = $datos->fetch_object();
  $statusID = $element->status_id;

  $query2 = "UPDATE products SET status_id = $statusID WHERE product_id = '$product_id'";
  if ($db->query($query2) === TRUE) {

    echo "listo";
  
  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Activar Factura
 ----------------------------------------------*/

 if ($_POST['action'] == "activarProducto") {
  $db = Database::connect();

  $product_id = $_POST['productID'];

  $query = "SELECT * FROM status WHERE status_name = 'Activo'";
  $datos = $db->query($query);

  $element = $datos->fetch_object();
  $statusID = $element->status_id;

  $query2 = "UPDATE products SET status_id = $statusID WHERE product_id = '$product_id'";
  if ($db->query($query2) === TRUE) {

    echo "listo";
  
  } else {

    echo "Error: " . $db->error;
  }
}
