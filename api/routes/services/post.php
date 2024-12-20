<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

require_once "models/connection.php";
require_once "controllers/post.controller.php";

if(isset($_POST)){

	/*=============================================
	Separar propiedades en un arreglo
	=============================================*/

	$columns = array();
	
	foreach (array_keys($_POST) as $key => $value) {

		array_push($columns, $value);
			
	}

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

	$response = new PostController();

	/*=============================================
	Peticion POST para registrar cliente
	=============================================*/	

	if(isset($_GET["registerC"]) && $_GET["registerC"] == true){

		$suffix = $_GET["suffix"] ?? "client";

		$response -> postRegisterC($table,$_POST,$suffix);

	/*=============================================
	Peticion POST para registrar usuario
	=============================================*/	

	}else if(isset($_GET["register"]) && $_GET["register"] == true){

		$suffix = $_GET["suffix"] ?? "user";

		$response -> postRegister($table,$_POST,$suffix);

	/*=============================================
	Peticion POST para login de usuario
	=============================================*/	

	}else if(isset($_GET["login"]) && $_GET["login"] == true){

		$suffix = $_GET["suffix"] ?? "user";

		$response -> postLogin($table,$_POST,$suffix);

	}else{


		if(isset($_GET["token"])){

			/*=============================================
			Peticion POST para usuarios no autorizados
			=============================================*/

			if($_GET["token"] == "no-token"){

				$response -> postData($table,$_POST);

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

				$response -> postData($table,$_POST);

			/*=============================================
			Peticion POST para usuarios autorizados
			=============================================*/

			}else{

				$tableToken = $_GET["table"] ?? "users";
				$suffix = $_GET["suffix"] ?? "user";

				$validate = Connection::tokenValidate($_GET["token"],$tableToken,$suffix);

				/*=============================================
				Solicitamos respuesta del controlador para crear datos en cualquier tabla
				=============================================*/		

				if($validate == "ok"){
		
					$response -> postData($table,$_POST);

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

}