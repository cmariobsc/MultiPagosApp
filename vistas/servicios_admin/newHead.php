<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 3/7/2019
 * Time: 8:52
 * Proyecto: lx_multipagos.eqadoor.com
 */

//    nombre ---> Lenin
//    valor ---> 6
//    texto ---> hjghj ghj
//    a ---> newTipo

try{
    $servicioNombre = isset_post("nombre");
    $proveedor_id = isset_post("proveedor", 1);
    $segmento_id = isset_post("segmento", 1);
    $servicioTexto = isset_post("texto");
    $servicioCodigo = strtoupper(isset_post("codigo"));

    if($segmento_id)
    {
        if($proveedor_id)
        {
            if ($servicioNombre)
            {
                if($servicioCodigo)
                {
                    $servicio = new EmpServicios();

                    $servicio->nombre = $servicioNombre;
                    $servicio->proveedor_id = $proveedor_id;
                    $servicio->segmento_id = $segmento_id;
                    $servicio->codigo = $servicioCodigo;
                    $servicio->texto = $servicioTexto;

                    if ($servicio->save()) {
                        $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    } else {
                        $_SESSION['mensajeSistema'] = "Ha sido imposible guardar el nuevo servicio";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "No se incluyó el código del servicio";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "No se incluyó el nombre del servicio";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "No se seleccionó el proveedor";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "No se seleccionó el segmento";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}