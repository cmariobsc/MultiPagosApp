<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 10/7/2019
 * Time: 11:42
 * Proyecto: lx_multipagos.eqadoor.com
 */

try{

        $tipoClienteId = isset_post("id");

        if($tipoClienteId)
        {
            $tipoCliente = EmpTipos::find($tipoClienteId);

            if($tipoCliente)
            {
                $servicios = EmpServicios::all();

                foreach ($servicios as $servicio)
                {
                    $perfilEmpresa = new EmpPerfiles();

                    $perfilEmpresa->tipo_id = $tipoClienteId;
                    $perfilEmpresa->servicio_id = $servicio->id;

                    /**
                     * Evaluo los valores de comisiones
                     */
                    $comiIn = isset_post("comision_in_" . $servicio->id);
                    $comiOut = isset_post("comision_out_" . $servicio->id);

                    if($comiIn && $comiOut)
                    {
                        $perfilEmpresa->comision_in = $comiIn;
                        $perfilEmpresa->comision_out = $comiOut;

                        if(!$perfilEmpresa->save())
                        {
                            $_SESSION['mensajeSistema'] = "Error al guardar el perfil del servicio " . $servicio->nombre;
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                    }
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "El tipo de cliente no existe";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Se desconoce el tipo de cliente";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }


    /**
     *  Si llega acá es que "all" está bien
     */
    $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
    header("Location:" . E_URL . E_VIEW);
    exit();

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />".$e; //
    header("Location:" . E_URL . E_VIEW);
    exit();
}