<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: latinexus.net
 * Date: 3/9/2018
 * Time: 12:28
 */

//    nombre ---> Banco del pacífico
//    texto ---> Banco del estado
//    a ---> newBanco

try{

    $nombre = isset_post("nombre");

    if($nombre)
    {

        $banco = new Banco();

        $banco->nombre = strtoupper($nombre);
        $banco->texto = isset_post("texto");

        if($banco->save())
        {
            $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Ha sido imposible crear el nuevo banco en el sistema";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el nombre del banco a crear";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }



} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />".$e; //
    header("Location:" . E_URL . E_VIEW);
    exit();
}