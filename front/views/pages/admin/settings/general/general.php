<?php

    /*=============================================
    Obtenemos las configuraciones adicionales
    =============================================*/
    foreach (json_decode($getSetting->extras_setting) as $key => $elementExtras) {

        $resetPass = $elementExtras->reset_pass;
        $registerUser = $elementExtras->register_system;
        $loginSocial = $elementExtras->social_login;

    }

?>

<div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
      <li class="nav-item">
          <button type="button" class="nav-link active" onclick="window.open('/settings/general','_self');">General</button>
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
          <button type="button" class="nav-link" onclick="window.open('/settings/gateway','_self');">Pasarelas De Pago</button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active">
          <p>
            <h5 class="card-title">Configuración General</h5>
            <p>Requerido para la personalización de datos en el front y SEO.</p>
          </p>

          <form method="post" class="needs-validation" novalidate autocomplete="off">

            <div class="row">

                <!--=====================================
                Sistema
                ======================================-->
                <div class="col-md-4">

                    <label for="">Nombre del sistema <sup class="text-danger">*</sup></label>
                    <div class="mt-2 mb-3">
                        <input type="text" name="name-sys" class="form-control" placeholder="Nombre del sistema" value="<?php echo $getSetting->name_system_setting ?>" required>
                    </div>

                </div>

                <!--=====================================
                Empresa
                ======================================-->
                <div class="col-md-4">

                    <label for="">Nombre de la empresa <sup class="text-danger">*</sup></label>
                    <div class="mt-2 mb-3">
                        <input type="text" name="name-emp" class="form-control" placeholder="Nombre de la empresa" value="<?php echo $getSetting->name_company_setting ?>" required>
                    </div>

                </div>

                <!--=====================================
                Web
                ======================================-->
                <div class="col-md-4">

                    <label for="">Web de la empresa</label>
                    <div class="mt-2 mb-3">
                        <input type="url" name="web-emp" class="form-control" placeholder="Web de la empresa" value="<?php echo $getSetting->web_setting ?>">
                    </div>

                </div>

                <!--=====================================
                Palabras Claves
                ======================================-->
                <div class="col-md-12">

                    <label for="">Palabras Clave <sup class="text-danger">*</sup></label>
                    <div class="form-group mt-2 mb-3">
                        <input
                        type="text"
                        class="form-control tags-input"
                        pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                        onchange="validateJS(event,'regex')"
                        value="<?php echo implode(",", json_decode($getSetting->keywords_setting, true)) ?>"
                        name="kw-emp"
                        placeholder="Palabras clave"
                        required>
                        <div class="invalid-feedback">Este campo es obligatorio</div>
                    </div>

                </div>

                <!--=====================================
                Descripción
                ======================================-->
                <div class="col-md-12">

                    <label>Descripción <sup class="text-danger">*</sup></label>
                    <div class="form-group mt-2 mb-3">
                        <textarea
                        class="summernote"
                        name="description-emp"
                        required
                        ><?php echo $getSetting->description_setting ?></textarea>
                        <div class="invalid-feedback">Este campo es obligatorio</div>
                    </div>

                </div>

            </div>

            <!-- Soporte -->
            <hr>

            <p>
                <h5 class="card-title">Soporte</h5>
                <p>Configura los canales de soporte como WhatsApp y YouTube.</p>
            </p>

            <div class="row">

                <!--=====================================
                WhatsApp
                ======================================-->
                <div class="col-md-4">

                    <label for="">WhatsApp</label>
                    <div class="mt-2 mb-3">
                        <input type="text" name="whatsapp-setting" class="form-control" placeholder="WhatsApp" value="<?php echo $getSetting->whatsapp_setting ?>">
                    </div>

                </div>

                <!--=====================================
                YouTube
                ======================================-->
                <div class="col-md-4">

                    <label for="">YouTube</label>
                    <div class="mt-2 mb-3">
                        <input type="text" name="youtube-setting" class="form-control" placeholder="YouTube" value="<?php echo $getSetting->youtube_setting ?>">
                    </div>

                </div>

            </div>

            <!-- Adicionales -->
            <hr>

            <p>
                <h5 class="card-title">Adicionales</h5>
                <p>Configura parámetros adicionales del sistema.</p>
            </p>

            <div class="row">

                <!--=====================================
                Permite registro
                ======================================-->
                <div class="col-md-4">

                    <label for="registro-sistema">¿Permite Registro? <sup class="text-danger">*</sup></label>
                    <div class="mt-2 mb-3">
                        <select id="selectpickerBasic" class="selectpicker w-100" name="registro-sistema" data-style="btn-default" required>
                            <?php if($registerUser == 'si'): ?>
                                <option disabled>Seleccionar</option>
                                <option value="si" selected>Sí</option>
                                <option value="no">No</option>
                            <?php else: ?>
                                <option disabled>Seleccionar</option>
                                <option value="si">Sí</option>
                                <option value="no" selected>No</option>
                            <?php endif ?>
                        </select>
                    </div>

                </div>

                <!--=====================================
                Permite recuperar contraseña
                ======================================-->
                <div class="col-md-4">

                    <label for="reset-sistema">¿Permite Reset Password? <sup class="text-danger">*</sup></label>
                    <div class="mt-2 mb-3">
                        <select id="selectpickerBasic" class="selectpicker w-100" name="reset-sistema" data-style="btn-default" required>
                            <?php if($resetPass == 'si'): ?>
                                <option disabled>Seleccionar</option>
                                <option value="si" selected>Sí</option>
                                <option value="no">No</option>
                            <?php else: ?>
                                <option disabled>Seleccionar</option>
                                <option value="si">Sí</option>
                                <option value="no" selected>No</option>
                            <?php endif ?>
                        </select>
                    </div>

                </div>

                <!--=====================================
                Permite ingreso con redes sociales
                ======================================-->
                <div class="col-md-4 hidden">

                    <label for="social-sistema">Permite Social Login? <sup class="text-danger">*</sup></label>
                    <div class="mt-2 mb-3">
                        <select id="selectpickerBasic" class="selectpicker w-100" name="social-sistema" data-style="btn-default" required>
                            <?php if($loginSocial == 'si'): ?>
                                <option disabled>Seleccionar</option>
                                <option value="si" selected>Sí</option>
                                <option value="no">No</option>
                            <?php else: ?>
                                <option disabled>Seleccionar</option>
                                <option value="si">Sí</option>
                                <option value="no" selected>No</option>
                            <?php endif ?>
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
                $edit->editGeneral();

            ?>

            <!--=====================================
            Botones
            ======================================-->
            <div class="col-md-12 mt-2">

                <a class="btn btn-default border text-left" href="/settings/general">Cancelar</a>
                <button type="submit" class="btn btn-primary float-right">Guardar</button>

            </div>

        </form>
          
        </div>
      </div>
    </div>