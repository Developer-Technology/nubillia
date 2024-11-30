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
        
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="views/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="views/assets/vendor/libs/typeahead-js/typeahead.css" /> 

        <!-- Helpers -->
        <script src="views/assets/vendor/js/helpers.js"></script>
        <!--Config  -->
        <script src="views/assets/js/config.js"></script>
        
    </head>

    <body>
    
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
                            <?php include "views/pages/home/home.php"; ?>
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
    
        <script src="views/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="views/assets/vendor/libs/popper/popper.js"></script>
        <script src="views/assets/vendor/js/bootstrap.js"></script>
        <script src="views/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="views/assets/vendor/libs/hammer/hammer.js"></script>
        <script src="views/assets/vendor/libs/i18n/i18n.js"></script>
        <script src="views/assets/vendor/libs/typeahead-js/typeahead.js"></script>
        <script src="views/assets/vendor/js/menu.js"></script>
    
        <!-- Main JS -->
        <script src="views/assets/js/main.js"></script>
    
    </body>

</html>