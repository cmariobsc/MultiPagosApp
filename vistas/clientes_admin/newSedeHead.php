<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 1/7/2019
 * Time: 12:04
 * Proyecto: lx_multipagos.eqadoor.com
 */
use Illuminate\Database\Capsule\Manager as Capsule;

//    array(1) { [0]=> string(11) "Sede Sauces" } sedeNombre --->
//    array(1) { [0]=> string(18) "Transporte escolar" } sedeActividad --->
//    array(1) { [0]=> string(17) "df dsjf sdjfn dsf" } sedeDireccion --->
//    array(1) { [0]=> string(13) "sd dsk sdk ds" } sedeNotas --->
//    array(2) { [0]=> string(7) "Marcelo" [1]=> string(7) "Lázaro" } contactoNombre --->
//    array(2) { [0]=> string(6) "Bélez" [1]=> string(7) "Reinoso" } contactoApellido --->
//    array(2) { [0]=> string(6) "558585" [1]=> string(4) "4587" } contactoTelefonoFijo --->
//    array(2) { [0]=> string(8) "56677777" [1]=> string(3) "789" } contactoTelefonoMovil --->
//    array(2) { [0]=> string(16) "marcelo@mail.com" [1]=> string(15) "lazaro@mail.com" } contactoCorreo --->
//    array(2) { [0]=> string(7) "Gerente" [1]=> string(10) "Secretario" } contactoCargo --->
//    array(2) { [0]=> string(20) "asdn asdna sd asd sa" [1]=> string(15) "dfm sdfdskf sdf" } contactoNotas --->
//    array(2) { [0]=> string(8) "qakfrqhx" [1]=> string(8) "bxmyyrih" } contactoPass --->
//    array(2) { [0]=> string(7) "Usuario" [1]=> string(7) "Usuario" } contactoRol --->
//    a ---> newSede
//    clienteId ---> 41

try{
    $modeloId = isset_post("clienteId", 1);
    if($modeloId)
    {
        $cliente = Empresa::find($modeloId);

        if($cliente)
        {
            /**
             *  Estos valores vienen como Array cada uno
             */
            $sedeNombre = isset_post("sedeNombre");
            $sedeActividad = isset_post("sedeActividad");
            $sedeDireccion = isset_post("sedeDireccion");
            $sedeNotas = isset_post("sedeNotas");

            /**
             * Averiguo si esta sucursal es la casa matriz
             */
            $isMatriz = isset_post("sedematriz");

            Capsule::beginTransaction();

            $sede = new EmpSucursales();

            $sede->empresa_id = $modeloId;
            $sede->nombre = $sedeNombre[0];
            $sede->actividad = $sedeActividad[0];
            $sede->direccion = $sedeDireccion[0];
            $sede->notas = $sedeNotas[0];


            if($isMatriz)
            {
                /**
                 *  Si la nueva sede es nominada como "casa matriz", entonces, debo poner todas las sedes del cliente en cero "0" para el campo "matriz"
                 *  y luego añadir un "1" en el campo "matriz" de la presente entrada
                 */
                EmpSucursales::st_sinMatriz($modeloId);
                $sede->matriz = 1;
            }

            if($sede->save())
            {
                //$_SESSION['mensajeSistema'] = ["Nueva Agencia Guardada con Éxito"];
                /**
                 *  Si llegó hasta aquí entonces debo intentar guardar los contactos
                 *  de esta nueva sede
                 */

                /**
                 *  Voy a asumir que todos los nuevos contactos traen el nombre
                 *  considerando que este es un campo obligatorio
                 */
                $contactos = isset_post("contactoNombre");
                if($contactos && is_array($contactos))
                {
                    $contactoNombre = isset_post("contactoNombre");
                    $contactoApellido = isset_post("contactoApellido");
                    $contactoTelefonoFijo = isset_post("contactoTelefonoFijo");
                    $contactoTelefonoMovil = isset_post("contactoTelefonoMovil");
                    $contactoCorreo = isset_post("contactoCorreo");
                    $contactoCargo = isset_post("contactoCargo");
                    $contactoNotas = isset_post("contactoNotas");
                    $contactoPass = isset_post("contactoPass");
                    $contactoRol = isset_post("contactoRol");

                    foreach($contactos as $conId => $conval)
                    {
                        $contactoNew = new EmpContacto();

                        $contactoNew->sucursal_id = $sede->id;
                        $contactoNew->nombre = $contactoNombre[$conId];
                        $contactoNew->apellido = $contactoApellido[$conId];
                        $contactoNew->correo = $contactoCorreo[$conId];
                        $contactoNew->telefono_fijo = $contactoTelefonoFijo[$conId];
                        $contactoNew->telefono_movil = $contactoTelefonoMovil[$conId];
                        $contactoNew->cargo = $contactoCargo[$conId];
                        $contactoNew->notas = $contactoNotas[$conId];

                        $newUsertel = !empty($contactoNew->telefono_movil) ? $contactoNew->telefono_movil : $contactoNew->telefono_fijo;

                        if($contactoNew->save())
                        {
                            /**
                             *  Una vez creado el contacto pregunto si ha traído contraseña
                             *  En cuyo caso debo proceder al crear el nuevo usuario para el sistema
                             */
                            if(isset($contactoPass[$conId]))
                            {
                                $newUserDatos = [
                                    "nombre" => $contactoNew->nombre,
                                    "apellido" => $contactoNew->apellido,
                                    "correo" => $contactoNew->correo,
                                    "telefono" => $newUsertel,
                                    "notas" => $contactoNew->notas,
                                    "pass" => $contactoPass[$conId],
                                    "rol" => $contactoRol[$conId]
                                ];

                                $newUserId = UserExt::setUser($newUserDatos);
                                if(is_numeric($newUserId))
                                {
                                    $contactoNew->user_id = $newUserId;

                                    if(!$contactoNew->save())
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
                        }
                        else
                        {
                            Capsule::rollback();
                            $_SESSION['mensajeSistema'] = "Fue imposible guardar uno de los nuevos contactos";
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                    }

                    /**
                     *   Si llega hasta aquí entonces podemos hacer el Commit
                     */

                    Capsule::commit();
                    $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
                else
                {
                    Capsule::rollback();
                    $_SESSION['mensajeSistema'] = "";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Imposible guardar la nueva Agencia";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El cliente indicado no existe";
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
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}

