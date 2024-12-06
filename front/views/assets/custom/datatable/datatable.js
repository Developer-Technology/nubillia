/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

var page;

function execDatatable(text) {

  /*=============================================
  Validamos tabla de planes
  =============================================*/
  if ($(".tablePlansAdmin").length > 0) {

    var url = "ajax/admin/data-plans.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user");

    var columns = [
      { "data": "id_plan" },
      { "data": "status_plan", "orderable": false },
      { "data": "name_plan" },
      { "data": "price_plan" },
      { "data": "content_plan" },
      { "data": "sales_plan" },
      { "data": "created_plan" },
      { "data": "actions", "orderable": false }
    ];

    page = "plans";

  }

  /*=============================================
  Validamos tabla de empresas
  =============================================*/
  if ($(".tableTenantsAdmin").length > 0) {

    var url = "ajax/admin/data-tenants.php?text=" + text + "&between1=" + $("#between1").val() + "&between2=" + $("#between2").val() + "&token=" + localStorage.getItem("token_user");

    var columns = [
      { "data": "id_tenant" },
      { "data": "status_tenant", "orderable": false },
      { "data": "name_tenant" },
      { "data": "plan_tenant" },
      { "data": "sunat_tenant" },
      { "data": "created_tenant" },
      { "data": "actions", "orderable": false }
    ];

    page = "tenants";

  }

  /*=============================================
  Ejecutamos DataTable
  =============================================*/
  var adminsTable = $(".adminsTable").DataTable({

    "responsive": true,
    "lengthChange": true,
    "aLengthMenu": [[5, 10, 50,50, 500, 1000], [5, 10, 50, 100, 500, 1000]],
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "order": [[0, "desc"]],
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "columns": columns,
    "language": {

      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }

    },

    "buttons": [

      { extend: "copy", className: "btn btn-label-primary btn-sm mb-2", text: "Copiar" },
      { extend: "csv", className: "btn btn-label-primary btn-sm mb-2", text: "CSV" },
      { extend: "excel", className: "btn btn-label-primary btn-sm mb-2", text: "Excel" },
      { extend: "pdf", className: "btn btn-label-primary btn-sm mb-2", text: "PDF", orientation: "landscape" },
      { extend: "print", className: "btn btn-label-primary btn-sm mb-2", text: "Imprimir" }

    ],
    fnDrawCallback: function (oSettings) {
      if (oSettings.aoData.length == 0) {
        $('.dataTables_paginate').hide();
        $('.dataTables_info').hide();
      } else {
        $('.dataTables_paginate').show();
        $('.dataTables_info').show();
      }

    }
  })

  if (text == "flat") {

    $(".adminsTable").on("draw.dt", function () {

      setTimeout(function () {

        adminsTable.buttons().container().appendTo('#adminsTable_wrapper .col-md-6:eq(0)');

      }, 100)

    })

  }

};

execDatatable("html");

/*=============================================
Ejecutamos Multilples tablas sin reporte
=============================================*/
$(".multipleTable").each(function() {
  var table = $(this); // Referencia a la tabla

  // Verificar si es la tabla de tiendas
  if (table.hasClass("tableSotresAdmin")) {
      var url = "/ajax/admin/data-tenants-stores.php?tenant=" + $("#tenant").val() + "&token=" + localStorage.getItem("token_user");
      var columns = [
          { "data": "id_store" },
          { "data": "status_store", "orderable": false },
          { "data": "name_store" },
          { "data": "address_store" },
          { "data": "created_store" },
          { "data": "actions", "orderable": false }
      ];
  }

  // Verificar si es la tabla de almacenes
  if (table.hasClass("tableWarehousesAdmin")) {
      var url = "/ajax/admin/data-tenants-warehouses.php?tenant=" + $("#tenant").val() + "&token=" + localStorage.getItem("token_user");
      var columns = [
          { "data": "id_warehouse" },
          { "data": "status_warehouse", "orderable": false },
          { "data": "name_warehouse" },
          { "data": "address_warehouse" },
          { "data": "created_warehouse" }
      ];
  }

  // Inicializar el DataTable para la tabla actual
  table.DataTable({
      "responsive": true,
      "lengthChange": true,
      "aLengthMenu": [[5, 10, 50, 500, 1000], [5, 10, 50, 100, 500, 1000]],
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [[0, "desc"]],
      "ajax": {
          "url": url,
          "type": "POST"
      },
      "columns": columns,
      "language": {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
      },
      "buttons": [
          { extend: "copy", className: "btn btn-label-primary btn-sm mb-2", text: "Copiar" },
          { extend: "csv", className: "btn btn-label-primary btn-sm mb-2", text: "CSV" },
          { extend: "excel", className: "btn btn-label-primary btn-sm mb-2", text: "Excel" },
          { extend: "pdf", className: "btn btn-label-primary btn-sm mb-2", text: "PDF", orientation: "landscape" },
          { extend: "print", className: "btn btn-label-primary btn-sm mb-2", text: "Imprimir" }
      ],
      fnDrawCallback: function (oSettings) {
          if (oSettings.aoData.length == 0) {
              $('.dataTables_paginate').hide();
              $('.dataTables_info').hide();
          } else {
              $('.dataTables_paginate').show();
              $('.dataTables_info').show();
          }
      }
  });
});

