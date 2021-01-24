<?php

class Bloque
{
    protected $B_equipo;  // esto identifica si es una PC un teléfono móvil o una tablet
    public static $autoId = 0;

    public function __construct($equipo = "")
    {
        $this->B_equipo = $equipo;
    }

    ////
    // Para las etiquetas de que abren y cierran (<a></a>, <div></div>, <p></p>, etc)
    public function blk($contenido = "", array $opt = [], $envoltura = "div")
    {
        $params = $this->params($opt);
        return "<" . $envoltura . " " . $params . ">" . $contenido . "</" . $envoltura . ">";
    }

    ////
    // Para las etiquetas de autocierre (<input />, <img />, <hr />, <br />, etc...)
    public function noBlk(array $opt = [], $envoltura = "input")
    {
        $params = $this->params($opt);
        return "<" . $envoltura . " " . $params . " />";//.PHP_EOL
    }

    ////
    // parámetros que se le pasarán a la etiqueta ()
    public function params($opt)
    {
        $opcionales = ["required", "readonly", "disabled"];
        if (!empty($opt)) {
            foreach ($opt as $opId => $op)
            {
                if (strtolower($opId) == "id")
                {
                    //$blk["id"] = !empty($op) ? 'id = "' . $op . '"' : 'id = "id_' . self::$autoId++ . '"';
                    $blk["id"] = !empty($op) ? 'id = "' . $op . '"' : 'id = "id_' . uniqid() . '"';
                } else {
                    if(in_array($opId, $opcionales))
                    {
                        $blk[$opId] = $opId . ' = ""';
                    }
                    else
                    {
                        $blk[$opId] = !empty($op) ? $opId . ' = "' . $op . '"' : "";
                    }
                }
            }

            if (!isset($blk["id"]))
            {
                $blk["id"] = 'id = "id_' . uniqid() . '"';
            }

            $optRetorno = implode(" ", $blk);
        }
        else
        {
            $optRetorno = "";
        }

        return $optRetorno;
    }

    ////
    // Llena una tabla de acuerdo a un arreglo con los contenidos y la cantidad de campos
    public function table(array $datos = [], $campos = "", $tablaArgs = ["border" => 1, "cellpadding" => 0, "cellspacing" => 0])
    {
        $retorno = "";

        // Compruebo si hay datos a ingresar
        if (!empty($datos) && !empty($campos)) {
            // Hago un ciclo con cada fila de datos
            foreach ($datos as $dt) {
                // Inicio la escritura de una fila
                $retorno .= "<tr>";
                // Recorro todos los campos de la fila en un ciclo "for"
                for ($i = 0; $i < $campos; $i++) {
                    $celdaArgs = [];
                    foreach ($dt[$i] as $id_ar => $val_ar) {
                        if ($id_ar != "data") {
                            $celdaArgs[$id_ar] = $val_ar;
                        }
                    }
                    $data = isset($dt[$i]["data"]) ? $dt[$i]["data"] : "";
                    $retorno .= $this->blk($data, $celdaArgs, "td");
                }
                $retorno .= "</tr>";
            }
            $retorno = $this->blk($retorno, $tablaArgs, "table");
        }

        return $retorno;
    }

    ////
    // Devuelve diversos tipos de listas siempre como "string"
    public function listaElo($datos, array $campos, $tipo = "li")
    {
        $retorno = "";
        $newA = [];


        switch ($tipo) {
            case "li":
                foreach ($datos as $dato) {
                    foreach ($campos as $ca) {
                        $retorno .= '<li class="noVin">' . $dato->$campos[$ca] . '</li>';
                    }
                    unset($ca);
                }
                unset($dato);
                break;
            case "select":
                foreach ($datos as $dato) {
                    $retorno .= '<option value="' . $dato->$campos[0] . '">' . $dato->$campos[1] . '</option>';
                }
                unset($dato);
                break;
            case "table":
                foreach ($datos as $dato) {
                    foreach ($campos as $ca) {
                        $retorno .= '<td>' . $dato->$campos[$ca] . '</option>';
                    }
                    unset($ca);
                }
                unset($dato);
                break;
            default:
                foreach ($datos as $dato) {
                    foreach ($campos as $ca) {
                        $retorno .= $dato->$campos[$ca] . '<br />';
                    }
                    unset($ca);
                    $retorno .= '<hr />';
                }
                unset($dato);
        }


        return $retorno;
    }

    public function set_files(array $files, $url = "")
    {
        $id = 0;
        $retorno = [];
        foreach ($files as $f) {
            $retorno [$id++] = is_array($f) ? [$url . $f[0], $f[1]] : $url . $f;
        }
        return $retorno;
    }

