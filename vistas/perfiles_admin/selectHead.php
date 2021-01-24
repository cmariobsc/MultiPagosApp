<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 7/7/2019
 * Time: 1:40
 * Proyecto: lx_multipagos.eqadoor.com
 */

try{
    $modeloId = isset_get("id", 1);
    if($modeloId)
    {
        $perfil = EmpPerfiles::find($modeloId);

        if(!$perfil)
        {
            $_SESSION['mensajeSistema'] = "El perfil no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el perfil";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}