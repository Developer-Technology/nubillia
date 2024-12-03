<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

/*=============================================
Definimos la zona horaria
=============================================*/
date_default_timezone_set('America/Lima');
$fechaHoy = date('Y-m-d');

/*=============================================
Verificamos la sesion de usuario
=============================================*/
session_start();

if(isset($_SESSION["user"])) {

    require_once "controllers/users.controller.php";
    $getUser = UsersController::getdata($_SESSION["user"]->id_user);

}

if(isset($_SESSION["store"])) {

    require_once "controllers/stores.controller.php";
    $getStore = StoresController::getdata($_SESSION["store"]->id_store);

}

/*=============================================
Obtenemos las configuraciones iniciales
=============================================*/
require_once "controllers/settings.controller.php";
$getSetting = SettingsController::getdata();

/*=============================================
Capturar las rutas de la URL
=============================================*/
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/*=============================================
Limpiar la Url de variables GET
=============================================*/
foreach ($routesArray as $key => $value) {

    $value = explode("?", $value)[0];
    $routesArray[$key] = $value;

}

/*=============================================
Texto para el breadcrumb
=============================================*/
if(!empty($routesArray[2])) {
    
    if($routesArray[2] == "new") {

      $txtBread = "Nuevo";

    } elseif($routesArray[2] == "edit") {

      $txtBread = "Editar";

    } else {

      $txtBread = "Detalle";

    }

}

?>

<!DOCTYPE html>

