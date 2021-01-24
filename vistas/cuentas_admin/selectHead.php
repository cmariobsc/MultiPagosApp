<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 27/8/2019
 * Time: 20:21
 * Proyecto: lx_redmultipago.com
 */


try{
    $modeloId = isset_get("id");
    if($modeloId)
    {
        $cuenta = BancoCuenta::find($modeloId);

        if(!$cuenta)
        {
            $_SESSION['mensajeSistema'] = "La cuenta indicada no existe";
            header("Location:" . E_URL . E_VIEW );
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el la cuenta";
        header("Location:" . E_URL . E_VIEW );
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW );
    exit();
}