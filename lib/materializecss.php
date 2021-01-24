<?php

/**
 * @param $contenido
 * @param string $envoltura
 * @return string
 */
function mat_form($contenido, $envoltura="")
{
    global $b;
    $retorno = "";

    if (empty($envoltura)) {
        $retorno = $b->blk($contenido,["class"=>"input-field col s12"]);
    } else {
        // si $envoltura es -1, entonces no pongo envoltura
        if ($envoltura != -1) {
            $valorEnvoltura = "input-field ".$envoltura;
            $retorno = $b->blk($contenido,["class"=>$valorEnvoltura]);
        }
        else
        {
            $retorno = $contenido;
        }
    }

    return $retorno;
}

/**
 * MATERIALIZECSS ( INPUT )
 * Devuelve un <select></select> con formato para materializecss
 *
 * @param $label
 * @param $name
 * @param string $type
 * @param string $envoltura
 * @param string $value
 * @param string $id
 * @return string
 */
function mat_input($label, $name, $datos = ["a"])
{
    global $b;
    $retorno = "";
    $opcionales = ["required", "readonly", "disabled"];
    $arregloOpciones = [];

    if(count($datos) > 0)
    {
        $type = isset($datos["type"]) ?  $datos["type"] : "text";
        $envoltura = isset($datos["envoltura"]) ? $datos["envoltura"] : "";
        $value = isset($datos["value"]) ? $datos["value"] : "";
        $id = isset($datos["id"]) ? $datos["id"] : $name;
        $clase = isset($datos["class"]) ? $datos["class"] : "";
        $list = isset($datos["list"]) ? $datos["list"] : ""; // $lista será el ID del <datalist> a cargar
        $min = isset($datos["min"]) ? $datos["min"] : "";
        $max = isset($datos["max"]) ? $datos["max"] : "";

        foreach ($opcionales as $opt)
        {
            if(isset($datos[$opt]))
            {
                $arregloOpciones[$opt] = "";
            }
        }
    }

    switch($clase)
    {
        case "datepicker":
            $clsCss = "datepicker";
            break;
        case "timepicker":
            $clsCss = "timepicker";
            break;
        case "-1":
            $clsCss = "";
            break;
        default:
            $clsCss = "validate ".$clase;
    }

    $arregloOpciones["id"] = $id;
    $arregloOpciones["name"] = $name;
    $arregloOpciones["class"] = $clsCss;
    $arregloOpciones["value"] = $value;
    $arregloOpciones["type"] = $type;

    if($arregloOpciones["type"] == "number")
    {
        if(!empty($min))
        {
            $arregloOpciones["min"] = $min;
        }
        if(!empty($max))
        {
            $arregloOpciones["max"] = $max;
        }
    }

    if(!empty($list)){$arregloOpciones["list"] = $list;}

    $retorno .= $b->noBlk($arregloOpciones).PHP_EOL;
    $retorno .= $b->blk($label,["for"=>$id], "label").PHP_EOL;

    return mat_form($retorno, $envoltura);
}

/**
 * MATERIALIZECSS ( SELECT )
 * Devuelve un <select></select> con formato para materializecss
 *
 * @param $label
 * @param $name
 * @param array $contenido
 * @param string $envoltura
 * @param string $default
 * @param string $id
 * @return string
 */


/**
 * MATERIALIZECSS ( TEXTAREA )
 * Devuelve un <textarea></textarea> con formato para materializecss
 *
 * Requiere "$('#textarea1').trigger('autoresize');" dentro del script de la vista si el valor es llenado dinámicamente
 *
 * @param $label
 * @param $name
 * @param string $type
 * @param string $envoltura
 * @param string $value
 * @param string $id
 * @param string $clase
 * @param int $largo
 * @return string
 */
function mat_textarea($label, $name, $envoltura = "", $value ="", $id="", $clase="materialize-textarea", $largo="")
{
    global $b;
    $retorno = "";

    if (!empty($id)) {
        $idShow = $id;
    } else {
        $idShow = $name;
    }

    switch($clase)
    {
        case "materialize-textarea":
            $clsCss = "materialize-textarea";
            break;
        default:
            $clsCss = "materialize-textarea ".$clase;
    }


    if(empty($largo))
    {
        $retorno .= $b->blk($value, ["id"=>$idShow, "name"=>$name, "class"=>$clsCss], "textarea");
    }
    else
    {
        $retorno .= $b->blk($value, ["id"=>$idShow, "name"=>$name, "class"=>$clsCss, "data-length"=>$largo], "textarea");
    }


    $retorno .= $b->blk($label, ["for"=>$idShow], "label");

    return mat_form($retorno, $envoltura);
}

