<?php

class Database
{

	public static function connect()
	{
		$db = new mysqli('localhost', 'root', '', 'dbsystem');
		$db->query("SET NAMES 'utf8'");

		if ($db->connect_errno) {
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}

		return $db;
	}

	public static function access($key)
	{

		if ($key == "prueba") {

			$db = new mysqli('localhost', 'root', '', 'dbsystem');
			$db->query("SET NAMES 'utf8'");

			if ($db->connect_errno) {
				printf("Connect failed: %s\n", $db->connect_error);
				exit();
			}

			return $db;

		} else if ($key == "prueba2") {

			$db = new mysqli('localhost', 'root', '', 'dbsystem2');
			$db->query("SET NAMES 'utf8'");

			if ($db->connect_errno) {
				printf("Connect failed: %s\n", $db->connect_error);
				exit();
			}

			return $db;

		}
	}
}













// public static function connect(){
// 	$db = new mysqli('localhost', 'root', '', 'dbsystem');
// 	$db->query("SET NAMES 'utf8'");

// 	if ($db->connect_errno) {
// 		printf("Connect failed: %s\n", $db->connect_error);
// 		exit();
// 	}

// 	return $db;
// }