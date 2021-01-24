<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use PHPMailer\PHPMailer\PHPMailer;

function if_exists($dato, $bol=0)
{
    if($bol===0)
		{
			return isset($dato) && !empty($dato) ? $dato : "";
		}
		else
		{
			return isset($dato) && !empty($dato) ? $dato : FALSE;
		}
}

/**
 *    Crea las entradas para favicons
 *
 * @return string
 */
function favicon()
{
	$retorno = "";
	
	$pic['icon'] = [192,96,32,16];
	$pic['apple'] = [180,152,144,120,114,76,72,60,57];
	$pic['shortcut'] = [65];
	
	foreach($pic as $id=>$pi)
	{
		switch($id)
		{
			case "icon":
				$temp = '<link rel="icon" type="image/png" sizes="%%" href="'.E_URL.'public/img/icons/icon_%%.png" />';
			break;
			case "apple":
				$temp = '<link rel="apple-touch-icon" sizes="%%" href="'.E_URL.'public/img/icons/icon_%%.png" />';
			break;
			case "shortcut":
				$temp = '<link rel="shortcut icon" href="'.E_URL.'/public/img/icons/icon_%%.png" />';
			break;
		}
		
		foreach($pi as $p)
		{
			if(file_exists("public/img/icons/icon_".$p."x".$p.".png"))
			{
				$retorno .= str_replace("%%", $p."x".$p, $temp).PHP_EOL;
			}
		}
	}
	if(file_exists("public/img/icons/icon_192x192.png"))
	{
		$retorno .= '<meta property="og:image" content="'.E_URL.'/public/img/icons/icon_192x192.png">'.PHP_EOL;
		$retorno .= '<meta property="og:type" content="article">'.PHP_EOL;
		$retorno .= '<meta property="og:title" content="'.E_VIEW.'">'.PHP_EOL;
		$retorno .= '<meta property="og:url" content="'.E_URL.E_DOMINIO.'">'.PHP_EOL;
		$retorno .= '<meta property="article:published_time" content="'.E_FECHA.'">'.PHP_EOL;
		$retorno .= '<meta property="article:modified_time" content="'.E_FECHA.'">'.PHP_EOL;
		$retorno .= '<meta property="og:site_name" content="'.E_DOMINIO.'">'.PHP_EOL;
		$retorno .= '<meta property="twitter:card" content="summary">'.PHP_EOL;
	}	
	return $retorno;
}

/**
 * Elimina un directorio con todo su contenido
 *
 * @param $dir
 * @return bool
 */
