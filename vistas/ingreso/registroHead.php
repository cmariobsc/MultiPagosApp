<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;

$regdef_user = null;
try
{
    if(filter_var(isset_post('correo'), FILTER_VALIDATE_EMAIL) != FALSE)
    {
        if (
            isset_post('nombres')
            && isset_post('apellidos')
            && isset_post('correo')
            && isset_post('clave1')
            && isset_post('clave2')
            && isset_post('nic')
            && $_POST['clave1'] === $_POST['clave2'])
        {

                $regdef_usuario = [
                    'email' => $_POST['correo'],
                    'password' => $_POST['clave1'],
                    'first_name' => $_POST['nombres'],
                    'last_name' => $_POST['apellidos'],
                ];

                $regdef_user = Sentinel::registerAndActivate($regdef_usuario);

                if ($regdef_user) {
                    $regdef_ext = new UserExt([
                        'user_id' => $regdef_user->id,
                        'nic' => isset_post('nic')
                    ]);



                    if($regdef_ext->save())
                    {
                        $ultimoId = $regdef_user->id;

                        // Aqui debo mandar un correo  con el ID generado
                        $regdef_correo = new PHPMailer();
                        $regdef_correo->IsSMTP();
                        //$correo->SMTPDebug = 2;
                        $regdef_correo->SMTPAuth = true;
                        $regdef_correo->SMTPSecure = 'ssl';
                        $regdef_correo->Host = E_CORREO_SERVIDOR;
                        $regdef_correo->Port = '465';
                        $regdef_correo->Username = E_CORREO_USUARIO;
                        $regdef_correo->Password = E_CORREO_CLAVE;
                        $regdef_correo->CharSet = 'UTF-8';
                        $regdef_correo->setFrom(E_CORREO_USUARIO, E_DOMINIO);
                        $regdef_correo->addAddress($nuevo->correo);
                        $regdef_correo->Subject = E_DOMINIO.' - '.L_CONFIRMACION_INSC;
                        $regdef_correo->isHTML(true);
                        $regdef_Registrante = $nuevo->nombre . ' ' . $nuevo->apellidos;
                        $regdef_bodyExpositor = $regdef_Registrante.PHP_EOL.PHP_EOL.L_MENSAJE_TEXTO.PHP_EOL.PHP_EOL."http://".E_DOMINIO."/registro?a=pre&u=".$ultimoId;
                        $regdef_bodyExpositorHtml = $regdef_correo->msgHTML(sprintf(file_get_contents(L_PLANTILLA_MAIL, dirname(__FILE__)), $regdef_Registrante, $ultimoId, $ultimoId));
                        $regdef_correo->AltBody = $regdef_bodyExpositor;
                        $regdef_correo->Body = $regdef_bodyExpositorHtml;


                        if ($regdef_correo->Send())
                        {
                            $regdef_correoAdmin = new PHPMailer();
                            $regdef_correoAdmin->IsSMTP();
                            //$correoAdmin->SMTPDebug = 2;
                            $regdef_correoAdmin->SMTPAuth = true;
                            $regdef_correoAdmin->SMTPSecure = 'ssl';
                            $regdef_correoAdmin->Host = E_CORREO_SERVIDOR;
                            $regdef_correoAdmin->Port = '465';
                            $regdef_correoAdmin->Username = E_CORREO_USUARIO;
                            $regdef_correoAdmin->Password = E_CORREO_CLAVE;
                            $regdef_correoAdmin->CharSet = 'UTF-8';
                            $regdef_correoAdmin->setFrom(E_CORREO_USUARIO, E_DOMINIO);
                            $regdef_correoAdmin->addAddress(E_CORREO_VENTAS);
                            $regdef_correoAdmin->addBCC('webmaster@latinexus.net');
                            $regdef_correoAdmin->Subject = E_DOMINIO.' - nueva inscripción';
                            $regdef_correoAdmin->isHTML(true);
                            $regdef_bodyAdmin = 'Nueva inscripción<br>';
                            $regdef_bodyAdmin .= 'Nombre: ' . $regdef_user->first_name . ' ' . $regdef_user->last_name . '<br>';
                            $regdef_bodyAdmin .= 'Correo: ' . $regdef_user->email . '<br>';
                            $regdef_correoAdmin->Body = $regdef_bodyAdmin;
                            $regdef_correoAdmin->Send();

                            $_SESSION['mensajeSistema'] = L_PRE_REGISTRO_ENVIADO;
                            header("Location:" . E_INDEX);
                            exit();
                        }
                        else
                        {
                            $mal="Ha ocurrido un error, El registro se realizó con éxito, pero no se ha logrado enviar el correo de confirmación, contacte a la dirección del evento";
                        }
                    }
                    else
                    {
                        $mal="Ha ocurrido un error, ha sido imposible realizar el registro";
                    }





































                } else {
                    $_SESSION['mensajeSistema'] = 'Error registrando al usuario';
                }
                unset($_POST);

        } else {
            $_SESSION['mensajeSistema'] = 'Llene correctamente los datos del formulario';
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = 'La dirección de correo &quot;'.isset_post('correo').'&quot; parece incorrecta y no pasó la validación, verifícala';
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}