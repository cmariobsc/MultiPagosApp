<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;

try {
    $modelId = isset_get('id');
    if ($modelId) {
        $rolsel_rol = Sentinel::getRoleRepository()->findById($modelId);
        if ($rolsel_rol)
        {
            $vistaInicio = VistaInicio::getVista($rolsel_rol->id);
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El rol seleccionado no existe o no es correcto";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Los datos no llegaron";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde." . $e;
    header("Location:" . E_URL . E_VIEW);
    exit();
}