function borra_directorio($dir)
{
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? borra_directorio("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

/**
 * Verifica si la variable es de tipo numerica o devuelve "null"
 *
 * @param $clave
 * @param $tipo
 * @param $n
 * @return null
 */
function valida_num($clave, $tipo, $n)
{
	if($n === 0)
	{
		return $tipo[$clave];
	}
	
	return is_numeric($tipo[$clave]) ? (float)$tipo[$clave] : null;
}

/**
 * Verifica si determinada variable GET a llegado o devuelve "null"
 *
 * @param $clave
 * @param $num
 * @return null
 */
function isset_get($clave, $num=0)
{
    if (isset($_GET[$clave]) && !empty($_GET[$clave]))
    {
			return valida_num($clave, $_GET, $num);
		}
    return null;
}

/**
 * Verifica si determinada variable POST a llegado o devuelve "null"
 *
 * @param $clave
 * @param $num
 * @return null
 */
function isset_post($clave, $num=0)
{
    if (isset($_POST[$clave]) && !empty($_POST[$clave]))
    {
    	return valida_num($clave, $_POST, $num);
    }
    return null;
}

/**
 * Verifica si determinada variable REQUEST a llegado o devuelve "null"
 *
 * @param $clave
 * @param $num
 * @return null
 */
function isset_request($clave, $num=0)
{
    if (isset($_REQUEST[$clave]) && !empty($_REQUEST[$clave]))
    { 
			return valida_num($clave, $_REQUEST, $num);
		}
    return null;
}

/**
 * @param $clave
 * @return null
 */
function isset_file($clave)
{
    if (isset($_FILES[$clave]) && $_FILES[$clave]["error"]==0) {
        return $_FILES[$clave];
    }
    else
    {
        switch($_FILES[$clave]["error"])
        {
            case 1:
                //UPLOAD_ERR_INI_SIZE
                $retorno = "El fichero subido excede el tamaño autorizado";
                break;
            case 2:
                //UPLOAD_ERR_FORM_SIZE
                $retorno = "El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML";
                break;
            case 3:
                //UPLOAD_ERR_PARTIAL
                $retorno = "El fichero fue sólo parcialmente subido";
                break;
            case 4:
                //UPLOAD_ERR_NO_FILE
                $retorno = "No se subió ningún fichero";
                break;
            case 6:
                //UPLOAD_ERR_NO_TMP_DIR
                $retorno = "Falta la carpeta temporal";
                break;
            case 7:
                //UPLOAD_ERR_CANT_WRITE
                $retorno = "No se pudo escribir el fichero en el disco";
                break;
            case 8:
                // UPLOAD_ERR_EXTENSION
                $retorno = "Una extensión de PHP detuvo la subida de ficheros";
                break;
            default:
                $retorno = "Error desconocido";
        }
        return null;
    }
}

/**
 * devuelve el argumento como valor de las propiedades alt y title para las imagenes
 * sustituye los saltos de línea y los caracteres HTML
 * @param $argumento
 * @return string
 */
function altImg($argumento)
{
    $argumentoNew = strtr($argumento, [
        chr(10) => "",
        chr(13) => ""
    ]);
    $retorno = ' alt="' . htmlentities($argumentoNew, ENT_QUOTES) . '" title="' . htmlentities($argumentoNew, ENT_QUOTES) . '" ';
    return $retorno;
}

/**
 * Añade los enlaces a hojas de estilo
 * @param array $datos nombres de archivos a incluir
 * @return string
 */
function inCSS($datos)
{
    $retorno = "";
    foreach ($datos as $d) {

        //$rutaCss = $d == "materialize" ? 'public/css/sass/' : 'public/css/';
        $rutaCss = 'public/css/';

        if (file_exists($rutaCss . $d . ".min.css"))
        {
            $retorno .= '<link href="'.E_URL . $rutaCss . $d . '.min.css" rel="stylesheet" type="text/css" />' . PHP_EOL;
        }
        else
        {
            if (file_exists($rutaCss . $d . ".css")) {
                $retorno .= '<link href="'.E_URL . $rutaCss . $d . '.css" rel="stylesheet" type="text/css" />' . PHP_EOL;
            }
        }
    }
    return $retorno;
}

/**
 * Añade los enlaces a páginas con codigos javascript
 * @param array $datos "nombres de archivos a incluir
 * @return string
 */
function inJS($datos)
{
    $retorno = "";

    foreach ($datos as $d) {
        if (file_exists("public/js/" . $d . ".min.js")) 
		{
			$retorno .= '<script type="text/javascript" src="'.E_URL.'public/js/' . $d . '.min.js"></script>' . PHP_EOL;
		}
		else
		{
			if (file_exists("public/js/" . $d . ".js")) {
				$retorno .= '<script type="text/javascript" src="'.E_URL.'public/js/' . $d . '.js"></script>' . PHP_EOL;
			}
		}
    }
    return $retorno;
}



/**
 * Evalua un dato y en caso de ser "cero", NULO o vacío no muestra la entrada
 * $flags será un array asociativo que servirá para añadir comportamiento adicional
 * tanto al elemento de la izquierda como al de la derecha
 *
 * $flags['id'] -> agrega un Id al elemento (usado en entidades independientes o únicas ej. imágenes)
 * $flags['idIzq'] -> agrega un Id al miembro de la izquierda
 * $flags['idDer'] -> agrega un Id al miembro de la derecha
 * $flags['class'] -> classe a aplicar (usado en entidades independientes o únicas ej. imágenes)
 * $flags['classIzq'] -> classe para el miembro de la izquierda
 * $flags['classDer'] -> casse para el miembro de la derecha
 * $flags['style'] -> estilo a aplicar (usado en entidades independientes o únicas ej. imágenes)
 * $flags['styleIzq'] -> estilo para el miembro de la izquierda
 * $flags['styleDer'] -> estilo para el miembro de la derecha
 * $flags['onClick'] -> Agrega comportamiento 'onClick' al elemento de la derecha o un elemento individual
 * $flags['onChange'] -> Agrega comportamiento 'onChange' al elemento de la derecha
 *
 * @param $dato
 * @param $valorDato
 * @param string $type
 * @param string $flags
 * @return string
 */
function existeDato($dato, $valorDato, $type = "li", $flags = "")
{
    $id = "";
    $idDer = "";
    $idIzq = "";
    $class = "";
    $classIzq = "";
    $classDer = "";
    $style = "";
    $styleIzq = "";
    $styleDer = "";
    $url = "";
    $onClick = "";

    if (is_array($flags)) {
        // ID
        if (isset($flags['id']) || array_key_exists("id", $flags)) {
            $id = 'id="' . $flags['id'] . '" ';
        }
        if (isset($flags['idDer']) || array_key_exists("idDer", $flags)) {
            $idDer = 'id="' . $flags['idDer'] . '" ';
        }
        if (isset($flags['idIzq']) || array_key_exists("idIzq", $flags)) {
            $idIzq = 'id="' . $flags['idIzq'] . '" ';
        }

        // CLASS
        if (isset($flags['class']) || array_key_exists("class", $flags)) {
            $class = 'class="' . $flags['class'] . '" ';
        }
        if (isset($flags['classIzq']) || array_key_exists("classIzq", $flags)) {
            $classIzq = 'class="' . $flags['classIzq'] . '" ';
        }
        if (isset($flags['classDer']) || array_key_exists("classDer", $flags)) {
            $classDer = 'class="' . $flags['classDer'] . '" ';
        }

        // STYLE
        if (isset($flags['style']) || array_key_exists("style", $flags)) {
            $style = 'style="' . $flags['style'] . '" ';
        }
        if (isset($flags['styleIzq']) || array_key_exists("styleIzq", $flags)) {
            $styleIzq = 'style="' . $flags['styleIzq'] . '" ';
        }
        if (isset($flags['styleDer']) || array_key_exists("styleDer", $flags)) {
            $styleDer = 'style="' . $flags['styleDer'] . '" ';
        }

        // URL
        if (isset($flags['url']) || array_key_exists("url", $flags)) {
            $url = $flags['url'] . '/';
        }

        // ONCLICK
        if (isset($flags['onClick']) || array_key_exists("onClick", $flags)) {
            $onClick = 'onclick="' . $flags['onClick'] . '" ';
        }
    }

    if (!empty($valorDato)) {
        switch ($type) {
            case "texto":
                $retorno = '<span ' . $styleIzq . $classIzq . $idIzq . '>' . $dato .
                    '</span> <span ' . $styleDer . $classDer . $idDer . $onClick . '>' .
                    $valorDato . '</span>'; //.PHP_EOL
                break;
            case "dato":
                $retorno = '<span ' . $styleDer . $classDer . $idDer . $onClick . '>' . $valorDato . '</span>'; //.PHP_EOL
                break;
            case "imagen":
                $retorno = '<img src="' . $url . $valorDato . '" ' . altImg($dato) . ' ' . $style . $class . $id . $onClick . '/>';
                break;
            case "div":
                $retorno = '<div class="nombreDato" ' . $styleIzq . $classIzq . $idIzq . '>' . $dato . '</div>'; //.PHP_EOL
                $retorno .= '<div class="valorDato" ' . $styleDer . $classDer . $idDer . $onClick . '>' . $valorDato . '</div>'; //.PHP_EOL
                $retorno .= '<div class="clear" ></div>'; //.PHP_EOL
                break;
            case "li":
                $retorno = '<li class="noLista nDato" ' . $styleIzq . $classIzq . $idIzq . '>' . $dato . '</li>'; //.PHP_EOL
                $retorno .= '<li class="noLista vDato" ' . $styleDer . $classDer . $idDer . $onClick . '>' . $valorDato . '</li>'; //.PHP_EOL
                break;
            default:
                $retorno = '<div class="nombreDato" ' . $styleIzq . $classIzq . $idIzq . '>' . $dato . '</div>'; //.PHP_EOL
                $retorno .= '<div class="valorDato" ' . $styleDer . $classDer . $idDer . $onClick . '>' . $valorDato . '</div>'; //.PHP_EOL
                $retorno .= '<div class="clear"></div>'; //.PHP_EOL
        }
    } else {
        $retorno = "";
    }

    return $retorno;
}

/**
 * @param array $val
 * @param string $file
 * @param string $comingVal
 * @return string
 */
function loadPart(array $val = [], $file = "main", $comingVal = "a")
{
    $retorno = "";

    if (isset($_REQUEST[$comingVal])) {
        if (in_array($_REQUEST[$comingVal], $val)) {
            if (file_exists(E_VISTAS . E_VIEW . DIRECTORY_SEPARATOR . $_REQUEST[$comingVal] . ucfirst($file) . ".php")) {
                $retorno = E_VISTAS . E_VIEW . DIRECTORY_SEPARATOR . $_REQUEST[$comingVal] . ucfirst($file) . ".php";
            }
        } else {
            if (file_exists(E_VISTAS . E_VIEW . DIRECTORY_SEPARATOR . "default" . ucfirst($file) . ".php")) {
                $retorno = E_VISTAS . E_VIEW . DIRECTORY_SEPARATOR . "default" . ucfirst($file) . ".php";
            }
        }
    } else {
        if (file_exists(E_VISTAS . E_VIEW . DIRECTORY_SEPARATOR . "default" . ucfirst($file) . ".php")) {
            $retorno = E_VISTAS . E_VIEW . DIRECTORY_SEPARATOR . "default" . ucfirst($file) . ".php";
        }
    }

    return $retorno;
}

/**
 * Devuelve si es una solicitud AJAX
 * @return bool
 */
function isAjax()
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        return false;
    }
}