/*=============================================
Ejecutar reporte 
=============================================*/
function reportActive(event) {

  matPreloader("on");
  fncSweetAlert("loading", "Cargando...", "");

  if (event.target.checked) {

    matPreloader("off");
    fncSweetAlert("close", "", "");

    $(".adminsTable").dataTable().fnClearTable();
    $(".adminsTable").dataTable().fnDestroy();

    setTimeout(function () {

      execDatatable("flat");

    }, 100)

  } else {

    matPreloader("off");
    fncSweetAlert("close", "", "");

    $(".adminsTable").dataTable().fnClearTable();
    $(".adminsTable").dataTable().fnDestroy();

    setTimeout(function () {

      execDatatable("html");

    }, 100)
  }

}

/*=============================================
Rango de fechas
=============================================*/
$('#daterange-btn').daterangepicker(
  {
    "locale": {
      "format": "YYYY-MM-DD",
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar",
      "fromLabel": "Desde",
      "toLabel": "Hasta",
      "customRangeLabel": "Rango Personalizado",
      "daysOfWeek": [
        "Do",
        "Lu",
        "Ma",
        "Mi",
        "Ju",
        "Vi",
        "Sa"
      ],
      "monthNames": [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
      ],
      "firstDay": 1
    },
    ranges: {
      'Hoy': [moment(), moment()],
      'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este Mes': [moment().startOf('month'), moment().endOf('month')],
      'Último Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
      'Este Año': [moment().startOf('year'), moment().endOf('year')],
      'Último Año': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
    },

    startDate: moment($("#between1").val()),
    endDate: moment($("#between2").val())

  },
  function (start, end) {

    window.location = page+"?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');

  },

)

/*=============================================
Eliminar registro
=============================================*/
$(document).on("click", ".removeItem", function () {

  var idItem = $(this).attr("idItem");
  var table = $(this).attr("table");
  var suffix = $(this).attr("suffix");
  var folder = $(this).attr("folder");
  var code = $(this).attr("code");
  var deleteFile = $(this).attr("deleteFile");
  var page = $(this).attr("page");

  fncSweetAlert("confirm", "¿Estás seguro de eliminar este registro?", "").then(resp => {

    if (resp) {

      matPreloader("on");
      fncSweetAlert("loading", "Cargando...", "");

      var data = new FormData();
      data.append("idItem", idItem);
      data.append("table", table);
      data.append("suffix", suffix);
      data.append("folder", folder);
      data.append("code", code);
      data.append("token", localStorage.getItem("token_user"));
      data.append("deleteFile", deleteFile);

      $.ajax({

        url: "ajax/ajax-delete.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {

          if (response == 200) {

            matPreloader("off");
            fncSweetAlert("close", "", "");
            fncSweetAlert(
              "success",
              "El registro ha sido eliminado exitosamente",
              "/" + page
            );

          } else if (response == "no-delete") {

            matPreloader("off");
            fncSweetAlert("close", "", "")
            fncSweetAlert(
              "error",
              "El registro tiene datos relacionados",
              "/" + page
            );

          } else {

            matPreloader("off");
            fncSweetAlert("close", "", "")
            fncNotie(3, "No se pudo eliminar el registro");

          }

        }

      })

    }

  })

})

/*=============================================
Cambiar estado del producto
=============================================*/
function changeState(event, id, table, suffix) {

  matPreloader("on");
  fncSweetAlert("loading", "Cargando...", "");

  if (event.target.checked) {

    var state = "1";
    var txtStatus = "Activo";
    $(".txtStatus").removeClass("bg-label-danger");
    $(".txtStatus").addClass("bg-label-success");
    var txtBtn = "Suspender";
    $(".suspend-user").removeClass("btn-label-success");
    $(".suspend-user").addClass("btn-label-danger");

  } else {

    var state = "0";
    var txtStatus = "Suspendido";
    $(".txtStatus").removeClass("bg-label-success");
    var txtBtn = "Activar";
    $(".txtStatus").addClass("bg-label-danger");
    $(".suspend-user").removeClass("btn-label-danger");
    $(".suspend-user").addClass("btn-label-success");

  }

  var data = new FormData();
  data.append("state", state);
  data.append("id", id);
  data.append("table", table);
  data.append("suffix", suffix);
  data.append("token", localStorage.getItem("token_user"));


  $.ajax({
    url: "/ajax/ajax-state.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {

      if (response == 200) {

        matPreloader("off");
        fncSweetAlert("close", "", "");
        fncNotie(1, "El registro fue actualizado");
        $(".txtStatus").text(txtStatus);
        $(".suspend-user").text(txtBtn);

      } else {

        matPreloader("off");
        fncSweetAlert("close", "", "");
        fncNotie(3, "No se pudo actualizar el registro");

      }

    }

  })

}