/**
 * MATERIALIZECSS ( CHECKBOX ) VERSIÓN VIEJA DE MATERIALIZECSS
 * Devuelve un "checkbox" con formato para materializecss
 *
 * @param $label
 * @param $name
 * @param string $envoltura
 * @param string $value
 * @param string $id
 * @param string $clase
 * @param string $checked
 * @return string
 */
function mat_check_old($label, $name, $value ="1", $id="", $clase="filled-in", $checked="")
{
    global $b;

    if (!empty($id)) {
        $idShow = $id;
    } else {
        $idShow = $name;
    }

    if($checked == "")
    {
        $params = ["name"=>$name, "id"=>$idShow, "type"=>"checkbox", "value"=>$value, "class"=>$clase];
    }
    else
    {
        $params = ["name"=>$name, "id"=>$idShow, "type"=>"checkbox", "value"=>$value, "class"=>$clase, "checked"=>"checked"];
    }

    $ip = $b->noBlk($params);
    $lab = $b->blk($label, ["for"=>$idShow], "label");

    $retorno = $b->blk($ip.$lab, [], "p");

    return mat_form($retorno, -1);
}

/**
 * MATERIALIZECSS ( CHECKBOX ) NUEVA VERSIÓN DE MATERIALIZE
 * Devuelve un "checkbox" con formato para materializecss
 *
 * @param $label
 * @param $name
 * @param string $value
 * @param string $id
 * @param string $clase
 * @param string $checked
 * @return string
 */
function mat_check($label, $name, $value ="1", $id="", $clase="filled-in", $checked="")
{
    global $b;

    if (!empty($id)) {
        $idShow = $id;
    } else {
        $idShow = $name;
    }

    if($checked == "")
    {
        $params = ["name"=>$name, "id"=>$idShow, "type"=>"checkbox", "value"=>$value, "class"=>$clase];
    }
    else
    {
        $params = ["name"=>$name, "id"=>$idShow, "type"=>"checkbox", "value"=>$value, "class"=>$clase, "checked"=>"checked"];
    }

    // input
    $inp = $b->noBlk($params);

    // label en este caso se usa <SPAN>
    $spa = $b->blk($label, [], "span");

    //Agrupamiento con el <LABEL>
    $lab = $b->blk($inp.$spa, ["for"=>$idShow], "label");


    $retorno = $b->blk($lab, [], "p");

    return mat_form($retorno, -1);
}

/**
 * CREAR UNA "CARD"
 * @param $titulo
 * @param $contenido
 * @return string
 */
function mat_card($titulo, $contenido)
{
    global $b;
    $title = $b->blk($titulo, ["class"=>"card-title", "span"]);
    $cont =  $b->blk($title . $contenido, ["class"=>"card-content"]);
    return $b->blk($cont,["class"=>"card"]);
}

/** CARD REVEAL */
function mat_card_reveal($arr)
{
    global $b;
    $cont = "";

//    $arr['titulo']
//    $arr['texto']
//    $arr['img']
//    $arr['alt']
//    $arr['link']
//    $arr['textoLink']

    $i = '<img src="'.$arr['img'].'" class="activator" '.altImg($arr['alt']).' />';
    $cont .= $b->blk($i,["class"=>"card-image waves-effect waves-block waves-light"]);

    $t = '<span class="card-title activator grey-text text-darken-4">'.$arr['titulo'].'<i class="material-icons right">more_vert</i></span>';
    $t .= (isset($arr['link']) && !empty($arr['link'])) ? '<p><a href="'.$arr['link'].'">'.$arr['textoLink'].'</a></p>' : '';
    $cont .= $b->blk($t,["class"=>"card-content"]);

    $r = '<span class="card-title grey-text text-darken-4">'.$arr['titulo'].'<i class="material-icons right">close</i></span>';
    $r .= !empty($arr['texto']) ? $arr['texto'] : "";
    $cont .= $b->blk($r,["class"=>"card-reveal letra4"]);


    return $b->blk($cont,["class"=>"card"]);
}

