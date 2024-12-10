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
            $url = "relations?rel=saleadmins,plans,users&type=saleadmin,plan,user&select=id_plan&linkTo=created_plan&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"];
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
                    $linkTo = ["name_plan", "price_plan", "description_plan", "trans_saleadmin", "status_saleadmin", "method_saleadmin", "username_user", "created_saleadmin"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    foreach ($linkTo as $value) {
                        $url = "relations?rel=saleadmins,plans,users&type=saleadmin,plan,user&select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

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
                $url = "relations?rel=saleadmins,plans,users&type=saleadmin,plan,user&select=" . $select . "&linkTo=created_plan&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

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

                    /* Validar si hay empresa asociada */
                    if ($value->id_tenant_saleadmin != 0) {

                        $asignado = 'Asignado';
    
                    } else {
    
                        $asignado = 'No Asignado';
    
                    }

                    /* Validar el estado */
                    if ($value->status_saleadmin != 'pagado') {

                        $pagado = 'No Pagado';
    
                    } else {
    
                        $pagado = 'Pagado';
    
                    }

                } else {

                    /* Validar si hay empresa asociada */
                    if ($value->id_tenant_saleadmin != 0) {

                        $asignado = "<span class='badge bg-info'><small>Asignado</small></span>";
    
                    } else {
    
                        $asignado = "<span class='badge bg-warning'><small>No Asignado</small></span>";
    
                    }

                    /* Validar el estado */
                    if ($value->status_saleadmin != 'pagado') {

                        $pagado = "<span class='badge bg-danger'><small>No Pagado</small></span>";
    
                    } else {
    
                        $pagado = "<span class='badge bg-success'><small>Pagado</small></span>";
    
                    }
                }

                $dataCompra = "<div class='d-flex flex-row'>
                                <div class='d-flex flex-column'>
                                    <small>Método: " . TemplateController::capitalize($value->method_saleadmin) . "</small>
                                    <small>Moneda: " . $value->money_saleadmin . "</small>
                                    <small>Total: " . $value->price_saleadmin . "</small>
                                    <small>T. Cambio: " . $value->type_change_saleadmin . "</small>
                                </div>
                            </div>";
                $dataCompra = TemplateController::htmlClean($dataCompra);

                $dataFirst = "<div class='d-flex flex-row'>
                                <div class='d-flex flex-column'>
                                    <small>ID: " . $value->trans_saleadmin . "</small>
                                    <small>Usuario: " . $value->username_user . "</small>
                                </div>
                            </div>";
                $dataFirst = TemplateController::htmlClean($dataFirst);
                
                $creado_venta = TemplateController::fechaEsShort($value->created_saleadmin);

                $dataJson .= '{
                    "id_saleadmin":"' . ($start + $key + 1) . '",
            		"trans_saleadmin":"' . $dataFirst . '",
                    "name_plan":"' . $value->name_plan . '",
            		"data_purchase":"' . $dataCompra . '",
                    "status_saleadmin":"' . $pagado . '",
            		"asign_saleadmin":"' . $asignado . '",
                    "created_saleadmin":"' . $creado_venta . '"
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
