<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 31/8/2019
 * Time: 14:16
 * Proyecto: lx_redmultipago.com
 */

require_once E_VISTAS . "bancos_admin" . DS . "models.php";

/**
 * CUENTAS PROPIAS
 */
$cuentasOrigen = BancoCuenta::where("empresa_id", $uEmpresa->id)->get();

$listaCuentasOrigen = [];
foreach($cuentasOrigen as $cProp)
{
    $listaCuentasOrigen[$cProp->id] = $cProp->banco()->nombre . " - " . $cProp->numero;
}
unset($cProp);

/**
 * CUENTAS DEL PROVEEDOR
 */
$cuentasDestino = BancoCuenta::where("empresa_id", $uEmpresa->padre)->get();

$listaCuentasDestino = [];
foreach($cuentasDestino as $cProp)
{
    $listaCuentasDestino[$cProp->id] = $cProp->banco()->nombre . " - " . $cProp->numero;
}


$listaDepositos = EmpMovimientos::where("empresa_origen_id", $uEmpresa->id)->orderBy("id","desc")->get();