/**
 * Trato de determinar si la cadena ingresada es un JSON válido
 * 
 * @param $str
 * @return bool
 */
function is_json($str)
{
    return is_array(json_decode($str, true));
}

/**
 * Muestra el mensaje de error presente en la sesión
 */
function msgSystem()
{
    if (isset($_SESSION['mensajeSistema'])) {
        if(is_array($_SESSION['mensajeSistema']))
        {
            $mensaje = $_SESSION['mensajeSistema'][0];
            echo '<script type="text/javascript">M.toast({html: \''.$mensaje.'\'})</script>';
        }
        else
        {
            echo '<script type="text/javascript">function cierraMensajeSistema() {$("#mensajeSistema").slideDown("slow", function() {$("#mensajeSistema").delay(4000).slideUp("slow");})}</script>';
            echo '<div id="mensajeSistema" class="oculto cen tipo2 eInt3 tColor3 fColor4">' . $_SESSION['mensajeSistema'] . '</div>';
            echo '<script type="text/javascript">cierraMensajeSistema();</script>';
        }
        unset($_SESSION['mensajeSistema']);
    }
}

/**
 * Cambio de colores exadecimales a RGBa
 * @param $hex
 * @param int $a
 * @param int $t
 * @return array|string
 */
function h2r($hex, $a = 1, $t = 1)
{
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = [$r, $g, $b];

    if ($t == 1) {
        // devuelve un array con los valores RGB
        $retorno = $rgb;
    } else {
        if ($a >= 0 && $a <= 1) {
            // Devuelvo un valor RGBa
            $rgb[3] = $a;
            $retorno = 'rgba(' . implode(",", $rgb) . ')';
        } else {
            // Devuelvo un valor RGB
            $retorno = 'rgb(' . implode(",", $rgb) . ')';
        }
    }

    return $retorno;
}


