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
            $url = "stores?select=id_store&linkTo=id_tenant_store&equalTo=" . $_GET["tenant"];
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
                    $linkTo = ["name_store", "address_store", "created_store"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    foreach ($linkTo as $value) {
                        $url = "stores?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length . "&filterTo=id_tenant_store&inTo=" . $_GET["tenant"];

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
                $url = "stores?select=" . $select . "&linkTo=id_tenant_store&equalTo=" . $_GET["tenant"] . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

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
                if ($value->status_store == 1) {

                    $txtType = "<label class='switch'>
                                    <input type='checkbox' class='switch-input' id='switch" . $key . "' checked onchange='changeState(event, " . $value->id_store . ", `stores`, `store`)' />
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
                                    <input type='checkbox' class='switch-input' id='switch" . $key . "' onchange='changeState(event, " . $value->id_store . ", `stores`, `store`)' />
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

                /*=============================================
                Acciones
                =============================================*/
                $actions = "<a class='btn btn-label-primary btn-sm' href='/redirect/" . base64_encode($value->id_store . "~" . $_GET["token"]) . "'>Acceder&nbsp;<i class='tf-icons bx bx-log-in-circle'></i></a>";

                $actions = TemplateController::htmlClean($actions);

                $name_store = $value->name_store;
                $address_store = $value->address_store;
                $created_store = TemplateController::fechaEsShort($value->created_store);

                $dataJson .= '{
                    "id_store": "' . ($start + $key + 1) . '",
                    "status_store": "' . $txtType . '",
                    "name_store": "' . TemplateController::capitalize($name_store) . '",
                    "address_store": "' . TemplateController::capitalize($address_store) . '",
                    "created_store": "' . $created_store . '",
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
