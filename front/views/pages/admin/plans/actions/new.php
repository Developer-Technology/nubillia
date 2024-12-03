<div class="row">
    <!-- Snow Theme -->
    <div class="col-12">
        <div class="card mb-4">
            <form method="post" class="needs-validation" novalidate>

                <?php

                    require_once "controllers/plans.controller.php";

                    $create = new PlansController();
                    $create -> create();

                ?>

                <div class="card-body mb-0 pb-0">

                    <div class="row">

                        <!--=====================================
                        Nombre
                        ======================================-->
                        <div class="col-md-10">
                        
                        
                        <label>Nombre <sup class="text-danger">*</sup></label>

                            <div class="mt-2 mb-3">


                                <input 
                                type="text" 
                                class="form-control"
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                                onchange="validateRepeat(event,'text','brands','name_brand')"
                                name="name-plan"
                                placeholder="Nombre"
                                required>

                            </div>

                        </div>

                        <!--=====================================
                        Precio
                        ======================================-->
                        <div class="col-md-2">

                            <label for="">Precio <sup class="text-danger">*</sup></label>

                            <div class="mt-2 mb-3">
                                <input
                                type="number"
                                class="form-control"
                                placeholder="Precio"
                                name="price-plan"
                                required>
                            </div>

                        </div>

                        <!--=====================================
                        Descripción
                        ======================================-->
                        <div class="col-md-12">

                            <div class="form-group mt-2 mb-3">
                                
                                <label>Descripción <sup class="text-danger">*</sup></label>

                                <textarea
                                class="summernote"
                                name="description-plan"
                                required
                                ></textarea>

                                <div class="invalid-feedback">Este campo es obligatorio</div>

                            </div>

                        </div>
                        
                    </div>

                </div>

                <div class="card-footer mt-0 pt-0">
                            
                    <div class="col-md-8">

                        <div class="form-group">

                            <a href="/plans" class="btn btn-default border text-left">Regresar</a>
                            
                            <button type="submit" class="btn btn-primary float-right saveBtn">Guardar</button>

                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>
    <!-- /Snow Theme -->
</div>