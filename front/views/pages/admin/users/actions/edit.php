<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/
	
	if(isset($routesArray[3])) {
		
		$security = explode("~",base64_decode($routesArray[3]));
	
		if($security[1] == $_SESSION["user"]->token_user) {

			$select = "*";

			$url = "plans?select=".$select."&linkTo=id_plan&equalTo=".$security[0];;
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url,$method,$fields);
			
			if($response->status == 200) {

				$plan = $response->results[0];

                /*=============================================
                Obtenemos lo que contiene el plan
                =============================================*/
                $jsonPlan = $plan->content_plan;
                $arrayPlan = json_decode($jsonPlan, true);
                foreach ($arrayPlan as $elementPlan) {

                    $totalUsers = $elementPlan["users"];
                    $totalStores = $elementPlan["stores"];
                    $totalWarehouses = $elementPlan["warehouses"];

                }

			} else {

				echo '<script>
                        window.location = "/plans";
                    </script>';

			}

		} else {

			echo '<script>
                    window.location = "/plans";
                </script>';

		}

	}

?>

<div class="row">
    <!-- Snow Theme -->
    <div class="col-12">
        <div class="card mb-4">
            <form method="post" class="needs-validation" novalidate autocomplete="off">

                <input type="hidden" value="<?php echo $plan->id_plan ?>" name="idPlan">

                <?php

                    require_once "controllers/plans.controller.php";

                    $create = new PlansController();
                    $create -> edit($plan->id_plan);

                ?>

                <div class="card-body mb-0 pb-0">

                    <div class="row">

                        <!--=====================================
                        Nombre
                        ======================================-->
                        <div class="col-md-4">
                        
                            <label>Nombre <sup class="text-danger">*</sup></label>

                            <div class="mt-2 mb-3">

                                <input 
                                type="text" 
                                class="form-control"
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                                onchange="validateRepeat(event,'text','brands','name_brand')"
                                name="name-plan"
                                placeholder="Nombre"
                                value="<?php echo $plan->name_plan ?>"
                                required>

                            </div>

                        </div>

                        <!--=====================================
                        Precio
                        ======================================-->
                        <div class="col-md-2">

                            <label for="">Precio <sup class="text-danger">*</sup></label>

                            <div class="mt-2 mb-3">
                                <input
                                type="number"
                                class="form-control"
                                placeholder="Precio"
                                name="price-plan"
                                value="<?php echo $plan->price_plan ?>"
                                required>
                            </div>

                        </div>

                        <!--=====================================
                        Usuarios
                        ======================================-->
                        <div class="col-md-2">

                            <label for="">Usuarios <sup class="text-danger">*</sup></label>

                            <div class="mt-2 mb-3">
                                <input
                                type="number"
                                class="form-control"
                                placeholder="Usuarios"
                                name="users-plan"
                                value="<?php echo $totalUsers ?>"
                                required>
                            </div>

                        </div>

                        <!--=====================================
                        Tiendas
                        ======================================-->
                        <div class="col-md-2">

                            <label for="">Tiendas <sup class="text-danger">*</sup></label>

                            <div class="mt-2 mb-3">
                                <input
                                type="number"
                                class="form-control"
                                placeholder="Tiendas"
                                name="stores-plan"
                                value="<?php echo $totalStores ?>"
                                required>
                            </div>

                        </div>

                        <!--=====================================
                        Almacenes
                        ======================================-->
                        <div class="col-md-2">

                            <label for="">Almacenes <sup class="text-danger">*</sup></label>

                            <div class="mt-2 mb-3">
                                <input
                                type="number"
                                class="form-control"
                                placeholder="Almacenes"
                                name="warehouses-plan"
                                value="<?php echo $totalWarehouses ?>"
                                required>
                            </div>

                        </div>

                        <!--=====================================
                        Descripción
                        ======================================-->
                        <div class="col-md-12">

                            <div class="form-group mt-2 mb-3">
                                
                                <label>Descripción</label>

                                <textarea
                                class="summernote"
                                name="description-plan"
                                ><?php echo $plan->description_plan ?></textarea>

                            </div>

                        </div>
                        
                    </div>

                </div>

                <div class="card-footer mt-0 pt-0">
                            
                    <div class="col-md-8">

                        <div class="form-group">

                            <a href="/plans" class="btn btn-default border text-left">Regresar</a>
                            
                            <button type="submit" class="btn btn-primary float-right saveBtn">Guardar</button>

                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>
    <!-- /Snow Theme -->
</div>