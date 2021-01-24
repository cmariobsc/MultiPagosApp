<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Email: elapez@gmail.com
 * Date: 1/12/2018
 * Time: 10:18 PM
 */
use Illuminate\Database\Eloquent\Model;
//use Cartalyst\Sentinel\Roles\EloquentRole;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

//--------------------------------------------------------------------
class Vista extends Model
{
    //protected $table = 'vistas';
    protected $fillable = ['nombre', 'permisos', 'menu', 'claves', 'describir'];

    public function nombre()
    {
        return $this->nombre;
    }

    public function permisos()
    {
        return json_decode($this->permisos);
    }

    public function hay_permiso($a)
    {
        $permisosVista = $this->permisos();
        if(in_array($a, $permisosVista))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Devuelve array con los tipos de usuarios autorizados
     * El índice de cada elemento es el Id del Role
     * @return array
     */
    public function autorizados()
    {
        $permisos = $this->permisos();
        $role = [];
        foreach($permisos as $permiso)
        {
            $role[$permiso] = Sentinel::findRoleById($permiso)->slug;
        }
        return $role;
    }

    public function carpeta()
    {
        return E_VISTAS . $this->nombre();
    }

    public function contenidos()
    {
        $contenidos = $this->hasMany(Contenido::class, "vistas_id", "id")->get();

        if(count($contenidos) > 0)
        {
            $cont = [];

            foreach ($contenidos as $c)
            {
                $cont[$c->vistaSub_id] = [
                    "titulo" => $c->titulo,
                    "texto" => $c->texto,
                    "imagen" => E_CONT_UPLOAD_DIR . 'contenidos/' . $c->imagen,
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

    public function getLocal($l=E_LAN)
    {
        switch($l)
        {
            case "en":
                $tabla_lan = "VistaText_en";
                break;
            case "es":
                $tabla_lan = "VistaText_es";
                break;
            default:
                // es
                $tabla_lan = "VistaText_".E_LAN;
        }
        return $this->hasMany($tabla_lan, "vista_id")->get();
    }

    public function setLocal($l, $tid, $text)
    {
        foreach($_SESSION['idiomas'] as $idim)
        {
            if($l == $idim)
            {
                $tabla_lan = "VistaText_" . $idim;
                break;
            }
        }

        if($tabla_lan)
        {
            $tValor = $tabla_lan::find($tid);
            if($tValor)
            {
                $tValor->texto = $text;
                if($tValor->save())
                {
                    return true;
                }
            }
        }
        return false;
    }

    public function getLocalRef($r)
    {
        $retorno = $this->getLocal()->where("referencia", $r)->first()->toArray();
        return $retorno["texto"];
    }

    /**
     * Devuelve "true" sólo si la vista es pública
     * @return bool
     */
    public function is_public()
    {
        $permisos = json_decode($this->permisos);
        return in_array(4, $permisos) ? true : false;
    }

    /**
     * Devuelve "true" sólo si la vista es para el acceso de clientes
     * @return bool
     */
    public function is_cliente()
    {
        $permisos = json_decode($this->permisos);
        return (in_array(3, $permisos) || in_array(5, $permisos)) ? true : false;
    }


    /**
     *      MÉTODOS ESTÁTICOS
     */

    public static function vistas()
    {
        $vistas = self::all();
        $retorno = [];
        foreach($vistas as $v)
        {
            array_push($retorno, $v->nombre);
        }
        return $retorno;
    }

    public static function vistasPublicas()
    {
        $retorno = [];
        $todas = self::all();
        foreach ($todas as $toda)
        {
            if($toda->is_public())
            {
               $retorno[$toda->id] = $toda->nombre;
            }
        }
        return $retorno;
    }

    public static function menu()
    {
        global $userTipo;

        $vistas = self::all();
        $retorno = [];

        foreach($vistas as $v)
        {
            $permisos_vista = json_decode($v->permisos);

            if(in_array($userTipo, $permisos_vista) && !empty($v->menu))
            {
                array_push($retorno, [$v->nombre, json_decode($v->menu)]);
            }
        }


        return $retorno;
    }

    /**
     * Devuelve el Id de la vista actual
     * @return integer
     */
    public static function vista_id()
    {
        $filaVista = self::where("nombre", E_VIEW)->first();
        return $filaVista->id;
    }
}

class VistaText_es extends Model{
    protected $table = 'vistas_text_es';
    public $timestamps = false;
}

class VistaText_en extends Model{
    protected $table = 'vistas_text_en';
    public $timestamps = false;
}