    public function contenidoImg(array $images, $id = "", $cssClass = "", $cssStyles = "", $contenedor = "")
    {
        $retorno = "";
        $B_css = $this->set_css($cssClass);
        $B_style = $this->set_estilos($cssStyles);

        while ($images) {

            $B_id = self::set_id($id);
            $actual = array_shift($images);
            if (is_array($actual)) {
                $imgImg = $actual[0];
                $imgAlt = $actual[1];
            } else {
                $imgImg = $actual;
                $imgAlt = substr(basename($actual), 0, -4);
            }

            if (empty($contenedor)) {
                $retorno .= '<img src="' . $imgImg . '" ' . $this->altImg($imgAlt) . $B_id . $B_css . $B_style . ' />';
            } else {
                $box_id = isset($contenedor[0]) ? $contenedor[0] : "";
                $box_css = isset($contenedor[1]) ? $contenedor[1] : "";
                $box_style = isset($contenedor[2]) ? $contenedor[2] : "";
                $retorno .= $this->bloqueDIV('<img src="' . $imgImg . '" ' . $this->altImg($imgAlt) . $B_id . $B_css . $B_style . ' />', $box_id, $box_css, $box_style);
            }
        }
        return $retorno;
    }

    public function contenidoList(array $listas)
    {
        return $listas;
    }

    public function contenidoText($texto)
    {
        return $texto;
    }

    public function f_select($name, $datos, $id = "", $select = "", $class = "", $estilo = "")
    {
        //global $_ACABADO_OPCIONES;
        $retorno = "";
        if (!empty($name) && !empty($datos)) {
            if (is_array($datos)) {
                if (!empty($id)) {
                    $i = 'id="' . $id . '" ';
                } else {
                    $i = "";
                }
                if (!empty($class)) {
                    $c = 'class="' . $class . '" ';
                } else {
                    $c = "";
                }
                if (!empty($estilo)) {
                    $e = 'style = "' . $estilo . '" ';
                } else {
                    $e = "";
                }
                $retorno .= '<select name="' . $name . '" ' . $i . ' ' . $c . ' ' . $e . ' >';
                foreach ($datos as $did => $d) {
                    if ($did == $select) {
                        $s = 'selected="selected" ';
                    } else {
                        $s = "";
                    }
                    $retorno .= '<option value="' . $did . '" ' . $s . '>' . $d . '</option>';
                }
                $retorno .= '</select>';
            } else {
                $retorno .= $datos;
            }
        }
        return $retorno;
    }

    public function altImg($argumento)
    {
        // esta funcion devuelve el argumento como valor de las propiedades alt y title para las imagenes
        // sustituye los saltos de línea y los caracteres HTML
        $argumentoNew = strtr($argumento, array(chr(10) => "", chr(13) => ""));
        $retorno = ' alt="' . htmlentities($argumentoNew, ENT_QUOTES) . '" title="' . htmlentities($argumentoNew, ENT_QUOTES) . '" ';
        return $retorno;
    }
}

//$b = new Bloque();
/////$imagenes = $b->set_files([["facebook.png","Dicen que esto es facebook"],"google-plus.png","twitter.png"], "public/images/icon/");
////$iconosAdicional = $b->bloqueDIV($b->contenidoImg($imagenes,"","","width:50%",["","noDiv cen eInt3","width:auto;"]),"galeria","wcuarto3 fondoColor5","border:solid 3px #000;");
////$textoAdicional = $b->bloqueDIV('<p class="jus">Verifique escribir correctamente su dirección de correo pues será a dicha dirección a donde enviaremos la respuesta a la mayor brevedad.<br />Recuerde que también nos puede contactar a través de las redes sociales.</p>',"","wcuarto3 bCen esquina5 fondoColor5");
////echo $b->blk($textoAdicional.$iconosAdicional);
//
//
//$cad = "Augue augue et habitasse habitasse torquent ut".$b->blk("sdfbshf shdfsf sdhf hsd fsdf sdh .oii",["style"=>"padding:2em; border:solid 2px red; margin:2em;"])."at pede ipsum torquent onec lorem conubia lorem mollis commodo metus ut n imperdiet commodo metus liquam unc torquent am augue dictumst quam orci nisl consectetuer nibh torquent eros ligula in facilisis orem platea leo torquent aptent dictum ut ras dolor consequat conubia onec sociosqu nisl mauris id vulputate condimentum consectetuer sed platea quis hac imperdiet onec ras roin risus quis lass sit consequat condimentum in purus in consequat sagittis mattis risus tortor lacus consequat dictumst id tiam mattis orem eleifend onec libero orem faucibus risus nec sagittis iaculis torquent at sollicitudin hac orbi at per nunc semper accumsan leo raesent odio mollis";
//
//
//for($i=1; $i<=10; $i++)
//{
//    echo $b->blk($cad,["style"=>"color:#22F;", "class"=>"tipo1"], "blockquote");
//}