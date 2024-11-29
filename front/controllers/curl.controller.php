<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

class CurlController
{

    /*=============================================
    Ruta API
    =============================================*/
    public static function api()
    {
    
        /* Produccion */
        //return "https://apinubillia.chanamoth.com/";

        /* Desarrollo */
        return "http://api.nubillia.local/";
        
    }

    /*=============================================
    Peticiones a la API SUNAT
    =============================================*/
    static public function request($url,$method,$fields){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => CurlController::api().$url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $fields,
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: c5LTA6WPbMwHhEabYu77nN9cn4VcMj'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response = json_decode($response);
		return $response;

	}

}