<html lang="es" class="light-style layout-navbar-fixed layout-menu-fixed layout-wide " dir="ltr" data-theme="theme-bordered" data-assets-path="views/assets/" data-template="vertical-menu-template-bordered">

    <head>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>.:: Nubillia ::.</title>

        <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
        <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="/views/assets/img/icons/logo.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" href="/views/assets/vendor/fonts/boxicons.css" />
        <link rel="stylesheet" href="/views/assets/vendor/fonts/fontawesome.css" />
        <link rel="stylesheet" href="/views/assets/vendor/fonts/flag-icons.css" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="/views/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="/views/assets/vendor/css/rtl/theme-bordered.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="/views/assets/css/demo.css" />
        <link rel="stylesheet" href="/views/assets/vendor/libs/sweetalert2/sweetalert2.css" />
        <link rel="stylesheet" href="/views/assets/custom/css/custom.css">
        
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="/views/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="/views/assets/vendor/libs/typeahead-js/typeahead.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css">

        <!-- Plugins -->
        <link rel="stylesheet" href="/views/assets/plugins/material-preloader/material-preloader.css">
        <link rel="stylesheet" href="/views/assets/plugins/notie/notie.css">
        <script src="/views/assets/plugins/data-tables/dataTables.js"></script>

        <!-- Helpers -->
        <script src="/views/assets/vendor/js/helpers.js"></script>
        <!--Config  -->
        <script src="/views/assets/js/config.js"></script>

        <!-- Scripts Footer -->
        <script src="/views/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="/views/assets/vendor/libs/popper/popper.js"></script>
        <script src="/views/assets/vendor/js/bootstrap.js"></script>
        <script src="/views/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="/views/assets/vendor/libs/hammer/hammer.js"></script>
        <script src="/views/assets/vendor/libs/i18n/i18n.js"></script>
        <script src="/views/assets/vendor/libs/typeahead-js/typeahead.js"></script>
        <script src="/views/assets/vendor/js/menu.js"></script>

        <!-- Plugins -->
        <script src="/views/assets/plugins/material-preloader/material-preloader.js"></script>
        <script src="/views/assets/plugins/notie/notie.min.js"></script>
        <script src="/views/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
        <script src="/views/assets/custom/alerts/alerts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
        <script src="/views/assets/custom/forms/forms.js"></script>

        <?php if(!empty($routesArray[1])): ?>
            <?php if($routesArray[1] == "plans" ||
                    $routesArray[1] == "tenants"): ?>
                
                <!-- DataTables  & Plugins -->
                <link rel="stylesheet" href="/views/assets/plugins/daterangepicker/daterangepicker.css">
                <link rel="stylesheet" href="/views/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
                <link rel="stylesheet" href="/views/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
                <link rel="stylesheet" href="/views/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

                <script src="/views/assets/plugins/moment/moment.min.js"></script>
                <script src="/views/assets/plugins/daterangepicker/daterangepicker.js"></script>
                <script src="/views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="/views/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
                <script src="/views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                <script src="/views/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                <script src="/views/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
                <script src="/views/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
                <script src="/views/assets/plugins/jszip/jszip.min.js"></script>
                <script src="/views/assets/plugins/pdfmake/pdfmake.min.js"></script>
                <script src="/views/assets/plugins/pdfmake/vfs_fonts.js"></script>
                <script src="/views/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
                <script src="/views/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
                <script src="/views/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

            <?php endif; ?>
        <?php endif; ?>
        
    </head>

    <body>
    
        <?php
        
            /* Si no hay sesión se le redirige al login */
            if(!isset($_SESSION["user"])) {
                
                if(!empty($routesArray[1])) {
                    
                    if($routesArray[1] == "forgot" ||
                        $routesArray[1] == "register") {
                        
                        echo '<link rel="stylesheet" href="/views/assets/vendor/css/pages/page-auth.css">';
                        include "views/pages/auth/".$routesArray[1]."/".$routesArray[1].".php";
                        
                    } else {
                        
                        echo '<link rel="stylesheet" href="/views/assets/vendor/css/pages/page-misc.css">';
                        include "views/pages/auth/404/404.php";
                    
                    }
                
                } else {
                    
                    echo '<link rel="stylesheet" href="/views/assets/vendor/css/pages/page-auth.css">';
                    include "views/pages/auth/login/login.php";
                
                }
                
                echo '</body></html>';
                return;
            
            }

            /* Si no hay sesión de tienda */
            if(isset($_SESSION["user"]) && !isset($_SESSION["store"]) && empty($_SESSION["admin"])) {
                
                if(!empty($routesArray[1])) {
                    
                    if($routesArray[1] == "logout" || 
                        $routesArray[1] == "redirect" || 
                        $routesArray[1] == "admin") {
                        
                        echo '<link rel="stylesheet" href="/views/assets/vendor/css/pages/page-misc.css">';
                        include "views/pages/".$routesArray[1]."/".$routesArray[1].".php";
                        
                    } else {
                        
                        echo '<link rel="stylesheet" href="/views/assets/vendor/css/pages/page-misc.css">';
                        include "views/pages/auth/404/404.php";
                    
                    }
                
                } else {
                    
                    echo '<link rel="stylesheet" href="/views/assets/vendor/css/pages/page-auth.css"><link rel="stylesheet" href="views/assets/vendor/css/pages/page-profile.css" />';
                    include "views/pages/auth/tenant/tenant.php";
                
                }
                
                echo '</body></html>';
                return;
            
            }

            /* Si hay sesión pero en bloqueo se le redirige al lock screen */
            if(!isset($_SESSION["user"]->password_user)) {
                
                if(!empty($routesArray[1])) {
                    
                    if($routesArray[1] == "logout") {
                        
                        include "views/pages/".$routesArray[1]."/".$routesArray[1].".php";
                    
                    } else {
                        
                        echo '<link rel="stylesheet" href="/views/assets/vendor/css/pages/page-misc.css">';
                        include "views/pages/auth/404/404.php";
                    
                    }
                
                } else {
                    
                    echo '<link rel="stylesheet" href="/views/assets/vendor/css/pages/page-auth.css">';
                    include "views/pages/auth/lockscreen/lockscreen.php";
                
                }
                
                echo '</body></html>';
                return;
            
            }
            
        ?>

        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">

            <div class="layout-container">

                <!-- Menu -->
                <?php include "views/modules/aside.php"; ?>
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">

                    <!-- Navbar -->
                    <?php include "views/modules/header.php"; ?>
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">

                        <!-- Content -->
                        <div class="container-fluid flex-grow-1 container-p-y">

                            <!-- Pagina -->
                            <?php

                                if(!empty($routesArray[1])) {

                                    if(empty($_SESSION["admin"])) {
                                        
                                        if($routesArray[1] == "clients" ||
                                            $routesArray[1] == "users" ||
                                            $routesArray[1] == "logout" ||
                                            $routesArray[1] == "lock" ||
                                            $routesArray[1] == "change") {


                                            if($routesArray[1] == "lock") {

                                                include "views/pages/auth/".$routesArray[1]."/".$routesArray[1].".php";
                                            
                                            } else {

                                                include "views/pages/".$routesArray[1]."/".$routesArray[1].".php";
                                            
                                            }

                                        } else {
                                            
                                            include "views/pages/404/404.php";
                                        
                                        }

                                    } else {
                                        
                                        if($routesArray[1] == "logout" || 
                                            $routesArray[1] == "lock" || 
                                            $routesArray[1] == "change" ||
                                            $routesArray[1] == "plans" || 
                                            $routesArray[1] == "tenants" ||
                                            $routesArray[1] == "users" || 
                                            $routesArray[1] == "settings") {

                                            if($routesArray[1] == "lock") {

                                                include "views/pages/auth/".$routesArray[1]."/".$routesArray[1].".php";

                                            } elseif($routesArray[1] == "change" || 
                                                    $routesArray[1] == "logout") {

                                                include "views/pages/".$routesArray[1]."/".$routesArray[1].".php";

                                            } else {

                                                include "views/pages/admin/".$routesArray[1]."/".$routesArray[1].".php";

                                            }

                                        } else {

                                            include "views/pages/404/404.php";

                                        }

                                    }

                                } else {

                                    include "views/pages/home/home.php";

                                }
                                
                            ?>
                            <!--/ Pagina -->

                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        <?php include "views/modules/footer.php"; ?>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>

                    </div>
                    <!-- Content wrapper -->

                </div>
                <!-- / Layout page -->

            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
            
            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
            
        </div>
        <!-- / Layout wrapper -->

        <!-- Main JS -->
        <script src="/views/assets/js/main.js"></script>
    
    </body>

</html>