<?php
use Cartalyst\Sentinel\Roles\EloquentRole;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once E_LIB . 'class/class.upload.php';


//    nombres ---> Felipe
//    apellidos ---> López
//    correo ---> felipelopez@hotmail.com
//    telefonoMovil ---> 551588787
//    telefonoFijo ---> 545456569
//    cargo ---> gerente
//    empresa_id ---> Multipagos S.A.
//    sucursal_id ---> 47
//    rol ---> Administrador
//    resumen ---> sd fmsd fsd f
//    a ---> update
//    id ---> 27


try {

    /**
     *  Los siguientes datos son obligatorios
     */
    $usuId = isset_post('id');
    $usuNombres = isset_post('nombres');
    $usuApellidos = isset_post('apellidos');
    $usuCorreo = isset_post('correo');
    $usuSucursal = isset_post('sucursal_id');

    if ($usuId && $usuNombres && $usuApellidos && $usuCorreo && $usuSucursal)
    {
        $usuupd_usuario = Sentinel::findById($usuId);

        if ($usuupd_usuario)
        {
            if(filter_var($usuCorreo, FILTER_VALIDATE_EMAIL) != FALSE)
            {
                Capsule::beginTransaction();

                $usuupd_datos = [
                    'first_name' => $usuNombres,
                    'last_name' => $usuApellidos
                ];

                $usuupd_usuario = Sentinel::update($usuupd_usuario, $usuupd_datos);

                /**
                 * Rol a actualizar
                 */
                $rolUpd = isset_post("rol");

                if ($rolUpd) {

                    /**
                     * Primero le quito cualquier rol previo para luego añadirle el nuevo rol
                     */
                    $usuupd_roles = EloquentRole::all();
                    foreach ($usuupd_roles as $usuupd_role) {
                        if ($usuupd_usuario->inRole($usuupd_role->slug)) {
                            $usuupd_role->users()->detach($usuupd_usuario);
                        }
                    }

                    $usuupd_r = Sentinel::findRoleBySlug($rolUpd);

                    if ($usuupd_r) {
                        $usuupd_r->users()->attach($usuupd_usuario);
                    }
                    else
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "Ha sido imposible cambiar el rol de usuario";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }

                /**
                 *  Usuario a actualizar
                 */
                $usuupd_ext = UserExt::where('user_id', $usuupd_usuario->id)->first();

                if ($usuupd_ext)
                {
                    $usuupd_ext->telefono = isset_post('telefonoMovil');
                    $usuupd_ext->telefono2 = isset_post('telefonoFijo');
                    $usuupd_ext->resumen = isset_post('resumen');

                    /**
                     *      Si llego acá sin interrupciones entonces proceso la imagen de avatar
                     */
                    if (isset_file('avatar')) {
                        $usuupd_avatar = new Upload();
                        $usuupd_avatar->campo = 'avatar';
                        $usuupd_avatar->ruta = UserExt::carpeta();

                        if ($usuupd_avatar->cargaFile()) {
                            $usuupd_ext->avatar = $usuupd_avatar->nombre;
                        }
                    }

                    if ($usuupd_ext->save())
                    {
                        /**
                         *  Si logro actualizar el usuario, entonces paso a actualizar el contacto de la sucursal
                         */
                        $usuContEmpresa = $usuupd_ext->empresa_contacto();

                        $usuContEmpresa->nombre = $usuNombres;
                        $usuContEmpresa->apellido = $usuApellidos;
                        $usuContEmpresa->correo = $usuCorreo;
                        $usuContEmpresa->telefono_movil = $usuupd_ext->telefono;
                        $usuContEmpresa->telefono_fijo = $usuupd_ext->telefono2;
                        $usuContEmpresa->cargo = isset_post("cargo");
                        $usuContEmpresa->notas = $usuupd_ext->resumen;
                        $usuContEmpresa->sucursal_id = $usuSucursal;

                        if($usuContEmpresa->save())
                        {
                            Capsule::commit();
                            $_SESSION['mensajeSistema'] = "Usuario actualizado correctamente";
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                        else
                        {
                            Capsule::rollback();
                            $_SESSION['mensajeSistema'] = "Imposible actualizar datos de contacto";
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                    }
                    else
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "Ha sido imposible actualizar los datos extendidos";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }
            }
            else
            {
                $mal = 'El correo es incorrecto';
            }
        }
        else
        {
            $mal = 'El usuario seleccionado no existe';
        }
    }
    else
    {
        $mal = "faltan datos obligatorios, revise: nombre, apellido, correo y sucursal";
    }

	
} catch (Exception $e) {
    if ($e->getCode() == '23000')
    {
        $_SESSION['mensajeSistema'] = "Cooreo electrónico en uso";
    }  
    else
    {
        $_SESSION['mensajeSistema'] = 'Se produjo un error grave, inténtelo más tarde.';
    }

    header("Location:" . E_URL . E_VIEW);
    exit();
}	