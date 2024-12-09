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
            $url = "relations?rel=tenants,plans&type=tenant,plan&select=id_tenant&linkTo=created_tenant&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"];
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
                    $linkTo = ["name_tenant", "ruc_tenant", "email_tenant", "address_tenant", "name_plan", "price_plan", "created_tenant"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    foreach ($linkTo as $value) {
                        $url = "relations?rel=tenants,plans&type=tenant,plan&select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

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
                $url = "relations?rel=tenants,plans&type=tenant,plan&select=" . $select . "&linkTo=created_tenant&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

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
                    if ($value->status_tenant == 1) {

                        $txtType = "Activo";

                    } else {

                        $txtType = "Inactivo";

                    }

                } else {

                    /*=============================================
                    Estado
                    =============================================*/
                    if ($value->status_tenant == 1) {

                        $txtType = "<label class='switch'>
                                        <input type='checkbox' class='switch-input' id='switch" . $key . "' checked onchange='changeState(event, " . $value->id_tenant . ", `tenants`, `tenant`)' />
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
                                        <input type='checkbox' class='switch-input' id='switch" . $key . "' onchange='changeState(event, " . $value->id_tenant . ", `tenants`, `tenant`)' />
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
                                        <li><a class='dropdown-item' href='/tenants/edit/" . base64_encode($value->id_tenant . "~" . $_GET["token"]) . "'>Editar Registro</a></li>
                                        <li><a class='dropdown-item' href='/tenants/view/" . base64_encode($value->id_tenant . "~" . $_GET["token"]) . "'>Ver Perfil</a></li>
                                    </ul>
                                </div>";

                    $actions = TemplateController::htmlClean($actions);
                }

                /*=============================================
                Datos Plan
                =============================================*/
                $dataPlan = "<div class='d-flex flex-row'>
                                <div class='d-flex flex-column'>
                                    <small>" . $value->name_plan . "</small>
                                    <small>" . $value->price_plan . "</small>
                                </div>
                            </div>";
                $dataPlan = TemplateController::htmlClean($dataPlan);

                /*=============================================
                Datos Fecha
                =============================================*/
                if($value->prox_bill_tenant == '0000-00-00') {

                    $proxFact = '----';

                } else {

                    $proxFact = TemplateController::fechaEsShort($value->prox_bill_tenant);

                }

                $dataFecha = "<div class='d-flex flex-row'>
                                <div class='d-flex flex-column'>
                                    <small>Creado: " . TemplateController::fechaEsShort($value->created_tenant) . "</small>
                                    <small>Prox. Fact.: " . $proxFact . "</small>
                                </div>
                            </div>";
                $dataFecha = TemplateController::htmlClean($dataFecha);

                /*=============================================
                Obtenemos los datos de facturación electrónica
                =============================================*/
                $jsonSunat = $value->sunat_tenant;
                $arraySunat = json_decode($jsonSunat, true);
                foreach ($arraySunat as $elementSunat) {

                    $factElect = $elementSunat["api"];
                    //$phaseElect = $elementSunat["phase"];

                }

                /*if($phaseElect == '') {

                    $phase = '----';

                } else {

                    $phase = TemplateController::capitalize($phaseElect);

                }*/

                /*=============================================
                Data Sunat
                =============================================*/
                $dataSunat = "<div class='d-flex flex-row'>
                                <div class='d-flex flex-column'>
                                    <small>Activado: " . TemplateController::capitalize($factElect) . "</small>
                                </div>
                            </div>";
                $dataSunat = TemplateController::htmlClean($dataSunat);

                /*=============================================
                Datos empresa
                =============================================*/
                $dataTenant = "<div class='d-flex flex-row'>
                                <div class='d-flex flex-column'>
                                    <small>" . $value->ruc_tenant . "</span><br>
                                    <small>" . $value->name_tenant . "</small>
                                </div>
                            </div>";
                $dataTenant = TemplateController::htmlClean($dataTenant);

                $dataJson .= '{
                    "id_tenant": "' . ($start + $key + 1) . '",
                    "status_tenant": "' . $txtType . '",
                    "name_tenant": "' . $dataTenant . '",
                    "plan_tenant": "' . $dataPlan . '",
                    "sunat_tenant": "' . $dataSunat . '",
                    "created_tenant": "' . $dataFecha . '",
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
