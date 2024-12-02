<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

class StoresController{

    /*=============================================
	Todas las tiendas
	=============================================*/	
	public static function getallstores(){

		$url = "stores";
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
            return $response;

        }

	}

    /*=============================================
	Todas las tiendas segun empresa
	=============================================*/	
	public static function getstores($id){

		$url = "stores?select=*&linkTo=id_tenant_store&equalTo=" . $id;
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
            return $response;

        }

	}

	/*=============================================
	Datos empresa / tienda
	=============================================*/	
	public static function getdata($id){

		$url = "relations?rel=stores,tenants&type=store,tenant&select=*&linkTo=id_store&equalTo=".$id;
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