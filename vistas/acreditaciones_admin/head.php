<?php //creado auntomáticamente desde localhost

require_once E_VISTAS . "bancos_admin" . DS . "models.php";

$parts = ["acredita","anula"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {include($subFileLoad);}
