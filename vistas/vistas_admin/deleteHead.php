<?php

try {
    if (isset_get('id')) {
        $visdel_view = Vista::findOrFail(isset_get('id', 1));

        if ($visdel_view == null) {
            $mal = 'La página seleccionada no existe o no es correcta';
        }
        else
        {
            if (!$visdel_view->delete())
            {
                $mal = 'Se produjo un error eliminando la página ' . $fila->nombre;
            }
            else
            {
                if (is_dir("vistas".DS.$visdel_view->nombre))
                {
                    borra_directorio("vistas".DS.$visdel_view->nombre);
                }
            }
        }
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}