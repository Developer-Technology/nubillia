<div class="row">
    <!-- Snow Theme -->
    <div class="col-12">
        <div class="card mb-4">
        
            <form method="post" class="needs-validation" novalidate autcomplete="off">

                <input type="hidden" value="11" id="doc-long">

                <div class="card-body mb-0 pb-0">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-3">
                                    <label for="doc-person">RUC <span id="estado-ruc"></span> <sup style="color:red;">*</sup></label>
                                    <div class="input-group mt-2 mb-3">
                                        <input type="text" class="form-control documento" id="doc-person" name="ruc-tenant" placeholder="RUC" aria-label="RUC" aria-describedby="basic-addon-search31" maxlength="11" pattern="[0-9]{1,}" onblur="validateRepeat(event,'text','tenants','ruc_tenant')" required />
                                        <button class="btn btn-outline-primary btn-sm" type="button" id="button-addon2" onclick="sendAjaxConsult('ruc')"><i class="bx bx-search"></i></button>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label for="name-tenant">Razón Social <sup style="color:red;">*</sup></label>
                                    <div class="mt-2 mb-3">
                                        <input type="text" class="form-control razon-social" id="name-tenant" name="name-tenant" placeholder="Razón Social" required >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="nc-tenant">Web</label>
                                    <div class="mt-2 mb-3">
                                        <input type="url" class="form-control" name="web-tenant" placeholder="Web" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="address-tenant">Dirección <span id="habido-ruc"></span> <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">
                                        <input type="text" class="form-control domicilio" id="address-tenant" name="address-tenant" placeholder="Dirección" required >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="phone-tenant">Teléfono <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">
                                        <input type="text" class="form-control phone-tenant" id="phone-tenant" name="phone-tenant" placeholder="Teléfono" pattern="[-\\(\\)\\0-9 ]{1,}" onchange="validateJS(event, 'phone')" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="email-tenant">Correo Electrónico <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">
                                        <input type="email" class="form-control" id="email-tenant" name="email-tenant" placeholder="Correo Electrónico" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="plan-tenant">Plan <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">

                                        <?php 

                                            $url = "plans?select=id_plan,name_plan,price_plan&orderBy=price_plan&orderMode=ASC";
                                            $method = "GET";
                                            $fields = array();
                                            $plans = CurlController::request($url, $method, $fields)->results;

                                        ?>

                                        <select name="plan-tenant" id="selectpickerLiveSearch" class="selectpicker w-100" data-style="btn-default" data-live-search="true" required>

                                            <option value="" disabled selected>Buscar...</option>

                                        <?php foreach ($plans as $key => $value): ?>	

                                            <option value="<?php echo $value->id_plan; ?>"><?php echo $value->name_plan . ' - S/' . $value->price_plan; ?></option>

                                        <?php endforeach ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="periodo-tenant">Periodo <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">
                                        <select name="periodo-tenant" id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default" required>
                                            <option value="" disabled selected>Seleccionar</option>
                                            <option value="1">1 Mes</option>
                                            <option value="2">2 Meses</option>
                                            <option value="3">3 Meses</option>
                                            <option value="4">4 Meses</option>
                                            <option value="5">5 Meses</option>
                                            <option value="6">6 Meses</option>
                                            <option value="7">7 Meses</option>
                                            <option value="8">8 Meses</option>
                                            <option value="9">9 Meses</option>
                                            <option value="10">10 Meses</option>
                                            <option value="11">11 Meses</option>
                                            <option value="12">12 Meses</option>
                                            <option value="unlimited">Sin Límite</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="usuario-tenant">Asignar Usuario <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">

                                        <?php 

                                            $urlUser = "relations?rel=users,workers&type=user,worker&select=id_user,name_worker,username_user&orderBy=id_user&orderMode=ASC";
                                            $methodUser = "GET";
                                            $fieldsUser = array();
                                            $users = CurlController::request($urlUser, $methodUser, $fieldsUser)->results;

                                        ?>

                                        <select name="usuario-tenant" id="selectpickerLiveSearch" class="selectpicker w-100" data-style="btn-default" data-live-search="true" required>

                                            <option value="" disabled selected>Buscar...</option>

                                        <?php foreach ($users as $key => $value): ?>	

                                            <option value="<?php echo $value->id_user; ?>"><?php echo $value->name_worker . ' - ' . $value->username_user; ?></option>

                                        <?php endforeach ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="metodo_pago-tenant">Método Pago <sup style="color:red;">*</sup></label>
                                    <div class="mb-3 mt-2">
                                        <select name="metodo_pago-tenant" id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default" required>
                                            <option value="" disabled selected>Seleccionar</option>
                                            <option value="Plin">Plin</option>
                                            <option value="Yape">Yape</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Transferencia">Transferencia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="comprobante-tenant">N. Operación</label>
                                    <div class="mb-3 mt-2">
                                        <input type="text" class="form-control" id="comprobante-tenant" name="comprobante-tenant" placeholder="N. Operación">
                                    </div>
                                </div>

                                <!--=====================================
                                Estado
                                ======================================-->
                                <div class="col-md-4">

                                    <label for="status-billing">Estado API <sup style="color:red;">*</sup></label>
                                    <div class="mt-2 mb-3">
                                        <select id="selectpickerBasic" class="selectpicker w-100" name="status-billing" data-style="btn-default" onchange="changeServer(this)" required>
                                            <option value="" disabled selected>Seleccionar</option>
                                            <option value="si">Activado</option>
                                            <option value="no">Desactivado</option>
                                        </select>
                                    </div>

                                </div>

                                <!--=====================================
                                Token
                                ======================================-->
                                <div class="col-md-4">

                                    <label for="">Token <sup class="text-danger hidden">*</sup></label>
                                    <div class="mt-2 mb-3">
                                        <input type="text" name="token-billing" class="form-control host-mail value-none required readonly" placeholder="Token" readonly>
                                    </div>

                                </div>

                                <!--=====================================
                                Clave Secreta
                                ======================================-->
                                <div class="col-md-4">

                                    <label for="">Clave Secreta <sup class="text-danger hidden">*</sup></label>
                                    <div class="mt-2 mb-3">
                                        <input type="text" name="secret-billing" class="form-control value-none required readonly" placeholder="Clave Secreta" readonly>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php

                    require_once "controllers/tenants.controller.php";

                    $create = new TenantsController();
                    $create->create(NULL, NULL, NULL, NULL);

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