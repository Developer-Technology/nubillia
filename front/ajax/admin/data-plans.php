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
            $url = "plans?select=id_plan&linkTo=created_plan&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"];
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
                    $linkTo = ["name_plan", "price_plan", "description_plan", "created_plan"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    foreach ($linkTo as $value) {
                        $url = "plans?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

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
                $url = "plans?select=" . $select . "&linkTo=created_plan&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

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
                    if ($value->status_plan == 1) {

                        $txtType = "Activo";

                    } else {

                        $txtType = "Inactivo";

                    }

                } else {

                    /*=============================================
                    Estado
                    =============================================*/
                    if ($value->status_plan == 1) {

                        $txtType = "<label class='switch'>
                                        <input type='checkbox' class='switch-input' id='switch" . $key . "' checked onchange='changeState(event, " . $value->id_plan . ", `plans`, `plan`)' />
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
                                        <input type='checkbox' class='switch-input' id='switch" . $key . "' onchange='changeState(event, " . $value->id_plan . ", `plans`, `plan`)' />
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

                    $actions = "<div class='btn-group'>
                                    <button type='button' class='btn btn-outline-primary dropdown-toggle btn-xs waves-effect' data-bs-toggle='dropdown' aria-expanded='false'>Acciones</button>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='/plans/edit/" . base64_encode($value->id_plan . "~" . $_GET["token"]) . "'>Editar Registro</a></li>
                                        <li><a class='dropdown-item removeItem pointer' idItem='" . base64_encode($value->id_plan . "~" . $_GET["token"]) . "' table='plans' suffix='plan' deleteFile='no' page='plans'>Eliminar Registro</a></li>
                                    </ul>
                                </div>";

                    $actions = TemplateController::htmlClean($actions);
                }

                $name_plan = $value->name_plan;
                $precioPlan = $value->price_plan;
                $created_plan = TemplateController::fechaEsShort($value->created_plan);

                $dataJson .= '{
                    "id_plan": "' . ($start + $key + 1) . '",
                    "status_plan": "' . $txtType . '",
                    "name_plan": "' . TemplateController::capitalize($name_plan) . '",
                    "price_plan": "' . $precioPlan . '",
                    "created_plan": "' . $created_plan . '",
                    "actions": "' . $actions . '"
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
