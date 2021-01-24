<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 11/7/2019
 * Time: 12:21
 * Proyecto: lx_multipagos.eqadoor.com
 */


try{
    $modeloId = isset_get("id");
    if($modeloId)
    {
        $modelo = EmpPerfiles::find($modeloId);

        if($modelo)
        {
            if($modelo->delete())
            {
                $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Ha sido imposible eliminar el perfil";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
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