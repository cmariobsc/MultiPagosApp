<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 10/7/2019
 * Time: 11:12
 * Proyecto: lx_multipagos.eqadoor.com
 */

//    a ---> addServicios
//    id ---> 1
$tipoId = isset_post("id");

if($tipoId)
{
    $servicios = EmpServicios::all();
}
else
{
    $_SESSION['mensajeSistema'] = "Se desconoce el tipo de cliente";
    header("Location:" . E_URL . E_VIEW);
    exit();
}


