<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;

try {
    if (isset_get('id')) {
        $rolsel_rol = Sentinel::getRoleRepository()->findById($_GET['id']);
        if (!$rolsel_rol) {
            $mal = 'El rol seleccionado no existe o no es correcto';
        }
    } else {
        $mal = "Los datos no llegaron";
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}