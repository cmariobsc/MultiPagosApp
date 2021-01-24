<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 15/4/2019
 * Time: 10:17
 * Proyecto: mn_coffee.eqadoor.com
 */
try{
    if(isAjax())
    {
        $id = isset_post("b"); // es el ID del texto
        $idi = isset_post("c"); // es el idioma
        $texto = isset_post("d"); // texto

        if($id && $idi)
        {
            $t = Vista::where("nombre", E_VIEW)->first();
            if($t->setLocal($idi, $id, $texto))
            {
                echo "1Actualización exitosa";
            }
            else
            {
                echo "0Imposible actualizar";
            }
        }
        else
        {
            echo "0Faltan valores";
        }

    }
    else
    {
        $_SESSION['mensajeSistema'] = "Petición incorrecta";
        header("Location:" . E_URL . E_VIEW);
    }
    exit();

} catch (Exception $e) {
    echo "0Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    exit();
}