<?php
/**
 * Si la vista índice no existe,
 * se debe cargar la página de contenido en construcción
 */

if (!file_exists(E_VISTAS . E_INDEX)) {
    include(E_LIB . "construccion.php");
    exit();
} else {
    // Definimos la vista por defecto
    define("E_VIEW", E_INDEX);
}

if (E_ORIGEN == "local") {
    header("Location:" . E_VIEW);
} else {
    header("Location:" . E_URL . E_VIEW);
}
exit();



