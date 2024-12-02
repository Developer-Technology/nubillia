<?php

session_start();

if(isset($_SESSION["user"])) {

    require_once "controllers/users.controller.php";
    $getUser = UsersController::getdata($_SESSION["user"]->id_user);

}

if(isset($_SESSION["store"])) {

    require_once "controllers/stores.controller.php";
    $getStore = StoresController::getdata($_SESSION["store"]->id_store);

}

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
Cambiamos el nombre de las rutas
=============================================*/
if (!empty($routesArray[2])) {
    
    if ($routesArray[2] == "new") {
      $subRuta = "Nuevo";
    } elseif ($routesArray[2] == "edit") {
      $subRuta = "Editar";
    } else {
      $subRuta = "Detalle";
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
        <link rel="icon" type="image/x-icon" href="views/assets/img/icons/logo.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" href="views/assets/vendor/fonts/boxicons.css" />
        <link rel="stylesheet" href="views/assets/vendor/fonts/fontawesome.css" />
        <link rel="stylesheet" href="views/assets/vendor/fonts/flag-icons.css" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="views/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="views/assets/vendor/css/rtl/theme-bordered.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="views/assets/css/demo.css" />
        <link rel="stylesheet" href="views/assets/custom/css/custom.css">
        
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="views/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="views/assets/vendor/libs/typeahead-js/typeahead.css" />

        <!-- Plugins -->
        <link rel="stylesheet" href="views/assets/plugins/material-preloader/material-preloader.css">
        <link rel="stylesheet" href="views/assets/plugins/notie/notie.css">

        <!-- Helpers -->
        <script src="views/assets/vendor/js/helpers.js"></script>
        <!--Config  -->
        <script src="views/assets/js/config.js"></script>

        <!-- Scripts Footer -->
        <script src="views/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="views/assets/vendor/libs/popper/popper.js"></script>
        <script src="views/assets/vendor/js/bootstrap.js"></script>
        <script src="views/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="views/assets/vendor/libs/hammer/hammer.js"></script>
        <script src="views/assets/vendor/libs/i18n/i18n.js"></script>
        <script src="views/assets/vendor/libs/typeahead-js/typeahead.js"></script>
        <script src="views/assets/vendor/js/menu.js"></script>

        <!-- Plugins -->
        <script src="views/assets/plugins/material-preloader/material-preloader.js"></script>
        <script src="views/assets/plugins/notie/notie.min.js"></script>
        <script src="views/assets/plugins/sweet-alert/sweetalert2-10.js"></script>
        <script src="views/assets/custom/alerts/alerts.js"></script>
        
    </head>

    <body>
    
        <?php
        
            /* Si no hay sesión se le redirige al login */
            if(!isset($_SESSION["user"])) {
                
                if(!empty($routesArray[1])) {
                    
                    if($routesArray[1] == "forgot" ||
                        $routesArray[1] == "register") {
                        
                        echo '<link rel="stylesheet" href="views/assets/vendor/css/pages/page-auth.css">';
                        include "views/pages/auth/".$routesArray[1]."/".$routesArray[1].".php";
                        
                    } else {
                        
                        echo '<link rel="stylesheet" href="views/assets/vendor/css/pages/page-misc.css">';
                        include "views/pages/auth/404/404.php";
                    
                    }
                
                } else {
                    
                    echo '<link rel="stylesheet" href="views/assets/vendor/css/pages/page-auth.css">';
                    include "views/pages/auth/login/login.php";
                
                }
                
                echo '</body></head>';
                return;
            
            }

            /* Si no hay sesión de tienda */
            if(!isset($_SESSION["store"])) {
                
                if(!empty($routesArray[1])) {
                    
                    if($routesArray[1] == "logout" || 
                        $routesArray[1] == "redirect") {
                        
                        include "views/pages/".$routesArray[1]."/".$routesArray[1].".php";
                        
                    } else {
                        
                        echo '<link rel="stylesheet" href="views/assets/vendor/css/pages/page-misc.css">';
                        include "views/pages/auth/404/404.php";
                    
                    }
                
                } else {
                    
                    echo '<link rel="stylesheet" href="views/assets/vendor/css/pages/page-auth.css"><link rel="stylesheet" href="views/assets/vendor/css/pages/page-profile.css" />';
                    include "views/pages/auth/tenant/tenant.php";
                
                }
                
                echo '</body></head>';
                return;
            
            }

            /* Si hay sesión pero en bloqueo se le redirige al lock screen */
            if(!isset($_SESSION["user"]->password_user)) {
                
                if(!empty($routesArray[1])) {
                    
                    if($routesArray[1] == "logout") {
                        
                        include "views/pages/".$routesArray[1]."/".$routesArray[1].".php";
                    
                    } else {
                        
                        echo '<link rel="stylesheet" href="views/assets/vendor/css/pages/page-misc.css">';
                        include "views/pages/auth/404/404.php";
                    
                    }
                
                } else {
                    
                    echo '<link rel="stylesheet" href="views/assets/vendor/css/pages/page-auth.css">';
                    include "views/pages/auth/lockscreen/lockscreen.php";
                
                }
                
                echo '</body></head>';
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

                                        //include "views/pages/".$routesArray[1]."/".$routesArray[1].".php";

                                    } else {

                                        include "views/pages/404/404.php";

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
        <script src="views/assets/js/main.js"></script>
    
    </body>

</html>