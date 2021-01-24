<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 21/1/2020
 * Time: 10:44
 * Proyecto: lx_redmultipago.com
 */
/**
 * Creo la instancia para el envío
 */

try{

    /**
     * solicitud de países
     */
    $meto = "GetH2HCountries";
    $dasCat = DasCatalogo::catalogo($meto, "array");
    $listaResult = [];
    foreach($dasCat as $dasC)
    {
        //$tmpLista = explode("|", $dasC);
        $listaResult[$dasC[0]] = $dasC[1];
    }
    unset($tmpLista);

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}