function migas(array $a = [-1], $clase1="pagina", $clase2="izq eInt10"){

    global $b;
    $respuesta = '<a href="'.E_URL.E_INDEX.'" ><div class="noDiv"  ><i class="tiny material-icons">home</i></div> <span class="tipo4">Inicio</span></a>';

    $ultima = count($a);
    $actual = 0;

    if($a !== [-1])
    {
        foreach($a as $a1=>$a2)
        {
            if(++$actual == $ultima)
            {
                $respuesta .= '<div class="noDiv"  >&nbsp;<i class="tiny material-icons">keyboard_arrow_right</i></div> <span class="tipo4">'.$a2.'</span>';
            }
            else
            {
                $respuesta .= '<div class="noDiv"  >&nbsp;<i class="tiny material-icons">keyboard_arrow_right</i></div><a href="'.E_URL.$a1.'" > <span class="tipo4">'.$a2.'</span></a>';
            }

        }
    }

    $respuesta = $b->blk($respuesta, ["class"=>$clase1]);

    return $b->blk($respuesta, ["class"=>$clase2]);
}



/**
 * Filtra correos de una cadena devolviendolos en un Array
 * @param mixed $cadena
 * @return array 
 */
function filtraCorreos($cadena)
{
	preg_match_all('#([a-z0-9\._-]+@[a-z0-9\._-]+)#is', $cadena, $correos);
	$c = $correos[1];
	if(count($c) > 0)
    {
        return $c;
    }
    else
    {
        return false;
    }
}

