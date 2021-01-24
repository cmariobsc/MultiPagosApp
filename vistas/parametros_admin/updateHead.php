<?php

try {
    if (isset_get('id')) {
        $parupd_param = Parametro::findOrFail(isset_get('id'));

        if ($parupd_param == null) {
            $mal = 'El parámetro seleccionado no existe';
        } else {
            if (isset_post('clave'))
                $parupd_param->clave = isset_post('clave');

            if (isset_post('valor'))
                $parupd_param->valor = isset_post('valor');

            if (isset_post('explica'))
                $parupd_param->explica = isset_post('explica');

            if ($parupd_param->save()) {
                $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
            else
            {
                $_SESSION['mensajeSistema'] = 'Se produjo un error actualizando el parámetro ' . $parupd_param->clave;
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = 'Se produjo un error grave, inténtelo más tarde.';
    header("Location:" . E_URL . E_VIEW);
    exit();
}