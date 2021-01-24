<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;
require_once E_LIB . "class".DS."class.upload.php";

//    empresaNombre ---> Multipagos S.A.
//    rucTipo ---> R
//    empresaRuc ---> 545654845
//    empresaNotas ---> zxc zxnc zxjc zxnc zjx czx c
//    empresaCredito ---> 10000
//    empresaTipo ---> 3
//    empresaEstado ---> 1
//    array(2) { [0]=> string(17) "Multipagos Guayas" [1]=> string(6) "Matriz" } sedeNombre --->
//    array(2) { [0]=> string(10) "Transporte" [1]=> string(10) "Transporte" } sedeActividad --->
//    array(2) { [0]=> string(24) "sdf sdfnsdf sdjf sd fjsd" [1]=> string(22) "dsf sdf sdjf sdjf dsjf" } sedeDireccion --->
//    array(2) { [0]=> string(18) "sdf sdsjd fsjd fsd" [1]=> string(21) "sj nsdfsdf sjf sdf sd" } sedeNotas --->
//    array(2) { [0]=> string(7) "Roberto" [1]=> string(7) "Delfín" } contactoNombre_0 --->
//    array(2) { [0]=> string(7) "Robaina" [1]=> string(5) "Quero" } contactoApellido_0 --->
//    array(2) { [0]=> string(5) "85478" [1]=> string(5) "85478" } contactoTelefonoFijo_0 --->
//    array(2) { [0]=> string(6) "666666" [1]=> string(6) "666666" } contactoTelefonoMovil_0 --->
//    array(2) { [0]=> string(17) "roberto@gmail.com" [1]=> string(15) "delfin@mail.com" } contactoCorreo_0 --->
//    array(2) { [0]=> string(7) "Gerente" [1]=> string(7) "gerente" } contactoCargo_0 --->
//    array(2) { [0]=> string(32) "sdfsdfsjdf fhas dhas dahd ash d" [1]=> string(27) "sdfsd fdsajf sdj sdjf sd sd" } contactoNotas_0 --->
//    array(2) { [0]=> string(8) "ygbvyhjh" [1]=> string(8) "dtnhutkh" } contactoPass_0 --->
//    array(2) { [0]=> string(13) "Administrador" [1]=> string(7) "Usuario" } contactoRol_0 --->
//    array(1) { [0]=> string(1) "1" } sedematriz --->
//    array(2) { [0]=> string(6) "Miriam" [1]=> string(5) "Sissi" } contactoNombre_1 --->
//    array(2) { [0]=> string(6) "Larrea" [1]=> string(3) "sdf" } contactoApellido_1 --->
//    array(2) { [0]=> string(4) "4646" [1]=> string(4) "4646" } contactoTelefonoFijo_1 --->
//    array(2) { [0]=> string(6) "456456" [1]=> string(6) "456456" } contactoTelefonoMovil_1 --->
//    array(2) { [0]=> string(15) "miriam@mail.com" [1]=> string(15) "sissi5@mail.com" } contactoCorreo_1 --->
//    array(2) { [0]=> string(15) "Administración" [1]=> string(15) "Administración" } contactoCargo_1 --->
//    array(2) { [0]=> string(38) "sdfsdn fsdhf has fdahsd ad ashd ahs as" [1]=> string(17) "sdfn asfksdfksdf " } contactoNotas_1 --->
//    array(2) { [0]=> string(8) "uhxxccud" [1]=> string(8) "pydvhixd" } contactoPass_1 --->
//    array(2) { [0]=> string(7) "Usuario" [1]=> string(7) "Usuario" } contactoRol_1 --->
//    propio ---> 37
//    a ---> new


