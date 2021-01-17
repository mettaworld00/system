<?php

require_once '../config/db.php';


if ($_POST['action'] == "agregarCategoria") {

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $user_id = $_POST['userID'];
  
    $db = Database::connect();
  
    $query = "INSERT INTO categories VALUES (null,'$user_id','$name','$comment')";

    if ($db->query($query) === TRUE) {
      echo 1;
    } else {
  
      echo "Error: " . $db->error;
    }
  }


  //  Eliminar categoría

if ($_POST['action'] == "eliminarCategoria") {

    $id = $_POST['id'];
  
    $db = Database::connect();
  
    $query = "DELETE FROM categories WHERE category_id = '$id'";
    
    if ($db->query($query) === TRUE) {
      echo 1;
    } else {
  
      echo "Error: " . $db->error;
    }
  }