/** HORIZONTAL CARD */
function mat_card_horizontal($arr)
{
    /**
     *  $arr['titulo'] --> Titulo de la tarjeta
     *  $arr['texto'] --> Texto de la tarjeta
     *  $arr['img'] --> Imagen de la tarjeta
     *  $arr['link'] --> Enlace de la tarjeta
     *  $arr['env'] --> Etiqueta de envoltura a la tarjeta horizontal
     */
    global $b;

    $imagen = '<img src="' . E_URL . $arr["img"] . '" '.altImg($arr["titulo"]).' />';
    $img = $b->blk($imagen, ["class"=>"card-image"]);

    $cont = '<h3>'.$arr["titulo"].'</h3>';
    $cont .= $arr["texto"];
    $contenido = $b->blk($cont, ["class"=>"card-content"]);

    if(isset($arr["link"]) && !empty($arr["link"]))
    {
        $enlace = $b->blk('<a href="'.$arr["link"].'"><i class="material-icons">add_circle</i></a>', ["class"=>"card-action"]);
    }
    else
    {
        $enlace = "";
    }

    $stack = $b->blk($contenido.$enlace, ["class"=>"card-stacked"]);

    $car = $img . $stack;

    $retorno = $b->blk($car,["class"=>"card horizontal"]);

    if(isset($arr["env"]))
    {
        return $b->blk($retorno,["class"=>$arr["env"]]);
    }
    else
    {
        return $retorno;
    }

}


/**
 *  MATERIALIZECSS ( FILE )
 * @param $titulo
 * @param $name
 * @return string
 */
function mat_file($titulo, $name, $envoltura="col s12 l6")
{
    global $b;

    $div1 = '<div class="btn"><span><i class="large material-icons">perm_media</i></span><input id="'.$name.'" name="'.$name.'" type="file"></div>';
    $div2 = '<div class="file-path-wrapper"><input id="file-wrapper" class="file-path validate" type="text" placeholder="'.$titulo.'"></div>';

    return mat_form($div1.$div2, 'file-field '.$envoltura);
}

/** RADIO BUTTON */
function mat_radio($label, $name, $value ="1", $id="", $clase="with-gap", $checked="")
{

    global $b;

    if (!empty($id)) {
        $idShow = $id;
    } else {
        $idShow = $name . uniqid();
    }

    if(empty($checked))
    {
        $params = ["name"=>$name, "id"=>$idShow, "type"=>"radio", "value"=>$value, "class"=>$clase];
    }
    else
    {
        $params = ["name"=>$name, "id"=>$idShow, "type"=>"radio", "value"=>$value, "class"=>$clase, "checked"=>"checked"];
    }

    $inp = $b->noBlk($params);

    $spa = $b->blk($label, [], "span");

    $lab = $b->blk($inp.$spa, ["for"=>$idShow], "label");

    $retorno = $b->blk($lab, [], "p");

    return mat_form($retorno, -1);
}

function mat_picker($label, $name, $datos = ["a"])
{
    if(count($datos) > 0)
    {
        if(isset($datos["tipo"]))
        {
            $tipo = ($datos["tipo"] == "time") ? "timepicker" : "datepicker";
        }
        else
        {
            $tipo = "datepicker";
        }

        $envoltura = isset($datos["envoltura"]) ? $datos["envoltura"] : "";
        $value = isset($datos["value"]) ? $datos["value"] : "";
        $id = isset($datos["id"]) ? $datos["id"] : $name;
        $class = isset($datos["class"]) ? $tipo." ".$datos["class"] : $tipo;
        $true = isset($datos["true"]) ? $datos["true"] : "";
        $otherTrueId = isset($datos["otherTrueId"]) ? $datos["otherTrueId"] : "";

    }
    else
    {
        $envoltura = "";
        $id = uniqid();
        $class = "";
        $tipo = "datepicker";
        $otherTrueId = "";
        $true = "";
        $value = "";
    }

    $contenido = '<input type="text" value="'.$value.'" name="'.$name.'" id="'.$id.'" class="'.$class.'">';
    $contenido .= '<label for="'.$id.'">'.$label.'</label>';
    $contenido .= '<input type="hidden" name="'.$tipo.'True'.$otherTrueId.'" id="'.$tipo.'True'.$otherTrueId.'" value="'.$true.'" />';

    return mat_form($contenido, $envoltura);
}

/**
$n = $datos["nombre"]
$i = $datos["id"]
$c = $datos["class"]
$l = datos["link"]
$d = $datos["delete"]
$v = $datos["vista"]
 */
