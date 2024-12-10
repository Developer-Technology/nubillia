<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

/*=============================================
Incluimos la libreria
=============================================*/
require_once "models/get.model.php";
require_once "models/connection.php";

require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;

class RoutesController{

	/*=============================================
	Ruta Principal
	=============================================*/
	public function index()
    {

		include "routes/routes.php";

	}

    /*=============================================
    Ruta del sistema
    =============================================*/
    public static function path()
    {
        /* Produccion */
        //return "https://admin.nibillia.com/";

        /* Desarrollo */
        return "http://admin.nubillia.local/";

    }

	/*=============================================
    Funcion para enviar correo
    =============================================*/
    public static function sendEmail($name, $subject, $email, $message, $txt, $url)
    {

        /*=============================================
        Definimos la zona horaria
        =============================================*/
        date_default_timezone_set("America/Lima");

        /*=============================================
        Recogemos los datos del sistema
        =============================================*/
        $dataSetting = GetModel::getDataFilter("settings", "*", "id_setting", 1, null, null, null, null);

        /* Validamos si tiene web */
        if($dataSetting[0]->web_setting != '') {
            
            $team = '<a href="' . $dataSetting[0]->web_setting . '">' . $dataSetting[0]->name_company_setting . '</a>';

        } else {

            $team = $dataSetting[0]->name_company_setting;

        }

		/*=============================================
		Obtenemos los datos del servidor de correo
		=============================================*/
		foreach (json_decode($dataSetting[0]->server_setting) as $key => $elementServer) {

			$server = $elementServer->server;
			$host = $elementServer->host;
			$user = $elementServer->user;
			$password = $elementServer->pass;
			$security = $elementServer->security;
			$port = $elementServer->port;
			$email = $elementServer->email;

		}

        $mail = new PHPMailer;
        $mail->Charset = "UTF-8";
        /* */
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $host;
        $mail->Username = $user;
        $mail->Password = $password;
        $mail->SMTPSecure = $security;
        $mail->Port = $port;
        /* */
        $mail->setFrom($email, $dataSetting[0]->name_company_setting);
        $mail->Subject = "Hola " . $name . " - " . $subject;
        $mail->addAddress($email);
        $mail->msgHTML('

			<div>
				Hola, ' . $name . ':
				<p>' . $message . '</p>
				<a href="' . $url . '">' . $txt . '</a>
				Atentamente, el equipo de <b>' . $team . '</b>.<br>
				Gracias
			</div>

		');

        $send = $mail->Send();

        if (!$send) {

            return $mail->ErrorInfo;

        } else {

            return "ok";

        }

    }

}