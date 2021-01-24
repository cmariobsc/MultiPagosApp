<?php
use Cartalyst\Sentinel\Roles\EloquentRole;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

try {
    $ususelUsId = isset_get('id', 1);
    if ($ususelUsId)
    {
        $ususel_usuario = Sentinel::findById($_GET['id']);

        $ususel_ext = UserExt::where('user_id', $ususel_usuario->id)->first();

        $ususel_roles = EloquentRole::all()->sortBy('slug');

        $ususel_roles_html = '';

        if($uRolNombre == "Master")
        {
            $listaEmpresaNewUser = mat_select("Empresa", "empresa_id", mat_slist("Empresa"), "col s12 l6");
            $listaSucursalNewUser = mat_select("Sucursal", "sucursal_id", mat_slist("EmpSucursales"), "col s12 l6", $ususel_ext->empresa_sucursal()->id);

            /**
             * Roles visibles para el Master
             */
            $usudef_roles_html = "";
            foreach($ususel_roles as $uRol)
            {
                if($ususel_ext->role_slug() == $uRol->slug)
                {
                    $usudef_roles_html .= mat_radio($uRol->slug, "rol", $uRol->slug, "", "with-gap", "1");
                }
                else
                {
                    $usudef_roles_html .= mat_radio($uRol->slug, "rol", $uRol->slug);
                }
            }
        }
        else
        {
            if($uEmpresa->id == $ususel_ext->empresa()->id)
            {
                switch ($uRolNombre)
                {
                    case "Administrador":
                        $listaEmpresaNewUser = mat_input("Empresa", "empresa_id", ["envoltura"=>"col s12 l6", "value"=>$uEmpresa->nombre, "readonly"=>""]);
                        $listaSucursalNewUser = mat_select("Sucursal", "sucursal_id", mat_slist("EmpSucursales", ["w"=>[["empresa_id",$uEmpresa->id]]]), "col s12 l6", $ususel_ext->empresa_sucursal()->id);
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
                        /**
                         * Roles visibles para el UsuarioAdmin
                         */
                        $usudef_roles_html = mat_radio("UsuarioAdmin", "rol", "UsuarioAdmin");
                        $usudef_roles_html .= mat_radio("Usuario", "rol", "Usuario");
                        //$usudef_roles_html .= mat_radio("Publico", "rol", "Publico");

                        break;
                    case "Usuario":
                        $listaEmpresaNewUser = mat_input("Empresa", "empresa_id", ["envoltura"=>"col s12 l6", "value"=>$uEmpresa->nombre, "readonly"=>""]);
                        $listaSucursalNewUser = mat_select("Sucursal", "sucursal_id", [$uExt->empresa_sucursal()->id => $uExt->empresa_sucursal()->nombre], "col s12 l3", $uExt->empresa_sucursal()->id);
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
    else
    {
        $mal = "Los datos no llegaron";
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}