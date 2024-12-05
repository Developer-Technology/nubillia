<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

/*=============================================
CORS
=============================================*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Authorization');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization');
    header('Allow: GET, POST, OPTIONS, PUT, DELETE');
    exit;
}

header('content-type: application/json; charset=utf-8');

/*=============================================
Requerimientos
=============================================*/
require_once "../models/connection.php";
require_once "../controllers/files.controller.php";

function jsonResponse($status, $data) {

    http_response_code($status);
    echo json_encode($data);
    exit;

}

// Verificar autenticación
$headers = getallheaders();
if (!isset($headers["Authorization"]) || $headers["Authorization"] != Connection::apikey()) {

    jsonResponse(401, ["status" => "error", "message" => "No autorizado"]);

}

// Verificar el método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    jsonResponse(405, ["status" => "error", "message" => "Método no permitido"]);

}

// Procesar las solicitudes
try {

    if (isset($_POST["file"]) && !empty($_POST["file"])) {

        // Procesar subida de archivo
        $newName = FilesController::fileData(
            $_POST["file"],
            $_POST["type"] ?? null,
            $_POST["folder"],
            $_POST["name"],
            $_POST["mode"] ?? null,
            $_POST["width"] ?? null,
            $_POST["height"] ?? null
        );

        if ($newName === 'error') {

            jsonResponse(500, ["status" => 500, "results" => "Error al guardar el archivo"]);

        }

        jsonResponse(200, ["status" => 200, "results" => "Archivo guardado", "file" => $newName]);

    } else if (isset($_POST["deleteFile"])) {

		// Procesar eliminación de archivo
		$result = FilesController::deleteUniqData(
			$_POST["deleteFile"],
			$_POST["deleteDir"] ?? "",
			$_POST["fol"] ?? "",
			$_POST["cod"] ?? ""
		);
	
		switch ($result) {

			case 'ok':
				jsonResponse(200, ["status" => 200, "results" => "Archivo eliminado"]);
				break;

			case 'file_not_found':
				jsonResponse(404, ["status" => 404, "results" => "Archivo no encontrado"]);
				break;

			case 'error':

			default:
				jsonResponse(500, ["status" => 500, "results" => "Error al eliminar el archivo"]);
				break;

		}

	} else {

        jsonResponse(400, ["status" => 400, "results" => "Solicitud no válida"]);

    }
} catch (Exception $e) {

    jsonResponse(500, ["status" => 500, "results" => $e->getMessage()]);
	
}