<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Email: elapez@gmail.com
 * Date: 1/12/2018
 * Time: 10:23 PM
 */
use Illuminate\Database\Eloquent\Model;

//--------------------------------------------------------------------
class Contenido extends Model
{
    protected $table = 'vistas_cont_' . E_LAN;
    protected $fillable = ['vistas_id', 'vistaSub_id', 'titulo', 'texto', 'imagen', 'alt', 'explicados', 'link', 'textoLink'];


    public function contenidos_vista()
    {
        $contenidos = $this->hasMany(Vista::class, 'vista_id')->get();

        if(count($contenidos) > 0)
        {
            $cont = [];

            foreach ($contenidos as $c)
            {
                $cont[$c->vistaSub_id] = [
                    "titulo" => $c->titulo,
                    "texto" => $c->texto,
                    "imagen" => $c->imagen,
                    "alt" => $c->alt,
                    "explicados" => $c->explicados,
                    "created_at" => $c->created_at
                ];
            }
        }
        else
        {
            $cont = NULL;
        }
        return $cont;
    }

    public static function carpeta()
    {
        return E_CONT_UPLOAD_DIR . 'contenidos/';
    }




//    public static function getCampos()
//    {
//        $first = (new static)->first();
//
//        if ($first) {
//            list($cols, $values) = array_divide($first->toArray());
//            return $cols;
//        }
//        return null;
//    }
}

/**
function blkCont()
{
    //global $idVista;
    $idVista = Vista::where("nombre", E_VIEW)->select("vistasId")->first(); // esto trae el ID de la Vista

    if ($idVista) {
        $datosContenidos = [];
        $vistaContenidos = Contenido::where("vistaId", $idVista->vistasId)->orderby("vistaSubId")->get();

        $datosCampos = Contenido::getCampos();
        //$datosCampos = ["vistaSubId", "titulo", "texto", "imagen", "alt", "explicados"];

        foreach ($vistaContenidos as $vCont) {
            foreach ($datosCampos as $dCamp) {
                $datosContenidos[$vCont->vistaSubId][$dCamp] = $vCont->$dCamp;
            }
            unset($dCamp);
        }
        unset($vCont);

        return $datosContenidos;
    }

    return null;
}
 * */