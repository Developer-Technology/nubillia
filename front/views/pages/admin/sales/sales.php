<nav aria-label="breadcrumb">
    
    <ol class="breadcrumb breadcrumb-style1">
        
        <?php if (isset($routesArray[2])): ?>
            
            <?php if ($routesArray[2] == "new" || $routesArray[2] == "edit"): ?>
                
                <li class="breadcrumb-item">
                    <a href="/plans" class="text-muted fw-light">Ventas</a>
                </li>
                <li class="breadcrumb-item active"><?php echo $txtBread ?></li>
                
            <?php endif?>
            
        <?php else: ?>
            
            <li class="breadcrumb-item active">Ventas</li>
            
        <?php endif?>
    
    </ol>

</nav>

<p>En esta sección podrás ver todas las ventas realizadas; asignadas o sin asignar, realizadas desde el registro por usuario o directo del panel.</p>

<?php

    if(isset($routesArray[2])) {
        
        if($routesArray[2] == "new" || $routesArray[2] == "edit" || $routesArray[2] == "view") {
            
            include "actions/" . $routesArray[2] . ".php";
        
        }
    
    } else {
        
        include "actions/list.php";
    
    }
    
?>