<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: latinexus.net
 * Date: 3/9/2018
 * Time: 13:51
 */

//        nombre ---> Banco Bolivariano
//        texto ---> Banco privado
//        a ---> bancoUpdate
//        id ---> 1


try{

    $banco = isset_post("id", 1);

    if($banco)
    {
        $ban = Banco::find($banco);

        $nombre = isset_post("nombre");

        if($ban)
        {
            if($nombre)
            {
                $ban->nombre = strtoupper($nombre);
                $ban->texto = isset_post("texto");

                if($ban->save())
                {
                    $_SESSION['mensajeSistema'] = ["Proceso exitoso"];;
                    header("Location:" . E_URL . E_VIEW );
                    exit();
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "Ha sido imposible actualizar el banco";
                    header("Location:" . E_URL . E_VIEW );
                    exit();
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "El nuevo nombre no fue ingresado";
                header("Location:" . E_URL . E_VIEW );
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El banco seleccionado no existe";
            header("Location:" . E_URL . E_VIEW );
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el banco seleccionado";
        header("Location:" . E_URL . E_VIEW );
        exit();
    }

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}