<nav aria-label="breadcrumb">
    
    <ol class="breadcrumb breadcrumb-style1">
        
        <?php if (isset($routesArray[2])): ?>
            
            <?php if ($routesArray[2] == "new" || $routesArray[2] == "edit"): ?>
                
                <li class="breadcrumb-item">
                    <a href="/users" class="text-muted fw-light">Usuarios</a>
                </li>
                <li class="breadcrumb-item active"><?php echo $txtBread ?></li>
                
            <?php endif?>
            
        <?php else: ?>
            
            <li class="breadcrumb-item active">Usuarios</li>
            
        <?php endif?>
    
    </ol>

</nav>

<p>En esta sección podrás administrar los usuarios registrados, ya se usuario o administrador del sistema.</p>

<?php

    if(isset($routesArray[2])) {
        
        if($routesArray[2] == "new" || $routesArray[2] == "edit" || $routesArray[2] == "view") {
            
            include "actions/" . $routesArray[2] . ".php";
        
        }
    
    } else {
        
        include "actions/list.php";
    
    }
    
?>