/**
 * @param string $textoExito
 * @param string $exito
 * @return string
 *
 * Devuelve un mensaje de éxito en la operación realizada
 */
function salioBien($textoExito = "Los datos fueron procesados correctamente", $exito = "PROCESO EXITOSO")
{
    $retorno = '<div style="padding:50px; text-align:center;">';
    $retorno .= '<h2>' . $exito . '</h2>';
    $retorno .= '<p>' . $textoExito . '</p>';
    $retorno .= '</div>';
    return $retorno;
}

/**
 * @param string $textoError
 * @param $dirCorreo
 * @param string $lamentamos
 * @param string $contacto
 * @return string
 *
 * Devuelve un mensaje de proceso insatisfactorio
 */
function salioMal($textoError = "El proceso solicitado no pudo efectuarse", $dirCorreo = E_CORREO_WEBMASTER, $lamentamos = "HA OCURRIDO UN ERROR", $contacto = "Puede contactarnos en ")
{
    // $lamentamos = "Lo lamentamos"
    // $mensaje1 = "Su mensaje no se ha podido entregar"
    // $mensaje2 = "Le sugerimos nos contacte directamente a través de la siguiente dirección de correo electrónico "
    if (filter_var($dirCorreo, FILTER_VALIDATE_EMAIL) != FALSE) {
        $retorno = '<div style="padding:50px; text-align:center;">';
        $retorno .= '<h2>' . $lamentamos . '</h2>';
        $retorno .= '<p>' . $textoError . '</p>';
        $retorno .= '<p>' . $contacto . ' <a href="mailto:' . $dirCorreo . '">' . $dirCorreo . '</a></p>';
        $retorno .= '</div>';
    } else {
        $retorno = '<div style="padding:100px auto; text-align:center;">';
        $retorno .= '<h2 style="text-align:center">' . $textoError . '</h2>';
        $retorno .= '</div>';
    }
    return $retorno;
}

/**
 * @param $titulo
 * @param string $class
 * @return string
 *
 * Muestra un titular al inicio de la vista
 */
function tBack($titulo, $class="Der mIzq10", $titular="h4")
{
    return '<' . $titular . ' class="'.$class.'">' . $titulo . '</' . $titular . '>';
}

/**
* Comprueba si existe una imagen y en caso de no existir
* devuelve una imagen por defecto
*/
function isImg ($a)
{
    if(file_exists($a))
    {
        return $a;
    }
    else
    {
        return E_URL . 'public/img/noImage.png';
    }
}

/**
 * Envía un correo
 * @param $email
 * @param $mensajeBody
 * @param $subject
 * @return bool
 */
function enviaCorreo($email, $mensajeBody, $subject){
    //
    //  incluir la cadena
    //  use PHPMailer\PHPMailer\PHPMailer;
    //
    $conenv_mail = new PHPMailer();
// Habilitar esta opcion para depurar problemas de conexión
//	$conenv_mail->SMTPDebug = 3;
    $conenv_mail->IsSMTP();
    $conenv_mail->SMTPAuth = true;
    $conenv_mail->SMTPSecure = 'ssl';
    $conenv_mail->isHTML(true);
    $conenv_mail->Host = E_CORREO_SERVIDOR;
    $conenv_mail->Port = E_CORREO_PUERTO;
    $conenv_mail->Username = E_CORREO_USUARIO;
    $conenv_mail->Password = E_CORREO_CLAVE;
    $conenv_mail->CharSet = 'UTF-8';
    $conenv_mail->setFrom(E_CORREO_USUARIO);
    $conenv_mail->addAddress($email);
    $conenv_mail->Subject = $subject;
    $conenv_mail->Body = $mensajeBody;

    if(E_ORIGEN == "remoto"):
        if($conenv_mail->Send())
        {
            //echo '1 correo enviado correctamente';
            return true;
        }
        else
        {
            //echo '1 correo no enviado';
            return false;
        }
    else:
        return true;
    endif;
}

function porciento2($porC,$neto){
    // esta funcion arroja directamente el precio publico
    // a partir del precio neto y el % de utilidad y en formato de decimales
    return number_format($neto/((100-$porC)/100), 2, '.', '');
    //return $neto/((100-$porC)/100);
}
function porciento($porC,$neto){
    //return ($porC*$neto)/100;
    return ($porC/100)*$neto;
}
function quePorciento($neto,$bruto){
    //return ($porC*$neto)/100;
    return ($neto * 100)/$bruto;
}


