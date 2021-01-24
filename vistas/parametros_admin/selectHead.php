<?php

try {
    $parsel_param = Parametro::findOrFail(isset_get('id'));
    if ($parsel_param == null) {
        $mal = 'El parámetro seleccionado no existe';
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}