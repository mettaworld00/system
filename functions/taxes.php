<?php

require_once '../config/db.php';


if ($_POST['action'] == "agregar_impuesto") {

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $value = $_POST['value'];
    $user_id = $_POST['userID'];
  
    $db = Database::connect();
  
    $query = "INSERT INTO taxes VALUES (null,'$user_id','$name','$value','$comment')";

    if ($db->query($query) === TRUE) {

      echo "ready";

    } else {
  
      echo "Error: " . $db->error;
    }
  }


  if ($_POST['action'] == "actualizar_impuesto") {

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $value = $_POST['value'];
    $tax_id = $_POST['tax_id'];
  
    $db = Database::connect();
  
    $query = "UPDATE taxes SET tax_name = '$name', tax_value = '$value', observation = '$comment' WHERE tax_id = '$tax_id'";

    if ($db->query($query) === TRUE) {

      echo "ready";

    } else {
  
      echo "Error: " . $db->error;
    }
  }


  //  Eliminar Impuesto

if ($_POST['action'] == "eliminar_impuesto") {

    $id = $_POST['tax_id'];
  
    $db = Database::connect();
  
    $query = "DELETE FROM taxes WHERE tax_id = '$id'";
    
    if ($db->query($query) === TRUE) {

      echo "ready";

    } else {
  
      echo "Error: " . $db->error;
    }
  }