<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

/*=============================================
Requerimos los controladores
=============================================*/
require_once "../../controllers/curl.controller.php";
require_once "../../controllers/template.controller.php";

class DatatableController
{
    public function data()
    {
        if (!empty($_POST)) {
            /*=============================================
            Capturando y organizando las variables POST de DT
            =============================================*/
            $draw = $_POST["draw"]; // Contador para secuencia de DataTables
            $orderByColumnIndex = $_POST['order'][0]['column']; // Índice de la columna de clasificación
            $orderBy = $_POST['columns'][$orderByColumnIndex]["data"]; // Nombre de la columna de clasificación
            $orderType = $_POST['order'][0]['dir']; // Orden ASC o DESC
            $start = $_POST["start"]; // Primer registro de paginación
            $length = $_POST['length']; // Longitud de paginación

            /*=============================================
            El total de registros de la data
            =============================================*/
            $url = "relations?rel=users,workers,rols&type=user,worker,rol&select=id_user&linkTo=created_user&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"];
            $method = "GET";
            $fields = array();

            $response = CurlController::request($url, $method, $fields);

            if (isset($response->status) && $response->status == 200) {
                $totalData = $response->total;
            } else {
                echo '{"data": []}';
                return;
            }

            /*=============================================
            Búsqueda de datos
            =============================================*/
            $select = "*";
            $data = array();
            $recordsFiltered = 0;

            if (!empty($_POST['search']['value'])) {
                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {
                    $linkTo = ["name_worker", "username_user", "rol_name", "method_user", "created_user"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    foreach ($linkTo as $value) {
                        $url = "relations?rel=users,workers,rols&type=user,worker,rol&select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

                        $response = CurlController::request($url, $method, $fields);

                        if (isset($response->results) && is_array($response->results)) {
                            $data = $response->results;
                            $recordsFiltered = count($data);
                            break;
                        }
                    }
                } else {
                    echo '{"data": []}';
                    return;
                }
            } else {
                /*=============================================
                Seleccionar datos
                =============================================*/
                $url = "relations?rel=users,workers,rols&type=user,worker,rol&select=" . $select . "&linkTo=created_user&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

                $response = CurlController::request($url, $method, $fields);

                if (isset($response->results) && is_array($response->results)) {
                    $data = $response->results;
                }
                $recordsFiltered = $totalData;
            }

            /*=============================================
            Cuando la data viene vacía
            =============================================*/
            if (empty($data)) {
                echo '{"data": []}';
                return;
            }

            /*=============================================
            Construimos el dato JSON a regresar
            =============================================*/
            $dataJson = '{
                "draw": ' . intval($draw) . ',
                "recordsTotal": ' . $totalData . ',
                "recordsFiltered": ' . $recordsFiltered . ',
                "data": [';

            /*=============================================
            Recorremos la data
            =============================================*/
            foreach ($data as $key => $value) {
                if ($_GET["text"] == "flat") {
                    $actions = "";

                    /*=============================================
                    Estado
                    =============================================*/
                    if ($value->status_user == 1) {

                        $txtType = "Activo";

                    } else {

                        $txtType = "Inactivo";

                    }

                    /*=============================================
                    Datos usuario
                    =============================================*/
                    $dataUser = "<div class='d-flex flex-row'>
                                    <div class='d-flex flex-column'>
                                        <span>&nbsp;&nbsp;" . $value->username_user . "</span>
                                        <small>&nbsp;&nbsp;" . $value->name_worker . "</small>
                                    </div>
                                </div>";
                    $dataUser = TemplateController::htmlClean($dataUser);

                    /*=============================================
                    Verificado
                    =============================================*/
                    if ($value->verified_user == 1) {

                        $txtVerificado = "Verificado";

                    } else {

                        $txtVerificado = "No Verificado";

                    }

                } else {

                    /*=============================================
                    Estado
                    =============================================*/
                    if ($value->id_user == 1 || $value->name_rol == 'Super Administrador') {

                        $txtType = "";

                    } else {

                        if ($value->status_user == 1) {

                            $txtType = "<label class='switch'>
                                            <input type='checkbox' class='switch-input' id='switch" . $key . "' checked onchange='changeState(event, " . $value->id_user . ", `users`, `user`)' />
                                            <span class='switch-toggle-slider'>
                                                <span class='switch-on'>
                                                    <i class='bx bx-check'></i>
                                                </span>
                                                <span class='switch-off'>
                                                    <i class='bx bx-x'></i>
                                                </span>
                                            </span>
                                        </label>";

                        } else {

                            $txtType = "<label class='switch'>
                                            <input type='checkbox' class='switch-input' id='switch" . $key . "' onchange='changeState(event, " . $value->id_user . ", `users`, `user`)' />
                                            <span class='switch-toggle-slider'>
                                                <span class='switch-on'>
                                                    <i class='bx bx-check'></i>
                                                </span>
                                                <span class='switch-off'>
                                                    <i class='bx bx-x'></i>
                                                </span>
                                            </span>
                                        </label>";

                        }

                        $txtType = TemplateController::htmlClean($txtType);

                    }

                    /*=============================================
                    Imagen
                    =============================================*/
                    if ($value->photo_worker == '') {

                        $imgUSer = "<img src='" . TemplateController::returnImg('img', 'avatars', '') . "' class='thumb-sm rounded-circle mr-2' width='40'>";

                    } else {

                        $imgUSer = "<img src='" . TemplateController::returnImg('users', '', $value->photo_worker) . "' class='thumb-sm rounded-circle mr-2' width='40'>";

                    }

                    /*=============================================
                    Datos usuario
                    =============================================*/
                    $dataUser = "<div class='d-flex flex-row'>
                                    " . $imgUSer . "
                                    <div class='d-flex flex-column'>
                                        <span>&nbsp;&nbsp;" . $value->username_user . "</span>
                                        <small>&nbsp;&nbsp;" . TemplateController::capitalize($value->name_worker) . "</small>
                                    </div>
                                </div>";
                    $dataUser = TemplateController::htmlClean($dataUser);

                    /*=============================================
                    Vertificado
                    =============================================*/
                    if ($value->verified_user == 1) {

                        $txtVerificado = "<span class='badge bg-success'><small>Verificado</small></span>";

                    } else {

                        $txtVerificado = "<span class='badge bg-danger'><small>No Verificado</small></span>";

                    }

                    if ($value->id_user == 1 || $value->name_rol == 'Super Administrador') {

                        $actions = "";

                    } else {

                        $actions = "<div class='btn-group'>
                                    <button type='button' class='btn btn-outline-primary dropdown-toggle btn-xs waves-effect' data-bs-toggle='dropdown' aria-expanded='false'>Acciones</button>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='/users/edit/" . base64_encode($value->id_user . "~" . $_GET["token"]) . "'>Editar Registro</a></li>
                                    </ul>
                                </div>";

                        $actions = TemplateController::htmlClean($actions);

                    }

                }

                /*=============================================
                Datos contacto
                =============================================*/
                $dataContact = "<div class='d-flex flex-row'>
                                <div class='d-flex flex-column'>
                                    <small>Teléfono: " . $value->phone_worker . "</small>
                                    <small>Email: " . $value->email_worker . "</small>
                                </div>
                            </div>";
                $dataContact = TemplateController::htmlClean($dataContact);

                /*=============================================
                Contamos empresas del usuario
                =============================================*/
                if ($value->id_tenant_user != null) {

                    $allEmp = json_decode($value->id_tenant_user, true);

                } else {

                    $allEmp = array();

                }

                $created_user = TemplateController::fechaEsShort($value->created_user);

                $dataJson .= '{
                    "id_user":"' . ($start + $key + 1) . '",
            		"status_user":"' . $txtType . '",
            		"data_user":"' . $dataUser . '",
                    "contact_user":"' . $dataContact . '",
                    "rol_user":"' . $value->name_rol . '",
                    "method_user":"' . $value->method_user . '",
                    "verified_user":"' . $txtVerificado . '",
                    "tenants_user":"' . count($allEmp) . '",
            		"created_user":"' . $created_user . '",
                    "actions":"' . $actions . '"
                },';
            }

            $dataJson = rtrim($dataJson, ','); // Eliminar última coma
            $dataJson .= ']}';

            echo $dataJson;
        }
    }
}

/*=============================================
Activar función DataTable
=============================================*/
$data = new DatatableController();
$data->data();
