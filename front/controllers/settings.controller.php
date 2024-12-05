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

    /*=============================================
    Cargar Favicon
    =============================================*/
    public function editFavicon()
    {

        if (isset($_POST["croppedImage"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            $select = "*";

            $urlSet = "settings?select=" . $select . "&linkTo=id_setting&equalTo=1";
            $methodSet = "GET";
            $fieldsSet = array();

            $responseSet = CurlController::request($urlSet, $methodSet, $fieldsSet);

            /*=============================================
            Borramos el archivo actual
            =============================================*/
            $urlDel = "uploads/index.php";
            $methodDel = "POST";
            $fieldsDel = array(

                "deleteFile" => $responseSet->results[0]->favicon_setting,
                "deleteDir" => "favicon"

            );
            $dataFielDel = json_encode($fieldsDel);

            $deletePicture = CurlController::request($urlDel, $methodDel, $dataFielDel);

            /*=============================================
            Guardamos el archivo enviado
            =============================================*/
            $urlUp = "uploads/index.php";
            $methodUp = "POST";
            $fieldsUp = array(

                "file" => $_POST["croppedImage"],
                "type" => "image/png",
                "folder" => "favicon",
                "name" => $_POST["croppedImage"] . time(),
                "width" => 150,
                "height" => 150,

            );

            $saveImageEmpr = CurlController::request($urlUp, $methodUp, $fieldsUp)->file;

            // Enviamos los datos al API
            $url = "settings?id=1&nameId=id_setting&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
            $method = "PUT";
            $fields = "&favicon_setting=" . $saveImageEmpr;

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $response->results->comment . '", "/settings/favicon");
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
    Editar Facturacion
    =============================================*/
    public function editBilling()
    {

        if (isset($_POST["status-billing"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            // Accedemos a los datos adicionales
            $urlGetSet = "settings?select=*&linkTo=id_setting&equalTo=1";
            $methodGetSet = "GET";
            $fieldsGetSet = array();
            $responseGetSet = CurlController::request($urlGetSet, $methodGetSet, $fieldsGetSet);

            if($_POST["status-billing"] == 'no') {
                $sendBilling = '';
            } else {
                $sendBilling = $_POST["send-billing"];
            }

            // Decodificar el JSON extras
            $jsonFacturacion = $responseGetSet->results[0]->invoice_setting;
            $datosFacturacion = json_decode($jsonFacturacion, true);

            // Acceder y editar los valores del arreglo
            $datosFacturacion[0]['factura']['serie'] = $_POST["serie-billing"];
            $datosFacturacion[0]['factura']['correlativo'] = $_POST["number-billing"];
            $datosFacturacion[0]['factura']['automatico'] = $sendBilling;
            $datosFacturacion[0]['api']['activo'] = $_POST["status-billing"];
            $datosFacturacion[0]['api']['token'] = $_POST["token-billing"];
            $datosFacturacion[0]['api']['secret'] = $_POST["secret-billing"];

            // Codificar de nuevo el JSON
            $jsonFacturacion = json_encode($datosFacturacion);

            // Enviamos los datos al API
            $url = "settings?id=1&nameId=id_setting&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
            $method = "PUT";
            $fields = "invoice_setting=" . $jsonFacturacion;

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $response->results->comment . '", "/settings/billing");
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
    Editar Pasarelas
    =============================================*/
    public function editGateway()
    {

        if (isset($_POST["client_id-paypal"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            $select = "*";

            $url = "settings?select=" . $select . "&linkTo=id_setting&equalTo=1";
            $method = "GET";
            $fields = array();

            $response = CurlController::request($url, $method, $fields);

            // Decodificar el JSON Paypal
            $jsonPaypal = $response->results[0]->paypal_setting;
            $datosPaypal = json_decode($jsonPaypal, true);

            // Acceder y editar los valores del arreglo
            $datosPaypal[0]['client_id'] = $_POST["client_id-paypal"];
            $datosPaypal[0]['secret_key'] = $_POST["secret_key-paypal"];

            // Codificar de nuevo el JSON
            $jsonPaypal = json_encode($datosPaypal);

            /*=============================================
            Solicitud a la API
            =============================================*/
            $urlPut = "settings?id=1&nameId=id_setting&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
            $methodPut = "PUT";
            $fieldsPut = "paypal_setting=" . $jsonPaypal;

            $responsePut = CurlController::request($urlPut, $methodPut, $fieldsPut);

            if ($responsePut->status == 200) {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $responsePut->results->comment . '", "/settings/gateway");
                    </script>';

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "' . $responsePut->results . '");
                    </script>';

            }

        }

    }

}