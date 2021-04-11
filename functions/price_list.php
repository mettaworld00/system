<?php

require_once '../config/db.php';

if ($_POST['action'] == 'agregarLista'){

    $name = $_POST['list_name'];
    $value = $_POST['list_value'];
    $comment = $_POST['list_comment'];
    $user_id = $_POST['userID'];
    
    $db = Database::connect();

    $query = "INSERT INTO price_lists VALUES (null,'$user_id','$name','$value','$comment')";

    if ($db->query($query) === TRUE){
      echo 1;
    } else {

        echo "Error: " . $db->error;
    }
}


// Actualizar lista de precios

if ($_POST['action'] == 'actualizar-lista'){

  $name = $_POST['list_name'];
  $value = $_POST['list_value'];
  $comment = $_POST['list_comment'];
  $list_id = $_POST['list_id'];
  
  $db = Database::connect();

  $query = "UPDATE price_lists 
          SET list_name = '$name', list_value = '$value',
              observation = '$comment' WHERE list_id = '$list_id'";

  if ($db->query($query) === TRUE){

    echo "ready";

  } else {

      echo "Error: " . $db->error;
  }
}

