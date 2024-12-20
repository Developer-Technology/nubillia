<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

if(isset($_GET["start"]) && isset($_GET["end"])) {

  $between1 = $_GET["start"];
  $between2 = $_GET["end"];

} else {

  $between1 = date("Y-m-d", strtotime("-100000 day", strtotime(date("Y-m-d"))));
  $between2 = date("Y-m-d");

}

?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">

<div class="card">

    <div class="card-header mb-0 pb-0">
        <div class="row">

            <!-- Left toolbar -->
            <div class="col-md-6 d-flex gap-1 align-items-center">

                <div class="d-flex mr-2 mt-2 mb-2">

                    <label class="switch">
                        <input type="checkbox" class="switch-input" onchange="reportActive(event)" />
                        <span class="switch-toggle-slider">
                            <span class="switch-on">
                                <i class="bx bx-check"></i>
                            </span>
                            <span class="switch-off">
                                <i class="bx bx-x"></i>
                            </span>
                        </span>
                        <span class="switch-label">Exportar</span>
                    </label>
                </div>

                <button type="button" class="btn btn-label-secondary btn-sm mt-2 mb-2 gap-2 float-right" id="daterange-btn">
                    <i class="fa fa-calendar-o mr-2"></i>
                    <?php if($between1 < "2000"){ echo "Inicio"; }else{ echo $between1; } ?> -
                    <?php echo $between2 ?>
                    <i class="bx bx-calendar"></i>
                </button>

            </div>
            <!-- END : Left toolbar -->

        </div>
    </div>

    <div class="card-datatable table-responsive pt-0">
        <table id="adminsTable" class="datatable-project border-top table-sm table table-hover adminsTable tableSalesAdmin">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>ID Compra</th>
                    <th>Plan</th>
                    <th>Compra</th>
                    <th class="th-status">Estado</th>
                    <th class="th-status">Asignado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script src="/views/assets/custom/datatable/datatable.js"></script>