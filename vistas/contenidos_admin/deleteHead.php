<?php

try {
    if (isset_get('id', 1)) {


        foreach ($_SESSION['idiomas'] as $condel_lang)
        {


            $condel_tmp_cont = new Contenido();



            $condel_tmp_cont->setTable('vistas_cont_' . $condel_lang);

            $condel_cnt = $condel_tmp_cont->findOrFail(isset_get('id', 1));

            $condel_cnt->setTable('vistas_cont_' . $condel_lang);


            if ($condel_cnt == null) {
                $mal = 'El texto seleccionado no existe o no es correcto para el idioma ' . nombreIdioma($condel_lang);
            } else {
                if (!$condel_cnt->delete()) {
                    $mal = 'Se produjo un error eliminando el texto ' . $condel_cnt->titulo;
                }
            }


        }


    } else {
        $mal = "Los datos no llegaron";
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}