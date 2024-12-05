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
    Ruta API Facturacion
    =============================================*/
    public static function apiFact()
    {
    
        /* Produccion */
        //return "https://apifacturacion.chanamoth.com/";

        /* Desarrollo */
        return "http://api.tukifac.local/";
        
    }

    /*=============================================
    Peticiones a la API del sistema
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

	/*=============================================
    Peticiones a la API Facturacion
    =============================================*/
    public static function requestSunat($url, $method, $fields, $token)
    {

        $curl = curl_init();

        if ($token != '') {

            $header = array(
                'Authorization: Bearer ' . $token,
            );

        } else {

            $header = array();

        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => CurlController::apiFact() . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);
        return $response;

    }

}