<?php 

require_once '../config/db.php';

/**
 * Iniciar sesión
 --------------------------------------------------------------*/

session_start();

if ($_POST['action'] == "login") {

    function verifyCredentials($passwordDB , $password, $data){

        if($passwordDB == $password){

        $_SESSION['identity'] = $data;

        echo "approved";

        } else {
            echo 'denied';
            
        }

    }

    $db = Database::access($_POST['key']);  

   $username = $db->real_escape_string($_POST['user']);
   $password = $_POST['password'];

    $query = "SELECT *FROM users WHERE username = '$username'";
    $login = $db->query($query);

    if ($login && $login->num_rows == 1) {
        $userData = $login->fetch_object();

      // Verificar contraseña
       verifyCredentials($userData->password, $password, $userData);



    } else {
        echo 'no encontrado';
    }
   
  }


  /**
   * Cerrar sesión
   -------------------------------------------------------------*/

  if ($_POST['action'] == "logout"){
      
    session_destroy();

    echo "ready";
  }






// if ($db->query($query) === TRUE) {
//     echo 'Approved';
//   } else {

//     echo "Error: " . $db->error;
//   }
