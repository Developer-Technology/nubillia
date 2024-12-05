<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

require_once "models/connection.php";
require_once "controllers/put.controller.php";

if(isset($_GET["id"]) && isset($_GET["nameId"])){

	/*=============================================
	Capturamos los datos del formulario
	=============================================*/
	
	$data = array();
	parse_str(file_get_contents('php://input'), $data);
		
	/*=============================================
	Separar propiedades en un arreglo
	=============================================*/

	$columns = array();
		
	foreach (array_keys($data) as $key => $value) {

		array_push($columns, $value);
		
	}

	array_push($columns, $_GET["nameId"]);

	$columns = array_unique($columns);

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

	if(isset($_GET["token"])){

		/*=============================================
		Peticion POST para usuarios no autorizados
		=============================================*/

		if($_GET["token"] == "no-token"){

			$response = new PutController();
			$response -> putData($table,$data,$_GET["id"],$_GET["nameId"]);

			return;

		}

		if($_GET["token"] == "no" && isset($_GET["except"])){

			/*=============================================
			Validar la tabla y las columnas
			=============================================*/

			$columns = array($_GET["except"]);

			if(empty(Connection::getColumnsData($table, $columns))){

				$json = array(
				 	'status' => 400,
				 	'results' => "Error: Los campos del formulario no coinciden con la base de datos"
				);

				echo json_encode($json, http_response_code($json["status"]));

				return;

			}

			/*=============================================
			Solicitamos respuesta del controlador para crear datos en cualquier tabla
			=============================================*/		

			$response = new PutController();
			$response -> putData($table,$data,$_GET["id"],$_GET["nameId"]);
			
		/*=============================================
		Peticion PUT para usuarios autorizados
		=============================================*/

		}else{

			$tableToken = $_GET["table"] ?? "users";
			$suffix = $_GET["suffix"] ?? "user";

			$validate = Connection::tokenValidate($_GET["token"],$tableToken,$suffix);

			/*=============================================
			Solicitamos respuesta del controlador para editar datos en cualquier tabla
			=============================================*/		

			if($validate == "ok"){
				
				$response = new PutController();
				$response -> putData($table,$data,$_GET["id"],$_GET["nameId"]);

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
				 	'results' => "Error: el usuario no está autorizado"
				);

				echo json_encode($json, http_response_code($json["status"]));

				return;

			}

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