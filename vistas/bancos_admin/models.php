<?php //creado auntomáticamente desde localhost

//use Cartalyst\Sentinel\Users\EloquentUser;
//use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Database\Eloquent\Model;
//--------------------------------------------------------------------

class Banco extends Model
{
    protected $table = 'bancos';
}

class BancoCuenta extends Model
{
    protected $table = 'bancos_cuentas';

    public function banco()
    {
        return $this->belongsTo("Banco", "banco_id")->first();
    }

    /**
     *  Métodos estáticos
     */
    public static function cuentas($a="")
    {
        if(!empty($a) && is_numeric($a))
        {
            return self::where("empresa_id", $a)->get();
        }
        else
        {
            global $uEmpresa;
            return self::where("empresa_id", $uEmpresa->id)->get();
        }
    }

}

class BancoCuentaTipo extends Model
{
    protected $table = 'banco_cuentas_tipo';
}

class Moneda extends Model
{
    protected $table = 'monedas';
}
