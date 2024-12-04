<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

class SettingsController{

	/*=============================================
	Datos de configuraciones
	=============================================*/	
	public static function getdata(){

		$url = "settings?select=*&linkTo=id_setting&equalTo=1";
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

    /*=============================================
    Editar datos generales
    =============================================*/
    public function editGeneral()
    {

        if (isset($_POST["name-sys"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            // Accedemos a los datos adicionales
            $urlGetSet = "settings?select=*&linkTo=id_setting&equalTo=1";
            $methodGetSet = "GET";
            $fieldsGetSet = array();
            $responseGetSet = CurlController::request($urlGetSet, $methodGetSet, $fieldsGetSet);

            // Decodificar el JSON extras
            $jsonExtras = $responseGetSet->results[0]->extras_setting;
            $datosExtras = json_decode($jsonExtras, true);

            // Acceder y editar los valores del arreglo
            $datosExtras[0]['reset_pass'] = $_POST["reset-sistema"];
            $datosExtras[0]['register_system'] = $_POST["registro-sistema"];
            $datosExtras[0]['social_login'] = $_POST["social-sistema"];

            // Codificar de nuevo el JSON
            $jsonExtras = json_encode($datosExtras);

            // Convertir el JSON en un arreglo PHP
            $rawKeywords = json_decode($_POST["kw-emp"], true);

            // Extraer únicamente los valores (sin la clave "value")
            $keywords = array_map(function($tag) {
                return $tag['value'];
            }, $rawKeywords);

            // Convertir el arreglo limpio a JSON para guardarlo
            $jsonKeywords = json_encode($keywords);

            // Enviamos los datos al API
            $url = "settings?id=1&nameId=id_setting&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
            $method = "PUT";
            $fields = "name_system_setting=" . $_POST["name-sys"] . "&name_company_setting=" . $_POST["name-emp"] . "&description_setting=" . TemplateController::htmlClean($_POST["description-emp"]) . "&web_setting=" . $_POST["web-emp"] . "&whatsapp_setting=" . $_POST["whatsapp-setting"] . "&youtube_setting=" . $_POST["youtube-setting"] . "&keywords_setting=" . $jsonKeywords . "&extras_setting=" . $jsonExtras;

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $response->results->comment . '", "/settings/general");
                    </script>';

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "' . $response->results . '");
                    </script>';

            }

        }

    }

    /*=============================================
    Editar servidor de correo
    =============================================*/
    public function editServer()
    {

        if (isset($_POST["host-mail"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            // Accedemos a los datos adicionales
            $urlGetSet = "settings?select=*&linkTo=id_setting&equalTo=1";
            $methodGetSet = "GET";
            $fieldsGetSet = array();
            $responseGetSet = CurlController::request($urlGetSet, $methodGetSet, $fieldsGetSet);

            if($_POST["server-mail"] == 'no') {
                $securityMail = '';
            } else {
                $securityMail = $_POST["security-mail"];
            }

            // Decodificar el JSON extras
            $jsonServer = $responseGetSet->results[0]->server_setting;
            $datosServer = json_decode($jsonServer, true);

            // Acceder y editar los valores del arreglo
            $datosServer[0]['server'] = $_POST["server-mail"];
            $datosServer[0]['host'] = $_POST["host-mail"];
            $datosServer[0]['user'] = $_POST["user-mail"];
            $datosServer[0]['pass'] = $_POST["pass-mail"];
            $datosServer[0]['security'] = $securityMail;
            $datosServer[0]['port'] = $_POST["port-mail"];
            $datosServer[0]['email'] = $_POST["email-mail"];

            // Codificar de nuevo el JSON
            $jsonServer = json_encode($datosServer);

            // Enviamos los datos al API
            $url = "settings?id=1&nameId=id_setting&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
            $method = "PUT";
            $fields = "&server_setting=" . $jsonServer;

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $response->results->comment . '", "/settings/server");
                    </script>';

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "' . $response->results . '");
                    </script>';

            }

        }

    }

}