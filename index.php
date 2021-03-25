<?php
session_start();
require_once 'autoload.php';
require_once 'help.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'views/layout/header.php';




if (isset($_GET['controller']) && isset($_GET['action'])) {
    
    $CONTROLLER_NAME = $_GET['controller'] . 'Controller';
    
} else if (!isset($_GET['controller']) || !isset($_GET['action'])) {
    $CONTROLLER_NAME = DEFAULT_CONTROLLER;
}

if (class_exists($CONTROLLER_NAME)) {

    $CLASSNAME = new $CONTROLLER_NAME();

    if (isset($_GET['action']) && method_exists($CLASSNAME, $_GET['action'])) {

        $ACTION = $_GET['action'];
        $CLASSNAME->$ACTION();

    } else if (!method_exists($CLASSNAME, $_GET['action'])) {

        $DEFAULT_CONTROLLER = DEFAULT_CONTROLLER;
		$DEFAULT_ACTION = DEFAULT_ACTION;

        $CLASSNAME = new $DEFAULT_CONTROLLER();
        
        $CLASSNAME->$DEFAULT_ACTION();
    }
} 




require_once 'views/layout/footer.php';
