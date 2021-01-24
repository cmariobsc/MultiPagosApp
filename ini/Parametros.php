<?php
use Illuminate\Database\Eloquent\Model;

//--------------------------------------------------------------------
class Parametro extends Model
{
    //protected $primaryKey = 'id';
    // Adicioné Explica aquí pero no quise hacerlo en los métodos porque creo que no será necesario
    protected $fillable = ['clave', 'valor', 'explica'];
}

//--------------------------------------------------------------------
class Parametros
{
    /**
     * Devuelve el valor de un parametro
     *
     * @param $clave
     * @return null
     */
    public static function get($clave)
    {
        $param = Parametro::where('clave', $clave)->first();
        if ($param) {
            return $param->valor;
        }
        return null;
    }

    /**
     * Establece el valor de un parametro
     *
     * @param $clave
     * @param $valor
     * @return bool
     */
    public static function set($clave, $valor)
    {
        $param = Parametro::where('clave', $clave)->first();
        if (!$param) {
            $param = new Parametro();
            $param->clave = $clave;
        }
        $param->valor = $valor;
        if ($param->save())
            return true;
        return false;
    }
}

$parametros = Parametro::orderby('clave')->get();

foreach ($parametros as $param) {
	eval("define('" . $param->clave . "','" . $param->valor . "');");
}
unset($param);