<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

if($getUser->id_rol == 1) {

    /*=============================================
    Controladores
    =============================================*/
    require_once "controllers/tenants.controller.php";
    $allTenants = TenantsController::getalltenants()->results;

    $urlEncodeAdmin = base64_encode($_SESSION['user']->id_user . '~' . $_SESSION['user']->token_user);

} else {

    $tenantsUser = json_decode($getUser->id_tenant_user, true);

    // Creamos un arreglo para almacenar los resultados de las empresas permitidas
    $allTenants = [];

    if (!empty($tenantsUser)) {
        foreach ($tenantsUser as $tenant) {
            // Obtener información detallada de cada empresa
            $url = "tenants?select=*&linkTo=id_tenant&equalTo=" . urlencode($tenant['id']);
            $method = "GET";
            $fields = [];

            $tenantResponse = CurlController::request($url, $method, $fields);

            if ($tenantResponse->status == 200 && isset($tenantResponse->results[0])) {
                $allTenants[] = $tenantResponse->results[0]; // Agregar la empresa al listado
            }
        }
    }

}

?>

<div class="container-xxl">

    <div class="row mt-5">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="<?php echo $avatarUser; ?>" alt="<?php echo $getUser->name_worker; ?>" class="d-block h-auto ms-0 ms-sm-4 rounded-circle user-profile-img">
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>
                                    <?php echo $getUser->name_worker; ?>
                                </h4>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item fw-medium">
                                        <i class='bx bx-briefcase-alt-2'></i>
                                        <?php echo $getUser->name_rol; ?>
                                    </li>
                                    <li>
                                    <?php
    
                                        if($getUser->id_rol == 1) {
                                            
                                            echo '<form action="/admin" method="POST">
                                                    <input type="hidden" name="admin_data" value="' . htmlspecialchars($urlEncodeAdmin, ENT_QUOTES, 'UTF-8') . '">
                                                    <button type="submit" class="btn btn-outline-primary btn-xs">Panel Admin</button>
                                                </form>';

                                        }

                                    ?>
                                    </li>
                                </ul>
                            </div>
                            <a href="/logout" class="btn btn-primary text-nowrap">
                                <i class='bx bx-power-off me-1'></i>Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="py-3 breadcrumb-wrapper mb-2">Empresas</h4>

    <p>Por favor selecciona una tienda para gestionar.</p>
    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                            <img src="/views/assets/img/illustrations/lady-with-laptop-light.png" class="img-fluid" alt="Image" width="100" data-app-light-img="illustrations/lady-with-laptop-light.png">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-3 text-nowrap add-new-role">Registrar Empresa</button>
                            <p class="mb-0">Nueva empresa en tu cuenta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach($allTenants as $oneTenant): ?>
            <?php
            
                /*=============================================
                Tiendas
                =============================================*/
                require_once "controllers/stores.controller.php";
                $allStores = StoresController::getstores($oneTenant->id_tenant);
            
            ?>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="fw-normal"><?php echo $oneTenant->ruc_tenant; ?></h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <?php foreach($allStores->results as $oneStore): ?>

                                    <?php
                                        
                                        /*=============================================
                                        Redirigimos con la sesion de la empresa y  tienda
                                        =============================================*/
                                        $urlEncode = base64_encode($oneStore->id_store . '~' . $_SESSION['user']->token_user);
                                        $tienda_actual = "window.open('redirect/".$urlEncode."','_self')";
                                        
                                    ?>

                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="<?php echo $oneStore->name_store; ?>" class="avatar avatar-sm pull-up pointer" onclick="<?php echo $tienda_actual; ?>">
                                        <img class="rounded" src="/views/assets/img/icons/shop.png" alt="Avatar" style="background: #f7f7f7; padding: 2px;">
                                    </li>

                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading" style="overflow: hidden;">
                                <h4 class="mb-1 text-truncate"><?php echo $oneTenant->name_tenant; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<script src="/views/assets/js/main.js"></script>