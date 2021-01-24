<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 19/2/2020
 * Time: 17:45
 * Proyecto: lx_redmultipago.com
 */

try{
    $paisCod = isset_post("pa");
    $modeloId = isset_post("pro");
    //echo "0" . $paisCod . " -- " . $modeloId; exit();
    if($modeloId && $paisCod)
    {
        $ciudades = DasCatalogo::catalogo("GetH2HCities", "array");
//echo "1" . $ciudades; exit();
        if($ciudades)
        {
            $listaCiudades = [];
            foreach($ciudades as $ciudad)
            {
                if($ciudad[1] == $paisCod  && $ciudad[2]==$modeloId)
                {
                    $listaCiudades[$ciudad[0]] = $ciudad[3];
                }
            }
            echo "1" . json_encode($listaCiudades);
            exit();
        }
        else
        {
            $_SESSION['mensajeSistema'] = "";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce la provincia o el país";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}