function mmPrin($m, $d="h")
{
    
/*    $menuPrincipal = [
//        "inversiones_admin"=>[
//            "i"=>"star",
//            "n"=>"Inversiones",
//            "c"=>[
//                "ingresos" => [
//                    "i"=>"call_received",
//                    "n"=>"Ingresos"
//                ],
//                "egresos" => [
//                    "i"=>"call_made",
//                    "n"=>"Egresos"
//                ],
//                "bancos"=>[
//                    "i"=>"casino",
//                    "n"=>"Bancos",
//                    "l"=>"bancos"
//                ],
//                "cuentas"=>[
//                    "i"=>"attach_money",
//                    "n"=>"Cuentas",
//                    "l"=>"bancos/cuentas"
//                ],
//				  "u" => [1]
//            ],
//			  "u" => [1,2]
//        ],
//        "movimientos_admin"=>[
//            "i"=>"star",
//            "n"=>"Movimientos",
//            "c"=>[
//                "cobros"=>[
//                    "i"=>"star",
//                    "n"=>"Cobros"
//                ],
//                "pagos"=>[
//                    "i"=>"star",
//                    "n"=>"Pagos"
//                ]
//            ]
//        ],
//        "rendimiento_admin"=>[
//            "i"=>"star",
//            "n"=>"Rendimiento"
//        ],
//        "noticias_admin"=>[
//            "i"=>"star",
//            "n"=>"Noticias",
//            "c"=>[
//                "noticias"=>[
//                    "i"=>"star",
//                    "n"=>"Noticias"
//                ],
//                "temas"=>[
//                    "i"=>"star",
//                    "n"=>"Temas"
//                ]
//            ]
//        ],
//        "usuarios"=>[
//            "i"=>"account_circle",
//            "n"=>"Usuarios"
//        ],
//        "salir"=>[
//            "i"=>"star",
//            "n"=>"Salir"
//        ]
//    ];
*/	
	
	global $b;
	global $userTipo;
    $mm_prin = "";

	/**
     *      $d -> define si el menú será mostrado verticalmente u horizontalmente
     *      v: vertical
     *      h: horizaontal
     */
    if($d=="v")
    {
        foreach($m as $MM_id=>$MM_val)
        {
            if(isset($MM_val["u"]))
            {
                if (in_array($userTipo, $MM_val["u"]))
                {
                    if (isset($MM_val["c"])) {
                        $sbMenu = "";
                        foreach ($MM_val["c"] as $i => $v)
                        {
                            if(isset($v["u"]))
                            {
                                if (in_array($userTipo, $v["u"]))
                                {
                                    if (isset($v["l"])) {
                                        $sbMenu .= '<li><a href="' . E_URL . $v["l"] . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                    }
                                    else
                                    {
                                        $sbMenu .= '<li><a href="' . E_URL . $MM_id . "/" . $i . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                    }
                                }
                            }
                            else
                            {
                                if (isset($v["l"]))
                                {
                                    $sbMenu .= '<li><a href="' . E_URL . $v["l"] . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                }
                                else
                                {
                                    $sbMenu .= '<li><a href="' . E_URL . $MM_id . "/" . $i . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                }
                            }
                        }

                        $sbMenu = $b->blk($sbMenu, ["id" => "dl" . ucfirst($MM_id)], "ul");

                        $mm_prin .= '<li>' . $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq"], "a") . '</li>';
                        $mm_prin .= $b->blk($sbMenu, [], "li");
                    }
                    else
                    {
                        $mm_prin .= '<li>' . $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq mAbajo", "href" => E_URL . $MM_id], "a") . '</li>';
                        $mm_prin .= "<br />";
                    }
                }
            }
            else
            {
                if (isset($MM_val["c"])) {
                    $sbMenu = "";
                    foreach ($MM_val["c"] as $i => $v) {
                        if (isset($v["l"])) {
                            $sbMenu .= '<li><a href="' . E_URL . $v["l"] . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                        } else {
                            $sbMenu .= '<li><a href="' . E_URL . $MM_id . "/" . $i . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                        }
                    }

                    $sbMenu = $b->blk($sbMenu, ["id" => "dl" . ucfirst($MM_id)], "ul");

                    $mm_prin .= '<li>' . $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq"], "a") . '</li>';
                    $mm_prin .= $b->blk($sbMenu, [], "li");
                } else {
                    $mm_prin .= '<li>' . $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq mAbajo", "href" => E_URL . $MM_id], "a") . '</li>';
                    $mm_prin .= "<br />";
                }
            }
        }
    }
    else
    {
        foreach($m as $MM_id=>$MM_val)
        {
            if(isset($MM_val["u"]))
            {
                if(in_array($userTipo, $MM_val["u"]))
                {
                    if (isset($MM_val["c"])) {
                        $sbMenu = "";
                        foreach ($MM_val["c"] as $i => $v)
                        {
                            if(isset($v["u"]))
                            {
                                if(in_array($userTipo, $v["u"]))
                                {
                                    if (isset($v["l"])) {
                                        $sbMenu .= '<li><a href="' . E_URL . $v["l"] . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                    } else {
                                        $sbMenu .= '<li><a href="' . E_URL . $MM_id . "/" . $i . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                    }
                                }
                            }
                            else
                            {
                                if (isset($v["l"])) {
                                    $sbMenu .= '<li><a href="' . E_URL . $v["l"] . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                } else {
                                    $sbMenu .= '<li><a href="' . E_URL . $MM_id . "/" . $i . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                }
                            }

                        }

                        $dataTarget = "dd" . ucfirst($MM_id);

                        echo $b->blk($sbMenu, ["id" => $dataTarget, "class" => "dropdown-content"], "ul");

                        $mm_prin .= $b->blk($MM_val["n"], ["class" => "dropdown-trigger btn btn-small mIzq mAbajo10", "data-target" => $dataTarget], "a");
                    } else {
                        $mm_prin .= $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq", "href" => E_URL . $MM_id], "a");
                    }
                }
            }
            else
            {
                if(isset($MM_val["c"]))
                {
                    $sbMenu = "";
                    foreach($MM_val["c"] as $i => $v)
                    {
                        if(isset($v["l"]))
                        {
                            $sbMenu .= '<li><a href="'.E_URL.$v["l"].'">'.$v["n"].'</a></li>'.PHP_EOL;
                        }
                        else
                        {
                            $sbMenu .= '<li><a href="'.E_URL.$MM_id."/".$i.'">'.$v["n"].'</a></li>'.PHP_EOL;
                        }
                    }

                    $dataTarget = "dd".ucfirst($MM_id);

                    echo $b->blk($sbMenu, ["id"=>$dataTarget, "class"=>"dropdown-content"],"ul");

                    $mm_prin .= $b->blk($MM_val["n"], ["class"=>"dropdown-trigger btn btn-small mIzq mAbajo10", "data-target"=>$dataTarget], "a");
                }
                else
                {
                    $mm_prin .= $b->blk($MM_val["n"], ["class"=>"btn btn-small mIzq mAbajo10", "href"=>E_URL.$MM_id], "a");
                }
            }
        }
    }

    return $mm_prin;
}

