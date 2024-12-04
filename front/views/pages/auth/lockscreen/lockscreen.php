<div class="container-xxl">

    <div class="authentication-wrapper authentication-basic container-p-y">

        <div class="authentication-inner py-4">

            <!-- Forgot Password -->
            <div class="card">

                <div class="card-body">

                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <?php include "views/assets/img/svg/logo.svg"; ?>
                            </span>
                            <span class="app-brand-text demo h3 mb-0 fw-bold"><?php echo $getSetting->name_system_setting; ?></span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <h4 class="mb-2"><?php echo $getUser->name_worker; ?></h4>
                    <p>Ingresa tu contraseña para desbloquear tu sesión.</p>

                    <?php if(isset($getStore)): ?>
                    <span class="footer-link me-4"><small><b>Empresa: </b><?php echo $getStore->name_tenant; ?> <br> <b>Tienda: </b><?php echo $getStore->name_store; ?></small></span>
                    <?php endif; ?>

                    <form class="mb-3 needs-validation mt-3" method="POST" novalidate autocomplete="off">
                        
                        <input type="hidden" class="form-control" id="username" name="loginUsername" placeholder="Ingresa tu Usuario" value="<?php echo $getUser->username_user; ?>">
                        <div class="mb-3 form-password-toggle">
                            <label for="loginPassword" class="form-label">Contraseña</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus required>
                                <span class="input-group-text cursor-pointer" onclick="showP()"><i class="bx bx-show" id="toggleIcon"></i></span>
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

                        <button class="btn btn-primary d-grid w-100" type="submit">Acceder</button>
                    </form>
                    <div class="text-center">
                        <a href="/logout" class="d-flex align-items-center justify-content-center">
                            Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->

        </div>

    </div>

</div>