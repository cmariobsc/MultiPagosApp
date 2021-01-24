<?php
    switch($userTipo)
    {
        case 1:
        case 2:
            // es master o admin
            echo '<header id="cabeza" class="fColor3 sombraAbajo"><div class="pagina">';
            include(E_LIB . DS . "zonas" . DS . "headerAdmin.php");
            echo '</div></header>';
            break;
        case 3:
        case 5:
            // Es usuario de punto de venta
            echo '<header id="cabeza" class="fColor3 sombraAbajo"><div class="pagina">';
            include(E_LIB . DS . "zonas" . DS . "headerPuntoVenta.php");
            echo '</div></header>';
            break;
        default:
            // Es público
            echo '<header id="cabeza"><div class="pagina">';
            ///include(E_LIB . DS . "zonas" . DS . "headerPublico.php");
            echo '</div></header>';
    }



