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

		/* Produccion */
		//return "nubillia.chanamoth.local/";

		/* Desarrollo */
		return "nubillia.local/";

	}

	/*=============================================
	Traemos la Vista Principal de la plantilla
	=============================================*/
	public function index() {

		include "views/template.php";

	}

	/*=============================================
    Token default del API SUNAT
    =============================================*/
    public static function tokenApi()
    {

        return "0312b11cfe3df2ca85728026f8a81da8f53110f6e828030cce3c9a1a8dc6f1bf";

    }

	/*=============================================
	Ruta para las imágenes del sistema
	=============================================*/
	static public function srcImg() {

		return CurlController::api() . "uploads/";

	}

	/*=============================================
	Devolver la imagen del MP
	=============================================*/
	static public function returnImg($folder,$id,$picture) {

		if($picture != null || $picture != '') {

			return TemplateController::srcImg(). $folder ."/". $id ."/". $picture;
		
		} else {

			return "/views/assets/" .$folder. "/" .$id. "/default.png";
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

	/*=============================================
    Creamos clave secreta unica tomando el ruc y hora de registro
    =============================================*/
    public static function secretKey($ruc)
    {

        $clave_secreta = date('H:i:s') . "RUC:c5LTA6WPbMwHhEabYu77nN9cn4VcMj";
        $iv = "0123456789abcdef";

        $ruc_encriptado = openssl_encrypt($ruc, "AES-256-CBC", $clave_secreta, OPENSSL_RAW_DATA, $iv);
        $ruc_encriptado = substr(rtrim(base64_encode($ruc_encriptado), "="), 0, 18);
        $caracteres = str_split($ruc_encriptado, 1);

        for ($i = 3; $i < count($caracteres); $i += 4) {

            array_splice($caracteres, $i, 0, "-");

        }

        $ruc_formateado = implode("", $caracteres);

        return rtrim(strtolower($ruc_formateado));

    }

	/*=============================================
    Creamos un id unico para las transacciones que no sean paypal o culqui
    =============================================*/
    public static function generateUniqueId($length = 17) {

        $microtime = microtime(true);
        $baseTime = str_replace('.', '', $microtime);
        $randomString = bin2hex(random_bytes(5));
        $uniqueId = $baseTime . $randomString;
        
        if (strlen($uniqueId) > $length) {
            $uniqueId = substr($uniqueId, 0, $length);
        }
        
        return $uniqueId;
        
    }

    /*=============================================
    Creamos un codigo unico para los servicios
    =============================================*/
    public static function generarCodigoProducto($nombreProducto, $idProducto) {
        // Tomar las primeras tres letras de cada palabra del nombre del producto
        $partesNombre = explode(' ', $nombreProducto);
        $codigo = '';
        foreach ($partesNombre as $parte) {
            $codigo .= substr($parte, 0, 3);
        }
    
        // Añadir un número secuencial único
        $codigo .= str_pad($idProducto, 5, '0', STR_PAD_LEFT); // Rellenar con ceros a la izquierda hasta tener 5 dígitos
    
        return strtoupper($codigo); // Convertir a mayúsculas
    }

}