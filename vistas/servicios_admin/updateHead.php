<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 3/7/2019
 * Time: 10:17
 * Proyecto: lx_multipagos.eqadoor.com
 */

//    nombre ---> Franquicia
//    valor ---> 5.500
//    texto ---> Comercios tercerizados
//    a ---> updateProveedor
//    id ---> 2
//request();

try{
    $modeloId = isset_post("id", 1);
    if($modeloId)
    {
        $proveedor_id = isset_post("proveedor", 1);
        if($proveedor_id)
        {
            $segmento_id = isset_post("segmento", 1);
            if($segmento_id)
            {
                $empServicio = EmpServicios::find($modeloId);
                if ($empServicio)
                {
                    $empServicio->proveedor_id = $proveedor_id;
                    $empServicio->segmento_id = $segmento_id;
                    $empServicio->codigo = isset_post("codigo");
                    $empServicio->nombre = isset_post("nombre");
                    $empServicio->texto = isset_post("texto");

                    if ($empServicio->save()) {
                        $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                    else
                    {
                        $_SESSION['mensajeSistema'] = "Imposible actualizar el servicio";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "El servicio no existe";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "No se ingresó el segmento";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "No se ingresó el proveedor";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el servicio";
        header("Location:" . E_URL . E_VIEW );
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW );
    exit();
}