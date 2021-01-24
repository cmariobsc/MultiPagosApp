<?php

try {
    if (isset_get('id')) {
        $parsel_param = Parametro::findOrFail(isset_get('id'));

        if ($parsel_param == null) {
            $mal = 'La parámetro seleccionado no existe';
        } else {
            if (!$parsel_param->delete()) {
                $mal = 'Se produjo un error eliminando el parámetro ' . $parsel_param->clave;
            }
        }
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}