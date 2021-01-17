<?php

require_once '../config/db.php';

/**
 * Buscar contacto
 ------------------------------------------------------------*/

if ($_POST['action'] == 'buscarCliente') {

  $q = $_POST['customer'];
  $db = Database::connect();

  $query = "SELECT *FROM customers WHERE customer_name LIKE '%" . $q . "%'";
  $datos = $db->query($query);

  $result = $datos->fetch_assoc();
  echo json_encode($result, JSON_UNESCAPED_UNICODE);
  exit;
}

/**
 * Crear contacto
 ------------------------------*/

if ($_POST['action'] == 'crearContacto') {

  $user_id = 1;
  $name = $_POST['name'];
  $rnc = $_POST['rnc'];
  $email = $_POST['email'];
  $tel1 = $_POST['tel1'];
  $tel2 = $_POST['tel2'];

  $db = Database::connect();

  $query = "INSERT INTO customers VALUES (null,$user_id,'$name','$email','$tel1','$tel2','$rnc',CURDATE())";

  if ($db->query($query) === TRUE) {

    echo 1;
  } else {

    echo "Error : " . $db->error;
  }
}

// Crear contacto desconocido

if ($_POST['action'] == 'CrearClienteDesconocido') {

  $user_id = 1;

  $db = Database::connect();

  $find = "SELECT *FROM customers WHERE customer_name = '-'";
  $datos = $db->query($find);

  if ($datos->num_rows > 0) {

    $result = $datos->fetch_object();
    echo $result->customer_id; // Id del cliente desconocido

  } else {

    $query = "INSERT INTO customers VALUES (null,$user_id,'-',null,null,null,null,CURDATE())";

    if ($db->query($query) === TRUE) {

      $LAST_ID = $db->insert_id;
      echo $LAST_ID;

    } else {

      echo "Error : " . $db->error;
    }
  }
}

// Eliminar cliente 

if (isset($_POST['customer_id'])) {
  $customer_id = $_POST['customer_id'];

  $db = Database::connect();

  $query = "DELETE FROM customers WHERE customer_id = '$customer_id'";
  $datos = $db->query($query);

  echo 1;
}
