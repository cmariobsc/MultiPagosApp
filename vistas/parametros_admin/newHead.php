<?php

try {
    if (isset_post('clave') && isset_post('valor')) {
        $parnew_param = new Parametro([
            'clave' => isset_post('clave'),
            'valor' => isset_post('valor'),
            'explica' => isset_post('explica'),
        ]);

        if ($parnew_param->save()) {
            $_SESSION['mensajeSistema'] = salioBien();
        } else {
            $mal = 'No se pudo crear el parámetro';
        }
    } else {
        $mal = 'Los datos esperados nunca llegaron';
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}