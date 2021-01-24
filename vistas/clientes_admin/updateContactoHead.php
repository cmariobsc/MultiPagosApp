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
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Capsule\Manager as Capsule;

//    contactoNombre ---> Pablo
//    contactoApellido ---> Pacheco
//    contactoTelefonoFijo ---> 999999
//    contactoTelefonoMovil --->
//    contactoCorreo ---> caja2@multipago.com
//    contactoCargo ---> Portero
//    contactoRol ---> 5
//    contactoNotas ---> usuario cambiado
//    a ---> updateContacto
//    contactoId ---> 20
//    userId ---> 12





try{
    $uSelected = UserExt::getUser(isset_post("userId"));
    if($uSelected)
    {
        $modeloId = isset_post("contactoId", 1);
        if($modeloId)
        {
            $contacto = EmpContacto::find($modeloId);

            if($contacto)
            {
                $contactoCorreo = isset_post("contactoCorreo");
                if(filter_var($contactoCorreo, FILTER_VALIDATE_EMAIL) != FALSE)
                {
                    Capsule::beginTransaction();

                    $contacto->nombre = !empty(isset_post("contactoNombre")) ? isset_post("contactoNombre") : $contacto->nombre;
                    $contacto->apellido = !empty(isset_post("contactoApellido")) ? isset_post("contactoApellido") : $contacto->apellido;
                    $contacto->correo = $contactoCorreo;
                    $contacto->telefono_fijo = isset_post("contactoTelefonoFijo");
                    $contacto->telefono_movil = isset_post("contactoTelefonoMovil");
                    $contacto->cargo = isset_post("contactoCargo");
                    $contacto->notas = isset_post("contactoNotas");

                    if($contacto->save())
                    {
                        /**
                         * Una vez actualizado verifico si el contacto es usuario del sistema
                         */
                        if(!empty($contacto->user_id))
                        {
                            $contactoUser = Sentinel::findById($contacto->user_id);

                            if ($contactoUser)
                            {
                                //$usuupd_datos['email'] = $userSistemaExt->nick . "@" . E_DOM_CORREO;
                                $contactoUser_datos = [
                                    'first_name' => $contacto->nombre,
                                    'last_name' => $contacto->apellido,
                                    'email' => $uSelected->nick . "@" . E_DOM_CORREO,
                                ];

                                if(Sentinel::update($contactoUser, $contactoUser_datos))
                                {
                                    //$contactoUser_ext = UserExt::where('user_id', $contacto->user_id)->first();

                                    /**
                                     * Averiguamos si hubo cambio de rol para este usuario
                                     */
                                    if($uSelected->role_id() != isset_post("contactoRol", 1))
                                    {
                                        /**
                                         * Quitamos todos los roles
                                         */
                                        $uSelected->quit_roles();

                                        /**
                                         * Asignamos el nuevo rol
                                         */
                                        $uSelected->add_role(isset_post("contactoRol", 1));
                                    }

                                    $uSelected->telefono = !empty($contacto->telefono_movil) ? $contacto->telefono_movil : $contacto->telefono_fijo;

                                    if($uSelected->save())
                                    {
                                        Capsule::commit();
                                        $_SESSION['mensajeSistema'] = ["Actualización exitosa"];
                                        header("Location:" . E_URL . E_VIEW);
                                        exit();
                                    }
                                    else
                                    {
                                        Capsule::rollback();
                                        $_SESSION['mensajeSistema'] = "Imposible guardar los datos extendidos";
                                        header("Location:" . E_URL . E_VIEW);
                                        exit();
                                    }

                                }
                                else
                                {
                                    Capsule::rollback();
                                    $_SESSION['mensajeSistema'] = "Imposible actualizar el usuario del sistema";
                                    header("Location:" . E_URL . E_VIEW);
                                    exit();
                                }
                            }
                            else
                            {
                                Capsule::rollback();
                                $_SESSION['mensajeSistema'] = "El usuario seleccionado no existe";
                                header("Location:" . E_URL . E_VIEW);
                                exit();
                            }
                        }
                        Capsule::commit();
                        $_SESSION['mensajeSistema'] = "";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                    else
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "Ha sido imposible actualizar el contacto";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }

            }
            else
            {
                $_SESSION['mensajeSistema'] = "El cliente no existe";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Se desconoce el cliente";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el usuario extendido";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}


