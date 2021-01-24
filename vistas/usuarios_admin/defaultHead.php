<?php
use Cartalyst\Sentinel\Users\EloquentUser;
use Cartalyst\Sentinel\Roles\EloquentRole;

try {

//    $usudef_roles = EloquentRole::all()->sortBy('slug');
//    $usudef_roles_html = '';
//    foreach ($usudef_roles as $usudef_role)
//    {
//        if($usudef_role->slug == "Master")
//        {
//            if(check_acceso_rol("Master", false))
//            {
//                $usudef_roles_html .= '<p>';
//                $usudef_roles_html .= '<label>';
//                //$usudef_roles_html .= '<input type="checkbox" name="roles[]" value="' . $usudef_role->id . '"  />';
//                $usudef_roles_html .= '<input class="with-gap" name="rol" type="radio" />';
//                $usudef_roles_html .= '<span>' . $usudef_role->slug . '</span>';
//                $usudef_roles_html .= '</label>';
//                $usudef_roles_html .= '</p>';
//            }
//        }
//        else
//        {
//            $usudef_roles_html .= '<p>';
//            $usudef_roles_html .= '<label>';
//            //$usudef_roles_html .= '<input type="checkbox" name="roles[]" value="' . $usudef_role->id . '" />';
//            $usudef_roles_html .= '<input class="with-gap" name="rol" type="radio"  />';
//            $usudef_roles_html .= '<span>' . $usudef_role->slug . '</span>';
//            $usudef_roles_html .= '</label>';
//            $usudef_roles_html .= '</p>';
//        }
//    }

    /**
     * Listado general de usuarios que luego voy a recorrer
     */
    $listaGeneralUsuariosActuales = EloquentUser::all()->sortBy('first_name');

    /**
     * Inicializo la lista de usuarios
     */
    $listaUsuarios_html = "";

    /**
     * Creo el listado de empresas
     * Si es Master las lista todas de lo contrario lista sólo los de su propia empresa
     */
    foreach($listaGeneralUsuariosActuales as $LGUA)
    {
        $userTemp = UserExt::getUser($LGUA->id);
        $userTempNombreCompleto = $userTemp->nombre_completo();
        $userTempEmpresa = $userTemp->empresa();
        $userTempSucursal = $userTemp->empresa_sucursal();
        $userTempRol = $userTemp->role_slug();

        /**
         * Botón de borrar usuario
         */
        $listaUsuarioActualBorra = $b->blk("delete", ["class" => "material-icons red-text"], "i");
        $listaUsuarioActualBorra = $b->blk($listaUsuarioActualBorra, ["onclick"=>"borrarUsuario(".$userTemp->user_id.",'".$userTempNombreCompleto."')"], "a");
        $listaUsuarioActualBorra = $b->blk($listaUsuarioActualBorra, ["class"=>"col s1"]);

        /**
         * Botón de editar usuario
         */
        $listaUsuarioActualEdita = $b->blk("mode_edit", ["class" => "material-icons blue-text"], "i");
        $listaUsuarioActualEdita = $b->blk($listaUsuarioActualEdita, ["href"=>E_URL . E_VIEW."?a=select&id=".$userTemp->user_id], "a");
        $listaUsuarioActualEdita = $b->blk($listaUsuarioActualEdita, ["class"=>"col s1"]);

        /**
         * Nombre del usuario
         */
        $nombreUsuario = $b->blk($userTempNombreCompleto, ["href"=>E_URL . E_VIEW."?a=select&id=".$userTemp->user_id, "class"=>"oscuro"], "a");
        $nombreUsuario = $b->blk($nombreUsuario . ' <small><i>(' . $userTempRol . " - "  . $userTempEmpresa->nombre . ')</i></small>', ["class"=>"col s10 m4 mAbajo10"]);

        if($uRolNombre == "Master")
        {
            $listaEmpresaNewUser = mat_select("Empresa", "empresa_id", mat_slist("Empresa"), "col s12 l6");
            $listaSucursalNewUser = mat_select("Sucursal", "sucursal_id", mat_slist("EmpSucursales"), "col s12 l6");

            /**
             * Unimos toda la fila
             */
            $listaUsuarios_html .= $b->blk($listaUsuarioActualBorra . $listaUsuarioActualEdita . $nombreUsuario, ["class"=>"row bordeAbajo"]);

            /**
             * Roles visibles para el Master
             */
            $usudef_roles_html = mat_radio("Master", "rol", "Master", "", "with-gap", "");
            $usudef_roles_html .= mat_radio("Administrador", "rol", "Administrador", "", "with-gap", "");
            $usudef_roles_html .= mat_radio("UsuarioAdmin", "rol", "UsuarioAdmin", "", "with-gap", "");
            $usudef_roles_html .= mat_radio("Usuario", "rol", "Usuario", "", "with-gap", "1");
            $usudef_roles_html .= mat_radio("Publico", "rol", "Publico", "", "with-gap", "");
        }
        else
        {
            if($uEmpresa->id == $userTempEmpresa->id)
            {
                switch ($uRolNombre)
                {
                    case "Administrador":
                        $listaEmpresaNewUser = mat_input("Empresa", "empresa_id", ["envoltura"=>"col s12 l6", "value"=>$uEmpresa->nombre, "readonly"=>""]);
                        $listaSucursalNewUser = mat_select("Sucursal", "sucursal_id", mat_slist("EmpSucursales", ["w"=>[["empresa_id",$uEmpresa->id]]]), "col s12 l6");
                        $listaUsuarios_html .= $b->blk($listaUsuarioActualBorra . $listaUsuarioActualEdita . $nombreUsuario, ["class"=>"row bordeAbajo"]);

                        /**
                         * Roles visibles para el Administrador
                         */
                        $usudef_roles_html = mat_radio("Administrador", "rol", "Administrador", "", "with-gap", "1");
                        //$usudef_roles_html .= mat_radio("UsuarioAdmin", "rol", "UsuarioAdmin");
                        //$usudef_roles_html .= mat_radio("Usuario", "rol", "Usuario");
                        //$usudef_roles_html .= mat_radio("Publico", "rol", "Publico");

                        break;
                    case "UsuarioAdmin":
                        $listaEmpresaNewUser = mat_input("Empresa", "empresa_id", ["envoltura"=>"col s12 l6", "value"=>$uEmpresa->nombre, "readonly"=>""]);
                        $listaSucursalNewUser = mat_select("Sucursal", "sucursal_id", [$uExt->empresa_sucursal()->id => $uExt->empresa_sucursal()->nombre], "col s12 l3", $uExt->empresa_sucursal()->id);
                        if($uExt->empresa_sucursal()->id == $userTempSucursal->id)
                        {
                            $listaUsuarios_html .= $b->blk($listaUsuarioActualBorra . $listaUsuarioActualEdita . $nombreUsuario, ["class"=>"row bordeAbajo"]);
                        }

                        /**
                         * Roles visibles para el UsuarioAdmin
                         */
                        $usudef_roles_html = mat_radio("UsuarioAdmin", "rol", "UsuarioAdmin");
                        $usudef_roles_html .= mat_radio("Usuario", "rol", "Usuario", "", "with-gap", "1");
                        //$usudef_roles_html .= mat_radio("Publico", "rol", "Publico");

                        break;
                    case "Usuario":
                        $listaEmpresaNewUser = mat_input("Empresa", "empresa_id", ["envoltura"=>"col s12 l6", "value"=>$uEmpresa->nombre, "readonly"=>""]);
                        $listaSucursalNewUser = mat_select("Sucursal", "sucursal_id", [$uExt->empresa_sucursal()->id => $uExt->empresa_sucursal()->nombre], "col s12 l3", $uExt->empresa_sucursal()->id);
                        if($uExt->user_id == $userTemp->id)
                        {
                            $listaUsuarios_html .= $b->blk($listaUsuarioActualBorra . $listaUsuarioActualEdita . $nombreUsuario, ["class"=>"row bordeAbajo"]);
                        }
                        /**
                         * Roles visibles para el Usuario
                         */
                        $usudef_roles_html = mat_radio("Usuario", "rol", "Usuario", "", "with-gap", "1");
                        break;
                    default:
                        //Publico
                        //El público no puede entrar aquí
                        exit();
                }

            }
        }

    }

    /**
     *  Si no se reistraron usuarios, declaro que no existen usuarios
     */
    if (empty($listaUsuarios_html))
    {
        $listaUsuarios_html = '<div class="eInt mAA10 esquina10"><p class="cen red-text">Aún no existe ningún usuario</p></div>';
    }

} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}




