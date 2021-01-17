<?php

require_once '../config/db.php';


if ($_POST['action'] == "agregarImpuesto") {

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $value = $_POST['value'];
    $user_id = $_POST['userID'];
  
    $db = Database::connect();
  
    $query = "INSERT INTO taxes VALUES (null,'$user_id','$name','$value','$comment')";

    if ($db->query($query) === TRUE) {
      echo 1;
    } else {
  
      echo "Error: " . $db->error;
    }
  }


  //  Eliminar Impuesto

if ($_POST['action'] == "eliminarImpuesto") {

    $id = $_POST['id'];
  
    $db = Database::connect();
  
    $query = "DELETE FROM taxes WHERE tax_id = '$id'";
    
    if ($db->query($query) === TRUE) {

      echo 1;

    } else {
  
      echo "Error: " . $db->error;
    }
  }