function mat_colection($c, $datos = ["a"])
{
    $obj = $c::all();

    return mat_filas($obj, $datos);

}

function mat_filas($obj, $datos = ["a"])
{
    global $b;
    $lista = "";

    if(count($obj) > 0)
    {
        $n = isset($datos["nombre"]) ? $datos["nombre"] : "nombre";
        $i = isset($datos["id"]) ? $datos["id"] : "id";
        $c = isset($datos["class"]) ? $datos["class"] : "oscuro";
        $l = isset($datos["link"]) ? $datos["link"] : TRUE;
        $d = isset($datos["delete"]) ? TRUE : FALSE;
        //$v = isset($datos["vista"]) ? $datos["vista"] : E_VIEW;
		$v = isset($datos["vista"]) ? E_URL . $datos["vista"] : E_URL . E_VIEW;

        foreach($obj as $elem)
        {
            $lista .= '<li class="collection-item">';

            if($l)
            {
                /**
                 * Lista y botones de viñetas
                 */
                if(is_bool($l))
                {
                    $lista .= '<a class="'.$c.'" href="'.$v.'?a=select&id='.$elem->$i.'">'.$elem->$n.'</a>';

                    if($d)
                    {
                        $lista .= '<a href="'.$v.'?a=delete&id='.$elem->$i.'" class="secondary-content '.$c.' mIzq10" onclick="if(confirma(\'de verdad lo quieres borrar\')){return true;}else{return false;}"><i class="material-icons red-text">delete</i></a>';
                    }

                    $lista .= '<a href="'.$v.'?a=select&id='.$elem->$i.'" class="secondary-content '.$c.'"><i class="material-icons green-text">edit</i></a>';
                }
                else
                {
                    $lista .= '<a class="'.$c.'" href="'.$v.'?a='.$l.'&a1=select&id='.$elem->$i.'">'.$elem->$n.'</a>';

                    if($d)
                    {
                        $lista .= '<a href="'.$v.'?a='.$l.'&a1=delete&id='.$elem->$i.'" class="secondary-content '.$c.' mIzq10" onclick="if(confirma(\'de verdad lo quieres borrar\')){return true;}else{return false;}"><i class="material-icons red-text">delete</i></a>';
                    }

                    $lista .= '<a href="'.$v.'?a='.$l.'&a1=select&id='.$elem->$i.'" class="secondary-content '.$c.'"><i class="material-icons green-text">edit</i></a>';
                }


            }
            else
            {
                /**
                 * Lista sencilla
                 */
                $lista .= $elem->$n;
            }

            $lista .= '</li>';
        }
    }
    else
    {
        $lista = '<li class="collection-item">No se encontraron elementos</li>';
    }

    return $b->blk($lista, ["class"=>"collection"], "ul");
}


/**
*
*
*
*/
function mat_select_service()
{
	
try{
	$url="https://abcell-recargas.com/webservicePuntoAgil/wsCatalogoProductos.asmx?wsdl";
   $soapClient = new SoapClient($url);
    // $params->pts_Usuario = '18862';
	// $params->pts_Clave = 'PUNTO1983';
   $respuesta = $soapClient->CatalogoServicios(array("strUsuario" => "18862", "strContrasena" => "PUNTO1983"))->CatalogoServiciosResult;
   $resp=$respuesta->any;
    $opciones = new SimpleXMLElement($resp);
	$datos = $opciones->NewDataSet->Table;
	//var_dump($datos);
	$listaServicios="";
	$info=array();
	$count =0;
	
	 foreach($datos as $listaPak)
     {
		$info[$count++] =array((string)$listaPak->pts_CodigoItem,(string)$listaPak->pts_NombreServicio);
		$listaServicios .= '<option value="' . (string)$listaPak->pts_CodigoItem . '" >' . (string)$listaPak->pts_NombreServicio . '</option>';
     }
	 //var_dump ($info);
	 $GLOBALS['info']=$info;
		
	 return $listaServicios;
} catch (Exception $e) {
   //echo $e;
   echo '0Se produjo un error grave, inténtelo más tarde.<br />'; // .$e
   exit();
}
}

