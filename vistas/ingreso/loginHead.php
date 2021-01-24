<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;

try {


        if (isset_post('correo') && isset_post('clave'))
        {
//            if(filter_var(isset_post('correo'), FILTER_VALIDATE_EMAIL) != FALSE)
//            {
                $logdef_usuario = [
                    'email' => isset_post('correo') . "@" . E_DOM_CORREO,
                    'password' => isset_post('clave')
                ];

                $tryUser = Sentinel::authenticate($logdef_usuario);
                if ($tryUser !== false)
                {
                    $uActual = UserExt::where("user_id", $tryUser->id)->first();
                    header("Location:" . $uActual->vista_inicio());
                    exit();
                }
                else
                {
                    $_SESSION['mensajeSistema'] = 'Usuario o contraseña inválido';
                    header("Location:" . E_VIEW);
                    exit();
                }
//            }
//            else
//            {
//                $_SESSION['mensajeSistema'] = 'La dirección de correo &quot;'.isset_post('correo').'&quot; parece incorrecta y no pasó la validación, verifícala';
//                header("Location:" . E_VIEW);
//                exit();
//            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = 'Llene correctamente los datos del formulario';
            header("Location:" . E_VIEW);
            exit();
        }


} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = 'Se produjo un error grave, inténtelo más tarde.';
    header("Location:" . E_VIEW);
    exit();
}