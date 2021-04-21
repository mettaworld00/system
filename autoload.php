<?php

/**
 * Auto cargar las rutas de todos los controladores del sistemas
 */

function controllers_autoload($classname){

	$filename = $classname . '.php';
	$file = 'controllers/' . $filename;

	if (file_exists($file) != false) {
		include ($file);
	} else {
		echo "EL controlador no existe";
	}
	
}

spl_autoload_register('controllers_autoload');

