<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: latinexus.net
 * Date: 3/9/2018
 * Time: 13:30
 */
try{

    $banco = isset_get("id", 1);

    if($banco)
    {
        $ban = Banco::find($banco);

        if(!$ban)
        {
            $_SESSION['mensajeSistema'] = "El banco seleccionado no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el banco seleccionado";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}