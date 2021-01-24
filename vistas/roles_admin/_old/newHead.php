<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;

try {
    if (isset_post('nombre') && isset_post('slug')) {
        $roldel_role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $_POST['nombre'],
            'slug' => $_POST['slug'],
        ]);
        if (!$roldel_role) {
            $mal = 'Se produjo un error creando el rol ' . $_POST['nombre'];
        }
    } else {
        $mal = "Los datos no llegaron";
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}