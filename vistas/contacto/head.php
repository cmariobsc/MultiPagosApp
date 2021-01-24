<?php
require_once E_LIB . 'models/contacto.php';


$parts = ["enviar","servicio"]; // Esta línea sólo en el head
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {
    include($subFileLoad);
}