function redondea($v,$decimales = 10){
    // valores de $decimales
    // 1 ... Se redondea hacia arriba hasta el próximo valor entero
    // -1 ... Se redondea hacia abajo hasta el próximo valor entero
    // 10 ... Se redondea hacia arriba al próximo múltiplo de 10
    //100 ... Se redondea hacia arriba con dos lugares decimales

    switch($decimales){
        case 10:
            $retorno = (ceil($v/10))*10;
            break;
        case 100:
            $retorno = (ceil($v * 100)) / 100;
            break;
        case 1:
            $retorno = ceil($v);
            break;
        case -1:
            $retorno = floor($v);
            break;
        default:
            $retorno = round($v);
    }
    return $retorno;
}


function validaVar($r, $modelo = "", $metodo="post", $url = E_URL . E_VIEW)
{ // $reqId=>$reqVal
    foreach($r as $v)
    {
        /**
         *      $v[0] => indice tomado del nombre de campo en la DB
         *      $v[1] => cadena con error que se va a mostrar
         *      $v[2] => indice a usar en vez del nombre de campo $v[0]
         */
        $indice = isset($v[2]) ? $v[2] : $v[0];
        $tmpName = $metodo == "post" ? isset_post($indice) : isset_get($indice);
        if($tmpName)
        {echo $v[0]." -- " . $tmpName;
            if(is_array($modelo))
            {
                $modelo[$v[0]] = $tmpName;
            }
            else
            {
                $tteem = $v[0];
                $modelo->$tteem = $tmpName;
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Debe indicar ".$v[2];
            header("Location:" . $url);
            exit();
        }
    }
    return $modelo;
}

/**
 * Genera cadena aleatoria que puede usarse como contraseña
 * @param int $largo
 * @param int $complejidad
 * @return string
 */
function genPass($largo=10, $complejidad=2)
{
    $pass = "";

    switch ($complejidad)
    {
        case 1:
            $caracteres = str_split('abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ012346789!$%&/()=?¿*-+^{}[]¨@ç_¡');
            break;
        case 2:
            $caracteres = str_split('abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ012346789');
            break;
        default:
            $caracteres = str_split('abcdefghijkmnpqrtuvwxyz012346789');
    }

    for ($i=0; $i<$largo; $i++)
    {
        $randPos = array_rand($caracteres);
        $pass .= $caracteres[$randPos];
    }
    return $pass;
}

/**
 * Genera automáticamente un nombre de usuario y su contraseña para crear un nuevo usuario
 * @param $nombre
 * @param $apellido
 * @param string $dom
 * @return array
 */
function genUser($nombre, $apellido, $dom = E_DOM_CORREO)
{
    /**
     * Creamos el nuevo usuario
     * Será un usuario con correo artificial
     * lo primero será crear dicho correo
     */
    $preCorreo = strtolower(substr(sinEspacio(sinAcento($nombre)), 0,1) . sinEspacio(sinAcento($apellido)));
    $posCorreo = "@" . $dom;

    /**
     * Formo el correo que comprobaré
     */
    $pruebaUsuarioCredenciales = [
        'email' => $preCorreo . $posCorreo,
        'password' => genPass(8)
    ];

    $credencialesAprobadas = 0;
    $credencialesVueltas = 1;

    /**
     * Inicio un ciclo que no se detendrá hasta tener un valor aprobado para correo
     */
    while($credencialesAprobadas == 0)
    {
        if(Sentinel::validForCreation($pruebaUsuarioCredenciales))
        {
            $credencialesAprobadas++;
            $newUserNick = $preCorreo;
        }
        else
        {
            $credencialesVueltas++;
            $newUserNick = $preCorreo . $credencialesVueltas;
            $pruebaUsuarioCredenciales['email'] = $newUserNick . $posCorreo;
        }
    }

    return ["email"=>$pruebaUsuarioCredenciales['email'], "password"=>$pruebaUsuarioCredenciales['password'], "nick"=>$newUserNick];
}

function msgPass($nom, $ape, $cor, $nic, $pas)
{
    $mensajeUsuarioBody = '<div style="text-align: center;"><h3>' . $nom . " " . $ape . '</h3>';
    $mensajeUsuarioBody .= '<p>Le damos la bienvenida a ' . E_DOMINIO . '</p>';
    $mensajeUsuarioBody .= '<p>Sus credenciales de acceso son:</p>';
    $mensajeUsuarioBody .= '<ul>';
    $mensajeUsuarioBody .= '<li>Usuario: ' . $nic . '</li>';
    $mensajeUsuarioBody .= '<li>Contraseña: ' . $pas . '</li>';
    $mensajeUsuarioBody .= '</ul>';
    $mensajeUsuarioBody .= '</div>';

    if(enviaCorreo($cor, $mensajeUsuarioBody, "Le damos la bienvenida a ".E_DOMINIO))
    {
        if(E_ORIGEN == "local")
        {
            $_SESSION['mensajeSistema'] = "Proceso exitoso: User: " . $nic. " - Pass: " . $pas;
        }
        else
        {
            $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
        }

        return true;
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Las credenciales de usuario no pudieron enviarse.";

        return false;
    }
}

function rtext($texto, $largo=200)
{
    $retorno = substr($texto, 0, $largo);
    return $retorno . " ...";
}



///**
// * @param array $padresActivos
// * @param $nomPadreIndice
// * @param $claseOperar
// *
// * En la geolocalización
// * Devuelve los hijos de padres activos
// * Pais->Provincia->Municipio->Zona
// */
//function activosGeo(array $padresActivos, $nomPadreIndice, $claseOperar )
//{
//    //ty($claseOperar::class);
//
//    $a = [];
//    foreach($padresActivos as $act)
//    {
//        $aTemp = $claseOperar::where($nomPadreIndice, $act->id)->get();
//
//        foreach($aTemp as $bTemp)
//        {
//            $a[$bTemp->id] = $bTemp->nombre;
//        }
//    }
//
//}

