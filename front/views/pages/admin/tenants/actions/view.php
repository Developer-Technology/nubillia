<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/
	
	if(isset($routesArray[3])) {
		
		$security = explode("~",base64_decode($routesArray[3]));
	
		if($security[1] == $_SESSION["user"]->token_user) {

			$select = "*";

			$url = "relations?rel=tenants,plans&type=tenant,plan&select=".$select."&linkTo=id_tenant&equalTo=".$security[0];;
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url,$method,$fields);
			
			if($response->status == 200) {

				$tenant = $response->results[0];

                if($tenant->status_tenant == 1) {

                    $class = "success";
                    $classAct = "danger";
                    $txt = "Activo";
                    $txtAct = "Suspender";
                    
                } else {

                    $class = "danger";
                    $classAct = "success";
                    $txt = "Suspendido";
                    $txtAct = "Activar";

                }

			} else {

				echo '<script>
                        window.location = "/tenants";
                    </script>';

			}

		} else {

			echo '<script>
                    window.location = "/tenants";
                </script>';

		}

	}

?>

<div class="row gy-4">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">
                        <!--<img class="img-fluid rounded my-4" src="../../assets/img/avatars/10.png" height="110"
                            width="110" alt="User avatar" />-->
                        <div class="user-info text-center">
                            <h5 class="mb-2"><?php echo $tenant->ruc_tenant; ?></h5>
                            <span class="badge bg-label-secondary"><?php echo $tenant->name_tenant; ?></span>
                        </div>
                    </div>
                </div>
                <!--<div class="d-flex justify-content-around flex-wrap my-4 py-3">
                    <div class="d-flex align-items-start me-4 mt-3 gap-3">
                        <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
                        <div>
                            <h5 class="mb-0">1.23k</h5>
                            <span>Tasks Done</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mt-3 gap-3">
                        <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
                        <div>
                            <h5 class="mb-0">568</h5>
                            <span>Projects Done</span>
                        </div>
                    </div>
                </div>-->
                <h5 class="pb-2 border-bottom mb-4 mt-4">Detalles</h5>
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-bold me-2">Email:</span>
                            <span><?php echo $tenant->email_tenant; ?></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-bold me-2">Estado:</span>
                            <span class="badge bg-label-<?php echo $class ?> txtStatus"><?php echo $txt ?></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-bold me-2">Teléfono:</span>
                            <span><?php echo $tenant->phone_tenant; ?></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-bold me-2">Web:</span>
                            <span><?php echo $tenant->web_tenant; ?></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-bold me-2">Dirección:</span>
                            <span><?php echo $tenant->address_tenant; ?></span>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-center pt-3">
                        <a href="/tenants/edit/<?php echo base64_encode($tenant->id_tenant . "~" . $_SESSION["user"]->token_user) ?>" class="btn btn-primary me-3">Editar</a>
                        <label for="checkStatus" class="btn btn-label-<?php echo $classAct ?> suspend-user"><?php echo $txtAct ?></label>
                        <?php if ($tenant->status_tenant == 1): ?>
                            <input type="checkbox" class="hidden" id="checkStatus" checked onchange='changeState(event, "<?php echo $tenant->id_tenant; ?>", `tenants`, `tenant`)'>
                        <?php else: ?>
                            <input type="checkbox" class="hidden" id="checkStatus" onchange='changeState(event, "<?php echo $tenant->id_tenant; ?>", `tenants`, `tenant`)'>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Card -->
        <!-- Plan Card -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="badge bg-label-primary"><?php echo $tenant->name_plan; ?></span>
                    <div class="d-flex justify-content-center">
                        <sup class="h5 pricing-currency mt-3 mt-sm-4 mb-0 me-1 text-primary">S/</sup>
                        <h1 class="display-3 fw-normal mb-0 text-primary"><?php echo $tenant->price_plan; ?></h1>
                        <sub class="fs-6 pricing-duration mt-auto mb-4">/mes</sub>
                    </div>
                </div>
                <?php echo $tenant->description_plan; ?>
                <!--<div class="d-flex justify-content-between align-items-center mb-1">
                    <h6 class="mb-0">Días</h6>
                    <h6 class="mb-0">65% Completed</h6>
                </div>-->
                <div class="progress mb-1" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span>Quedan 4 días</span>
                <div class="d-grid w-100 mt-3 pt-2">
                    <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Actualiza Plan</button>
                </div>
            </div>
        </div>
        <!-- /Plan Card -->
    </div>
    <!--/ User Sidebar -->


    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- User Pills -->
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                        class="bx bx-home me-1"></i>Tiendas</a></li>
            <li class="nav-item"><a class="nav-link" href="app-user-view-billing.html"><i
                        class="bx bx-detail me-1"></i>Facturación</a></li>
        </ul>
        <!--/ User Pills -->

        <!-- Project table -->
        <div class="card mb-4">
            <h5 class="card-header">User's Projects List</h5>
            <div class="table-responsive mb-3">
                <table class="table datatable-project border-top">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Project</th>
                            <th class="text-nowrap">Total Task</th>
                            <th>Progress</th>
                            <th>Hours</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /Project table -->
    </div>
    <!--/ User Content -->
</div>

<script src="/views/assets/custom/datatable/datatable.js"></script>