/*=============================================
Función para actualizar la orden
=============================================*/
$(document).on("click", ".nextProcess", function () {

  /*=============================================
  Limpiamos la ventana modal
  =============================================*/
  $(".orderBody").html("");

  var idOrder = $(this).attr("idOrder");
  var processOrder = JSON.parse(atob($(this).attr("processOrder")));


  /*=============================================
  Nombramos la ventana modal con el id de la orden
  =============================================*/
  $(".modal-title span").html("Order N. " + idOrder);

  /*=============================================
   Quitamos la opción de llenar el campo de recibido si no se ha enviado el producto
  =============================================*/
  if (processOrder[1].status == "pending") {

    processOrder.splice(2, 1);

  }

  /*=============================================
  Información dinámica que aparecerá en la ventana modal
  =============================================*/
  processOrder.forEach((value, index) => {

    let date = "";
    let status = "";
    let comment = "";

    if (value.status == "ok") {

      date = `<div class="col-10 p-3">
          
              <input type="date" class="form-control" value="`+ value.date + `" readonly>

          </div>`;

      status = `<div class="col-10 mt-1 p-3">

                <div class="text-uppercase">`+ value.status + `</div>

              </div>`;

      comment = `<div class="col-10 p-3">   
                <textarea class="form-control" readonly>`+ value.comment + `</textarea>
            </div>`;

    } else {

      date = `<div class="col-10 p-3">
          
              <input type="date" class="form-control" name="date" value="`+ value.date + `" required>

          </div>`;


      status = `<div class="col-10 mt-1 p-3">

                    <input type="hidden" name="stage" value="`+ value.stage + `">
                    <input type="hidden" name="processOrder" value="`+ $(this).attr("processOrder") + `">
                    <input type="hidden" name="idOrder" value="`+ idOrder + `">
                    <input type="hidden" name="clientOrder" value="`+ $(this).attr("clientOrder") + `">
                    <input type="hidden" name="emailOrder" value="`+ $(this).attr("emailOrder") + `">
                    <input type="hidden" name="productOrder" value="`+ $(this).attr("productOrder") + `">

                    <div class="custom-control custom-radio custom-control-inline">

                      <input 
                          id="status-pending" 
                          type="radio" 
                          class="custom-control-input" 
                          value="pending" 
                          name="status" 
                          checked>

                          <label  class="custom-control-label" for="status-pending">Pending</label>

                    </div>

                    <div class="custom-control custom-radio custom-control-inline">

                      <input 
                          id="status-ok" 
                          type="radio" 
                          class="custom-control-input" 
                          value="ok" 
                          name="status" 
                          >

                          <label  class="custom-control-label" for="status-ok">Ok</label>

                    </div>

        </div>`;

      comment = `<div class="col-10 p-3">   
                <textarea class="form-control" name="comment" required>`+ value.comment + `</textarea>
            </div>`;

    }


    $(".orderBody").append(`

       <div class="card-header text-uppercase">`+ value.stage + `</div> 

       <div class="card-body">
          
          <!--=====================================
          Bloque Fecha
          ======================================-->

          <div class="form-row">

            <div class="col-2 text-right">

                <label class="p-3 lead">Date:</label>

            </div>

            `+ date + `

          </div>

          <!--=====================================
          Bloque Status
          ======================================-->

          <div class="form-row">
                        
            <div class="col-2 text-right">
                <label class="p-3 lead">Status:</label>
            </div>

            `+ status + `

          </div> 

          <!--=====================================
            Bloque Comentarios
          ======================================-->

          <div class="form-row">

            <div class="col-2 text-right">
                <label class="p-3 lead">Comment:</label>
            </div>

            `+ comment + `

          </div>

        </div>
     

    `)

  })

  $("#nextProcess").modal()

})

/*=============================================
Función para responder disputa
=============================================*/
$(document).on("click", ".answerDispute", function () {

  $("[name='idDispute']").val($(this).attr("idDispute"));
  $("[name='clientDispute']").val($(this).attr("clientDispute"));
  $("[name='emailDispute']").val($(this).attr("emailDispute"));

  /*=============================================
   Aparecemos la ventana Modal
   =============================================*/
  $("#answerDispute").modal()

})

/*=============================================
Función para responder mensaje
=============================================*/
$(document).on("click", ".answerMessage", function () {

  $("[name='idMessage']").val($(this).attr("idMessage"));
  $("[name='clientMessage']").val($(this).attr("clientMessage"));
  $("[name='emailMessage']").val($(this).attr("emailMessage"));
  $("[name='urlProduct']").val($(this).attr("urlProduct"));

  /*=============================================
 Aparecemos la ventana Modal
 =============================================*/
  $("#answerMessage").modal()

})