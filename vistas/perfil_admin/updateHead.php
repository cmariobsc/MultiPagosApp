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
use Illuminate\Database\Capsule\Manager as Capsule;

require_once E_LIB . 'class/class.upload.php';


//    miNombre ---> Eric
//    miApellido ---> Larrea
//    miPass ---> 1234
//    miPass2 ---> 1234
//    miTelefono1 ---> 0984008290
//    miTelefono2 --->
//    miCorreo ---> elapez@gmail.com
//    miFoto --->
//    a ---> update


$userSistema = Sentinel::findById($usuario->id);

if($userSistema)
{
    $userSistemaExt = UserExt::getUser($usuario->id);

    if($userSistemaExt)
    {
        $pass1 = isset_post("miPass");
        $pass2 = isset_post("miPass2");

        if(!empty($pass1) && $pass1 === $pass2)
        {
            $usuupd_datos['password'] = $pass1;
            $usuupd_datos['email'] = $userSistemaExt->nick . "@" . E_DOM_CORREO;

            if(Sentinel::update($userSistema, $usuupd_datos))
            {
                $_SESSION['mensajeSistema'] = ["La Contraseña para el usuario ha sido cambiada satisfactoriamente"];
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Ha sido imposible cambiar la contraseña";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Las contraseñas no parecen coincidir";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "No se encontraron datos extendidos";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
}
else
{
    $_SESSION['mensajeSistema'] = "El usuario indicado no existe";
    header("Location:" . E_URL . E_VIEW);
    exit();
}

