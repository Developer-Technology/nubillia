<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

/*=============================================
Requerimos los controladores
=============================================*/
require_once "../controllers/curl.controller.php";
require_once "../controllers/template.controller.php";

class DeleteController
{

    public $idItem;
    public $table;
    public $suffix;
    public $folder;
    public $code;
    public $token;
    public $deleteFile;

    public function dataDelete()
    {

        $security = explode("~", base64_decode($this->idItem));

        if ($security[1] == $this->token) {

            /*=============================================
            Validar primero que el plan no este asociado a una empresa
            =============================================*/
            if ($this->table == "plans") {

                $url = "tenants?select=id_plan_tenant&linkTo=id_" . $this->suffix . "_tenant&equalTo=" . $security[0];
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if ($response->status == 200) {

                    echo "no-delete";

                    return;

                }

            }

            /*=============================================
            Validar primero que el usuario no tenga empresas
            =============================================*/
            if ($this->table == "users") {

                if ($security[0] == 1) {

                    echo "no-delete";

                    return;

                } else {

                    $url = "users?select=*&linkTo=id_usuario&equalTo=" . $security[0];
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if ($response->results[0]->id_tenant_user != '[]') {

                        echo "no-delete";

                        return;

                    }

                }

            }

            /*=============================================
            Validar que si vengan archivos para borrar
            =============================================*/
            if ($this->deleteFile != "no") {

                $url = "file/delete";
                $method = "POST";

                if ($this->table == "empresas") {

                    $count = 0;
                    
                    foreach (json_decode(base64_decode($this->deleteFile), true) as $key => $value) {

                        $count++;

                        $fields = array(

                            "deleteFile" => $value,

                        );

                        CurlController::request($url, $method, $fields, $token);

                        if ($count == count(json_decode(base64_decode($this->deleteFile), true))) {

                            $picture = "ok";

                        }

                    }

                } else {

                    $fields = array(

                        "deleteFile" => $this->deleteFile,
                        "deleteDir" => $this->suffix,
                        "deleteFol" => $this->folder,
                        "deleteCod" => $this->code,

                    );

                    $picture = CurlController::request($url, $method, $fields, $token);

                }

            } else {

                $picture = "ok";

            }

            /*=============================================
            Eliminar registro
            =============================================*/
            if ($picture == "ok") {

                $url = $this->table . "?id=" . $security[0] . "&nameId=id_" . $this->suffix . "&token=" . $this->token . "&table=users&suffix=user";
                $method = "DELETE";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                echo $response->status;

            }

        } else {

            echo 404;

        }

    }

}

if (isset($_POST["idItem"])) {

    $validate = new DeleteController();
    $validate->idItem = $_POST["idItem"];
    $validate->table = $_POST["table"];
    $validate->suffix = $_POST["suffix"];
    $validate->folder = $_POST["folder"];
    $validate->code = $_POST["code"];
    $validate->token = $_POST["token"];
    $validate->deleteFile = $_POST["deleteFile"];
    $validate->dataDelete();

}