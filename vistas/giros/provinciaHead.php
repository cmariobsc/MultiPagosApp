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
    $modeloId = isset_post("p");
    if($modeloId)
    {
        $provincias = DasCatalogo::catalogo("GetH2HStates", "array");

        if($provincias)
        {
            $listaProvincias = [];
            foreach($provincias as $provincia)
            {
                if($provincia[0] == $modeloId)
                {
                    $listaProvincias[$provincia[1]] = $provincia[2];
                }
            }
            echo "1" . json_encode($listaProvincias);
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
        $_SESSION['mensajeSistema'] = "Se desconoce la provincia";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}