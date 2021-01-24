<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 5/2/2020
 * Time: 19:24
 * Proyecto: lx_redmultipago.com
 */

try{

    $c = isset_post("b");

    $existeServ = EmpServicios::where(["codigo", strtoupper($c)])->orWhere(["codigo",strtolower($c)])->count();

    if($existeServ === 0)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
    exit();

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}