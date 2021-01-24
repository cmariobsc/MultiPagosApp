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
//    a ---> updateTipo
//    id ---> 2


try{
    $modeloId = isset_post("id", 1);
    if($modeloId)
    {
        $empTipo = EmpTipos::find($modeloId);

        if($empTipo)
        {
            $empTipo->nombre = isset_post("nombre");
            $empTipo->texto = isset_post("texto");

            if($empTipo->save())
            {
                $_SESSION['mensajeSistema'] = "Proceso exitoso";
                header("Location:" . E_URL . E_VIEW) ;
                exit();
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Imposible actualizar el tipo de cliente";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El tipo no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el tipo";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}