<?php

use PHPMailer\PHPMailer\PHPMailer;

//--------------------------------------------------------------------
try {
    /**
     * Creo un arreglo con las variables que llegan
     */
    $conenv_claves = ['nombre', 'correo', 'asunto', 'mensaje'];
    $conenv_datos = [];

    foreach ($conenv_claves as $conenv_c)
    {
        if ($conenv_c == "correo")
        {
            $conenv_correoRemite = isset_post($conenv_c);

            if ($conenv_correoRemite && filter_var($conenv_correoRemite, FILTER_VALIDATE_EMAIL))
            {
                $conenv_datos[$conenv_c] = $conenv_correoRemite;
            }
            else
            {
                $_SESSION['mensajeSistema'] = "El correo ingresado no parece correcto";
                header("Location:" . E_URL.E_VIEW);
                $mal++;
                exit();
            }
            unset($conenv_correoRemite);
        }
        else
        {
            $conenv_datos[$conenv_c] = isset_post($conenv_c);

            if(empty($conenv_datos[$conenv_c]))
            {
                $_SESSION['mensajeSistema'] = 'Complete los campos obligatorios incluyento "'.$conenv_c.'"';
                header("Location:" . E_URL.E_VIEW);
                $mal++;
                exit();
            }
        }
    }

    if ($mal === 0)
    {

        $conenv_mensaje = new Mensaje([
            'nombre' => $conenv_datos['nombre'],
            'correo' => $conenv_datos['correo'],
            'asunto' => $conenv_datos['asunto'],
            'texto' => $conenv_datos['mensaje']
        ]);


        /**
         * Evalúo si el mensaje fue guardado en la DB
         */
        if ($conenv_mensaje->save())
        {
            $conenv_mail = new PHPMailer();

            /**
             * Habilitar esta opcion para depurar problemas de conexión
             */
            // $conenv_mail->SMTPDebug = 3;

            $conenv_mail->IsSMTP();
            $conenv_mail->SMTPAuth = true;
            $conenv_mail->SMTPSecure = 'ssl';
            $conenv_mail->Host = E_CORREO_SERVIDOR;
            $conenv_mail->Port = E_CORREO_PUERTO;
            $conenv_mail->Username = E_CORREO_USUARIO;
            $conenv_mail->Password = E_CORREO_CLAVE;
            $conenv_mail->CharSet = 'UTF-8';

            /**
             *  CORREO PARA LA ADMINISTRACIÓN DEL SITIO
             */
            $mensajeBody = "Datos del mensaje:\r\n";
            foreach ($conenv_datos as $idmsg => $datomsg)
            {
                $mensajeBody .= $idmsg . ": " . $datomsg . "\r\n";
            }

            $conenv_mail->setFrom(E_CORREO_USUARIO, E_DOMINIO);
            $conenv_mail->addAddress(E_CORREO_DIRECCION); //
            $conenv_mail->addBCC("webmaster@latinexus.net");
            $conenv_mail->Subject = "Mensaje de contacto de " . E_DOMINIO;
            $conenv_mail->Body = $mensajeBody;

            if ($conenv_mail->Send())
            {

                /**
                 * Correo de confirmación para el usuario
                 */
                $cliente_mail = new PHPMailer();

                /**
                 * Habilitar esta opcion para depurar problemas de conexión
                 */
                //$cliente_mail->SMTPDebug = 3;

                $cliente_mail->IsSMTP();
                $cliente_mail->SMTPAuth = true;
                $cliente_mail->SMTPSecure = 'ssl';
                $cliente_mail->Host = E_CORREO_SERVIDOR;
                $cliente_mail->Port = E_CORREO_PUERTO;
                $cliente_mail->Username = E_CORREO_USUARIO;
                $cliente_mail->Password = E_CORREO_CLAVE;
                $cliente_mail->CharSet = 'UTF-8';

                $cliente_mail->setFrom(E_CORREO_USUARIO, E_DOMINIO);
                $cliente_mail->addAddress($conenv_datos['correo']); //

                $cliente_mail->isHTML(true);
                $cliente_mail->Subject = $contView[3]['titulo'];
                $cliente_mail->Body = $contView[3]['texto'];

                if ($cliente_mail->send())
                {
                    $_SESSION['mensajeSistema'] = "Proceso exitoso";
                    header("Location:" . E_URL.E_VIEW);
                    exit();
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "Su mensaje ha sido entregado, pero no hemos podido enviarle confirmación a su correo";
                    header("Location:" . E_URL.E_VIEW);
                    exit();
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = 'Mensaje NO enviado. Código de error: ' . $conenv_mail->ErrorInfo;
                header("Location:" . E_URL.E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = 'Error salvando los datos del mensaje';
            header("Location:" . E_URL.E_VIEW);
            exit();
        }

    }
    else
    {
        $_SESSION['mensajeSistema'] = "Ocurrió un error";
        header("Location:" . E_URL.E_VIEW);
        exit();
    }

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = 'Se produjo un error grave, inténtelo más tarde.';
    header("Location:" . E_URL.E_VIEW);
    exit();
}