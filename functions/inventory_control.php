<?php

require_once '../config/db.php';

if ($_POST['action'] == "mostrarProductos") {

  $q = $_POST['query'];

  $db = Database::connect();

  $query = "SELECT *FROM products WHERE product_name = '$q'";
  $data = $db->query($query);

  $result = $data->fetch_assoc();
  echo json_encode($result, JSON_UNESCAPED_UNICODE);
}


/**
 * Crear ajuste de inventario
--------------------------------------------------- */

if ($_POST['action'] == 'crearAjuste') {

  $user_id = $_POST['userID'];
  $total_setting = $_POST['total_setting'];
  $observation = $_POST['observation'];

  $db = Database::connect();

  $query = "INSERT INTO item_settings VALUES (null,'$user_id','$total_setting','$observation',CURDATE())";

  if ($db->query($query) === TRUE) {

    $LAST_ID = $db->insert_id;
    echo $LAST_ID;

  } else {

    echo "Error: " . $db->error;
  }
}


if ($_POST['action'] == "agregarDetalleAlAjustes") {

  function update($AVG,$final_quantity,$product_id) {
    $db = Database::connect();
    
    $query = "UPDATE products SET price_in = $AVG, quantity = '$final_quantity' WHERE product_id = '$product_id';";
    if ($db->query($query) === TRUE) {

      echo "ready";
    } else {

      echo "Error: " . $db->error;
    }

  }

  $item_setting_id = $_POST['item_setting_id'];
  $product_id = $_POST['product_id'];
  $type_id = $_POST['type_id'];
  $type_name = $_POST['type_name'];
  $setting_quantity = $_POST['quantity'];
  $final_quantity = $_POST['final_quantity'];
  $price_in = $_POST['price_in'];

  $db = Database::connect();

  $query = "SELECT * FROM products WHERE product_id = '$product_id'";
  $datos = $db->query($query);

  $element = $datos->fetch_object();
  $previousCost = $element->price_in; // Precio anterior del producto

  // Agregar detalle al ajuste
  $query = "INSERT INTO item_setting_details VALUES (null,'$item_setting_id','$type_id','$product_id',$previousCost,'$price_in','$setting_quantity');";
  if ($db->query($query) === TRUE) {

    // Calcular AVG de costo

   if($type_name == 'incremento') {

    $var1 = $element->quantity * $element->price_in; // Cantidad x costo del producto
    $var2 = $setting_quantity * $price_in; // Cantidad ajustada x nuevo costo ingresado en el ajuste
    $AVG = ($var1 + $var2) / $final_quantity;  // AVG

    update($AVG,$final_quantity,$product_id);

   } else if ($type_name == 'descremento') {

    $var1 = $element->quantity * $element->price_in; // Cantidad x costo del producto
    $var2 = $setting_quantity * $price_in; // Cantidad ajustada x nuevo costo ingresado en el ajuste
    $total_quantity = $setting_quantity + $element->quantity;
    $AVG = ($var1 + $var2) / $total_quantity; // AVG

    update($AVG,$final_quantity,$product_id);
   }
    
  

   
  } else {

    echo "Error: " . $db->error;
  }
}

/**
 * Eliminar detalles del ajuste
 ---------------------------------------*/

if ($_POST['action'] == 'EliminardetalleDelAjuste') {

  $db = Database::connect();

  $item_setting_id = $_POST['item_setting_id'];

  // Función para actualizar productos
  function update($quantity, $price_in, $product_id)
  {
    $db = Database::connect();

    $query2 = "UPDATE products SET quantity = $quantity, price_in = $price_in WHERE product_id = $product_id";
    $db->query($query2);
  }


  // Datos del detalle
  $query = "SELECT * FROM item_setting_details i 
  INNER JOIN type_item_settings t ON i.type_item_setting_id =  t.type_item_setting_id
  WHERE i.item_setting_id = '$item_setting_id'";
  $datos = $db->query($query);

  // Loop
  while ($element = $datos->fetch_object()) {

    $price_in = $element->previous_cost;
    $product_id = $element->product_id;
    $item_setting_detail_id = $element->item_setting_detail_id;

    $query1 = "SELECT *FROM products WHERE product_id = $product_id";
    $datos1 = $db->query($query1);

    $product = $datos1->fetch_object();

    // Verificar el tipo de ajuste

    if ($element->item_setting_name == 'incremento') {

      $quantity = $product->quantity - $element->setting_quantity;

      if ($quantity > 0) {

        update($quantity, $price_in, $product_id);

      } else if ($quantity <= 0) {

        update(0, $price_in, $product_id);

      }
    } else if ($element->item_setting_name == 'descremento') {

      $quantity = $product->quantity + $element->setting_quantity;
      update($quantity, $price_in, $product_id);
    }
  }

  // Borrar detalle del ajuste
  $query2 = "DELETE FROM item_setting_details WHERE item_setting_id = '$item_setting_id'";
  $db->query($query2);
}

// Eliminar Ajuste

if ($_POST['action'] == 'EliminarAjuste') {

  $db = Database::connect();
  $item_setting_id = $_POST['item_setting_id'];

  $query = "DELETE FROM item_settings WHERE item_setting_id = '$item_setting_id'";
  if ($db->query($query) === TRUE) {

    echo 1;
  } else {

    echo "Error: " . $db->error;
  }
}
