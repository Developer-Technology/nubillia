<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

echo '<script>
        matPreloader("on");
        fncSweetAlert("loading", "Cargando...", "");
    </script>';

$session_name = session_name();
unset($_SESSION['store']);
unset($_SESSION['admin']);
$url = '/';

if (isset($_COOKIE[$session_name])) {
	echo '<script>
            fncFormatInputs();
            window.location = "' . $url . '"
        </script>'; 
}