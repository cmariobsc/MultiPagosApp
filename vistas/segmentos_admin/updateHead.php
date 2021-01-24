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


try{
    $modeloId = isset_post("id", 1);
    if($modeloId)
    {
        $empProveedor = EmpSegmentos::find($modeloId);

        if($empProveedor)
        {
            $empProveedor->nombre = isset_post("nombre");
            $empProveedor->texto = isset_post("texto");

            if($empProveedor->save())
            {
                $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Imposible actualizar el proveedor";
                header("Location:" . E_URL . E_VIEW );
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El proveedor no existe";
            header("Location:" . E_URL . E_VIEW );
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el proveedor";
        header("Location:" . E_URL . E_VIEW );
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW );
    exit();
}