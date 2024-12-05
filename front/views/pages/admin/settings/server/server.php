<?php

    /*=============================================
    Obtenemos las configuraciones adicionales
    =============================================*/
    foreach (json_decode($getSetting->server_setting) as $key => $elementServer) {

        $server = $elementServer->server;
        $host = $elementServer->host;
        $user = $elementServer->user;
        $password = $elementServer->pass;
        $security = $elementServer->security;
        $port = $elementServer->port;
        $email = $elementServer->email;

    }

    /*=============================================
    Validamos el estadi
    =============================================*/
    if($server == 'no') {

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
            <button type="button" class="nav-link active" onclick="window.open('/settings/server','_self');">Servidor De
                Correo</button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" onclick="window.open('/settings/favicon','_self');">Favicon</button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link"
                onclick="window.open('/settings/billing','_self');">Facturación</button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" onclick="window.open('/settings/gateway','_self');">Pasarelas De
                Pago</button>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade show active">
            <p>
                <h5 class="card-title">Servidor De Correo</h5>
                <p>Requerido para la configuración para el envío de correos.</p>
            </p>

            <form method="post" class="needs-validation" novalidate autocomplete="off">

                <div class="row">

                    <!--=====================================
                    Estado
                    ======================================-->
                    <div class="col-md-4">

                        <label for="server-mail">Estado <sup class="text-danger">*</sup></label>
                        <div class="mt-2 mb-3">
                            <select id="selectpickerBasic" class="selectpicker w-100" name="server-mail" data-style="btn-default" onchange="changeServer(this)" required>
                                <?php if($server == 'si'): ?>
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
                    Host
                    ======================================-->
                    <div class="col-md-4">

                        <label for="">Host <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <input type="text" name="host-mail" class="form-control host-mail value-none required readonly" placeholder="Host" value="<?php echo $host ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                        </div>

                    </div>

                    <!--=====================================
                    Usuario
                    ======================================-->
                    <div class="col-md-4">

                        <label for="">Usuario <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <input type="text" name="user-mail" class="form-control value-none required readonly" placeholder="Usuario" value="<?php echo $user ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                        </div>

                    </div>

                    <!--=====================================
                    Password
                    ======================================-->
                    <div class="col-md-4 form-password-toggle">

                        <label for="">Contraseña <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="input-group input-group-merge mt-2 mb-3">
                            <input type="password" class="form-control value-none required readonly" name="pass-mail" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" value="<?php echo $password ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                            <span class="input-group-text cursor-pointer" onclick="showP()"><i class="bx bx-hide" id="toggleIcon"></i></span>
                        </div>

                    </div>

                    <!--=====================================
                    Puerto
                    ======================================-->
                    <div class="col-md-2">

                        <label for="">Puerto <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <input type="number" name="port-mail" class="form-control value-none required readonly" placeholder="Puerto" value="<?php echo $port ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                        </div>

                    </div>

                    <!--=====================================
                    Seguridad
                    ======================================-->
                    <div class="col-md-2">

                        <label for="security-mail">Seguridad <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <select id="selectpickerBasic" class="selectpicker w-100 value-none required readonly" name="security-mail" data-style="btn-default" <?php echo $required ?> <?php echo $readOnly ?>>
                                <?php if($security == 'ssl'): ?>
                                    <option disabled>Seleccionar</option>
                                    <option value="ssl" selected>SSL</option>
                                    <option value="tls">TLS</option>
                                <?php elseif($security == 'tls'): ?>
                                    <option disabled>Seleccionar</option>
                                    <option value="ssl">SSL</option>
                                    <option value="tls" selected>TLS</option>
                                <?php else: ?>
                                    <option disabled selected>Seleccionar</option>
                                    <option value="ssl">SSL</option>
                                    <option value="tls">TLS</option>
                                <?php endif; ?>
                            </select>
                        </div>

                    </div>

                    <!--=====================================
                    Correo
                    ======================================-->
                    <div class="col-md-4">

                        <label for="">Correo Emisor <sup class="text-danger <?php echo $spanRequire ?>">*</sup></label>
                        <div class="mt-2 mb-3">
                            <input type="email" name="email-mail" class="form-control value-none required readonly" placeholder="Correo Emisor" value="<?php echo $email ?>" <?php echo $required ?> <?php echo $readOnly ?>>
                        </div>

                    </div>

                </div>

                <?php

                    /*=============================================
                    Controladores
                    =============================================*/
                    require_once "controllers/settings.controller.php";

                    $edit = new SettingsController();
                    $edit->editServer();

                ?>

                <!--=====================================
                Botones
                ======================================-->
                <div class="col-md-12 mt-2">

                    <a class="btn btn-default border text-left" href="/settings/server">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-right">Guardar</button>

                </div>

            </form>

        </div>
    </div>
</div>