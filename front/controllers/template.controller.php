<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

class TemplateController {

	/*=============================================
	Ruta del aplicativo
	=============================================*/
	static public function path() {

		return "nubillia.local/";

	}

	/*=============================================
	Traemos la Vista Principal de la plantilla
	=============================================*/
	public function index() {

		include "views/template.php";

	}

	/*=============================================
	Ruta para las imágenes del sistema
	=============================================*/
	static public function srcImg() {

		return CurlController::api() . "documents/";

	}

	/*=============================================
	Devolver la imagen del MP
	=============================================*/
	static public function returnImg($folder,$id,$picture) {

		if($picture != null) {

			return TemplateController::srcImg()."views/".$folder."/".$id."/".$picture;
		
		} else {

			return "views/images/users/default.png";
		}

	}

	/*=============================================
	Función para mayúscula inicial
	=============================================*/
	static public function capitalize($value) {

		$value = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
		return $value;

	}

	/*=============================================
	Función para recoger variables globales
	=============================================*/
	static public function recoge1($var) {

		$tmp = (isset($_REQUEST[$var])) ? trim(strip_tags($_REQUEST[$var])) : '';

		if (get_magic_quotes_gpc()) {
			$tmp = stripslashes($tmp);
		}

		$tmp = str_replace('&', '&amp;',  $tmp);
		$tmp = str_replace('"', '&quot;', $tmp);
		$tmp = str_replace('í', '&iacute;', $tmp);

		return $tmp;

	}

	/*=============================================
	Función Limpiar HTML
	=============================================*/	
	static public function htmlClean($code) {

		$search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
		$replace = array('>','<','\\1');
		$code = preg_replace($search, $replace, $code);
		$code = str_replace("> <", "><", $code);

		return $code;

	}

    /*=============================================
    Convertir fecha a español
    =============================================*/
    public static function fechaEsShort($fecha) {

        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);

        return $nombreMes . " " . $numeroDia . ", " . $anio;

    }

}