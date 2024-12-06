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
            $url = "warehouses?select=id_warehouse&linkTo=id_tenant_warehouse&equalTo=" . $_GET["tenant"];
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
                    $linkTo = ["name_warehouse", "address_warehouse", "created_warehouse"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    foreach ($linkTo as $value) {
                        $url = "warehouses?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length . "&filterTo=id_tenant_warehouse&inTo=" . $_GET["tenant"];

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
                $url = "warehouses?select=" . $select . "&linkTo=id_tenant_warehouse&equalTo=" . $_GET["tenant"] . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

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

                /*=============================================
                Estado
                =============================================*/
                if ($value->status_warehouse == 1) {

                    $txtType = "<label class='switch'>
                                    <input type='checkbox' class='switch-input' id='switch" . $key . "' checked onchange='changeState(event, " . $value->id_warehouse . ", `warehouses`, `warehouse`)' />
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
                                    <input type='checkbox' class='switch-input' id='switch" . $key . "' onchange='changeState(event, " . $value->id_warehouse . ", `warehouses`, `warehouse`)' />
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

                $name_warehouse = $value->name_warehouse;
                $address_warehouse = $value->address_warehouse;
                $created_warehouse = TemplateController::fechaEsShort($value->created_warehouse);

                $dataJson .= '{
                    "id_warehouse": "' . ($start + $key + 1) . '",
                    "status_warehouse": "' . $txtType . '",
                    "name_warehouse": "' . TemplateController::capitalize($name_warehouse) . '",
                    "address_warehouse": "' . TemplateController::capitalize($address_warehouse) . '",
                    "created_warehouse": "' . $created_warehouse . '"
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
