<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

/*=============================================
Controladores
=============================================*/
require_once "controllers/curl.controller.php";

echo '<script>
        matPreloader("on");
        fncSweetAlert("loading", "Cargando...", "");
    </script>';

/*=============================================
Desencriptamos la url
=============================================*/
$security = explode("~", base64_decode($routesArray[2]));
$value = $security[0];

/*=============================================
Tomamos los datos de la empresa y tienda
=============================================*/
$url = "relations?rel=stores,tenants&type=store,tenant&select=*&linkTo=id_store&equalTo=" . $value;
$method = "GET";
$fields = array();

$stores = CurlController::request($url, $method, $fields);

/*=============================================
Creamos la sesion de la empresa y tienda
=============================================*/
$_SESSION['store'] = $stores->results[0];

/*=============================================
Redireccionamos al panel
=============================================*/
header("Location: /");