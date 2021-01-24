<?php //creado auntomáticamente desde localhost

require_once E_VISTAS . "clientes_admin" . DS . "models.php";
require_once 'models.php';

/**
 * Usuario a cargo de esta empresa-cliente
 */
if($uExt->role_slug() == "Master"):
    $propio = Empresa::where("user_id", $usuario->id)->first();
else:
    $eMio = EmpContacto::where("user_id", $usuario->id)->first();
    $propio = $eMio->empresa();
endif;

$parts = ["new", "select", "update", "delete", "cuentas", "cuentasNew", "cuenta_seleccionar", "cuenta_actualizar", "cuenta_borrar"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {include($subFileLoad);}
