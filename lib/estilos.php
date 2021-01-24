<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 1/13/2018
 * Time: 1:01 AM
 */

// Colores del sitio
// Atención a que el array inicia en 1,
// para hacerlo coincidir luego con los estilos CSS a generar
$_SESSION['colores'][1] = '#76FF03';        // light-green accent-3
$_SESSION['colores'][2] = '#039BE5';        // indigo accent-4
$_SESSION['colores'][3] = '#FFF';           // white
$_SESSION['colores'][4] = '#424242';        // grey-text text-darken-3
$_SESSION['colores'][5] = '#33691E';        // light-green darken-4
$_SESSION['colores'][6] = '#E53935';        // red darken-1
$_SESSION['colores'][7] = '#FDD835';        // yellow darken-1

$_SESSION['rgba'] = [
    1 => h2r($_SESSION['colores'][1], .5),
    h2r($_SESSION['colores'][2], .5),
    h2r($_SESSION['colores'][3], .5),
    h2r($_SESSION['colores'][4], .5),
    h2r($_SESSION['colores'][5], .5),
    h2r($_SESSION['colores'][6], .5),
    h2r($_SESSION['colores'][7], .5)
];


/**
 * @param array $colores
 * @return string
 */
function coloresApp(array $colores = [1 => "#006A9E", "#06853F", "#FFF", "#80B5CF", "#CEA822", "#E53935", "#FDD835"])
{
    //$estilo = '<style type="text/css">';
    $estilo = "";
    $reglas = ["tColor", "fColor", "bColor"];
    foreach ($reglas as $regla) {
        switch ($regla) {
            case "fColor":
                $c = "background-color";
                break;
            case "bColor":
                $c = "border-color";
                break;
            default:
                $c = "color";
        }

        foreach ($colores as $n => $col)
        {
            $estilo .= '.' . $regla . $n . ' {' . $c . ':' . $col . ';}';
        }

    }

    foreach ($colores as $n => $col)
    {
        $tono = h2r($_SESSION['colores'][$n]);
        $estilo .= '.' . "ftColor" . $n . ' {background-color: rgba(' . $tono[0] . ',' . $tono[1] . ',' . $tono[2] .', .5);}';
    }


    //$estilo .=  "</style>".PHP_EOL;
    return $estilo;
}


/**
 * $direccion es:
 * 1 - De arriba hacia abajo
 * 2 - De derecha a izquierda
 * 3 - De abajo a arriba
 * 4 - De izquierda a Derecha
 *
 * El Arreglo de colores tiene que incluir como indice el color y como valor el valor porcentual de la parada
 *
 * EJEMPLO
 * $coloresFondoGeneral = array(array("#003A6D",0),array("rgba(255,255,255,.5)",25px),array("#1BE5E2",50%));
 * echo gradienteCSS("gradienteGeneral",$coloresFondoGeneral);
 *
 * @param $nombreClase
 * @param $coloresArreglo
 * @param int $direccion
 * @param int $fondoPorDefecto
 * @return string
 */
