<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once E_LIB . 'class/class.upload.php';

//    nombres ---> Miguel Angel
//    apellidos ---> Pulman García
//    correo ---> miky23@gmail.com
//    telefonoMovil ---> 54545454
//    telefonoFijo ---> 262626262
//    cargo ---> portero
//    empresa_id ---> Multipagos S.A.
//    sucursal_id ---> 47
//    rol ---> 2
//    resumen ---> ghfghfghfgh
//    a ---> new

/**
 * Guardo los resultados adquiridos
*/

try {
    /**
     * Leo las variables que han llegado
     */
    $new_user_nombres = isset_post('nombres');
    $new_user_apellidos = isset_post('apellidos');
    $new_user_correo = isset_post('correo');
    $new_user_telefono = isset_post('telefonoMovil');
    $new_user_telefono2 = isset_post('telefonoFijo');
    $new_user_resumen = isset_post('resumen');
    $new_user_rol = isset_post('rol');
    $new_user_sucursal = isset_post('sucursal_id');
    $new_user_cargo = isset_post('cargo');

    /**
     * Defino que valores son obligatorios
     */
    $postObligados = [
        "nombres" => "Se desconoce el nombre",
        "apellidos" => "Se desconoce el apellido",
        "correo" => "Se desconoce el correo",
        "rol" => "Se desconoce el rol",
        "sucursal_id" => "Se desconoce la sucursal"
    ];

    /**
     * Determino si falta alguno de los valores obligatorios
     */
    foreach ($postObligados as $pObId => $pObDato)
    {
        if(!isset_post($pObId))
        {
            $_SESSION['mensajeSistema'] = $pObDato;
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }

    /**
     *      Si llego acá sin interrupciones entonces proceso la imagen de avatar
     */
    if (isset_file('avatar')) {
        $usunew_avatar = new Upload();
        $usunew_avatar->campo = 'avatar';
        $usunew_avatar->ruta = UserExt::carpeta();
        if ($usunew_avatar->cargaFile()) {
            $new_user_avatar = $usunew_avatar->nombre;
        } else {
            $new_user_avatar = "";
        }
    }

    /**
     * Verificamos si el correo es válido
     */
    if (filter_var($new_user_correo, FILTER_VALIDATE_EMAIL))
    {
        /**
         * Iniciamos la transaccion
         */
        Capsule::beginTransaction();

        $new_user_credenciales = genUser($new_user_nombres, $new_user_apellidos);

        $datosNuevoUser = [
            "rol"=>$new_user_rol,
            "nombre"=>$new_user_nombres,
            "apellido"=>$new_user_apellidos,
            "correo"=>$new_user_credenciales["email"],
            "pass"=>$new_user_credenciales["password"],
            "nick"=>$new_user_credenciales["nick"],
            "telefono"=>$new_user_telefono,
            "telefono2"=>$new_user_telefono2,
            "notas"=>$new_user_resumen,
            "avatar"=>$new_user_avatar
        ];

        /**
         *  Creamos el nuevo usuario
         *  Esta función nos devuelve el Id del usuario
         */
        $nuevoUserExt = UserExt::setUser($datosNuevoUser);

        if ($nuevoUserExt)
        {
            $new_user_contacto = new EmpContacto();

            $new_user_contacto->sucursal_id = $new_user_sucursal;
            $new_user_contacto->user_id = $nuevoUserExt;
            $new_user_contacto->nombre = $new_user_nombres;
            $new_user_contacto->apellido = $new_user_apellidos;
            $new_user_contacto->correo = $new_user_correo;
            $new_user_contacto->telefono_movil = $new_user_telefono;
            $new_user_contacto->telefono_fijo = $new_user_telefono2;
            $new_user_contacto->cargo = $new_user_cargo;
            $new_user_contacto->notas = $new_user_resumen;

            if($new_user_contacto->save())
            {
                if(msgPass($new_user_nombres, $new_user_apellidos, $new_user_correo, $new_user_credenciales["nick"], $new_user_credenciales["password"]))
                {
                    /**
                     * El mensaje de sistema se genera dentro de msgPass
                     */
                    Capsule::commit();
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
                else
                {
                    /**
                     * El mensaje de sistema se genera dentro de msgPass
                     */
                    Capsule::rollback();
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
        }
        else
        {
            Capsule::rollback();
            $_SESSION['mensajeSistema'] = "Se produjo un error creando el contacto en la sucursal.";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }

    }
    else
    {
        $_SESSION['mensajeSistema'] = "El correo ingresado no parece válido";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }


} catch (Exception $e) {
    if ($e->getCode() == '23000')
    {
		Capsule::rollback();
        $_SESSION['mensajeSistema'] = "Correo electrónico ya está en el sistema.";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }

    Capsule::rollback();
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.";
    header("Location:" . E_URL . E_VIEW);
    exit();
}