<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 14/8/2019
 * Time: 12:42
 * Proyecto: lx_redmultipago.com
 */

/**
 * Usuario a cargo de esta empresa-cliente
 */
if($uExt->role_slug() == "Master"):
    $propio = Empresa::where("user_id", $usuario->id)->first();
else:
    //$eMio = EmpContacto::where("user_id", $usuario->id)->first();
    //$propio = $eMio->empresa();
    $propio = $uEmpresa;
endif;
$clientesPropios = count($propio) > 0 ? $propio->hijos() : "";

/**
 * CUENTAS PROPIAS
 */
$cuentasDestinos = BancoCuenta::cuentas();
$listaCuentasDestino = [];
foreach($cuentasDestinos as $cuentasDestino)
{
    $listaCuentasDestino[$cuentasDestino->id] = $cuentasDestino->numero . " - " . $cuentasDestino->banco()->nombre;
}
unset($cuentasDestino);