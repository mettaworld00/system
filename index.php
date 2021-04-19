<?php
session_start();
require_once 'autoload.php';
require_once 'help.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'views/layout/header.php';


function PAGE_INDEX($CONTROLLER_NAME) 
{
    if (class_exists($CONTROLLER_NAME)) {


        $CLASSNAME = new $CONTROLLER_NAME();
    
        if (isset($_GET['action']) && method_exists($CLASSNAME, $_GET['action'])) {
            // Solo si el CONTROLLER y el ACTION son correctos
    
            $ACTION = $_GET['action'];
            $CLASSNAME->$ACTION();
    
        } else if (isset($_GET['action'])) {
            // Si el ACTION no existe
    
            $DEFAULT_CONTROLLER = DEFAULT_CONTROLLER;
            $NO_FOUND = NO_FOUND;
    
            $CLASSNAME = new $DEFAULT_CONTROLLER();
            
            $CLASSNAME->$NO_FOUND();
        } 
    } 
}

if (isset($_GET['controller']) && isset($_GET['action'])) {
    
    $CONTROLLER_NAME = $_GET['controller'] . 'Controller';
    PAGE_INDEX($CONTROLLER_NAME);
    
    
} else if (!isset($_GET['controller']) || !isset($_GET['action'])) {

    // Sin datos en la URL
    
    $CONTROLLER_NAME = DEFAULT_CONTROLLER;
    $ACTION = DEFAULT_ACTION;

    $CLASSNAME = new $CONTROLLER_NAME();
    $CLASSNAME->$ACTION();
 
}






// method_exists($CLASSNAME, $_GET['action'])

require_once 'views/layout/footer.php';
