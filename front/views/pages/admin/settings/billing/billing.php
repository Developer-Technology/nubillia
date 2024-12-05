<?php

    /*=============================================
    Obtenemos las configuraciones adicionales
    =============================================*/
    foreach (json_decode($getSetting->invoice_setting) as $key => $elementInvoice) {

        /* Estado */
        $activo = $elementInvoice->api->activo;
        /* Factura */
        $serie = $elementInvoice->factura->serie;
        $correlativo = $elementInvoice->factura->correlativo;
        $automatico = $elementInvoice->factura->automatico;
        /* Api */
        $token = $elementInvoice->api->token;
        $secret = $elementInvoice->api->secret;

    }

    /*=============================================
    Validamos el estado
    =============================================*/
    if($activo == 'no') {

        $required = '';
        $spanRequire = 'hidden';
        $readOnly = 'readonly';

    } else {

        $required = 'required';
        $spanRequire = '';
        $readOnly = '';

    }

?>

<div class="nav-align-top mb-4">

    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link" onclick="window.open('/settings/general','_self');">General</button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" onclick="window.open('/settings/server','_self');">Servidor De Correo</button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" onclick="window.open('/settings/favicon','_self');">Favicon</button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link active" onclick="window.open('/settings/billing','_self');">Facturación</button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" onclick="window.open('/settings/gateway','_self');">Pasarelas De Pago</button>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade show active">
            <p>
                <h5 class="card-title">Datos del API</h5>
                <p>Requerido para la conexión con el API de facturación electrónica.</p>
            </p>

            <form method="post" class="needs-validation" novalidate autocomplete="off">

                <div class="row">

                    <!--=====================================
                    Estado
                    ======================================-->
                    <div class="col-md-4">

                        <label for="status-billing">Estado <sup class="text-danger">*</sup></label>
                        <div class="mt-2 mb-3">
                            <select id="selectpickerBasic" class="selectpicker w-100" name="status-billing" data-style="btn-default" onchange="changeServer(this)" required>
                                <?php if($activo == 'si'): ?>
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
                            <input type="text" name="token-billing" class="form-control host-mail value-none required readonly" placeholder="Token" value="<?php echo $token ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                        </div>

                    </div>

                    <!--=====================================
                    Clave Secreta
                    ======================================-->
                    <div class="col-md-4">

                        <label for="">Clave Secreta <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <input type="text" name="secret-billing" class="form-control value-none required readonly" placeholder="Clave Secreta" value="<?php echo $secret ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                        </div>

                    </div>

                </div>

                <!-- Datos de la factura -->
                <hr>

                <p>
                    <h5 class="card-title">Datos De La Factura</h5>
                    <p>Requerido para generar las facturas al recibir y/o aprobar un pago (inicia desde el número actual).</p>
                </p>

                <div class="row">

                    <!--=====================================
                    Serie
                    ======================================-->
                    <div class="col-md-4">

                        <label for="">Serie <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <input type="text" name="serie-billing" class="form-control value-none required readonly" placeholder="Serie" value="<?php echo $serie ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                        </div>

                    </div>

                    <!--=====================================
                    Correlativo
                    ======================================-->
                    <div class="col-md-4">

                        <label for="">Correlativo <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <input type="text" name="number-billing" class="form-control value-none required readonly" placeholder="Correlativo" value="<?php echo $correlativo ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                        </div>

                    </div>

                    <!--=====================================
                    Envío a SUNAT
                    ======================================-->
                    <div class="col-md-4">

                        <label for="send-billing">Envío a SUNAT <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <select id="selectpickerBasic" class="selectpicker w-100 value-none required readonly" name="send-billing" data-style="btn-default" <?php echo $required ?> <?php echo $readOnly ?>>
                                <?php if($automatico == 'si'): ?>
                                    <option disabled>Seleccionar</option>
                                    <option value="si" selected>Automático</option>
                                    <option value="no">Manual</option>
                                <?php elseif($automatico == 'no'): ?>
                                    <option disabled>Seleccionar</option>
                                    <option value="si">Automático</option>
                                    <option value="no" selected>Manual</option>
                                <?php else: ?>
                                    <option disabled selected>Seleccionar</option>
                                    <option value="si">Automático</option>
                                    <option value="no">Manual</option>
                                <?php endif; ?>
                            </select>
                        </div>

                    </div>

                </div>

                <?php

                    /*=============================================
                    Controladores
                    =============================================*/
                    require_once "controllers/settings.controller.php";

                    $edit = new SettingsController();
                    $edit->editBilling();

                ?>

                <!--=====================================
                Botones
                ======================================-->
                <div class="col-md-12 mt-2">

                    <a class="btn btn-default border text-left" href="/settings/billing">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-right">Guardar</button>

                </div>

            </form>

        </div>
    </div>
</div>