function mat_select_subService($cod)
{
	
try{
	$url="https://abcell-recargas.com/webservicePuntoAgil/wsCatalogoProductos.asmx?wsdl";
   $soapClient = new SoapClient($url);
    // $params->pts_Usuario = '18862';
	// $params->pts_Clave = 'PUNTO1983';
   $respuesta = $soapClient->CatalogoServiciosCamposItem(array("strUsuario" => "18862", "strContrasena" => "PUNTO1983","pts_CodigoItem" => $cod))->CatalogoServiciosCamposItemResult;
   $resp=$respuesta->any;
    $opciones = new SimpleXMLElement($resp);
	$datos = $opciones->NewDataSet->Table;
	var_dump($datos);
	//exit();
	$listaServicios="";
	$info=array();
	$count =0;
	
	 foreach($datos as $listaPak)
     {
		$info[$count++] =array((string)$listaPak->pts_CodigoItem,(string)$listaPak->pts_NombreServicio,(string)$listaPak->pts_Referencia,(string)$listaPak->pts_DocumentoIdentificacion,(string)$listaPak->pts_Nombres,(string)$listaPak->pts_ComboServicio,(string)$listaPak->pts_ComboTipoDocumento);
		$listaServicios .= '<option value="' . (string)$listaPak->pts_CodigoItem . '" >' . (string)$listaPak->pts_NombreServicio . '</option>';
     }
	 //var_dump ($info);
	 $GLOBALS['info']=$info;
		
	 return $listaServicios;
} catch (Exception $e) {
   //echo $e;
   echo '0Se produjo un error grave, inténtelo más tarde.<br />'; // .$e
   exit();
}
}
/**
 * @param $c
 * @param string $i
 * @param string $n
 */
function mat_select_list($c, $i="id", $n="nombre", $order="")
{
    if(empty($order))
    {
        $all = $c::all()->sortBy($n);
    }
    else
    {
        $all = $c::all()->sortBy($order);
    }

    $retorno = [];

    foreach($all as $ea)
    {
        if(is_array($n))
        {
            $nTmp = "";
            foreach($n as $m)
            {
                $nTmp .= $ea->$m . " ";
            }
            $retorno[$ea->$i] = $nTmp;
        }
        else
        {
            $retorno[$ea->$i] = $ea->$n;
        }
    }

    return $retorno;
}

function mat_select($label, $name, $contenido, $envoltura = "", $selected="", $default="", $id="", $extra="")
{
    global $b;
    $retorno = "";
	//print_r($contenido);
    if (!empty($id)) {
        $idShow = $id;
    } else {
        $idShow = $name;
    }

    if(empty($default))
    {
        $retorno .= '<select name="' . $name . '" id="' . $idShow . '" '.$extra.'>'.PHP_EOL;
        $label = '<label for="' . $idShow . '">' . $label . '</label>'.PHP_EOL;
    }
    else
    {
        $retorno .= '<div><small>'.$label.':</small></div>';
        $retorno .= '<select name="' . $name . '" id="' . $idShow . '" class="browser-default" '.$extra.'>'.PHP_EOL;
        $label = "";
    }

    if (is_array($contenido))
    {
		
        if(empty($selected))
        {
            $retorno .= '<option value="" disabled selected>Seleccionar</option>'.PHP_EOL;
        }		
		
        foreach ($contenido as $id_val => $val) {
            if($selected === $id_val)
            {
                $retorno .= '<option value="' . $id_val . '" selected="">' . $val . '</option>'.PHP_EOL;
            }
            else
            {
                $retorno .= '<option value="' . $id_val . '">' . $val . '</option>'.PHP_EOL;
            }

        }
    }
	elseif (!empty($contenido))
	{
		 if(empty($selected))
        {
            $retorno .= '<option value="" disabled selected>Seleccionar</option>'.PHP_EOL;
        }
		$retorno.=$contenido;
	}
    else
    {
		//$retorno.=$contenido;
		//var_dump($contenido);
        $retorno .= '<option value="" disabled selected>Sin elementos</option>'.PHP_EOL;
    }

    $retorno .= '</select>'.PHP_EOL;
    $retorno .= $label;

    return mat_form($retorno, $envoltura);
}


