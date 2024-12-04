<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

if(isset($routesArray[2])) {
    
    if($routesArray[2] == "general"){
        
        $txtBread = 'Configuración General';
    
    } elseif($routesArray[2] == "server") {
        
        $txtBread = 'Servidor De Correo';
    
    } elseif($routesArray[2] == "favicon") {
        
        $txtBread = 'Cargar Favicon';
    
    } elseif($routesArray[2] == "gateway") {
        
        $txtBread = 'Pasarelas De Pago';
    
    } elseif($routesArray[2] == "billing") {
        
        $txtBread = 'Facturación';
    
    } else {
        
        $txtBread = '----';
    
    }

} else {
    
    $txtBread = '----';

}

?>

<nav aria-label="breadcrumb">
    
    <ol class="breadcrumb breadcrumb-style1">
        
        <li class="breadcrumb-item">
            <a href="/settings/general" class="text-muted fw-light">Configuraciones</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $txtBread ?></li>
    </ol>

</nav>

<p>En esta sección podrás configurar los parámetros del sistema.</p>

<?php

    if(isset($routesArray[2])) {
        
        if($routesArray[2] == "general" ||
            $routesArray[2] == "server" ||
            $routesArray[2] == "gateway" ||
            $routesArray[2] == "billing" ||
            $routesArray[2] == "favicon"
        ) {
            
            include $routesArray[2]."/".$routesArray[2].".php";
        
        } else {
            
            echo '<script>
                    window.location = "/settings/general";
                </script>'; 
        
        }

    } else {

        echo '<script>
                    window.location = "/settings/general";
                </script>'; 

    }

?>