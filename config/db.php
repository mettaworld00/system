<?php

class Database
{

	public static function connect()
	{

		$SERVER_NAME = "localhost";
		$USER_NAME = "root";
		$PASSWORD = "";
		$DATABASE_NAME = $_SESSION['DATABASE_NAME'];

		$db = new mysqli($SERVER_NAME,$USER_NAME, $PASSWORD, $DATABASE_NAME);
		$db->query("SET NAMES 'utf8'");

		if ($db->connect_errno) {
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}

		return $db;
	}

	public static function access($key)
	{

		$SERVER_NAME = "localhost";
		$USER_NAME = "root";
		$PASSWORD = "";

		if ($key == "prueba") {

			$db = new mysqli($SERVER_NAME,$USER_NAME, $PASSWORD, 'dbsystem');
			$db->query("SET NAMES 'utf8'");

			if ($db->connect_errno) {
				printf("Connect failed: %s\n", $db->connect_error);
				exit();
			}

			$_SESSION['DATABASE_NAME'] = "dbsystem";
			return $db;

		} else if ($key == "prueba2") {

			$db = new mysqli($SERVER_NAME,$USER_NAME, $PASSWORD, 'dbsystem2');
			$db->query("SET NAMES 'utf8'");

			if ($db->connect_errno) {
				printf("Connect failed: %s\n", $db->connect_error);
				exit();
			}

			$_SESSION['DATABASE_NAME'] = "dbsystem2";
			return $db;

		} else if ($key == "prueba3") {

			$db = new mysqli($SERVER_NAME,$USER_NAME, $PASSWORD, 'dbsystem3');
			$db->query("SET NAMES 'utf8'");

			if ($db->connect_errno) {
				printf("Connect failed: %s\n", $db->connect_error);
				exit();
			}

			$_SESSION['DATABASE_NAME'] = "dbsystem2";
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