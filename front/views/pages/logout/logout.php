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

session_destroy();

echo '<script>
        window.location= "/";
    </script>';