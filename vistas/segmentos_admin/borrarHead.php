<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 13/8/2019
 * Time: 9:34
 * Proyecto: lx_redmultipago.com
 */
try{
    $segmentoId = isset_get("id");
    if($segmentoId)
    {
        $modelo = EmpSegmentos::find($segmentoId);

        if($modelo)
        {
            if($modelo->delete())
            {
                $_SESSION['mensajeSistema'] = ["proceso exitoso"];
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Fue imposible borrar el segmento seleccionado";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El segmento seleccionado no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el servicio";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}