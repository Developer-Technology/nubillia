<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

class SettingsController{

	/*=============================================
	Datos empresa / tienda
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

}