try{

    $empresaNombre = isset_post("empresaNombre");

    if($empresaNombre)
    {
        /**
         * Iniciamos una transaccion
         */
        Capsule::beginTransaction();


        $empresa = new Empresa();

        /**
         * Continuamos con el ingreso de valores para la tabla principal de Empresas
         */
        $empresa->padre = isset_post("propio");
        $empresa->nombre = $empresaNombre;
        $empresa->estado = isset_post("empresaEstado");
        $empresa->vendedor = $usuario->id;
        //$empresa->clasificacion = isset_post("empresaCalifica");

        if($empresa->save())
        {



            /**
             *      Proceso los datos secundarios
             */
            $empresaDatos = new EmpDatos();

            $empresaDatos->empresa_id = $empresa->id;
            $empresaDatos->ruc = isset_post("empresaRuc");
            $empresaDatos->rucTipo  = isset_post("rucTipo");
            $empresaDatos->notas = isset_post("empresaNotas");

            if($empresaDatos->save())
            {
                /**
                 *      Creación de la información comercial
                 */
                $empresaCredito = isset_post("empresaCredito");
                $empresaTipo = isset_post("empresaTipo");
                if($empresaCredito)
                {
                    $comercial = new EmpComercial();

                    $comercial->empresa_id = $empresa->id;
                    $comercial->credito = $empresaCredito;
                    $comercial->tipo_id = $empresaTipo ? $empresaTipo : 1;

                    if(!$comercial->save())
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "Imposible guardar la información comercial";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }

                /**
                 *      Creación de las sucursales (sedes)
                 */
                $sedeNombre = isset_post("sedeNombre");

                if($sedeNombre && is_array($sedeNombre))
                {
                    $sedeActividad = isset_post("sedeActividad");
                    $sedeDireccion = isset_post("sedeDireccion");
                    $sedeNotas = isset_post("sedeNotas");

                    /**
                     * Averiguo si esta sucursal es la casa matriz
                     */
                    $matriz = isset_post("sedematriz",1);

                    foreach ($sedeNombre as $sId=>$sNom)
                    {
                        $sucursal = new EmpSucursales();

                        $sucursal->empresa_id = $empresa->id;
                        $sucursal->matriz = ($matriz && $matriz[$sId] == $sId) ? 1 : 0 ;
                        $sucursal->nombre = $sedeNombre[$sId];
                        $sucursal->actividad = $sedeActividad[$sId];
                        $sucursal->direccion = $sedeDireccion[$sId];
                        $sucursal->notas = $sedeNotas[$sId];

                        if($sucursal->save())
                        {
                            /**
                             *  Con la sucursal creada, procedemos a crear sus contactos
                             */
                            $contactoNombre = isset_post("contactoNombre_" . $sId);
                            $contactoApellido = isset_post("contactoApellido_" . $sId);
                            $contactoTelefonoFijo = isset_post("contactoTelefonoFijo_" . $sId);
                            $contactoTelefonoMovil = isset_post("contactoTelefonoMovil_" . $sId);
                            $contactoCorreo = isset_post("contactoCorreo_" . $sId);
                            $contactoCargo = isset_post("contactoCargo_" . $sId);
                            $contactoNotas = isset_post("contactoNotas_" . $sId);
                            //$contactoPass = isset_post("contactoPass_" . $sId);
                            $contactoRol = isset_post("contactoRol_" . $sId);

                            if($contactoNombre && is_array($contactoNombre))
                            {
                                foreach($contactoNombre as $cId => $cNombre)
                                {
                                    $contacto = new EmpContacto;

                                    $contacto->sucursal_id = $sucursal->id;
                                    $contacto->nombre = $contactoNombre[$cId];
                                    $contacto->apellido = $contactoApellido[$cId];
                                    $contacto->correo = $contactoCorreo[$cId];
                                    $contacto->telefono_fijo = $contactoTelefonoFijo[$cId];
                                    $contacto->telefono_movil = $contactoTelefonoMovil[$cId];
                                    $contacto->cargo = $contactoCargo[$cId];
                                    $contacto->notas = $contactoNotas[$cId];

                                    if($contacto->save())
                                    {
                                        if(!empty($contacto->correo))
                                        {
                                            if(filter_var($contacto->correo, FILTER_VALIDATE_EMAIL))
                                            {
                                                $new_user_credenciales = genUser($contacto->nombre, $contacto->apellido);

                                                $datosNuevoUser = [
                                                    "rol"=>$contactoRol[$cId],
                                                    "nombre"=>$contacto->nombre,
                                                    "apellido"=>$contacto->apellido,
                                                    "correo"=>$new_user_credenciales['email'],
                                                    "pass"=>$new_user_credenciales['password'],
                                                    "nick"=>$new_user_credenciales['nick'],
                                                    "telefono"=>$contacto->telefono_movil,
                                                    "telefono2"=>$contacto->telefono_fijo,
                                                    "notas"=>$contacto->notas
                                                ];

                                                $nuevoUserExt = UserExt::setUser($datosNuevoUser);

                                                if($nuevoUserExt)
                                                {
                                                    $contacto->user_id = $nuevoUserExt;

                                                    if($contacto->save())
                                                    {
                                                        if(msgPass($contacto->nombre, $contacto->apellido, $contacto->correo, $new_user_credenciales['nick'], $new_user_credenciales['password']))
                                                        {
                                                            /**
                                                             * El mensaje de respuesta se genera dentro de msgPass
                                                             */
                                                            Capsule::commit();
                                                            header("Location:" . E_URL . E_VIEW);
                                                            exit();
                                                        }
                                                        else
                                                        {
                                                            /**
                                                             * El mensaje de respuesta se genera dentro de msgPass
                                                             */
                                                            Capsule::rollback();
                                                            header("Location:" . E_URL . E_VIEW);
                                                            exit();
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $_SESSION['mensajeSistema'] = "Cliente creado, pero la tabla de contactos de la empresa no pudo ser actualizada.";
                                                    }
                                                }
                                                else
                                                {
                                                    $_SESSION['mensajeSistema'] = "Cliente creado, no obstante ocurrió un problema creando los datos extras.";
                                                }
                                            }
                                            else
                                            {
                                                //Capsule::rollback();
                                                $_SESSION['mensajeSistema'] = "Cliente creado, pero el correo ingresado para el usuario -" . $contacto->nombre . " " . $contacto->apellido . "- no parece válido";
                                            }
                                        }
                                        else
                                        {
                                            //Capsule::rollback();
                                            $_SESSION['mensajeSistema'] = "Cliente creado, pero se desconoce el correo del usuario " . $contacto->nombre . " " . $contacto->apellido;
                                        }
                                    }
                                    else
                                    {
                                        Capsule::rollback();
                                        $_SESSION['mensajeSistema'] = "No se pudo guardar los contactos de la sucursal " . $cId + 1;
                                        header("Location:" . E_URL . E_VIEW);
                                        exit();
                                    }

                                }
                            }
                            else
                            {
                                Capsule::rollback();
                                $_SESSION['mensajeSistema'] = "No se encontraron contactos para la sucursal " . $sId + 1;
                                header("Location:" . E_URL . E_VIEW);
                                exit();
                            }
                        }
                        else
                        {
                            Capsule::rollback();
                            $_SESSION['mensajeSistema'] = "Ha sido imposible guardar la sucursal " . $sId+1;
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                    }

                    /**
                     * Si llegamos aquí sin que se produzca una exepción
                     * entonces es que las cosas van bien y procedemos a cerrar la transaccion
                     */
                    Capsule::commit();
                    $_SESSION['mensajeSistema'] = "Proceso exitoso";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
                else
                {
                    Capsule::rollback();
                    $_SESSION['mensajeSistema'] = "No se encontraron referencias a las oficinas del cliente";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                Capsule::rollback();
                $_SESSION['mensajeSistema'] = "Imposible guardar los datos secundarios";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            Capsule::rollback();
            $_SESSION['mensajeSistema'] = "ha sido imposible crear el nuevo cliente";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoceel nombre de la empresa cliente";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }

} catch (Exception $e) {
    echo $e;
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />".$e; //
    //header("Location:" . E_URL . E_VIEW);
    exit();
}
exit();