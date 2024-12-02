<?php

/*-------------------------
Autor: Chanamoth
Web: www.chanamoth.com
Mail: info@chanamoth.com
---------------------------*/

// Capturar cualquier salida previa (solución temporal)
ob_start();

// Iniciar la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Eliminar la contraseña del usuario de la sesión
if (isset($_SESSION['user']) && is_object($_SESSION['user'])) {
    unset($_SESSION['user']->password_user);
}

// Obtener el nombre de la sesión
$session_name = session_name();

// Redirigir si la cookie de sesión existe
$url = '/';
if (isset($_COOKIE[$session_name])) {
    echo '<script>
            fncFormatInputs();
            window.location = "' . $url . '"
        </script>';
}

// Liberar el búfer (solo si lo usaste)
ob_end_flush();