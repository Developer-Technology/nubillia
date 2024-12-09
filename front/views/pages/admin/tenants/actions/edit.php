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

			$url = "relations?rel=tenants,plans&type=tenant,plan&select=".$select."&linkTo=id_tenant&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url,$method,$fields);
			
			if($response->status == 200) {

				$tenant = $response->results[0];

                /*=============================================
                Obtenemos lo que contiene el api
                =============================================*/
                $jsonApi = $tenant->sunat_tenant;
                $arrayApi = json_decode($jsonApi, true);
                foreach ($arrayApi as $elementApi) {

                    $api = $elementApi["api"];
                    $token = $elementApi["token"];
                    $secret = $elementApi["secret"];

                }

                /*=============================================
                Validamos el estado
                =============================================*/
                if($api == 'no') {

                    $required = '';
                    $spanRequire = 'hidden';
                    $readOnly = 'readonly';

                } else {

                    $required = 'required';
                    $spanRequire = '';
                    $readOnly = '';

                }

			} else {

				echo '<script>
                        window.location = "/tenants";
                    </script>';

			}

		} else {

			echo '<script>
                    window.location = "/tenants";
                </script>';

		}

	}

?>

<div class="row">
    <!-- Snow Theme -->
    <div class="col-12">
        <div class="card mb-4">
            <form method="post" class="needs-validation" novalidate autcomplete="off">

                <input type="hidden" value="<?php echo $tenant->id_tenant ?>" name="idTenant">

                <div class="card-body mb-0 pb-0">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-3">
                                    <label for="doc-person">RUC <span id="estado-ruc"></span> <sup style="color:red;">*</sup></label>
                                    <div class="input-group mt-2 mb-3">
                                        <input type="text" class="form-control documento" id="doc-person" name="ruc-tenant" placeholder="RUC" aria-label="RUC" aria-describedby="basic-addon-search31" value="<?php echo $tenant->ruc_tenant ?>" disabled />
                                        <button class="btn btn-outline-primary btn-sm" type="button" id="button-addon2" disabled><i class="bx bx-search"></i></button>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label for="name-tenant">Razón Social <sup style="color:red;">*</sup></label>
                                    <div class="mt-2 mb-3">
                                        <input type="text" class="form-control razon-social" id="name-tenant" name="name-tenant" placeholder="Razón Social" value="<?php echo $tenant->name_tenant ?>" disabled >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="nc-tenant">Web</label>
                                    <div class="mt-2 mb-3">
                                        <input type="url" class="form-control" name="web-tenant" placeholder="Web" value="<?php echo $tenant->web_tenant ?>" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="address-tenant">Dirección <span id="habido-ruc"></span> <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">
                                        <input type="text" class="form-control domicilio" id="address-tenant" name="address-tenant" placeholder="Dirección" value="<?php echo $tenant->address_tenant ?>" required >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="phone-tenant">Teléfono <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">
                                        <input type="text" class="form-control phone-tenant" id="phone-tenant" name="phone-tenant" placeholder="Teléfono" pattern="[-\\(\\)\\0-9 ]{1,}" onchange="validateJS(event, 'phone')" value="<?php echo $tenant->phone_tenant ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="email-tenant">Correo Electrónico <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">
                                        <input type="email" class="form-control" id="email-tenant" name="email-tenant" placeholder="Correo Electrónico" value="<?php echo $tenant->email_tenant ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="plan-tenant">Plan <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">

                                        <?php 

                                            $url = "plans?select=id_plan,name_plan,price_plan&orderBy=price_plan&orderMode=ASC";
                                            $method = "GET";
                                            $fields = array();
                                            $plans = CurlController::request($url, $method, $fields)->results;

                                        ?>

                                        <select name="plan-tenant" id="selectpickerLiveSearch" class="selectpicker w-100" data-style="btn-default" data-live-search="true" required>

                                            <option value="" disabled>Buscar...</option>

                                            <?php foreach ($plans as $key => $value): ?>	

                                                <?php if ($value->id_plan == $tenant->id_plan_tenant): ?>

                                                    <option value="<?php echo $tenant->id_plan_tenant ?>" selected><?php echo $tenant->name_plan ?></option>

                                                <?php else: ?>

                                                    <option value="<?php echo $value->id_plan ?>"><?php echo $value->name_plan ?></option>

                                                <?php endif ?>

                                            <?php endforeach ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="pfact-tenant">Prox. Facturación</label>
                                    <div class="mb-3 mt-2">
                                        <input type="date" class="form-control" id="pfact-tenant" name="pfact-tenant" placeholder="Prox. Facturación" value="<?php echo $tenant->prox_bill_tenant ?>">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                            
                                <!--=====================================
                                Estado
                                ======================================-->
                                <div class="col-md-4">

                                    <label for="status-sunat">Estado API <sup style="color:red;">*</sup></label>
                                    <div class="mt-2 mb-3">
                                        <select id="selectpickerBasic" class="selectpicker w-100" name="status-sunat" data-style="btn-default" onchange="changeServer(this)" required>
                                        <?php if($api == 'si'): ?>
                                            <option disabled>Seleccionar</option>
                                            <option value="si" selected>Activado</option>
                                            <option value="no">Desactivado</option>
                                        <?php else: ?>
                                            <option disabled>Seleccionar</option>
                                            <option value="si">Activado</option>
                                            <option value="no" selected>Desactivado</option>
                                        <?php endif ?>
                                        </select>
                                    </div>

                                </div>

                                <!--=====================================
                                Token
                                ======================================-->
                                <div class="col-md-4">

                                    <label for="">Token <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                                    <div class="mt-2 mb-3">
                                        <input type="text" name="token-sunat" class="form-control host-mail value-none required readonly" placeholder="Token" value="<?php echo $token ?>" <?php echo $readOnly ?> <?php echo $required ?>>
                                    </div>

                                </div>

                                <!--=====================================
                                Clave Secreta
                                ======================================-->
                                <div class="col-md-4">

                                    <label for="">Clave Secreta <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                                    <div class="mt-2 mb-3">
                                        <input type="text" name="secret-sunat" class="form-control value-none required readonly" placeholder="Clave Secreta" value="<?php echo $secret ?>" <?php echo $readOnly ?> <?php echo $required ?>>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php

                    require_once "controllers/tenants.controller.php";

                    $create = new TenantsController();
                    $create->edit($tenant->id_tenant);

                ?>

                <div class="card-footer mt-0 pt-0">
                            
                    <div class="col-md-8">

                        <div class="form-group">

                            <a href="/tenants" class="btn btn-default border text-left">Regresar</a>
                            
                            <button type="submit" class="btn btn-primary float-right saveBtn">Guardar</button>

                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>
    <!-- /Snow Theme -->
</div>