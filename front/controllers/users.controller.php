<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

class UsersController{

	/*=============================================
	Login de administradores
	=============================================*/	
	public function login(){

		if(isset($_POST["loginUsername"])){

			echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Cargando...", "");
				</script>';

			/*=============================================
			Validamos la sintaxis de los campos
			=============================================*/	
			$url = "users?login=true&suffix=user";
			$method = "POST";
			$fields = array(

				"username_user" => $_POST["loginUsername"],
				"password_user" => $_POST["loginPassword"]

			);

			$response = CurlController::request($url,$method,$fields);

			/*=============================================
			Validamos que si escriba correctamente los datos
			=============================================*/	
			
			if($response->status == 200){

				$urlUser = "users?select=*&linkTo=id_user&equalTo=".$response->results[0]->id_user;
				$methodUser = "GET";
				$fieldsUser = array();

				$responseUser = CurlController::request($urlUser,$methodUser,$fieldsUser);

				if($responseUser->status == 200){

					/*=============================================
					Validamos que si tenga rol administrativo
					=============================================*/	

					if($responseUser->results[0]->status_user != 1){

						echo ' <script>

								fncFormatInputs();
								matPreloader("off");
								fncSweetAlert("close", "", "");
								fncNotie(3, "No tienes permisos para acceder");
						
							</script>';
						return;
					}

					/*=============================================
					Creamos variable de sesión
					=============================================*/	
					$_SESSION["user"] = $responseUser->results[0];
					
					echo '<script>
                            fncFormatInputs();
                            localStorage.setItem("token_user", "'.$response->results[0]->token_user.'");
                            window.location = "' . $_SERVER["REQUEST_URI"] . '"
                        </script>';

				}

			}else{

				echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "'.$response->results.'");
                    </script>';

			}

					

		}

	}

	/*=============================================
	Creación usuarios
	=============================================*/	
	public function create(){

		if(isset($_POST["displayname"])){

			echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Cargando...", "");

			</script>';

			/*=============================================
			Validamos la sintaxis de los campos
			=============================================*/		

			if(preg_match('/^[A-Za-z0-9]{1,}$/', $_POST["username"] ) && 
			   preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"] ) &&
			   preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["password"] ) &&
			   preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["password-confirm"] )){

			   	/*=============================================
				Agrupamos la información 
				=============================================*/		

				$data = array(

					"email" => trim(strtolower($_POST["email"])),
					"user_name" => trim(strtolower($_POST["username"])),
					"password" =>  trim($_POST["password"]),
					"password_confirmation" =>  trim($_POST["password-confirm"]),
					"user_access" => 1,
					"user_worker" => 1,
					"user_business" => 1,
					"user_active" => 1,
					"status" => 1,
					"user_settings" => ''

				);

				/*=============================================
				Solicitud a la API
				=============================================*/		

				$url = "auth/register";
				$method = "POST";
				$header = array();
				$fields = $data;

				$response = CurlController::request($url,$method,$fields,$header);

				/*=============================================
				Respuesta de la API
				=============================================*/		
				
				if($response->status == 200){

					echo '<script>

						fncFormatInputs();
						matPreloader("off");
						fncSweetAlert("close", "", "");
						fncSweetAlert("success", "Your records were created successfully", "/");

					</script>';

				} else {

					if($response->response->password) {
						$rpta = json_encode($response->response->password);
					} elseif($response->response->email) {
						$rpta = json_encode($response->response->email);
					} else {
						$rpta = $response->response;
					}

					echo '<script>

						fncFormatInputs();
						matPreloader("off");
						fncSweetAlert("close", "", "");
				
					</script> 
					<div class="alert alert-danger">'.$rpta.'</div>';
				}

			}else{

				echo '<script>

					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncNotie(3, "Field syntax error");

				</script>';

				
			}
		}

	}

	/*=============================================
	Edición usuarios
	=============================================*/	
	public function edit($id){

		if(isset($_POST["idAdmin"])){

			echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Cargando...", "");

			</script>';

			if($id == $_POST["idAdmin"]){

				$select = "password_user,picture_user";

				$url = "users?select=".$select."&linkTo=id_user&equalTo=".$id;
				$method = "GET";
				$fields = array();

				$response = CurlController::request($url,$method,$fields);
			
				if($response->status == 200){

					/*=============================================
					Validamos la sintaxis de los campos
					=============================================*/		

					if(preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["displayname"] ) && 
					   preg_match('/^[A-Za-z0-9]{1,}$/', $_POST["username"] ) && 
					   preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"] ) &&
					   preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["city"] ) &&
					   preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["address"] ) &&
					   preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["phone"] )){


					   	/*=============================================
						Validar cambio contraseña
						=============================================*/	

						if(!empty($_POST["password"])){

							$password = crypt(trim($_POST["password"]), '$2a$07$azybxcags23425sdg23sdfhsd$');
						
						}else{

							$password = $response->results[0]->password_user;

						}

						/*=============================================
						Validar cambio imagen
						=============================================*/	

						if(isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])){	

								$fields = array(
								
									"file"=>$_FILES["picture"]["tmp_name"],
									"type"=>$_FILES["picture"]["type"],
									"folder"=>"users/".$id,
									"name"=>$id,
									"width"=>300,
									"height"=>300
								);

								$picture = CurlController::requestFile($fields);

						}else{

							$picture = $response->results[0]->picture_user;

						}

					   	/*=============================================
						Agrupamos la información 
						=============================================*/		

						$data = "displayname_user=".trim(TemplateController::capitalize($_POST["displayname"]))."&username_user=". trim(strtolower($_POST["username"]))."&email_user=".trim(strtolower($_POST["email"]))."&password_user=".$password."&country_user=".trim(explode("_",$_POST["country"])[0])."&city_user=". trim(TemplateController::capitalize($_POST["city"]))."&address_user=".trim($_POST["address"])."&phone_user=".trim(explode("_",$_POST["country"])[1]."_".$_POST["phone"])."&picture_user=".$picture;

						/*=============================================
						Solicitud a la API
						=============================================*/		

						$url = "users?id=".$id."&nameId=id_user&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
						$method = "PUT";
						$fields = $data;

						$response = CurlController::request($url,$method,$fields);

						/*=============================================
						Respuesta de la API
						=============================================*/		
						
						if($response->status == 200){		

							echo '<script>

								fncFormatInputs();
								matPreloader("off");
								fncSweetAlert("close", "", "");
								fncSweetAlert("success", "Your records were created successfully", "/admins");

							</script>';
	
						}else{

							echo '<script>

								fncFormatInputs();
								matPreloader("off");
								fncSweetAlert("close", "", "");
								fncNotie(3, "Error editing the registry");

							</script>';
							
						}

					}else{

						echo '<script>

							fncFormatInputs();
							matPreloader("off");
							fncSweetAlert("close", "", "");
							fncNotie(3, "Field syntax error");

						</script>';
						
					}

				}else{

					echo '<script>

						fncFormatInputs();
						matPreloader("off");
						fncSweetAlert("close", "", "");
						fncNotie(3, "Error editing the registry");

					</script>';

					
				}

			}else{

				echo '<script>

					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncNotie(3, "Error editing the registry");

				</script>';

				
			}
		}

	}

	/*=============================================
	Datos usuario
	=============================================*/	
	public static function getdata($id){

		$url = "relations?rel=users,workers,rols&type=user,worker,rol&select=*&linkTo=id_user&equalTo=".$id;
		$method = "GET";
		$fields = array();

		$response = CurlController::request($url,$method,$fields);

        /*=============================================
        Validamos si se tiene un usuario
        =============================================*/	
        if($response->status == 200){

            /*=============================================
            Obtenemos los datos del usuario
            =============================================*/	
            return $response->results[0];

        }

	}

}