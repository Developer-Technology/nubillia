<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

class TenantsController{

    /*=============================================
	Todas las empresas
	=============================================*/	
	public static function getalltenants(){

		$url = "tenants";
		$method = "GET";
		$fields = array();

		$response = CurlController::request($url,$method,$fields);

        /*=============================================
        Validamos si se tiene un usuario
        =============================================*/	
        if($response->status == 200){

            /*=============================================
            Obtenemos los datos del usuario
            =============================================*/	
            return $response;

        } else {

            return "Not found";

        }

	}

	/*=============================================
	Datos empresa / tienda
	=============================================*/	
	public static function getdata($id){

		$url = "relations?rel=stores,tenants&type=store,tenant&select=*&linkTo=id_store&equalTo=".$id;
		$method = "GET";
		$fields = array();

		$response = CurlController::request($url,$method,$fields);

        /*=============================================
        Validamos si se tiene un usuario
        =============================================*/	
        if($response->status == 200){

            /*=============================================
            Obtenemos los datos del usuario
            =============================================*/	
            return $response->results[0];

        }

	}

    /*=============================================
    Crear empresa
    =============================================*/
    public function create($idTenants, $idStores, $plan, $idPlan)
    {

        if (isset($_POST['ruc-tenant'])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';
            
            $tokenApi = TemplateController::tokenApi();

            /*=============================================
            Validamos los datos enviados de usuario asignado
            =============================================*/
            if ($idTenants != NULL && $idStores != NULL) {

                $idTenants = $idTenants;
                $idStores = $idStores;

            } else {

                $urlGetUser = "users?select=*&linkTo=id_user&equalTo=" . $_POST['usuario-tenant'];
                $methodGetUser = "GET";
                $fieldsGetUser = array();
                $responseGetUser = CurlController::request($urlGetUser, $methodGetUser, $fieldsGetUser);

                $idTenants = $responseGetUser->results[0]->id_tenant_user;
                $idStores = $responseGetUser->results[0]->id_store_user;

            }

            /*=============================================
            Validamos los datos enviados para la redireccion
            =============================================*/
            if($plan != NULL && $idPlan != NULL) {

                $urlRegister = '/';

            } else {

                $urlRegister = '/tenants';

            }

            /*=============================================
            Verificamos si se envia un usuario desde el formulario
            =============================================*/
            if(isset($_POST['usuario-tenant'])) {

                $usuarioRegistro = $_POST['usuario-tenant'];

            } else {

                $usuarioRegistro = $_SESSION["user"]->id_user;

            }

            /*=============================================
            Validamos se se envia algun dato en el plan
            =============================================*/
            if($plan != NULL) {

                $plan = $plan;

            } else {

                $plan = $_POST['plan-tenant'];

            }

            /*=============================================
            Creamos la clave secreta
            =============================================*/
            $secretKey = TemplateController::secretKey($_POST["ruc-tenant"]);

            $json[] = ['api' => $_POST['status-billing'], 'token' => $_POST['token-billing'], 'secret' => $_POST['secret-billing']];
            $content = json_encode($json);

            $url = "tenants?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
            $method = "POST";
            $fields = array(
                "ruc_tenant" => $_POST["ruc-tenant"],
                "name_tenant" => $_POST["name-tenant"],
                "phone_tenant" => $_POST["phone-tenant"],
                "email_tenant" => $_POST["email-tenant"],
                "id_plan_tenant" => $plan,
                "address_tenant" => $_POST["address-tenant"],
                "web_tenant" => $_POST["web-tenant"],
                "status_tenant" => 1,
                "sunat_tenant" => $content,
                "created_tenant" => date('Y-m-d'),
            );

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                /* Creamos la tienda */
                $urlStore = "stores?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
                $methodStore = "POST";
                $fieldsStore = array(
                    "id_tenant_store" => $response->results->lastId,
                    "name_store" => "Tienda Principal",
                    "address_store" => $_POST["address-tenant"],
                    "status_store" => 1,
                    "type_store" => 1,
                    "created_store" => date('Y-m-d'),
                );

                $responseStore = CurlController::request($urlStore, $methodStore, $fieldsStore);

                /* Creamos el almacen */
                $urlWarehouse = "warehouses?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
                $methodWarehouse = "POST";
                $fieldsWarehouse = array(
                    "id_tenant_warehouse" => $response->results->lastId,
                    "id_store_warehouse" => $responseStore->results->lastId,
                    "name_warehouse" => "Almacén Principal",
                    "address_warehouse" => $_POST["address-tenant"],
                    "status_warehouse" => 1,
                    "created_warehouse" => date('Y-m-d'),
                );

                $responseWarehouse = CurlController::request($urlWarehouse, $methodWarehouse, $fieldsWarehouse);

                /* Obtenemos los datos del usuario */
                $urlGetUsuario = "relations?rel=users,workers,rols&type=user,worker,rol&select=*&linkTo=id_user&equalTo=" . $_POST['usuario-tenant'];
                $methodGetUsuario = "GET";
                $fieldsGetUsuario = array();
                $responseGetUsuario = CurlController::request($urlGetUsuario, $methodGetUsuario, $fieldsGetUsuario);

                /*=============================================
                Actualizamos el usuario con la empresa
                =============================================*/
                $dataArray = $idTenants;

                if ($dataArray != null) {

                    $arr = json_decode($dataArray, true);
                    array_push($arr, array("id" => $response->results->lastId));
                    $tenants = json_encode($arr);

                } else {

                    $json[] = ['id' => $response->results->lastId];
                    $tenants = json_encode($json);

                }

                /*=============================================
                Actualizamos el usuario con la tienda
                =============================================*/
                $dataArrayStore = $idStores;

                if ($dataArrayStore != null) {

                    $arrStore = json_decode($dataArrayStore, true);
                    array_push($arrStore, array("id" => $responseStore->results->lastId));
                    $arrayStores = json_encode($arrStore);

                } else {

                    $jsonStores[] = ['id' => $responseStore->results->lastId];
                    $arrayStores = json_encode($jsonStores);

                }

                /* Actualizamos el listado de empresas */
                $urlUp = 'users?id=' . $usuarioRegistro . '&nameId=id_user&token=' . $_SESSION["user"]->token_user . '&table=users&suffix=user';
                $methodUp = "PUT";
                $fieldsUp = "id_tenant_user=" . $tenants . "&id_store_user=" . $arrayStores;

                $responseU = CurlController::request($urlUp, $methodUp, $fieldsUp);

                /*=============================================
                Creamos un id unico para las transferencias que no son paypal o culqui
                =============================================*/
                $transVenta = TemplateController::generateUniqueId();

                /*=============================================
                Obtenemos el precio del plan seleccionado
                =============================================*/
                $urlGetPlan = "plans?select=*&linkTo=id_plan&equalTo=" . $plan;
                $methodGetPlan = "GET";
                $fieldsGetPlan = array();
                $responseGetPlan = CurlController::request($urlGetPlan, $methodGetPlan, $fieldsGetPlan);
                $montoPlan = $responseGetPlan->results[0]->price_plan;
                $ventaPlan = $responseGetPlan->results[0]->sales_plan;
                $sumaPlan = $ventaPlan + 1;

                /*=============================================
                Validamos se si envia algun limite del periodo del servicio
                =============================================*/
                if(isset($_POST['periodo-tenant'])) {

                    if ($_POST['periodo-tenant'] != 'unlimited') {

                        $fechaActual = date('Y-m-d'); // Obtener la fecha actual en formato 'YYYY-MM-DD'
                        $fechaNueva = date('Y-m-d', strtotime('+' . $_POST['periodo-tenant'] . ' month', strtotime($fechaActual))); // Aumentar un mes a la fecha actual
                        $precioPlan = $montoPlan * $_POST['periodo-tenant'];
    
                    } else {
    
                        $fechaNueva = '0000-00-00';
                        $precioPlan = $montoPlan;
    
                    }

                } else {

                    $fechaActual = date('Y-m-d'); // Obtener la fecha actual en formato 'YYYY-MM-DD'
                    $fechaNueva = date('Y-m-d', strtotime('+1 month', strtotime($fechaActual))); // Aumentar un mes a la fecha actual
                    $precioPlan = $montoPlan;

                }

                /*=============================================
                Validamos si el registro se hace desde el panel o por el usuario
                =============================================*/
                if($idPlan != NULL) {
                 
                    $urlSale = 'saleadmins?id=' . $idPlan . '&nameId=trans_saleadmin&token=' . $_SESSION["user"]->token_user . '&table=users&suffix=user';
                    $methodSale = "PUT";
                    $fieldsSale = "id_tenant_saleadmin=" . $response->results->lastId;

                    $responseSale = CurlController::request($urlSale, $methodSale, $fieldsSale);
                    
                } else {

                    /*=============================================
                    Obtenemos el tipo de cambio
                    =============================================*/
                    $urlTC = "exchange/consult";
                    $methodTC = "POST";
                    $dataTC = array();

                    $fieldsTC = $dataTC;

                    $responseTC = CurlController::requestSunat($urlTC, $methodTC, $fieldsTC, $tokenApi);

                    if ($responseTC->response->success == true) {

                        $tC = $responseTC->response->data->compra;
                        $tV = $responseTC->response->data->venta;

                    } else {

                        $tC = 1;
                        $tV = 1;

                    }

                    /* Moneda */
                    if($_POST["metodo_pago-tenant"] == "Paypal") {
                        
                        $monedaPago = "USD";

                    } else {

                        $monedaPago = "PEN";

                    }

                    /*=============================================
                    Insertamos el registro de venta
                    =============================================*/
                    $urlSale = "saleadmins?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
                    $methodSale = "POST";
                    $fieldsSale = array(
                        "id_user_saleadmin" => $usuarioRegistro,
                        "id_plan_saleadmin" => $plan,
                        "id_tenant_saleadmin" => $response->results->lastId,
                        "method_saleadmin" => $_POST["metodo_pago-tenant"],
                        "trans_saleadmin" => $transVenta,
                        "money_saleadmin" => $monedaPago,
                        "price_saleadmin" => $precioPlan,
                        "type_change_saleadmin" => $tC,
                        "status_saleadmin" => "pagado",
                        "created_saleadmin" => date('Y-m-d'),
                    );

                    $responseSale = CurlController::request($urlSale, $methodSale, $fieldsSale);

                }

                /*=============================================
                Actualizamos las ventas de planes
                =============================================*/
                $urlUptPlan = 'plans?id=' . $plan . '&nameId=id_plan&token=' . $_SESSION["user"]->token_user . '&table=users&suffix=user';
                $methodUptPlan = "PUT";
                $fieldsUptPlan = "sales_plan=" . $sumaPlan;

                $responseUptPlan = CurlController::request($urlUptPlan, $methodUptPlan, $fieldsUptPlan);

                /*=============================================
                Actualizamos la fecha proxima de facturacion
                =============================================*/
                $urlPf = 'tenants?id=' . $response->results->lastId . '&nameId=id_tenant&token=' . $_SESSION["user"]->token_user . '&table=users&suffix=user';
                $methodPf = "PUT";
                $fieldsPf = "prox_bill_tenant=" . $fechaNueva;

                $responsePf = CurlController::request($urlPf, $methodPf, $fieldsPf);

                /*=============================================
                Validamos si se tiene conexión con Supabase
                =============================================*/
                $urlSet = "settings";
                $methodSet = "GET";
                $fieldsSet = array();

                $responseSet = CurlController::request($urlSet, $methodSet, $fieldsSet);

                /*=============================================
                Capturar datos de la facturacion
                =============================================*/
                $jsonFacturacion = $responseSet->results[0]->invoice_setting;
                $datosFacturacion = json_decode($jsonFacturacion, true);

                /*=============================================
                Insertamos el registro de la suscripcion
                =============================================*/
                $urlSusc = "suscriptions?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
                $methodSusc = "POST";
                $fieldsSusc = array(
                    "id_tenant_suscription" => $response->results->lastId,
                    "id_user_suscription" => $usuarioRegistro,
                    "id_plan_suscription" => $plan,
                    "trans_suscription" => $transVenta,
                    "emision_suscription" => date('Y-m-d'),
                    "pay_suscription" => date('Y-m-d'),
                    "price_suscription" => $precioPlan,
                    "method_suscription" => $_POST["metodo_pago-tenant"],
                    "operation_suscription" => $_POST["comprobante-tenant"],
                    "status_suscription" => "pagado",
                    "created_suscription" => date('Y-m-d'),
                );

                $responseSusc = CurlController::request($urlSusc, $methodSusc, $fieldsSusc);

                echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "' . $response->results->comment . '", "' . $urlRegister . '");
                        </script>';
                    
                    return;

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "' . $response->results . '");
                    </script>';
                    
