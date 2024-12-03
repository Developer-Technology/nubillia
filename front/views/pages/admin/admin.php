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

if (!empty($_POST['admin_data'])) {

    echo '<script>
            fncSweetAlert("loading", "Cargando...", "");
        </script>';

    $adminData = base64_decode($_POST['admin_data']);
    $security = explode("~", $adminData);
    $verify = $security[0];

    /*=============================================
    Validamos que el usuario si exista
    =============================================*/
    $url = "users?linkTo=id_user&equalTo=" . $verify . "&select=id_rol_user";
    $method = "GET";
    $fields = array();

    $item = CurlController::request($url, $method, $fields);

    if (!empty($item)) {

        if ($item->status == 200) {

            /*=============================================
            Verificamos si la cuenta no ha sido validada
            =============================================*/
            if ($item->results[0]->id_rol_user == 1) {

                /*=============================================
                Creamos variable de sesión
                =============================================*/	
                $_SESSION["admin"] = 1;

                /*=============================================
                Accede al panel
                =============================================*/
                echo '<script>
                        fncFormatInputs();
                        window.location = "/"
                    </script>'; 

            } else {

                echo '<script>
                        fncFormatInputs();
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("error", "No tienes acceso para esta sección.", "/");
                    </script>';

            }

        } else {

            echo '<script>
                    fncFormatInputs();
                    fncSweetAlert("close", "", "");
                    fncSweetAlert("error", "Ha ocurrido un error al verificar el usuario.", "/");
                </script>';

        }

    } else {

        echo '<script>
                fncFormatInputs();
                fncSweetAlert("close", "", "");
                fncSweetAlert("error", "No se ha encontrado el usuario.", "/");
            </script>';

    }
    
} else {

    echo '<script>
            fncFormatInputs();
            fncSweetAlert("close", "", "");
            fncSweetAlert("error", "No se recibieron datos válidos.", "/");
        </script>';

}