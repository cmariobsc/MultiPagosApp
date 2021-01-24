<?php //creado auntomáticamente desde localhost

use Cartalyst\Sentinel\Users\EloquentUser;
//use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;


//--------------------------------------------------------------------

class Empresa extends Model
{
	protected $table = 'empresas';
	//protected $primaryKey = 'id';
	//protected $fillable = ['nombre','descripcion'];
	//public $timestamps = false;

    /**
     * Devuelve las sucursales de la empresa
     * en un modelo completo con ->get()
     */
    public function sucursalesFull()
    {
        return $this->hasMany("EmpSucursales", "empresa_id")->get();
    }

    /**
     * Devuelve las sucursales de la empresa
     * en un array con ->toArray()
     */
    public function sucursales()
    {
        return $this->sucursalesFull()->pluck("nombre", "id")->toArray();
    }

    /**
     * Devuelve las personas de contacto registradas
     * para cada una de las sucursales de la empresa
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function contactos($sede = 0)
    {
        return empty($sede) ? EmpSucursales::st_contactos($this->id) : EmpSucursales::find($sede)->contactos();
    }

    /**Devuelve los datos asociados a esta empresa
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function datos()
    {
        return $this->hasOne("EmpDatos")->first();
    }

    public function comercial()
    {
        return $this->hasOne("EmpComercial")->first();
    }

    /**
     * Devuelve las redes sociales asociadas a esta empresa
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function redesSociales()
    {
        return $this->hasMany("EmpRedesSociales", "empresa_id")->get();
    }

    public function marcas()
    {
        return $this->hasMany("EmpMarcas", "empresa_id")->get();
    }

    /**
     * Devuelve los datos de usuario REGISTRADO al que pertenece esta empresa
     * puede darse el caso que la empresa no tenga un usuario asociado
     * en dicho caso el valor devuelto será NULL
     */
    public function usuario()
    {
        $usr = $this->user_id;
        if(!empty($usr))
        {
            return UserExt::getUser($usr);
        }
        else
        {
            return null;
        }
    }

    /**
     * Devuelve la empresa de la que se es cliente
     */
    public function padre()
    {
        $padre = $this->padre;
        //return $this->hasOne("Empresa", "padre", "id")->get();
        //return UserExt::where("user_id", $padre)->first();
        return Empresa::find($padre);
    }

    /**
     * Devuelve los clientes del modelo actual - la coleccion completa
     */
    public function hijosFull()
    {
        $padre = $this->id;
        return Empresa::where("padre", $padre)->get();
    }

    /**
     * Devuelve los clientes del modelo actual - en un array simple id => nombre
     */
    public function hijos()
    {
        return $this->hijosFull()->pluck("nombre", "id")->toArray();
    }

    /**
     * Devuelve el nombre del archivo registrado como logo para la empresa
     * @return mixed|string
     */
    public function logo()
    {
        return $this->imagen ? $this->imagen : 'nofoto.png';
    }

    /**
     * Devuelve las alertas existentes para la empresa actual
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function alertas()
    {
        return $this->hasMany("EmpAlerta", "empresa_id")->get();
    }

    /**
     * Devuelve colexión (de un sólo elemento porque los códigos son indices únicos)
     * si el código por el que se pregunta existe en la tabla EmpServicios
     * @param $codigoServicio
     * @return mixed
     */
    public function siServicio($codigoServicio)
    {
        // El final tiene que ser get porque probamos con first y no devuelve
        // valores que fx perfil pueda usar
        return EmpServicios::where("codigo",$codigoServicio)->get();
    }

    /**
     * Devuelve un perfil (el primero que coincida) según el tipo de empresa y el tipo de servicio
     * @param $codigoServicio
     * @return bool
     */
    public function perfil($codigoServicio)
    {
        $codServicio = $this->siServicio($codigoServicio)->pluck("id")->first();

        if($codServicio)
        {
            $serviciosAutorizados = $this->comercial()->tipo()->perfiles()->pluck("servicio_id")->toArray();

            if(in_array($codServicio, $serviciosAutorizados))
            {
                $tipoComercial = $this->comercial()->tipo()->id;
                return EmpPerfiles::where([["tipo_id", $tipoComercial],["servicio_id", $codServicio]])->first();
            }

            return false;
        }
        else
        {
            return false;
        }
    }



    /**
     *          Métodos estáticos
     */

    public static function carpeta()
    {
        return E_CONT_UPLOAD_DIR . 'empresas/';
    }

    public static function user_empresa($u)
    {
        return self::where("user_id", $u)->first();
    }

}

class EmpContacto extends Model
{
    protected $table = "empresas_contactos";
    protected $fillable = ["sucursal_id", "user_id", "nombre", "apellido", "correo", "telefono_fijo", "telefono_movil", "cargo", "nick", "avatar", "notas"];

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

    public function rol()
    {
        return $this->roles()->first();
    }

    public function role_id()
    {
        return $this->rol()->id;
    }

    public function role_slug()
    {
        return $this->rol()->slug;
    }

    public function usuario_actual($a=1)
    {
        return empty($a) ?
            $this->nombre_completo() . "<br />" . $this->role_slug() :
            $this->nombre_completo() . " (" . $this->role_slug() . ")";
    }

    public function vista_inicio()
    {
        $vistaId =  VistaInicio::getVista($this->role_id());
        return Vista::find($vistaId)->nombre();
    }

    public function sede()
    {
        return $this->belongsTo("EmpSucursales", "sucursal_id")->first();
    }

    public function sedeNombre()
    {
        return $this->sede()->nombre;
    }

    public function empresa()
    {
        $sede = $this->sede();
        return $sede->belongsTo("Empresa", "empresa_id")->first();
    }

