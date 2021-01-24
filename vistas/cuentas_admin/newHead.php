<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 27/8/2019
 * Time: 03:17
 * Proyecto: lx_redmultipago.com
 */

//    nombre ---> namesilo
//    numero ---> 45345435
//    tipo ---> 1
//    banco ---> 1
//    moneda ---> 1
//    texto ---> dfdfdfddfg df ffdfdgd dfgdfgd f
//    a ---> cuentasNew


$cuentaBanco = new BancoCuenta();

$cuentaBanco->nombre = isset_post("nombre");
$cuentaBanco->banco_id = isset_post("banco");
$cuentaBanco->empresa_id = $uEmpresa->id;
$cuentaBanco->tipo_id = isset_post("tipo");
$cuentaBanco->numero = isset_post("numero");
$cuentaBanco->moneda_id = isset_post("moneda");
$cuentaBanco->descripcion = isset_post("texto");

if($cuentaBanco->save())
{
    $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
}
else
{
    $_SESSION['mensajeSistema'] = "Ocurrió un error";
}

header("Location:" . E_URL . E_VIEW );
exit();