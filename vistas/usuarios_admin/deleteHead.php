<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;

try {
        if (isset_get('id')) {
            $usudel_usuario = Sentinel::getUserRepository()->findById($_GET['id']);

            if (!$usudel_usuario) {
                $mal = 'El usuario seleccionado no existe';
            }
            else
            {
                if ($usudel_usuario->id !== 1) {
                    $ususel_ext = UserExt::where('user_id', $usudel_usuario->id)->first();

                    if(!empty($ususel_ext->avatar))
                    {
                        if ($ususel_ext && file_exists(UserExt::carpeta() . $ususel_ext->avatar)) {
                            unlink(UserExt::carpeta() . $ususel_ext->avatar);
                        }
                    }

                    if ($usudel_usuario->delete())
                    {
                        $_SESSION['mensajeSistema'] = salioBien();
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                    else
                    {
                        $_SESSION['mensajeSistema'] = 'Se produjo un error eliminando el usuario ' . $ususel_ext->nombre_completo();
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }

                }
                else
                {
                    $_SESSION['mensajeSistema'] = "No se puede borrar el usuario inicial";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Los datos no llegaro";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.";
    header("Location:" . E_URL . E_VIEW);
    exit();
}