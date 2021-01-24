<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 20/8/2019
 * Time: 11:08
 * Proyecto: lx_redmultipago.com
 */
use Cartalyst\Sentinel\Native\Facades\Sentinel;

if(check_acceso_rol(["Master","Administrador"]))
{
    $contactoUserId = isset_get("id", 1);
    if($contactoUserId)
    {
        $userSistema = Sentinel::findById($contactoUserId);

        if($userSistema)
        {
            $userSistemaExt = UserExt::getUser($contactoUserId);

            if($userSistemaExt)
            {
                $usuupd_datos['password'] = genPass();

                $usuContacto = $userSistemaExt->empresa_contacto();

                if(Sentinel::update($userSistema, $usuupd_datos))
                {
                    $msjBody = 'La Contraseña para el usuario ha sido reiniciada, la nueva contraseña es: ' . $usuupd_datos['password'];

                    if(enviaCorreo($usuContacto->correo, $msjBody, "Notificación de " . E_DOMINIO))
                    {
                        $_SESSION['mensajeSistema'] = ["La contraseña se ha cambiado correctamente, el mensaje de notificación fue enviado"];
                    }
                    else
                    {
                        $_SESSION['mensajeSistema'] = "Ocurrió un error, la clave fue actualizada, pero fue imposible enviarla a correo del usuario";
                    }
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "Ha sido imposible cambiar la contraseña";
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "No se encontraron datos extendidos";
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El usuario indicado no existe";
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el usuario a procesar";
    }
}
else
{
    $_SESSION['mensajeSistema'] = accesoNo();
}
header("Location:" . E_URL . $_SESSION['pOld']);
exit();