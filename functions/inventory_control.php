<?php

require_once '../config/db.php';

if ($_POST['action'] == "mostrarProductos") {

    $q = $_POST['query'];

    $db = Database::connect();

    $query = "SELECT *FROM products WHERE product_name LIKE '%" . $q . "%'";
    $data = $db->query($query);

    $result = $data->fetch_assoc();
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}





/**
 * Crear ajuste de inventario
--------------------------------------------------- */

if ($_POST['action'] == 'crearAjuste') {

    $user_id = 1;
    $total_setting = $_POST['total_setting'];
    $total_quantity = $_POST['total_quantity'];
    $observation = $_POST['observation'];

    $db = Database::connect();

    $query = "INSERT INTO item_settings VALUES (null,$user_id,'$total_quantity','$total_setting','$observation',CURDATE())";

    if ($db->query($query) === TRUE) {

        $LAST_ID = $db->insert_id;
        echo $LAST_ID;
      
      } else {

        echo "Error: " . $db->error;
      }
  
}


if ($_POST['action'] == "agregarDetalleDeAjustes") {

    $item_setting_id = $_POST['item_setting_id'];
    $product_id = $_POST['product_id'];
    $type_id = $_POST['type_id'];
    $quantity = $_POST['quantity'];
    $final_quantity = $_POST['final_quantity'];
    $price_out = $_POST['price_out'];

    $db = Database::connect();

    // Agregar detalle

    $query = "INSERT INTO item_setting_details VALUES (null,'$item_setting_id','$type_id','$product_id','$price_out','$quantity');";

    // Editar producto

    $query .= "UPDATE products SET price_out = '$price_out', quantity = '$final_quantity' WHERE product_id = '$product_id';";

    if ($db->multi_query($query) === TRUE) {

      echo 1;
      
      } else {

        echo "Error: " . $db->error;
      }
  
}



