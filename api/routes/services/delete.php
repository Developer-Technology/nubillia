<?php

require_once "models/connection.php";
require_once "controllers/delete.controller.php";

if(isset($_GET["id"]) && isset($_GET["nameId"])){

	$columns = array($_GET["nameId"]);

	/*=============================================
	Validar la tabla y las columnas
	=============================================*/

	if(empty(Connection::getColumnsData($table, $columns))){

		$json = array(
		 	'status' => 400,
		 	'results' => "Error: Los campos del formulario no coinciden con la base de datos"
		);

		echo json_encode($json, http_response_code($json["status"]));

		return;

	}

	/*=============================================
	Peticion DELETE para usuarios autorizados
	=============================================*/

	if(isset($_GET["token"])){

		$tableToken = $_GET["table"] ?? "users";
		$suffix = $_GET["suffix"] ?? "user";

		$validate = Connection::tokenValidate($_GET["token"],$tableToken,$suffix);

		/*=============================================
		Solicitamos respuesta del controlador para eliminar datos en cualquier tabla
		=============================================*/	
			
		if($validate == "ok"){
	
			$response = new DeleteController();
			$response -> deleteData($table,$_GET["id"],$_GET["nameId"]);

		}

		/*=============================================
		Error cuando el token ha expirado
		=============================================*/	

		if($validate == "expired"){

			$json = array(
			 	'status' => 303,
			 	'results' => "Error: el token ha caducado"
			);

			echo json_encode($json, http_response_code($json["status"]));

			return;

		}

		/*=============================================
		Error cuando el token no coincide en BD
		=============================================*/	

		if($validate == "no-auth"){

			$json = array(
			 	'status' => 400,
			 	'results' => "Error: El usuario no está autorizado"
			);

			echo json_encode($json, http_response_code($json["status"]));

			return;

		}

	/*=============================================
	Error cuando no envía token
	=============================================*/	

	}else{

		$json = array(
		 	'status' => 400,
		 	'results' => "Error: se requiere autorización"
		);

		echo json_encode($json, http_response_code($json["status"]));

		return;	

	}	

}

