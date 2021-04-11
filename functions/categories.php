<?php

require_once '../config/db.php';


if ($_POST['action'] == "agregarCategoria") {

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $user_id = $_POST['userID'];
  
    $db = Database::connect();
  
    $query = "INSERT INTO categories VALUES (null,'$user_id','$name','$comment')";

    if ($db->query($query) === TRUE) {

      echo "ready";
      
    } else {
  
      echo "Error: " . $db->error;
    }
  }


  if ($_POST['action'] == "actualizar_categoria") {

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $category_id = $_POST['category_id'];
  
    $db = Database::connect();
  
    $query = "UPDATE categories SET category_name = '$name', observation = '$comment' WHERE category_id = '$category_id'";

    if ($db->query($query) === TRUE) {

      echo "ready";
      
    } else {
  
      echo "Error: " . $db->error;
    }
  }


  //  Eliminar categoría

if ($_POST['action'] == "eliminar_categoria") {

    $id = $_POST['category_id'];
  
    $db = Database::connect();
  
    $query = "DELETE FROM categories WHERE category_id = '$id'";
    
    if ($db->query($query) === TRUE) {

      echo "ready";

    } else {
  
      echo "Error: " . $db->error;
    }
  }