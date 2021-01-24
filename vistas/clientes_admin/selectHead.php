
<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 10/4/2019
 * Time: 10:12
 * Proyecto: lx_cotizador.eqadoor.com
 */
use Cartalyst\Sentinel\Roles\EloquentRole;

try{
    //$clienteId = isset_request("cliente");
    $clienteId = isset_post("cliente");
    if($clienteId)
    {
        $cliente = Empresa::find($clienteId);

        if($cliente)
        {
            $clienteDatos = $cliente->datos();
            $clienteComercial = $cliente->comercial();
            //$clienteRedesSociales = $cliente->redesSociales();
            //$sucursales = $cliente->sucursales();
            $sucursales = $cliente->sucursalesFull();
            $cantidadSedes = $sucursales->count();
            $chequed = empty($cliente->estado) ? 0 : 1;

            $siCredito = isset($clienteComercial->credito) ? $clienteComercial->credito : "";

            $empTipos = EmpTipos::all();
            $empTipoVal = $clienteComercial->tipo();
            $eTipo = "";
            if($empTipoVal)
            {
                foreach($empTipos as $empTipo)
                {
                    $checkedRadio = $empTipoVal->id == $empTipo->id ? 1 : "";
                    $eTipo .= mat_radio($empTipo->nombre, "empresaTipo", $empTipo->id, "", "with-gap", $checkedRadio);
                }
            }
            else
            {
                foreach($empTipos as $empTipo)
                {
                    $eTipo .= mat_radio($empTipo->nombre, "empresaTipo", $empTipo->id, "", "with-gap", "");
                }
            }


            switch($clienteDatos->rucTipo)
            {
                case "R":
                    $radioR = 1;
                    $radioC = 0;
                    $radioP = 0;
                    break;
                case "C":
                    $radioR = 0;
                    $radioC = 1;
                    $radioP = 0;
                    break;
                case "P":
                    $radioR = 0;
                    $radioC = 0;
                    $radioP = 1;
                    break;
                default:
                    $radioR = 1;
                    $radioC = 0;
                    $radioP = 0;
            }


            $usudef_roles = EloquentRole::all()->sortBy('slug');
            $usudef_roles_html = '';
            $listaRoles = [];
            $objRoles = "{";
            foreach ($usudef_roles as $usudef_role)
            {
                /**
                 * Si el rol a incluir es Master y el usuario activo es Master: Lo muestro
                 */
                if($usudef_role->slug == "Master" || $usudef_role->slug == "Administrador")
                {
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
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El cliente no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el cliente";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />".$e; //
    header("Location:" . E_URL . E_VIEW);
    exit();
}