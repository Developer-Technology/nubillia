<?php 

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

require_once "models/get.model.php";
require_once "models/post.model.php";
require_once "models/connection.php";

require_once "vendor/autoload.php";
use Firebase\JWT\JWT;

require_once "models/put.model.php";

class PostController{

	/*=============================================
	Peticion POST para crear datos
	=============================================*/

	static public function postData($table, $data){

		$response = PostModel::postData($table, $data);
		
		$return = new PostController();
		$return -> fncResponse($response,null,null);

	}

	/*=============================================
	Peticion POST para registrar usuario
	=============================================*/

	static public function postRegister($table, $data, $suffix){

		if(isset($data["password_".$suffix]) && $data["password_".$suffix] != null){

			$crypt = crypt($data["password_".$suffix], Connection::cryptData());

			$data["password_".$suffix] = $crypt;

			$response = PostModel::postData($table, $data);

			$return = new PostController();
			$return -> fncResponse($response,null,$suffix);

			/*=============================================
			Recogemos los datos del sistema
			=============================================*/
			$dataSett = GetModel::getDataFilter("settings", "*", "id_setting", 1, null, null, null, null);

			/*=============================================
			Obtenemos los datos del servidor de correo
			=============================================*/
			foreach (json_decode($dataSett[0]->server_setting) as $key => $elementServer) {

				$server = $elementServer->server;

			}

			if($server == "si") {
			
				/*=============================================
				Generamos el correo
				=============================================*/
				$name = $data["email_" . $suffix];
				$subject = "Verifica tu cuenta";
				$email = $data["email_" . $suffix];
				$message = "Debemos verificar tu cuenta para que puedas acceder a <b>" . $dataSett[0]->name_system_setting . "</b>";
				$text = "Haz clic en este enlace para verificar tu cuenta";
				/* Ruta donde se encuentra el sistema */
				$url = RoutesController::path() . 'verify/' . base64_encode($data["email_" . $suffix] . '~' . date('Y-m-d H:i:s') . '~c5LTA6WPbMwHhEabYu77nN9cn4VcMj' . '~' . uniqid());

				//$sendEmail = RoutesController::sendEmail($name, $subject, $data["email_" . $suffix], $message, $text, $url);
			
				//return $sendEmail;
				
			}

		}else{

			/*=============================================
			Registro de usuarios desde APP externas
			=============================================*/

			$response = PostModel::postData($table, $data);

			if(isset($response["comment"]) && $response["comment"] == "El proceso fue exitoso" ){

				/*=============================================
				Validar que el usuario exista en BD
				=============================================*/

				$response = GetModel::getDataFilter($table, "*", "username_".$suffix, $data["username_".$suffix], null,null,null,null);
				
				if(!empty($response)){		

					$token = Connection::jwt($response[0]->{"id_".$suffix}, $response[0]->{"username_".$suffix});

					$jwt = JWT::encode($token, "dfhsdfg34dfchs4xgsrsdry46");

					/*=============================================
					Actualizamos la base de datos con el Token del usuario
					=============================================*/

					$data = array(

						"token_".$suffix => $jwt,
						"token_exp_".$suffix => $token["exp"]

					);

					$update = PutModel::putData($table, $data, $response[0]->{"id_".$suffix}, "id_".$suffix);

					if(isset($update["comment"]) && $update["comment"] == "El proceso fue exitoso" ){

						$response[0]->{"token_".$suffix} = $jwt;
						$response[0]->{"token_exp_".$suffix} = $token["exp"];

						$return = new PostController();
						$return -> fncResponse($response, null,$suffix);

					}

				}


			}


		}

	}

	/*=============================================
	Peticion POST para login de usuario
	=============================================*/

	static public function postLogin($table, $data, $suffix){

		/*=============================================
		Validar que el usuario exista en BD
		=============================================*/

		$response = GetModel::getDataFilter($table, "*", "username_".$suffix, $data["username_".$suffix], null,null,null,null);
		
		if(!empty($response)){	

			if($response[0]->{"password_".$suffix} != null)	{
			
				/*=============================================
				Encriptamos la contraseña
				=============================================*/

				$crypt = crypt($data["password_".$suffix], Connection::cryptData());
				//$crypt = md5($data["password_".$suffix]);

				if($response[0]->{"password_".$suffix} == $crypt){

					$token = Connection::jwt($response[0]->{"id_".$suffix}, $response[0]->{"username_".$suffix});

					$jwt = JWT::encode($token, "dfhsdfg34dfchs4xgsrsdry46");

					/*=============================================
					Actualizamos la base de datos con el Token del usuario
					=============================================*/

					$data = array(

						"token_".$suffix => $jwt,
						"token_exp_".$suffix => $token["exp"]

					);

					$update = PutModel::putData($table, $data, $response[0]->{"id_".$suffix}, "id_".$suffix);

					if(isset($update["comment"]) && $update["comment"] == "El proceso fue exitoso" ){

						$response[0]->{"token_".$suffix} = $jwt;
						$response[0]->{"token_exp_".$suffix} = $token["exp"];

						$return = new PostController();
						$return -> fncResponse($response, null,$suffix);

					}
					
					
				}else{

					$response = null;
					$return = new PostController();
					$return -> fncResponse($response, "Contraseña incorrecta",$suffix);

				}

			}else{

				/*=============================================
				Actualizamos el token para usuarios logueados desde app externas
				=============================================*/

				$token = Connection::jwt($response[0]->{"id_".$suffix}, $response[0]->{"email_".$suffix});

				$jwt = JWT::encode($token, "dfhsdfg34dfchs4xgsrsdry46");				

				$data = array(

					"token_".$suffix => $jwt,
					"token_exp_".$suffix => $token["exp"]

				);

				$update = PutModel::putData($table, $data, $response[0]->{"id_".$suffix}, "id_".$suffix);

				if(isset($update["comment"]) && $update["comment"] == "El proceso fue exitoso" ){

					$response[0]->{"token_".$suffix} = $jwt;
					$response[0]->{"token_exp_".$suffix} = $token["exp"];

					$return = new PostController();
					$return -> fncResponse($response, null,$suffix);

				}

			}

		}else{

			$response = null;
			$return = new PostController();
			$return -> fncResponse($response, "Usuario incorrecto",$suffix);

		}


	}

	/*=============================================
	Respuestas del controlador
	=============================================*/

	public function fncResponse($response,$error,$suffix){

		if(!empty($response)){

			/*=============================================
			Quitamos la contraseña de la respuesta
			=============================================*/

			/*if(isset($response[0]->{"password_".$suffix})){

				unset($response[0]->{"password_".$suffix});

			}*/

			$json = array(

				'status' => 200,
				'total' => count($response),
				'results' => $response

			);

		}else{

			if($error != null){

				$json = array(
					'status' => 400,
					'results' => 'Not Found',
					"results" => $error
				);

			}else{

				$json = array(

					'status' => 404,
					'results' => 'Not Found',
					'method' => 'post'

				);
			}

		}

		echo json_encode($json, http_response_code($json["status"]));

	}

}