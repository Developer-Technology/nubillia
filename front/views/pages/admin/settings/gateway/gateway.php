<?php

    /*=============================================
    Obtenemos las configuraciones adicionales
    =============================================*/
    foreach (json_decode($getSetting->paypal_setting) as $key => $itemPaypal) {

        $clientId = $itemPaypal->client_id;
        $secret_key = $itemPaypal->secret_key;

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
            <button type="button" class="nav-link" onclick="window.open('/settings/billing','_self');">Facturación</button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link active" onclick="window.open('/settings/gateway','_self');">Pasarelas De Pago</button>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade show active">
            <p>
                <h5 class="card-title">Pasarelas De Pago</h5>
                <p>Requerido para los pagos de planes.</p>
            </p>

            <form method="post" class="needs-validation" novalidate autocomplete="off">

                <div class="accordion mb-4" id="_dm-defaultAccordion">

                    <div class="accordion-item border">
                        <div class="accordion-header" id="_dm-defAccHeadingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#_dm-defAccCollapseOne" aria-expanded="true" aria-controls="_dm-defAccCollapseOne">
                                PayPal
                            </button>
                        </div>
                        <div id="_dm-defAccCollapseOne" class="accordion-collapse collapse show" aria-labelledby="_dm-defAccHeadingOne" data-bs-parent="#_dm-defaultAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Client ID</label>
                                        <div class="mt-2 mb-3">
                                            <input type="text" class="form-control" name="client_id-paypal" placeholder="Client ID" value="<?php echo $clientId ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Secret Key</label>
                                        <div class="mt-2 mb-3">
                                            <input type="text" class="form-control" name="secret_key-paypal" placeholder="Secret Key" value="<?php echo $secret_key ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php

                    /*=============================================
                    Controladores
                    =============================================*/
                    require_once "controllers/settings.controller.php";

                    $edit = new SettingsController();
                    $edit->editGateway();

                ?>

                <!--=====================================
                Botones
                ======================================-->
                <div class="col-md-12 mt-2">

                    <a class="btn btn-default border text-left" href="/settings/gateway">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-right">Guardar</button>

                </div>

            </form>

        </div>
    </div>
</div>