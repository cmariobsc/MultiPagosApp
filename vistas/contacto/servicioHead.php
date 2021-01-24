<?php

//require_once E_LIB . 'class/Parametros.php'; //Lo he quitado porque está en la plantilla del cms

//--------------------------------------------------------------------
try {
    $conenv_claves = ['nombre', 'correo', 'asunto', 'texto'];
    $conenv_datos = [];
    foreach ($conenv_claves as $conenv_c) {
        if ($conenv_c == "correo") {
            $conenv_correoRemite = isset_post($conenv_c);
            if (!empty($conenv_correoRemite) && filter_var($conenv_correoRemite, FILTER_VALIDATE_EMAIL)) {
                $conenv_datos[$conenv_c] = $conenv_correoRemite;
            } else {
                $mal = "El correo ingresado no parece correcto";
            }
            unset($conenv_correoRemite);
        } else {
            $conenv_datos[$conenv_c] = isset_post($conenv_c);
        }
    }

    if ($mal === 0) {
        if ($conenv_datos['nombre'] && $conenv_datos['correo'] && $conenv_datos['asunto'] && $conenv_datos['texto']) {
            $conenv_mensaje = new Mensaje([
                'nombre' => $conenv_datos['nombre'],
                'correo' => $conenv_datos['correo'],
                'asunto' => $conenv_datos['asunto'],
                'texto' => $conenv_datos['texto'],
            ]);
            if (!$conenv_mensaje->save()) {
                $_SESSION['mensajeSistema'] = 'Error salvando los datos del mensaje';
                exit();
            }

            $conenv_mail = new PHPMailer();

            // Habilitar esta opcion para depurar problemas de conexión
            //$CONTACTO_mail->SMTPDebug = 3;

            $conenv_mail->IsSMTP();
            $conenv_mail->SMTPAuth = true;
            $conenv_mail->SMTPSecure = 'ssl';
            $conenv_mail->Host = E_CORREO_SERVIDOR;
            $conenv_mail->Port = E_CORREO_PUERTO;
            $conenv_mail->Username = E_CORREO_USUARIO;
            $conenv_mail->Password = E_CORREO_CLAVE;
            $conenv_mail->CharSet = 'UTF-8';

            // Correo para los encargados del sitio
            $mensajeBody = "Datos del mensaje:\r\n";
            foreach ($conenv_datos as $idmsg => $datomsg) {
                $mensajeBody .= $idmsg . ": " . $datomsg . "\r\n";
            }

            $conenv_mail->setFrom(E_CORREO_USUARIO, E_DOMINIO);
            $conenv_mail->addAddress(E_CORREO_OFICIAL); // debe llegar a actech@enfriando.com
            $conenv_mail->addBCC("webmaster@latinexus.net");
            $conenv_mail->Subject = "Mensaje de contacto de " . E_DOMINIO;
            $conenv_mail->Body = $mensajeBody;

            if ($conenv_mail->Send()) {
                // Correo de confirmación para el usuario
                $conenv_mail->isHTML(true);
                $conenv_mail->Subject = $CT[2]['titulo'] . " a " . E_DOMINIO . " " . $conenv_datos['nombre'];
                $conenv_mail->Body = $CT[2]['texto'] . " " . E_DOMINIO;
                //$CONTACTO_mail->msgHTML = $CT[2]['texto']." ".E_DOMINIO;
                if (!$conenv_mail->send()) {
                    $mal = 'Error enviando la confirmación';
                }
            } else {
                $mal = 'Mensaje NO enviado. Código de error: ' . $conenv_mail->ErrorInfo;
            }

        } else {
            $mal = 'Parámetros incorrectos.';
        }
    }

} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}