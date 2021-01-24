<?php
use Cartalyst\Sentinel\Roles\EloquentRole;

try {
    $roldef_roles = EloquentRole::all()->sortBy('slug');
    $ususel_roles_html = '';
    if (count($roldef_roles)) {
        foreach ($roldef_roles as $roldef_role) {

            //botón de borrado
            $roldef_bti1 = $b->blk("delete", ["class" => "material-icons red-text", "i"]);
            $roldef_bt1 = $b->blk($roldef_bti1, ["class" => "secondary-content", "href" => E_VIEW . "?a=delete&id=" . $roldef_role->id], "a");

            // botón de edición
            $roldef_bti2 = $b->blk("mode_edit", ["class" => "material-icons blue-text", "i"]);
            $roldef_bt2 = $b->blk($roldef_bti2, ["class" => "secondary-content", "href" => E_VIEW . "?a=select&id=" . $roldef_role->id], "a");

            // fila
            $ususel_roles_html .= '<li class="collection-item">';
            $ususel_roles_html .=   '<div class="row">';
            $ususel_roles_html .=       '<div class="noDiv col6 letra2">' . $roldef_role->slug . '</div>';
            $ususel_roles_html .=       '<div class="noDiv col6">' . $roldef_role->name . '</div>';
            $ususel_roles_html .=       '<div class="noDiv col4">' . $roldef_bt1 . $roldef_bt2 . '</div>';
            $ususel_roles_html .=   '</div>';
            $ususel_roles_html .= '</li>';

        }
        unset($roldef_bti1, $roldef_bt1, $roldef_bti2, $roldef_bt2);
    } else {
        $ususel_roles_html = '<li class="collection-item"><span class="red-text">Aún no existe ningún rol</span></li>';
    }

    $listaPaginas = mat_select_list("Vista");
    
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}