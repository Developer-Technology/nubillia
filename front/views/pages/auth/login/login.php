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
                <img src="/views/assets/img/pages/login-light.png" alt="Auth Cover Bg color" width="520" class="img-fluid authentication-cover-img" data-app-light-img="pages/login-light.png" data-app-dark-img="pages/login-dark.html">
                <div class="mx-auto">
                    <h3>Tu ERP en la nube 🌥️</h3>
                    <p>
                        Gestiona tu empresa, equipos, sucursales, inventarios y ventas desde una plataforma segura, centralizada y fácil de usar, con reportes detallados al alcance de tu mano.
                    </p>
                </div>
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
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
                <h4 class="mb-2">¡Bienvenido! 👋</h4>
                <p class="mb-4">Inicia sesión en tu cuenta y comienza la aventura.</p>

                <form method="post" class="mb-3 needs-validation" novalidate autocomplete="off">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="loginUsername" placeholder="Ingresa tu Usuario" autofocus required>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="loginPassword">Contraseña</label>
                            <?php if($resetPass == 'si'): ?>
                            <a href="/forgot">
                                <small>¿Olvidaste tu contraseña?</small>
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="loginPassword" class="form-control" name="loginPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"aria-describedby="password" required>
                            <span class="input-group-text cursor-pointer" onclick="showP()"><i class="bx bx-hide" id="toggleIcon"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" onchange="rememberMe(event)">
                            <label class="form-check-label" for="remember">
                                Recuérdame
                            </label>
                        </div>
                    </div>

                    <?php

                        /*=============================================
                        Controladores
                        =============================================*/
                        require_once "controllers/users.controller.php";

                        $login = new UsersController();
                        $login->login();

                    ?>

                    <button type="submit" class="btn btn-primary d-grid w-100">
                        Iniciar Sesión
                    </button>
                </form>

                <?php if($registerUser == 'si'): ?>
                <p class="text-center">
                    <span>¿No tienes una cuenta?</span>
                    <a href="/register">
                        <span>Regístrate</span>
                    </a>
                </p>
                <?php endif; ?>

                <?php if($loginSocial == 'si'): ?>
                <div class="divider my-4">
                    <div class="divider-text">O</div>
                </div>

                <div class="d-flex justify-content-center">
                    <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                        <i class="tf-icons bx bxl-facebook"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-label-google-plus">
                        <i class="tf-icons bx bxl-google"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /Login -->
    </div>
</div>