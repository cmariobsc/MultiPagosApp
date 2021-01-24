<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Email: elapez@gmail.com
 * Date: 1/12/2018
 * Time: 10:18 PM
 */

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Capsule\Manager as Capsule;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
//use Cartalyst\Sentinel\Roles\EloquentRole;



class UserExt extends Model
{
    protected $table = 'users_ext';
    protected $fillable = ['user_id', 'telefono', 'avatar', 'resumen', 'nick'];

    public function avatar()
    {
        return $this->avatar ? $this->avatar : 'user.jpg';
    }

    public function user()
    {
        return $this->belongsTo(EloquentUser::class, 'user_id')->first();
    }

    public function nombre_completo()
    {
        $user = $this->user();
        return ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
    }

    public function roles()
    {
        return $this->user()->getRoles();
    }

    public function role_id()
    {
        return $this->roles()->first()->id;
    }

    public function role_slug()
    {
        return $this->roles()->first()->slug;
    }

    /**
     * Asignamos al usuario actual un determinado rol
     */
    public function add_role($r)
    {
        /**
         * Traigo el ID del usuario actual
         */
        $u = $this->user_id;

        /**
         * Hago que Sentinel localice al usuario actual
         */
        $sentinelUser = Sentinel::findById($u);

        /**
         * Cargamos el modelo para el rol ingresado
         */
        $modelRol = Sentinel::findRoleById($r);

        /**
         * Asigno el usuario actual al modelo de rol
         */
        $modelRol->users()->attach($sentinelUser);
    }

    /**
     * Le quitamos al usuario todos los roles al que haya sido asignado
     */
    public function quit_roles()
    {
        /**
         * Traigo todos los roles y los convierto en un array
         */
        $roles = Sentinel::getRoleRepository()->pluck("slug","id")->toArray();

        /**
         * Traigo el ID del usuario actual
         */
        $u = $this->user_id;

        /**
         * Hago que Sentinel localice al usuario actual
         */
        $sentinelUser = Sentinel::findById($u);

        /**
         * Recorro el array de roles
         */
        foreach($roles as $pbrId=>$pbr)
        {
            /**
             * Pregunto en cada caso si el usuario ha sido asignado al rol
             * y en caso de haber sido asignado al rol, lo saco del mismo
             */
            if($sentinelUser->inRole($pbr))
            {
                /**
                 * Consigo el modelo de el rol actual
                 */
                $plebelloRoles = Sentinel::findRoleById($pbrId);

                /**
                 * Sustraigo el usuario seleccionado del modelo de rol
                 */
                $plebelloRoles->users()->detach($sentinelUser);
            }
        }
        return true;
    }

    public function empresa_contacto()
    {
        return $this->hasOne("EmpContacto", "user_id", "user_id")->first();
    }

    public function empresa_sucursal()
    {
        $sucursal_id = $this->empresa_contacto()->sucursal_id;
        return EmpSucursales::find($sucursal_id);
    }

    public function empresa()
    {
        if($this->role_slug() == "Master"):
            return Empresa::user_empresa($this->user_id);
        else:
            $empresaId = $this->empresa_sucursal()->empresa_id;
            return Empresa::find($empresaId);
        endif;
    }

    public function usuario_actual()
    {
        $user = '<a href="' . E_URL . 'perfil_admin" ' . altImg("Actualizar perfil personal") . ' >' .$this->nombre_completo()."</a><br />";
        return $user . $this->role_slug();
    }

    public function vista_inicio()
    {
        $vistaId =  VistaInicio::getVista($this->role_id());
        return Vista::find($vistaId)->nombre();
    }
	
	
	/** MÉTODOS ESTÁTICOS  */
	
    public static function carpeta()
    {
        return E_CONT_UPLOAD_DIR . 'avatars/';
    }

    public static function getUser($i="")
    {
        if(!empty($i))
        {
            $user = self::where("user_id", $i)->first();
            return !empty($user)? $user : null;
            //return EloquentUser::find($i);
        }
        else
        {
            return null;
        }
    }

    public static function setUser($u)
    {
        //$u = ["rol"=>"", "nombre"=>"", "apellido"=>"", "correo"=>"", "pass"=>"", "nick"=>"", "telefono"=>"", "telefono2"=>"", "avatar"=>"", "notas"=>""];
        $uRol = isset($u["rol"]) ? $u["rol"] : "Usuario";
        $retorno = false;

        /**
         * Pregunto si hay datos de contraseña
         */
        if(isset($u["pass"]))
        {
            /**
             * Si llega un valor para contraseña entonces necesitamos crear un usuario
             * Iniciamos verificamos si el correo es válido
             */
            if(!empty($u["correo"]))
            {
                if(filter_var($u["correo"], FILTER_VALIDATE_EMAIL))
                {
                    /**
                     *  Iniciamos la transacción
                     */
                    Capsule::beginTransaction();

                    /**
                     * Creamos el nuevo usuario
                     */
                    $userNew = Sentinel::registerAndActivate([
                        'first_name' => $u["nombre"],
                        'last_name' => $u["apellido"],
                        'email' => $u["correo"],
                        'password' => $u["pass"]
                    ]);

                    if ($userNew)
                    {
                        $userNewRol = Sentinel::findRoleBySlug($uRol);
                        if ($userNewRol)
                        {
                            $userNewRol->users()->attach($userNew);
                        }

                        /**
                         * Se crearán los datos extras del usuario
                         */
                        $userNewExt = new UserExt();

                        $userNewExt->user_id = $userNew->id;
                        $userNewExt->nick = isset($u["nick"]) ? $u["nick"] : null;
                        $userNewExt->telefono = isset($u["telefono"]) ? $u["telefono"] : null;
                        $userNewExt->telefono2 = isset($u["telefono2"]) ? $u["telefono2"] : null;
                        $userNewExt->avatar = isset($u["avatar"]) ? $u["avatar"] : null;
                        $userNewExt->resumen = isset($u["notas"]) ? $u["notas"] : null;

                        if ($userNewExt->save())
                        {
                            $_SESSION['mensajeSistema'] = ["Usuario creado exitosamente"];
                            Capsule::commit();
                            $retorno = $userNew->id;
                        }
                        else
                        {
                            Capsule::rollback();
                            $_SESSION['mensajeSistema'] = "Cliente creado, no obstante ocurrió un problema creando los datos extras.";
                            $retorno = false;
                        }
                    }
                    else
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "Cliente creado, no obstante el usuario no pudo crearse";
                        $retorno = false;
                    }
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "El correo ingresado, no parece válido";
                    $retorno = false;
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Se desconoce el correo del nuevo usuario";
                $retorno = false;
            }
        }
        return $retorno;
    }

}


class VistaInicio extends Model
{
    protected $table = 'vistas_inicio';
    protected $primaryKey = 'role_id';

    public static function getVista($rol)
    {
        $rol = self::find($rol);
        if($rol)
        {
            return $rol->vista_id;
        }
        else
        {
            return "";
        }
    }

    public static  function setVista($role_id,$vista_id)
    {
        $rol = self::find($role_id);
        if($rol)
        {
            $rol->vista_id = $vista_id;
            if($rol->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            /**
             * Si no se encuentra el role correspondiente, entonces hay que crearlo
             */
            $r = new self();
            $r->role_id = $role_id;
            $r->vista_id = $vista_id;

            if($r->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
}