function gradienteCSS($nombreClase, $coloresArreglo, $direccion = 1, $fondoPorDefecto = 2)
{
    $preCadena = "";
    $preCadenaWebKit = "";
    $countColorIni = 1;

    foreach ($coloresArreglo as $cArr) {
        if ($countColorIni == 1) {
            $colorInicio = $cArr[0];
            $countColorIni++;
        }

        $preCadena .= $cArr[0] . ' ' . $cArr[1] . ',';
        $preCadenaWebKit .= 'color-stop(' . $cArr[1] . ',' . $cArr[0] . '),';
    }
    $colorFinal = $cArr[0];

    unset($countColorIni);
    unset($cArr);

    $cadena = substr($preCadena, 0, -1) . ");";
    $cadenaWebKit = substr($preCadenaWebKit, 0, -1) . ');';

    switch ($fondoPorDefecto) {
        case 1:
            $colorDeFondo = $colorInicio;
            break;
        case 2:
            $colorDeFondo = $colorFinal;
            break;
        default:
            $colorDeFondo = $fondoPorDefecto;
    }

    if (!empty($nombreClase)) {
        $claseAbre = '.' . $nombreClase . '{' . PHP_EOL;
        $claseCierra = '}' . PHP_EOL;
    } else {
        $claseAbre = "";
        $claseCierra = "";
    }

    $retorno = "";
    $retorno .= $claseAbre;
    $retorno .= 'background: ' . $colorDeFondo . ';' . PHP_EOL;

    switch ($direccion) {
        case 1:
            $direccionMoz = "top";
            $direccionWebkit1 = "left top, left bottom";
            $direccionOtros = "top";
            $direccionAcme = "to bottom";
            break;

        case 2:
            $direccionMoz = "right";
            $direccionWebkit1 = "right top, left top";
            $direccionOtros = "right";
            $direccionAcme = "to left";
            break;

        case 3:
            $direccionMoz = "bottom";
            $direccionWebkit1 = "left bottom, left top";
            $direccionOtros = "bottom";
            $direccionAcme = "to top";
            break;

        case 4:
            $direccionMoz = "left";
            $direccionWebkit1 = "left top, right top";
            $direccionOtros = "left";
            $direccionAcme = "to right";
            break;

        default:
            $direccionMoz = "top";
            $direccionWebkit1 = "left top, left bottom";
            $direccionOtros = "top";
            $direccionAcme = "to bottom";
    }

    $retorno .= 'background: -moz-linear-gradient(' . $direccionMoz . ', ' . $cadena . PHP_EOL;
    $retorno .= 'background: -webkit-gradient(linear, ' . $direccionWebkit1 . ', ' . $cadenaWebKit . PHP_EOL;
    $retorno .= 'background: -webkit-linear-gradient(' . $direccionOtros . ', ' . $cadena . PHP_EOL;
    $retorno .= 'background: -o-linear-gradient(' . $direccionOtros . ',  ' . $cadena . PHP_EOL;
    $retorno .= 'background: -ms-linear-gradient(' . $direccionOtros . ', ' . $cadena . PHP_EOL;
    $retorno .= 'background: linear-gradient(' . $direccionAcme . ', ' . $cadena . PHP_EOL;
    $retorno .= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $colorInicio .
        '\', endColorstr=\'' . $colorFinal . '\',GradientType=0 );' . PHP_EOL;
    $retorno .= $claseCierra;
    return $retorno;
}

/**
 * Se generarán dos tipos de clases que dan formato a columnas:
 * fundamentalmente basados en el ancho de las mismas
 * .[Nombre de columna] -> para columnas simples
 * .[Nombre de columna]H -> para encabezados de columnas
 *
 * @param string $nombreClass
 * @param int $cantColumnas
 * @param string $classAplicar
 * @param string $styleAplicar
 * @param string $classAplicarH
 * @param string $styleAplicarH
 * @return string
 */
function cols($nombreClass = "col", $cantColumnas = 16, $classAplicar = "", $styleAplicar = "", $classAplicarH = "", $styleAplicarH = "")
{
    $anchoOriginal = floor(100 / $cantColumnas);
    $ancho = $anchoOriginal;
    $retorno = "";
    for ($i = 1; $i <= $cantColumnas; $i++) {
        $retorno .= '.' . $nombreClass . $i . ', .' . $nombreClass . 'H' . $i . '{width:' . $ancho . '%; overflow:hidden; ' . $styleAplicar . '}';
        $retorno .= '.' . $nombreClass . 'H' . $i . '{text-align:center; padding:.3em 0; ' . $styleAplicarH . '}';
        $ancho += $anchoOriginal;
    }

    return $retorno;
}

function cNom($val)
{
    return strtoupper(E_VIEW). "_" .$val;
}
