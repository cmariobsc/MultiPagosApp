<?php
use Cartalyst\Sentinel\Roles\EloquentRole;


try {


    /**
     *  VISTAS ACTUALES
     */
    $visdef_actuales = Vista::all()->sortBy('nombre');

    $visdef_show = '<ul class="collection with-header">';

    if (count($visdef_actuales))
    {
        foreach ($visdef_actuales as $visdef_vista)
        {
            $visdef_show .= '<li class="collection-item">';
            $visdef_show .= '<div>';
            $visdef_show .= '<a href="?a=select&id=' . $visdef_vista->id . '" >' . $visdef_vista->nombre() . '</a>';
            $visdef_show .= '<br /><small class="letra1 tipo4">' . implode(", ", $visdef_vista->autorizados()) . '</small>';
            $visdef_show .= '<a href="?a=delete&id=' . $visdef_vista->id . '" class="secondary-content">';
            $visdef_show .= '<i class="material-icons red-text">delete</i>';
            $visdef_show .= '</a>';
            $visdef_show .= '<a href="?a=select&id=' . $visdef_vista->id . '" class="secondary-content">';
            $visdef_show .= '<i class="material-icons blue-text">mode_edit</i>';
            $visdef_show .= '</a>';
            if($visdef_vista->is_public()):
                $visdef_show .= '<a href="?a=local&id=' . $visdef_vista->id . '" class="secondary-content">';
                $visdef_show .= '<i class="material-icons green-text">g_translate</i>';
                $visdef_show .= '</a>';
            endif;
            $visdef_show .= '</div>';
            $visdef_show .= '</li>';
        }
        unset($bti1, $bt1, $bti2, $bt2);
    }
    else
    {
        $visdef_show .= '<li class="collection-item noVin"><div class="red-text">Aún no existen vistas disponible</div></li>';
    }
    $visdef_show .= '</ul>';





    /**
     * ROLES DISPONIBLES
     */
    $ususel_roles = EloquentRole::all()->sortBy('slug');


    $ususel_roles_html = '';

    foreach ($ususel_roles as $ususel_role)
    {

        if($ususel_role->slug == "Master")
        {
            if(check_acceso_rol("Master", false))
            {
                $ususel_roles_html .= '<p>';
                $ususel_roles_html .= '<label>';
                $ususel_roles_html .= '<input type="checkbox" name="roles[]" value="' . $ususel_role->id . '" />';
                $ususel_roles_html .= '<span>' . $ususel_role->slug . '</span>';
                $ususel_roles_html .= '</label>';
                $ususel_roles_html .= '</p>';
            }
        }
        else
        {
            $ususel_roles_html .= '<p>';
            $ususel_roles_html .= '<label>';
            $ususel_roles_html .= '<input type="checkbox" name="roles[]" value="' . $ususel_role->id . '" />';
            $ususel_roles_html .= '<span>' . $ususel_role->slug . '</span>';
            $ususel_roles_html .= '</label>';
            $ususel_roles_html .= '</p>';
        }
    }


} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}