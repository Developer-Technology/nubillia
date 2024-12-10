<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

/*=============================================
Obtenemos las configuraciones adicionales
=============================================*/
foreach (json_decode($getSetting->extras_setting) as $key => $elementExtras) {

    $resetPass = $elementExtras->reset_pass;
    $registerUser = $elementExtras->register_system;
    $loginSocial = $elementExtras->social_login;

}

?>

<div class="authentication-wrapper authentication-cover">
  <div class="authentication-inner row m-0">

    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center">
      <div class="flex-row text-center mx-auto">
        <img src="/views/assets/img/pages/register-light.png" alt="Auth Cover Bg color" width="520" class="img-fluid authentication-cover-img" data-app-light-img="pages/register-light.png" data-app-dark-img="pages/register-dark.html">
        <div class="mx-auto">
          <h3>Unos pocos clics para comenzar 🚀</h3>
          <p>
            Comencemos con tu prueba gratuita de 14 días y comienza a gestionar hoy mismo.
          </p>
        </div>
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Register -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="/" class="app-brand-link gap-2 mb-2">
            <span class="app-brand-logo demo">
              <img src="<?php echo $faviconSetting; ?>" style="width:26px;">
            </span>
            <span class="app-brand-text demo h3 mb-0 fw-bold"><?php echo $getSetting->name_system_setting; ?></span>
          </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">La aventura comienza aquí 🚀</h4>
        <p class="mb-4">¡Haz que la gestión de tus aplicaciones sea fácil!</p>

        <form method="post" class="mb-3 needs-validation" novalidate autocomplete="off">

          <div class="mb-3">
            <label for="registerName" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="registerName" name="registerName" placeholder="Ingresa tu nombre completo" autofocus required>
          </div>
          <div class="mb-3">
            <label for="registerEmail" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="registerEmail" name="registerEmail" placeholder="Ingresa tu correo electrónico" onchange="validateRepeat(event,'text','workers','email_worker')" required>
          </div>
          <div class="mb-3">
            <label for="registerUserName" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="registerUserName" name="registerUserName" placeholder="Ingresa tu nombre de usuario" onchange="validateRepeat(event,'text','users','username_user')" required>
          </div>
          <div class="mb-3 form-password-toggle">
            <label class="form-label" for="loginPassword">Contraseña</label>
            <div class="input-group input-group-merge">
              <input type="password" id="loginPassword" class="form-control" name="loginPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
              <span class="input-group-text cursor-pointer" onclick="showP()"><i class="bx bx-hide"></i></span>
            </div>
          </div>

          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
              <label class="form-check-label" for="terms-conditions">
                Acepto los
                <a href="javascript:void(0);">términos y condiciones</a>
              </label>
            </div>
          </div>

          <?php

            /*=============================================
            Controladores
            =============================================*/
            require_once "controllers/users.controller.php";

            $login = new UsersController();
            $login->register();

          ?>

          <button class="btn btn-primary d-grid w-100">
            Regístrate ahora
          </button>
        </form>

        <p class="text-center">
          <span>¿Ya tienes una cuenta?</span>
          <a href="/">
            <span>Inicia Sesión</span>
          </a>
        </p>

        <?php if($loginSocial == 'si'): ?>
        <div class="divider my-4">
          <div class="divider-text">or</div>
        </div>

        <div class="d-flex justify-content-center">
          <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
            <i class="tf-icons bx bxl-facebook"></i>
          </a>
          <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
            <i class="tf-icons bx bxl-google-plus"></i>
          </a>
          </a>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>