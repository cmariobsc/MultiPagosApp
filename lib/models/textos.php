<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Email: elapez@gmail.com
 * Date: 1/12/2018
 * Time: 10:18 PM
 */
use Illuminate\Database\Eloquent\Model;

//--------------------------------------------------------------------
class Texto extends Model
{
    protected $table = 'textos';
    protected $primaryKey = 'id';
    protected $idim = E_LAN;

    public function contenido($l="")
    {
        $lg = empty($l) ? E_LAN : $l;

        switch ($lg)
        {
            case "es":
                $retorno = $this->hasOne(TextoEs::class, "textos_id", "id")->first();
                break;
            default:
                //ingles
                $retorno = $this->hasOne(TextoEn::class, "textos_id", "id")->first();
        }

        return $retorno;
    }

    public function contenidoTitulo($l="")
    {
        return empty($l) ? $this->contenido()->titulo : $this->contenido($l)->titulo;
    }

    public function contenidoTexto($l="")
    {
        return empty($l) ? $this->contenido()->texto : $this->contenido($l)->texto;
    }

    public function tema()
    {
        //return $this->belongsTo(TextoTema::class, "textos_temas_id", "id")->first();
        return $this->belongsTo(TextoTema::class, "tema_id", "id")->first();
    }

    public function temaNombre()
    {
        return $this->tema()->nombre;
    }

    public function categoria()
    {
        return $this->tema()->categoria();
    }

    public function categoriaNombre()
    {
        return $this->categoria()->nombre;
    }

    public function imagen()
    {
        return json_decode($this->imagen,"true");
    }

    public function imagenCant(){
        if(!empty($this->imagen()))
        {
            return count($this->imagen());
        }
        else
        {
            return 0;
        }
    }

    public function video()
    {
        return json_decode($this->video,"true");
    }

    public function videosCant(){
        if(!empty($this->video()))
        {
            return count($this->video());
        }
        else
        {
            return 0;
        }
    }

    public function alt()
    {
        return json_decode($this->alt,"true");
    }

    public function textoFotos()
    {
        /** gestión de imagenes */
        $fotos = $this->imagen();
        $alts = $this->alt();
        $texto = $this->contenidoTexto();
        $categoria = $this->categoria_id;
        $tema = $this->tema_id;
        $url = E_URL . Texto::carpeta() . $categoria . "/" . $tema . "/";

        $cantFotos = count($fotos);

        if($cantFotos > 0)
        {
            $aparece = substr_count($texto, '[***]blk_foto_');
            if($aparece > 0)
            {
                /**
                 * Entonces el texto trae incorporada la cadena de al menos una foto
                 * así que procederemos a sustituir la(s) cadena(s) por la(s) foto(s)
                 */
                foreach ($fotos as $fid=>$fval)
                {
                    $etFoto = '<div class="cen eInt3 mAA10"><img src="'.$url.$fval.'" '.altImg($alts[$fid]).' /></div>';
                    $aguja = ['<p>[***]blk_foto_'.$fid.'[***]</p>', '[***]blk_foto_'.$fid.'[***]'];
                    $texto = str_replace ($aguja, $etFoto, $texto );
                }
                unset($fid,$fval);
            }
//            else
//            {
//                /**
//                 * No se encuentre la cadena en el texto, así que sólo pondremos la primera imagen al inicio del texto
//                 * Si se encuentra una segunda imagen, la pondremos al final
//                 */
//                $iniFoto = '<div class="cen eInt3 mAA10"><img src="'.$url.$fotos[0].'" '.altImg($alts[0]).' /></div>';
//                $endFoto = isset($fotos[1]) ? '<div class="cen eInt3 mAA10"><img src="'.$url.$fotos[1].'" '.altImg($alts[1]).' /></div>' : "";
//                $texto = $iniFoto . $texto . $endFoto;
//            }
            return $texto;
        }

        return $texto;
    }

