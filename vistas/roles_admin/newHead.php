<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;



try {
    $nombreRol = isset_post('nombre');
    $slugRol = isset_post('slug');
    $vistaRol = isset_post('vista');

    if ($nombreRol && $slugRol && $vistaRol) {

        Capsule::beginTransaction();

        $roldel_role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $nombreRol,
            'slug' => $slugRol,
        ]);
        if ($roldel_role)
        {
            $vistaInicial = new VistaInicio();

            $vistaInicial->role_id = $roldel_role->id;
            $vistaInicial->vista_id = $vistaRol;

            if($vistaInicial->save())
            {
                Capsule::commit();
                $_SESSION['mensajeSistema'] = "Rol creado correctamente";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
            else
            {
                Capsule::rollback();
                $_SESSION['mensajeSistema'] = 'Se produjo un error creando el rol ' . $_POST['nombre'];
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            Capsule::rollback();
            $_SESSION['mensajeSistema'] = 'Se produjo un error creando el rol ' . $_POST['nombre'];
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    } else {
        $mal = "Los datos no llegaron";
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}