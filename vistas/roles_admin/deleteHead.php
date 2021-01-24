<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;

try {
    if (isset_get('id')) {
        $roldel_role = Sentinel::getRoleRepository()->findById($_GET['id']);

        if (!$roldel_role) {
            $mal = 'El rol seleccionado no existe';
        } else {
            if (!$roldel_role->delete()) {
                $mal = 'Se produjo un error eliminando el rol ' . $_POST['slug'];
            }
        }
    } else {
        $mal = "Los datos no llegaron";
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}