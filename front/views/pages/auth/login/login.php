<div class="authentication-wrapper authentication-cover">
    <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center">
            <div class="flex-row text-center mx-auto">
                <img src="views/assets/img/pages/login-light.png" alt="Auth Cover Bg color" width="520" class="img-fluid authentication-cover-img" data-app-light-img="pages/login-light.png" data-app-dark-img="pages/login-dark.html">
                <div class="mx-auto">
                    <h3>Nubillia es tu ERP en la nube 🌥️</h3>
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
                            <?php include "views/assets/img/svg/logo.svg"; ?>
                        </span>
                        <span class="app-brand-text demo h3 mb-0 fw-bold">Nubillia</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">¡Bienvenido! 👋</h4>
                <p class="mb-4">Inicia sesión en tu cuenta y comienza la aventura.</p>

                <form id="formAuthentication" class="mb-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="mail" class="form-control" id="email" name="email-username" placeholder="Ingresa tu Correo Electrónico" autofocus>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Contraseña</label>
                            <a href="/forgot">
                                <small>¿Olvidaste tu contraseña?</small>
                            </a>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me">
                            <label class="form-check-label" for="remember-me">
                                Recuérdame
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100">
                        Iniciar Sesión
                    </button>
                </form>

                <p class="text-center">
                    <span>¿No tienes una cuenta?</span>
                    <a href="/register">
                        <span>Regístrate</span>
                    </a>
                </p>

                <div class="divider my-4">
                    <div class="divider-text">O</div>
                </div>

                <div class="d-flex justify-content-center">
                    <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                        <i class="tf-icons bx bxl-facebook"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                        <i class="tf-icons bx bxl-google-plus"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                        <i class="tf-icons bx bxl-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Login -->
    </div>
</div>