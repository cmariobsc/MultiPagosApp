<?php //creado auntomáticamente desde localhost

//require_once E_VISTAS . "clientes_admin" . DS . "models.php";
require_once E_VISTAS . "bancos_admin" . DS . "models.php";

/**
 * Usuario a cargo de esta empresa-cliente
 */

$parts = ["new", "select", "update", "delete"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {include($subFileLoad);}
