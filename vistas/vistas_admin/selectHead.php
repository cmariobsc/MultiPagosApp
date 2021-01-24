<?php
use Cartalyst\Sentinel\Roles\EloquentRole;

try {

    $datosVista = Vista::findOrFail(isset_get('id'));

    if ($datosVista)
    {

        if(!empty($datosVista->menu))
        {
            $menuVista = json_decode($datosVista->menu);

            $menuVistaIcono = $menuVista[0];
            $menuVistaTitulo = $menuVista[1];
        }
        else
        {

            $menuVistaIcono = "";
            $menuVistaTitulo = "";
        }


        /**
         * ROLES DISPONIBLES
         */
        $ususel_roles = EloquentRole::all()->sortBy('slug');
        $permisosVista = json_decode($datosVista->permisos);


        $ususel_roles_html = '';

        foreach ($ususel_roles as $ususel_role)
        {
//            if(in_array($ususel_role->id, $permisosVista))
//            {
                $vChecked = in_array($ususel_role->id, $permisosVista) ? 'checked=""' : "";
 //           }

            if($ususel_role->slug == "Master")
            {
                if(check_acceso_rol("Master", false))
                {
                    $ususel_roles_html .= '<p>';
                    $ususel_roles_html .= '<label>';
                    $ususel_roles_html .= '<input type="checkbox" name="roles[]" value="' . $ususel_role->id . '" '.$vChecked.' />';
                    $ususel_roles_html .= '<span>' . $ususel_role->slug . '</span>';
                    $ususel_roles_html .= '</label>';
                    $ususel_roles_html .= '</p>';
                }
            }
            else
            {
                $ususel_roles_html .= '<p>';
                $ususel_roles_html .= '<label>';
                $ususel_roles_html .= '<input type="checkbox" name="roles[]" value="' . $ususel_role->id . '" '.$vChecked.' />';
                $ususel_roles_html .= '<span>' . $ususel_role->slug . '</span>';
                $ususel_roles_html .= '</label>';
                $ususel_roles_html .= '</p>';
            }
        }



    }
    else
    {
        $mal = 'La vista seleccionada no existe';
    }



} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}