    public function textoVideo()
    {
        $texto = $this->textoFotos();
        $videos = $this->video();
        $cantVideos = count($videos);

        if($cantVideos > 0)
        {
            foreach ($videos as $vid => $vval)
            {
                $posCorteUrl = strrpos ( $vval , "/" );
                $newVideoUrl = substr($vval,$posCorteUrl);
                $etVideo = '<iframe width="100%" height="500px" class="mAA10" src="https://www.youtube.com/embed/'.$newVideoUrl.'?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                $texto = str_replace ( ['<p>[***]blk_video_'.$vid.'[***]</p>', '[***]blk_foto_'.$vid.'[***]'], $etVideo, $texto );
//                    https://youtu.be/A69bnVr2JfA
//                    https://youtu.be/E-UD-BZAf0E
//                    https://youtu.be/EmbmjzDuOh8
//                    https://youtu.be/9eD5iUoZRnM
//                    https://www.youtube.com/embed/9eD5iUoZRnM
            }
            unset($vid, $vval);
            return $texto;
        }
        return $texto;
    }

    public function textoResultante()
    {
        return $this->textoVideo();
    }

    public function carpetaMedios()
    {
        $raiz = self::carpeta();
        return $raiz . $this->categoria_id . "/" . $this->tema_id . "/";
    }

    public function coleccionSelect($page="tema")
    {
        $pag = $page . "/";
        $title = $this->contenido()->titulo;
        $texto_id = $this->id;
        $tema_id = $this->tema_id;

        $cad = '<li class="collection-item"><div>';
        $cad .= '<a href="'.E_URL.E_VIEW.'/'.$pag . urlencode($title) . '?i='.$texto_id.'&t='.$tema_id.'">';
        $cad .= $title;
        $cad .= '</a></div></li>';
        return $cad;
    }

    public function coleccionGeneral($page="tema")
    {
        $pag = $page . "/";
        $title = $this->contenido()->titulo;
        $texto_id = $this->id;

        $cad = '<li class="collection-item"><div>';
        $cad .= '<a href="'.E_URL.E_VIEW.'/'.$pag . urlencode($title) . '?i='.$texto_id.'">';
        $cad .= $title;
        $cad .= '</a></div></li>';
        return $cad;
    }

    /*****************************************************
     *      FUNCIONES ESTÁTICAS
     */

    public static function carpeta()
    {
        return E_CONT_UPLOAD_DIR . 'texto/';
    }

    public static function carpetaTexto($t)
    {
        // donde $t tiene que ser "#/#" (1/3)
        return self::carpeta() . $t . "/";
    }

    /**
     * Devuelve el modelo completo de acuerdo al parámetro índice
     */
    public static function modeloTexto($id)
    {
        return self::find($id);
    }

    public static function contenidos($categoria_id, $tema_id="", $cantidad=20)
    {
        if(empty($tema_id))
        {
            return self::where("categoria_id", $categoria_id)->orderByDesc("id")->take($cantidad)->get();
        }
        else
        {
            return self::where([["categoria_id", $categoria_id],["tema_id", $tema_id]])->orderByDesc("id")->take($cantidad)->get();
        }
    }
}


class TextoTema extends Model
{
    protected $table = 'textos_temas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsTo(TextoCategoria::class, "textos_categorias_id", "id")->first();
    }


    /**
     * FUNCIONES ESTÁTICAS
     */

    public static function staticCat($c)
    {
        return self::where("textos_categorias_id", $c)->get();
    }

    public static function carpeta()
    {
        return E_CONT_UPLOAD_DIR . 'textoTemas/';
    }

}


class TextoCategoria extends Model
{
    protected $table = 'textos_categorias';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function carpeta()
    {
        return E_CONT_UPLOAD_DIR . 'textoCategorias/';
    }

    public function temas()
    {
        return $this->hasMany(TextoTema::class, "textos_categorias_id")->get();
    }
}


class TextoEs extends Model
{
    protected $table = 'textos_es';
    protected $primaryKey = 'id';
    public $timestamps = false;

}


class TextoEn extends Model
{
    protected $table = 'textos_en';
    protected $primaryKey = 'id';
    public $timestamps = false;

}




