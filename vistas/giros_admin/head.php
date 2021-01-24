<?php //creado auntomáticamente desde localhost

require_once E_VISTAS . 'clientes_admin' . DS . 'models.php';
require_once E_VISTAS . 'giros' . DS . 'variables.php';
require_once E_VISTAS . 'giros' . DS . 'models.php';

$parts = ["heartBeat","das"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {include($subFileLoad);}
