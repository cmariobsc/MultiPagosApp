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
$segmentoNombre = isset_post("nombre");
$segmentoTexto = isset_post("texto");

    if($segmentoNombre)
    {
        $segmento = new EmpSegmentos();

        $segmento->nombre = $segmentoNombre;
        $segmento->texto = $segmentoTexto;

        if($segmento->save())
        {
            $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Ha sido imposible guardar el nuevo proveedor";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
         $_SESSION['mensajeSistema'] = "No se incluyó el nombre del proveedor";
         header("Location:" . E_URL . E_VIEW);
         exit();
    }

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; //.$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}