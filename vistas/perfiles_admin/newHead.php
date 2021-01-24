<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 6/7/2019
 * Time: 10:05
 * Proyecto: lx_multipagos.eqadoor.com
 */


try{
    /**
     *  Lo primero es crear el tipo de cliente
     */

    $tipoClienteNombre = isset_post("tipo");
    $tipoClienteTexto = isset_post("texto");

    if($tipoClienteNombre)
    {
        $tipoCliente = new EmpTipos();

        $tipoCliente->nombre = $tipoClienteNombre;
        $tipoCliente->texto = $tipoClienteTexto;

        if($tipoCliente->save())
        {
            $servicios = EmpServicios::all();

            foreach ($servicios as $servicio)
            {
                $perfilEmpresa = new EmpPerfiles();

                $perfilEmpresa->tipo_id = $tipoCliente->id;
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
            $_SESSION['mensajeSistema'] = "Ha sido imposible crear el nuevo tipo de cliente";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "No se ha ingresado el tipo de cliente";
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