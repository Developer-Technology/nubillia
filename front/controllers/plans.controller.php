<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

class PlansController
{

    /*=============================================
    Crear datos
    =============================================*/
    public function create()
    {

        if (isset($_POST['name-plan'])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            $json[] = ['users' => $_POST['users-plan'], 'stores' => $_POST['stores-plan'], 'warehouses' => $_POST['warehouses-plan']];
            $content = json_encode($json);

            $url = "plans?token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
            $method = "POST";
            $fields = array(
                "name_plan" => $_POST["name-plan"],
                "description_plan" => TemplateController::htmlClean($_POST["description-plan"]),
                "price_plan" => $_POST["price-plan"],
                "content_plan" => $content,
                "status_plan" => 1,
                "created_plan" => date('Y-m-d'),
            );

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $response->results->comment . '", "/plans");
                    </script>';

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "' . $response->results . '");
                    </script>';

            }

        }

    }

    /*=============================================
    Editar datos
    =============================================*/
    public function edit($id)
    {

        if (isset($_POST["idPlan"])) {

            echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Cargando...", "");
				</script>';

            if ($id == $_POST["idPlan"]) {

                $select = "*";

                $url = "plans?select=" . $select . "&linkTo=id_plan&equalTo=" . $id;
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if ($response->status == 200) {

                    // Decodificar el JSON
                    $json = $response->results[0]->content_plan;
                    $datosPlan = json_decode($json, true);

                    // Acceder y editar los valores del arreglo
                    $datosPlan[0]['users'] = $_POST["users-plan"];
                    $datosPlan[0]['stores'] = $_POST["stores-plan"];
                    $datosPlan[0]['warehouses'] = $_POST["warehouses-plan"];

                    // Codificar de nuevo el JSON
                    $json = json_encode($datosPlan);

                    /*=============================================
                    Agrupamos la información
                    =============================================*/
                    $dataUp = "name_plan=" . trim(TemplateController::capitalize($_POST["name-plan"])) . "&description_plan=" . trim(TemplateController::htmlClean($_POST["description-plan"])) . "&price_plan=" . $_POST["price-plan"]. "&content_plan=" . $json;

                    /*=============================================
                    Solicitud a la API
                    =============================================*/
                    $url = "plans?id=" . $id . "&nameId=id_plan&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
                    $method = "PUT";
                    $fields = $dataUp;

                    $response = CurlController::request($url, $method, $fields);

                    /*=============================================
                    Respuesta de la API
                    =============================================*/
                    if ($response->status == 200) {

                        echo '<script>
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncSweetAlert("success", "' . $response->results->comment . '", "/plans");
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
                            fncNotie(3, "' . $response->results . '");
                        </script>';

                }

            } else {

                echo '<script>
						fncFormatInputs();
						matPreloader("off");
						fncSweetAlert("close", "", "");
						fncNotie(3, "No se pudo editar el registro");
					</script>';

            }

        }

    }

}