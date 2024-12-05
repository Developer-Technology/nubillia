<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

require_once "../models/connection.php";

class FilesController
{

    /*=============================================
    Peticion Files para almacenar archivos en el servidor
    =============================================*/
    public static function fileData($file, $type, $folder, $name, $mode, $width, $height)
    {

        /*=============================================
        Crear archivo en el servidor
        =============================================*/
        if (isset($file) && !empty($file)) {

            /*=============================================
            Configuramos la ruta del directorio donde se guardará la imagen
            =============================================*/
            $directory = strtolower($folder);

            /*=============================================
            Preguntamos primero si no existe el directorio, para crearlo
            =============================================*/
            if (!file_exists($directory)) {

                mkdir($directory, 0755, true);

            }

            /*=============================================
            Capturar ancho y alto original de la imagen
            =============================================*/
            if($file != 'avatar') {
                list($lastWidth, $lastHeight) = getimagesize($file);
            }

            /*=============================================
            De acuerdo al tipo de imagen aplicamos las funciones por defecto
            =============================================*/
            if ($type == "image/jpeg") {

                //definimos nombre del archivo
                $encript = $name;
                $newName = crypt($encript, Connection::cryptData()) . '.jpg';

                //definimos el destino donde queremos guardar el archivo
                $folderPath = $directory . '/' . $newName;

                if (isset($mode) && $mode == "base64") {

                    file_put_contents($folderPath, file_get_contents($file));

                } else {

                    //Crear una copia de la imagen
                    $start = imagecreatefromjpeg($file);

                    //Instrucciones para aplicar a la imagen definitiva
                    $end = imagecreatetruecolor($width, $height);

                    imagecopyresized($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);

                    imagejpeg($end, $folderPath);

                }

            }

            if ($type == "image/png") {

                //definimos nombre del archivo
                $encript = $name;
                $newName = crypt($encript, Connection::cryptData()) . '.png';

                //definimos el destino donde queremos guardar el archivo
                $folderPath = $directory . '/' . $newName;

                if (isset($mode) && $mode == "base64") {

                    file_put_contents($folderPath, file_get_contents($file));

                } else {

                    //Crear una copia de la imagen
                    $start = imagecreatefrompng($file);

                    //Instrucciones para aplicar a la imagen definitiva
                    $end = imagecreatetruecolor($width, $height);

                    imagealphablending($end, false);

                    imagesavealpha($end, true);

                    imagecopyresampled($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);

                    imagepng($end, $folderPath);

                }

            }

            if ($type == "image/gif") {

                //definimos nombre del archivo
                $encript = $name;
                $newName = crypt($encript, Connection::cryptData()) . '.gif';

                //definimos el destino donde queremos guardar el archivo
                $folderPath = $directory . '/' . $newName;

                move_uploaded_file($file, $folderPath);
            }

            if ($type == "application/x-pkcs12") {

                $encript = $name;
                $newName = crypt($encript, Connection::cryptData()) . '.pfx';
                $folderPath = $directory . '/' . $newName;

                file_put_contents($folderPath, file_get_contents($file));

            }

            /*=============================================
            Función para crear perfil con inicial
            =============================================*/
            if ($file == "avatar") {

                $encript = $name[0] . "_" . date('Y-m-d') . "_" . time();
                $newName = crypt($encript, Connection::cryptData()) . ".png";
                $folderPath = $directory . "/" . $newName;

                //base avatar image that we use to center our text string on top of it.
                $avatar = imagecreatetruecolor($width, $height);
                $red = rand(0, 255);
                $green = rand(0, 255);
                $blue = rand(0, 255);
                $bg_color = imagecolorallocate($avatar, $red, $green, $blue);
                imagefill($avatar, 0, 0, $bg_color);
                $avatar_text_color = imagecolorallocate($avatar, 255, 255, 255);
                // Load the gd font and write
                $font = imageloadfont($_SERVER['DOCUMENT_ROOT'] . '/uploads/font/gd-font.gdf');
                imagestring($avatar, $font, 10, 10, $name[0], $avatar_text_color);
                imagepng($avatar, $folderPath);
                imagedestroy($avatar);

            }

            return $newName;

        } else {

            return 'error';

        }

    }

    /*=============================================
    Peticion Files para eliminar archivo unico en el servidor
    =============================================*/
    public static function deleteUniqData($file, $dir, $fol, $cod)
    {
        /*=============================================
        Construir la ruta del archivo
        =============================================*/
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $dir . "/" . $fol . "/" . $cod . "/" . $file;

        /*=============================================
        Verificar si el archivo existe
        =============================================*/
        if (file_exists($filePath)) {
            /*=============================================
            Borrar el archivo
            =============================================*/
            if (unlink($filePath)) {
                return "ok";
            } else {
                return "error"; // Error al intentar eliminar el archivo
            }
        } else {
            return "file_not_found"; // El archivo no existe
        }
    }

    /*=============================================
    Peticion Files para eliminar archivos en el servidor
    =============================================*/
    public static function deleteData($file, $dir, $fol, $cod)
    {

        /*=============================================
        Borrar archivo en el servidor
        =============================================*/
        if (isset($deleteFile)) {

            /*=============================================
            Borramos el archivo
            =============================================*/
            unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $dir . "/" . $fol . "/" . $cod . "/" . $deleteFile);

            $arrayDelete = explode("/", $deleteFile);
            array_pop($arrayDelete);
            $arrayDelete = implode("/", $arrayDelete);

            /*=============================================
            Borramos todos los posibles archivos del directorio
            =============================================*/
            $files = glob($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $dir . "/" . $fol . "/" . $cod . "/" . $arrayDelete . "/*");

            foreach ($files as $file) {
                unlink($file);
            }

            /*=============================================
            Borramos el directorio
            =============================================*/
            rmdir($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $dir . "/" . $fol . "/" . $cod . "/" . $arrayDelete);

            return "ok";

        } else {

            return "error";

        }

    }

}