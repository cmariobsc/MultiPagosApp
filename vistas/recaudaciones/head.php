<?php
require_once E_VISTAS . 'clientes_admin' . DS . 'models.php';
//--------------------------------------------------------------------
require_once 'variables.php';
$parts = ["servicio", "servicioForm","servicioFormSub","servicioPago", "recaudaciones", "recargas", "bancos", "giros", "acreditacion", "consultas", "reversos"];
    $subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
    if (!empty($subFileLoad)) {
        include($subFileLoad);
    }
