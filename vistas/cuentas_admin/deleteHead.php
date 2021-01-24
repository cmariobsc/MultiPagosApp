<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 27/8/2019
 * Time: 20:20
 * Proyecto: lx_redmultipago.com
 */


try{

    $cuentaId = isset_get("id");

    if($cuentaId)
        {
            $cuenta = BancoCuenta::find($cuentaId);

            if($cuenta)
            {
                if($cuenta->delete())
                {
                    $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "Fue imposible borrar la cuenta";
                }

                header("Location:" . E_URL . E_VIEW);
                exit();
            }
            else
            {
                $_SESSION['mensajeSistema'] = "El valor indicado no existe";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Se desconoce el valor indicado";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}