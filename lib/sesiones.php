<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * email: elapez@gmail.com
 * Date: 1/12/2018
 * Time: 11:35 PM
 */
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\EloquentRole;


//require_once E_VISTAS . "clientes_admin" . DS . "models.php";
//require_once E_VISTAS . "bancos_admin" . DS . "models.php";


/**
 * VERIFICAR CIERRE DE SESSIÓN
 */
if(isset($_REQUEST['out']))
{
    Sentinel::logout(null, true);
    header("Location:" . E_INDEX_PUBLIC);
    exit();
}

/**
 * VERIFICAR SESION ACTIVA
 */
$usuario = Sentinel::check();

if($usuario)
{
    $uExt = UserExt::getUser($usuario->id);

    $uRoles = $uExt->roles();
    $uRol = $uRoles->first();
    $uRolNombre = $uRol->slug;
    $uRolId = $uRol->id;

    $uEmpresa = $uExt->empresa();

    $uEmpresaContacto = $uExt->empresa_contacto();


    $allRoles = EloquentRole::all();

    foreach($allRoles as $ar)
    {
        if($usuario->inRole($ar->slug))
        {
            // encontramos el role_id
            //$userTipo = $uExt->role_id();
            $userTipo = $ar->id;

            define("E_INDEX", $uExt->vista_inicio($userTipo));
        }
    }

    unset($ar);

}
else
{
    $uExt = $uRoles = NULL;
    $userTipo = 4; // 4 es el visitante público ... no es en sí mismo un usuario
    define("E_INDEX", E_INDEX_PUBLIC);
}


/**
 * @param $roles
 * @param bool $redirect
 * @return bool
 *
 * Devuelve un boleano o produce un salto a la vista de inicio
 */
function check_acceso_rol($roles, $redirect = true)
{
    $found = false;
    if (is_array($roles)) {
        foreach ($roles as $role) {
            if (Sentinel::check()->inRole($role)) {
                $found = true;
                break;
            }
        }
    } else {
        if (Sentinel::check()->inRole($roles)) {
            $found = true;
        }
    }

    if (!$found && $redirect) {
        header("Location:" . E_INDEX);
    }

    return $found;
}

/**
 * @return mixed
 *
 * Muestra mensaje aleatorio de negación de acceso a un usuario
 */
function accesoNo()
{
    $opciones = [
        "No puedes entrar a esta zona",
        "No tienes permiso para acceder a este contenido",
        "Esta es un área restringida, y no tienes acceso",
        "Vaya, la verdad no pareces estar invitado, no podrás entrar",
        "No te dejaré pasar!",
        "Habla con alguien que te entre a esta zona, yo no puedo",
        "Si si si... Puedes seguir intentando, no te dejaré entrar",
        "Tus credenciales no te dan acceso a este lugar",
        "Que no, que no, prueba en otro momento, por ahora no puedes entrar",
        "Zona restringida, no puede entrar",
        "En algunos lugares con un par de monedas lograrías entrar, ¡Este no es uno de ellos!",
        "No puedo creer que pensarás ver esa página, que pena, ¡No puedes!",
        "Acceso restringido, :-(",
        "Oh ... tal vez cuando crezcas te dejaremos entrar"
    ];

    $select = array_rand($opciones);
    return $opciones[$select];
}

/**
 * @param string $msg
 * @param string $destino
 *
 * Redirije la navegación y muestra un mensaje en la vista a cargar
 */
function redir($msg = "", $destino = "", $predeterminado = "acceso")
{

    if(empty($msg))
    {
        switch($predeterminado)
        {
            case "exito":
                $_SESSION['mensajeSistema'] = salioBien();
                break;
            case "error":
                $_SESSION['mensajeSistema'] = salioMal("Ha ocurrido un error", 1);
                break;
            default:
                // acceso
                $_SESSION['mensajeSistema'] = accesoNo();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = $msg;
    }


    if(empty($destino))
    {
        header("Location:" . E_URL . E_INDEX);
    }
    else
    {
        header("Location:" . E_URL . $destino);
    }


    exit();
}