    public function empresaNombre()
    {
        return $this->empresa()->nombre;
    }


    /** MÉTODOS ESTÁTICOS  */

    public static function carpeta()
    {
        return E_CONT_UPLOAD_DIR . 'avatars/';
    }

    public static function get_user($i="")
    {
        if(!empty($i))
        {
            $user = self::where("user_id", $i)->first();
            return !empty($user)? $user : null;
        }
        return null;
    }

    public static function set_user($u)
    {
        //$u = ["rol", "nombre", "apellido", "correo", "pass"];
        $uRol = isset($u["rol"]) ? $u["rol"] : "Usuario";

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
                            $_SESSION['mensajeSistema'] = ["Usuario creado exitosamente"];
                            Capsule::commit();
                            $retorno = $userNew->id;
                        }
                        else
                        {
                            Capsule::rollback();
                            $_SESSION['mensajeSistema'] = "Ocurrió un error con el rol del nuevo usuario.";
                            $retorno = false;
                        }
                    }
                    else
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "El usuario no pudo crearse";
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
        else
        {
            $_SESSION['mensajeSistema'] = "No se ingresó contraseña";
            $retorno = false;
        }
        return $retorno;
    }

    public static function contacto($u)
    {
        return self::where("user_id", $u)->first();
    }
}

class EmpDatos extends Model
{
    protected $table = 'empresas_datos';
    public $timestamps = false;
}

class EmpSucursales extends Model
{
    protected $table = 'empresas_sucursales';
    public $timestamps = false;

    public function contactosFull()
    {
        return $this->hasMany("EmpContacto", "sucursal_id")->get();
    }

    public function contactos()
    {
        return $this->contactosFull()->pluck("nombre", "id")->toArray();
    }

    /**
     *  MÉTODOS ESTÁTICOS
     */

    public static function st_contactos($empresa_id)
    {
        $sucursales = self::where("empresa_id", $empresa_id)->get();
        $contactos = [];
        foreach ($sucursales as $sucursal)
        {
            $contactos[$sucursal->id] = $sucursal->contactos();
        }
        return $contactos;
    }

    public static function st_sinMatriz($empresa_id)
    {
        self::where("empresa_id", $empresa_id)->update(["matriz" => 0]);
    }
}

class EmpRedesSociales extends Model
{
    protected $table = 'empresas_redes_sociales';
    public $timestamps = false;
}

class EmpComercial extends Model
{
    protected $table = 'empresas_comercial';
    public $timestamps = false;

    public function tipo()
    {
        return $this->belongsTo("EmpTipos", "tipo_id")->first();
    }
}

class EmpMarcas extends Model
{
    protected $table = 'empresas_marcas';
    public $timestamps = false;

    /**
     *          Métodos estáticos
     */

    public static function carpeta()
    {
        return E_CONT_UPLOAD_DIR . 'marcas/';
    }
}

class EmpTipos extends Model{
    protected $table = 'emp_tipos';
    public $timestamps = false;

    public function perfiles()
    {
        return $this->hasMany("EmpPerfiles", "tipo_id")->get();
    }

    public static function nombre($n)
    {
        return self::find($n)->nombre;
    }
}

class EmpProveedores extends Model{
    protected $table = 'emp_proveedores';
    public $timestamps = false;
}

class EmpServicios extends Model{
    protected $table = 'emp_servicios';
    public $timestamps = false;

    public function segmento()
    {
        return $this->belongsTo("EmpSegmentos", "segmento_id")->first();
    }

    public function proveedor()
    {
        return $this->belongsTo("EmpProveedores", "proveedor_id")->first();
    }
}

class EmpSegmentos extends Model{
    protected $table = 'emp_segmentos';
    public $timestamps = false;

    public function servicios()
    {
        return $this->hasMany("EmpServicios", "segmento_id")->get();
    }
}

class EmpPerfiles extends Model{
    protected $table = 'emp_perfiles';

    public function servicio()
    {
        return $this->belongsTo("EmpServicios", "servicio_id")->first();
    }

    public function tipo()
    {
        return $this->belongsTo("EmpTipos", "tipo_id")->first();
    }
}

class EmpMovimientos extends Model{
    protected $table = 'emp_movimientos';
}

class EmpAlerta extends Model{
    protected $table = 'emp_alerta';
}

class EmpPagos extends Model{
    protected $table = 'pagos';

    public function segmento()
    {
        return $this->belongsTo("EmpSegmentos", "segmento_id")->first();
    }

    public function proveedor()
    {
        return $this->belongsTo("EmpProveedores", "proveedor_id")->first();
    }

    public function user()
    {
        return $this->belongsTo(EloquentUser::class, 'usuario_id')->first();
    }

    public function empresa()
    {
        $user = $this->usuario_id;
        //return EmpContacto::find($user)->empresa();
        return UserExt::getUser($user)->empresa();
    }
}

class EmpPagosRecargas extends Model{
    protected $table = 'pagos_recargas';

    public function pago()
    {
        return $this->belongsTo("EmpPagos", 'pagos_id')->first();
    }

    public function servicio()
    {
        return $this->belongsTo("EmpServicios", "servicio_id")->first();
    }

    public function operadora()
    {
        return $this->servicio()->nombre;
    }
//
//    public function filtraEmpresa()
//    {
//        return $this->pago();
//    }

}

class EmpPagosVenezuela extends Model{
    protected $table = 'pagos_venezuela';
}

class EmpProductos extends Model{
    protected $table = 'emp_productos';
}


//class EmpPrueba extends Model{
//    protected $connection = 'segura';
//    protected $table = 'prueba';
//    public $timestamps = false;
//}