function mat_slist($c, $a = [])
{
    $i = isset($a["i"]) ? $a["i"] : "id";
    $n = isset($a["n"]) ? $a["n"] : "nombre";
    $o = isset($a["o"]) ? $a["o"] : ""; // Orden
    $d = isset($a["d"]) ? $a["d"] : ""; // Dirección
    $w = isset($a["w"]) ? $a["w"] : ""; // where

    if(empty($w))
    {
        if(empty($o))
        {
            if(empty($d))
            {
                $all = $c::all()->sortBy($n);
            }
            else
            {
                $all = $c::all()->sortByDesc($n);
            }
        }
        else
        {
            if(empty($d))
            {
                $all = $c::all()->sortBy($o);
            }
            else
            {
                $all = $c::all()->sortByDesc($o);
            }
        }
    }
    else
    {
        if(empty($o))
        {
            if(empty($d))
            {
                $all = $c::where($w)->get();
            }
            else
            {
                $all = $c::where($w)->orderBy($n,$d)->get();
            }
        }
        else
        {
            if(empty($d))
            {
                $all = $c::where($w)->orderBy($o)->get();
            }
            else
            {
                $all = $c::where($w)->orderBy($o,$d)->get();
            }
        }
    }


    $retorno = [];

    foreach($all as $ea)
    {
        if(is_array($n))
        {
            $nTmp = "";
            foreach($n as $m)
            {
                $nTmp .= $ea->$m . " ";
            }
            $retorno[$ea->$i] = $nTmp;
        }
        else
        {
            $retorno[$ea->$i] = $ea->$n;
        }
    }

    return $retorno;
}

function camposModelo($modelo)
{
    $camp = json_decode($modelo, true);

    $retorno = [];

    foreach($camp as $cid=>$c)
    {
        $retorno[$cid] = gettype($c);
    }

    return $retorno;
}

function camposClase($clase)
{
    $campos = $clase::all();


    return camposModelo($campos[0]);
}

/**
 * @return string
 *
 * Devuelve los elementos de formularios según los campos de un modelo de eloquent
 */
function camposMaterialize()
{

    $lista = camposModelo();

    $retorno = "";
    foreach($lista as $li)
    {
        if(substr($li,-3) == "_id")
        {
            // asumimos que es un campo FK (foreing Key)
            // lo montamos en un select, de lo contrario usaremos un input
            $retorno .= mat_select(ucfirst(substr($li,0, -3)), $li, [], "col s12 l6").PHP_EOL;

        }
        else
        {
            if($li != "id")
            {
                $retorno .= mat_input(ucfirst($li), $li, ["envoltura" => "col s12 l6"]) . PHP_EOL;
            }
        }
    }

    return $retorno;

}

function collapsible($lista, $datos = [])
{
    /**
     * [
     *  ["titulo","contenido","icono"],
     *  ["titulo","contenido","icono"],
     *  ["titulo","contenido","icono"]
     * ]
     */
    global $b;
    $retorno = "";
    foreach ($lista as $li)
    {
        $cssHeader = isset($datos["cssH"]) ? " " . $datos["cssH"] : "";
        $cssBody = isset($datos["cssB"]) ? " " . $datos["cssB"] : "";

        $retorno .= '<li>';
        $retorno .= isset($li[2]) ? '<div class="collapsible-header'.$cssHeader.'"><i class="material-icons">'.$li[2].'</i>'.$li[0].'</div>' :
            '<div class="collapsible-header'.$cssHeader.'">'.$li[0].'</div>';
        $retorno .= '<div class="collapsible-body'.$cssBody.'"><span>'.$li[1].'</span></div>';
        $retorno .= '</li>';
    }
    return '<ul class="collapsible">'.$retorno.'</ul>';
}

function clasificar($c=0, $a="")
{
    $cl = empty($c) ? 1 : $c;
    $cantidad = 5;
    $simbolo = '<i class="material-icons yellow-text text-darken-3">favorite</i>';
    $inicio = 0;
    if(is_array($a))
    {
        $cantidad = isset($a["cantidad"]) ? $a["cantidad"] : $cantidad;
        $simbolo = isset($a["simbolo"]) ? $a["simbolo"] : $simbolo;
        $inicio = isset($a["inicio"]) ? $a["inicio"] : $inicio;
    }
    $allStar = array_fill($inicio, $cantidad, $simbolo);
    $retorno = "";
    for($clasifica = 5; $clasifica >= 1; $clasifica--)
    {
        $clasi = $cl == $clasifica ? 1 : 0;
        $retorno .= mat_radio(implode("", $allStar), "empresaCalifica",  $clasifica, uniqid(), "with-gap", $clasi);
        array_shift($allStar);
    }
    return $retorno;
}









