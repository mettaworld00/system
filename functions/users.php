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

        } else {
            echo 'diferentes';
            
        }

    }

    $db = Database::connect();  

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


  if ($_POST['action'] == "logout"){
      
    session_destroy();

    echo "sesion cerrada";
  }




function login()
{
    $result = false;

    $username = $this->usuario;
    $password = $this->password;

    $query = "SELECT *FROM usuarios WHERE usuario = '$username'";
    $login = $this->db->query($query);

    if ($login && $login->num_rows == 1) {
        $usuario = $login->fetch_object();

        $verify = password_verify($password, $usuario->password);
        $verify2 = $password;   // verificar contraseña normal 

        if ($verify) {

            $result = $usuario;
            header("Location: " . base_url);
        } else  if ($verify2 == $usuario->password) {

            $result = $usuario;
            header("Location: " . base_url);
        } else {
            $result = false;
        }
        
    } else {
        $result = false;
    }

    return $result;
}



// if ($db->query($query) === TRUE) {
//     echo 'Approved';
//   } else {

//     echo "Error: " . $db->error;
//   }
