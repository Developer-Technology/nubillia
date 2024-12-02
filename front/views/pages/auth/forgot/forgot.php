<div class="authentication-wrapper authentication-cover">
  <div class="authentication-inner row m-0">

    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center">
      <div class="flex-row text-center mx-auto">
        <img src="views/assets/img/pages/forgot-password-light.png" alt="Auth Cover Bg color" width="520" class="img-fluid authentication-cover-img" data-app-light-img="pages/forgot-password-light.png" data-app-dark-img="pages/forgot-password-dark.html">
        <div class="mx-auto">
          <h3>No te preocupes, te enviaremos instrucciones. 👩🏻‍💻</h3>
          <p>
            Podemos ayudarte a restablecer tu contraseña y tu información de seguridad. Primero, ingresa tu dirección de correo electrónico y haz clic para enviar enlace de restablecimiento.
          </p>
        </div>
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Forgot Password -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="/" class="app-brand-link gap-2 mb-2">
            <span class="app-brand-logo demo">
                <?php include "views/assets/img/svg/logo.svg"; ?>
            </span>
            <span class="app-brand-text demo h3 mb-0 fw-bold"><?php echo $getSetting->name_system_setting; ?></span>
          </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">¿Olvidaste tu contraseña? 🔒</h4>
        <p class="mb-4">Ingresa tu correo electrónico y te enviaremos instrucciones para restablecer tu contraseña</p>
        <form id="formAuthentication" class="mb-3" action="https://demos.pixinvent.com/frest-html-admin-template/html/vertical-menu-template-bordered/auth-reset-password-cover.html" method="GET">
          <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa tu Correo Electrónico" autofocus>
          </div>
          <button class="btn btn-primary d-grid w-100">Enviar</button>
        </form>
        <div class="text-center">
          <a href="/" class="d-flex align-items-center justify-content-center">
            <i class="bx bx-chevron-left scaleX-n1-rtl"></i>
            Volver al inicio de sesión
          </a>
        </div>
      </div>
    </div>
    <!-- /Forgot Password -->
  </div>
</div>