                return;

            }

        }

    }

    /*=============================================
    Modificar empresas
    =============================================*/
    public static function edit($id)
    {

        if (isset($_POST["idTenant"])) {

            /*=============================================
            Mensaje de carga
            =============================================*/
            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            /*=============================================
            Enviamos los datos
            =============================================*/
            if ($_POST["idTenant"] == $id) {

                $select = "*";

                $url = "tenants?select=" . $select . "&linkTo=id_tenant&equalTo=" . $id;
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if ($response->status == 200) {

                    // Decodificar el JSON
                    $json = $response->results[0]->sunat_tenant;
                    $datosApi = json_decode($json, true);

                    // Acceder y editar los valores del arreglo
                    $datosApi[0]['api'] = $_POST["status-sunat"];
                    $datosApi[0]['token'] = $_POST["token-sunat"];
                    $datosApi[0]['secret'] = $_POST["secret-sunat"];

                    // Codificar de nuevo el JSON
                    $json = json_encode($datosApi);

                    $data = "web_tenant=" . $_POST["web-tenant"] . "&phone_tenant=" . $_POST["phone-tenant"] . "&email_tenant=" . $_POST["email-tenant"] . "&address_tenant=" . $_POST["address-tenant"]. "&prox_bill_tenant=" . $_POST["pfact-tenant"] . "&id_plan_tenant=" . $_POST["plan-tenant"] . "&sunat_tenant=" . $json;

                    $url = "tenants?id=" . $id . "&nameId=id_tenant&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
                    $method = "PUT";
                    $fields = $data;

                    $response = CurlController::request($url, $method, $fields);

                    if ($response->status == 200) {

                        echo '<script>
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncSweetAlert("success", "' . $response->results->comment . '", "/tenants");
                            </script>';

                    } else {

                        echo '<script>
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "' . $response->results . '");
                            </script>';

                    }

                } else {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "No se econtró el registro a editar.");
                        </script>';

                }

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Debe enviar un ID para editar.");
                    </script>';

            }

        }

    }

}