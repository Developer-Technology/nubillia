<div class="nav-align-top mb-4">

  <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link" onclick="window.open('/settings/general','_self');">General</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link" onclick="window.open('/settings/server','_self');">Servidor De Correo</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link active" onclick="window.open('/settings/favicon','_self');">Favicon</button>
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
        <h5 class="card-title">Cargar Favicon</h5>
        <p>Realiza la carga del Favicon de la empresa en formato ".png" o ".jpg".</p>
      </p>

      <div class="row mb-3">

        <div class="col-md-2">
          <div class="card" style="display: grid; justify-content: space-around;">
            <h5 class="card-header">Actual</h5>
            <div class="card-body">
              <div class="avatar avatar-xl">
                <img src="<?php echo $faviconSetting; ?>" class="rounded">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="card" style="display: grid; justify-content: space-around;">
            <h5 class="card-header">Nuevo</h5>
            <div class="card-body">
              <div class="avatar avatar-xl">
                <img src="/views/assets/img/favicon/default.png" id="cropedImage" class="rounded">
              </div>
            </div>
          </div>
        </div>

        <!-- Contenedor para la previsualización -->
        <div class="col-md-2">
          <img id="faviconPreview" style="max-width: 100%; display: none;" />
        </div>

      </div>

      <div class="row">

        <div class="col-md-7">
          <div class="input-group">
            <input type="file" class="form-control" id="faviconInput" accept="image/png, image/jpeg" required>
            <button class="btn btn-label-primary" id="cropButton" style="display: none;">Recortar</button>
          </div>
        </div>

      </div>

      <form method="post" class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">

        <?php

          /*=============================================
          Controladores
          =============================================*/
          require_once "controllers/settings.controller.php";

          $edit = new SettingsController();
          $edit->editFavicon();

        ?>

        <!--=====================================
        Botones
        ======================================-->
        <div class="col-md-12 mt-2">

          <a class="btn btn-default border text-left" href="/settings/favicon">Cancelar</a>
          <input type="hidden" name="croppedImage" id="croppedImageInput" />
          <button type="submit" class="btn btn-primary float-right" style="display: none;" id="submitButton">Guardar</button>

        </div>

      </form>

    </div>
  </div>
  
</div>