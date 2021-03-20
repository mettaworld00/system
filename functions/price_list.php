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
