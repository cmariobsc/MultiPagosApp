<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 20/4/2019
 * Time: 8:23
 * Proyecto: lx_cotizador.eqadoor.com
 */
use Cartalyst\Sentinel\Roles\EloquentRole;


/**
 * Usuario a cargo de esta empresa-cliente
 */
if($uExt->role_slug() == "Master"):
    $propio = Empresa::where("user_id", $usuario->id)->first();
else:
    $eMio = EmpContacto::where("user_id", $usuario->id)->first();
    $propio = $eMio->empresa();
endif;
$clientesPropios = count($propio) > 0 ? $propio->hijos() : "";

$usudef_roles = EloquentRole::all()->sortBy('slug');
$usudef_roles_html = '';
$listaRoles = [];
$objRoles = "{";
foreach ($usudef_roles as $usudef_role)
{
    if($usudef_role->slug == "Master" || $usudef_role->slug == "Administrador")
    {
        /**
         * Si el rol a incluir es Master y el usuario activo es Master: Lo muestro
         */
        if(check_acceso_rol("Master", false))
        {
            $usudef_roles_html .= mat_radio($usudef_role->slug, "rol[]", $usudef_role->id);
            $listaRoles[$usudef_role->id] = $usudef_role->slug;
            $objRoles .= $listaRoles[$usudef_role->id] . ': "' . $usudef_role->slug . '",';
        }
    }
    else
    {
        if($usudef_role->slug == "Usuario" || $usudef_role->slug == "UsuarioAdmin")
        {
            $usudef_roles_html .= mat_radio($usudef_role->slug, "rol[]", $usudef_role->id);
            $listaRoles[$usudef_role->id] = $usudef_role->slug;
            $objRoles .= $listaRoles[$usudef_role->id] . ': "' . $usudef_role->slug . '",';
        }
    }
}
$objRoles .= "}";
$empTipos = EmpTipos::all();
$eTipo = "";
foreach($empTipos as $empTipo)
{
    $checkedRadio = empty($eTipo) ? 1 : "";
    $eTipo .= mat_radio($empTipo->nombre, "empresaTipo", $empTipo->id, "", "with-gap", $checkedRadio);
}
