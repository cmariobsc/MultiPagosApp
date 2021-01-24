<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;

try {
    if (isset_get('id') && isset_post('nombre') && isset_post('slug')) {
        $rolupd_role = Sentinel::getRoleRepository()->findById($_GET['id']);

        if (!$rolupd_role) {
            $mal = 'El rol seleccionado no existe';
        } else {
            $rolupd_role->name = $_POST['nombre'];
            $rolupd_role->slug = $_POST['slug'];

            if (!$rolupd_role->save()) {
                $mal = 'Se produjo un error actualizando el rol ' . $_POST['slug'];
            }
        }
    } else {
        $mal = "Los datos no llegaron";
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}