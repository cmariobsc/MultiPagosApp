<?php //creado auntomáticamente desde localhost

require_once E_VISTAS . 'clientes_admin' . DS . 'models.php';

$parts = ["new", "select", "update", "delete"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {include($subFileLoad);}
