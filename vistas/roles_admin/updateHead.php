<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;


try {
    $idRol = isset_post('id');
    $nombreRol = isset_post('nombre');
    $slugRol = isset_post('slug');
    $vistaRol = isset_post('vista');
    if ($idRol && $nombreRol && $slugRol && $vistaRol)
    {
        $rolupd_role = Sentinel::getRoleRepository()->findById($idRol);

        if ($rolupd_role)
        {
            Capsule::beginTransaction();

            $rolupd_role->name = $nombreRol;
            $rolupd_role->slug = $slugRol;

            if ($rolupd_role->save())
            {
                if(VistaInicio::setVista($idRol,$vistaRol))
                {
                    Capsule::commit();
                    $_SESSION['mensajeSistema'] = "Rol actualizado correctamente";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
                else
                {
                    Capsule::rollback();
                    $_SESSION['mensajeSistema'] = "Imposible actualizar el rol";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                Capsule::rollback();
                $_SESSION['mensajeSistema'] = 'Se produjo un error actualizando el rol ' . $slugRol;
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El rol seleccionado no existe";
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
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.";
    header("Location:" . E_URL . E_VIEW);
    exit();
}