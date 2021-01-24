<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 20/4/2019
 * Time: 10:07
 * Proyecto: lx_cotizador.eqadoor.com
 */

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

//    contactoNombre ---> { [0]=> string(6) "Felipe" }
//    contactoApellido ---> { [0]=> string(6) "Oporto" }
//    contactoTelefonoFijo ---> { [0]=> string(6) "225963" }
//    contactoTelefonoMovil ---> { [0]=> string(7) "5236999" }
//    contactoCorreo ---> { [0]=> string(20) "ericlarrea@gmail.com" }
//    contactoCargo ---> { [0]=> string(6) "piloto" }
//    contactoNotas ---> { [0]=> string(14) "primera línea" }
//    contactoRol ---> { [0]=> string(7) "Usuario" }
//    a ---> newContacto
//    agencia ---> 48

try{
    $agenciaId = isset_post("agencia", 1);
    if($agenciaId)
    {
        $sede = EmpSucursales::find($agenciaId);

        if($sede)
        {
            $nContactoNombre = isset_post("contactoNombre");
            $nContactoApellido = isset_post("contactoApellido");
            $nContactoCorreo = isset_post("contactoCorreo");
            $nContactoTelefono_fijo = isset_post("contactoTelefonoFijo");
            $nContactoTelefono_movil = isset_post("contactoTelefonoMovil");
            $nContactoCargo = isset_post("contactoCargo");
            $nContactoNotas = isset_post("contactoNotas");

            $contactoNew = new EmpContacto();

            $contactoNew->sucursal_id = $sede->id;
            $contactoNew->nombre = $nContactoNombre[0];
            $contactoNew->apellido = $nContactoApellido[0];
            $contactoNew->correo = $nContactoCorreo[0];
            $contactoNew->telefono_fijo = $nContactoTelefono_fijo[0];
            $contactoNew->telefono_movil = $nContactoTelefono_movil[0];
            $contactoNew->cargo = $nContactoCargo[0];
            $contactoNew->notas = $nContactoNotas[0];


            $newUsertel = !empty($contactoNew->telefono_movil) ? $contactoNew->telefono_movil : $contactoNew->telefono_fijo;

            Capsule::beginTransaction();

            if($contactoNew->save())
            {
                /**
                 *  Una vez creado el contacto paso a crear el usuario
                 */

                //$nContactoPass = genPass();
                $nContactoRol = isset_post("contactoRol");

                $new_user_credenciales = genUser($contactoNew->nombre, $contactoNew->apellido);

                $newUserDatos = [
                    "rol"=>$nContactoRol[0],
                    "nombre"=>$contactoNew->nombre,
                    "apellido"=>$contactoNew->apellido,
                    "correo"=>$new_user_credenciales["email"],
                    "pass"=>$new_user_credenciales["password"],
                    "nick"=>$new_user_credenciales["nick"],
                    "telefono"=>$contactoNew->telefono_movil,
                    "telefono2"=>$contactoNew->telefono_fijo,
                    "notas"=>$contactoNew->notas
                ];


                $newUserId = UserExt::setUser($newUserDatos);

                if($newUserId && is_numeric($newUserId))
                {
                    $contactoNew->user_id = $newUserId;

                    if($contactoNew->save())
                    {
                        /**
                         * Una vez guardado, envío el correo al nuevo usuario
                         * con su correspondiente contraseña generada
                         */
                        if(msgPass($contactoNew->nombre, $contactoNew->apellido, $contactoNew->correo, $new_user_credenciales["nick"], $new_user_credenciales["password"]))
                        {
                            /**
                             * El mensaje de sistema se genera dentro de msgPass
                             */
                            Capsule::commit();
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                        else
                        {
                            /**
                             * El mensaje de sistema se genera dentro de msgPass
                             */
                            Capsule::rollback();
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                    }
                    else
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "El usuario fue creado, pero no pudo vincularse al nuevo contacto";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }
                else
                {
                    Capsule::rollback();
                    $_SESSION['mensajeSistema'] = "Ha sido imposible crear el nuevo usuario";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                Capsule::rollback();
                $_SESSION['mensajeSistema'] = "Fue imposible guardar uno de los nuevos contactos";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "La agencia no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce la agencia";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />".$e; //
    header("Location:" . E_URL . E_VIEW);
    exit();
}


