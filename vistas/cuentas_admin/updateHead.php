<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 27/8/2019
 * Time: 20:47
 * Proyecto: lx_redmultipago.com
 */

//    nombre ---> Cuenta de gastos
//    numero ---> 345345
//    tipo ---> 1
//    banco ---> 1
//    moneda ---> 1
//    texto --->
//    id ---> 1
//    a ---> cuenta_actualizar

try{
    $modeloId = isset_post("id");
    if($modeloId)
    {
        $cuentaBanco = BancoCuenta::find($modeloId);

        if($cuentaBanco)
        {
            $cuentaBanco->nombre = isset_post("nombre");
            $cuentaBanco->banco_id = isset_post("banco");
            $cuentaBanco->empresa_id = $propio->id;
            $cuentaBanco->tipo_id = isset_post("tipo");
            $cuentaBanco->numero = isset_post("numero");
            $cuentaBanco->moneda_id = isset_post("moneda");
            $cuentaBanco->descripcion = isset_post("texto");

            if($cuentaBanco->save())
            {
                $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Ocurrió un error";
            }

            header("Location:" . E_URL . E_VIEW);
            exit();
        }
        else
        {
            $_SESSION['mensajeSistema'] = "la cuenta no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el la cuenta";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}