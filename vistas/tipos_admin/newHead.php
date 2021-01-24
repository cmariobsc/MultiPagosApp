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
$tipoNombre = isset_post("nombre");
$tipoTexto = isset_post("texto");

    if($tipoNombre)
    {
        $tipoEmpresa = new EmpTipos();

        $tipoEmpresa->nombre = $tipoNombre;
        $tipoEmpresa->texto = $tipoTexto;

        if($tipoEmpresa->save())
        {
            $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Ha sido imposible guardae el nuevo tipo";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
         $_SESSION['mensajeSistema'] = "No se incluyó el nombre";
         header("Location:" . E_URL . E_VIEW);
         exit();
    }

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}