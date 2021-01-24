<?php
/**
 * RESOLUCIÓN Y MANEJO DE IDIOMA
 */

// Idiomas disponibles en el sitio
$_SESSION['idiomas'] = array_merge([E_LANG], explode(",", E_LANG_OTROS));


// Cantidad de idiomas disponibles
define("E_IDIOMAS_CANT", count($_SESSION['idiomas']));

// Resolución del idioma de la session
if (isset($_GET['lan'])) {

    // primero pregunto si el valor de $_GET['lan']
    // se encuentra en el arreglo $_SESSION['idiomas']

    if (in_array($_GET['lan'], $_SESSION['idiomas'])) {
        define("E_LAN", $_GET['lan']);
    } else {
        define("E_LAN", E_LANG);
    }
    $_SESSION['lan'] = E_LAN;
} else {
    if (isset($_SESSION['lan'])) {
        define("E_LAN", $_SESSION['lan']);
    } else {
        
		if(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
        {
            $language = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
        }
        else {
            $language = E_LANG;
        }
		
        if (in_array($language, $_SESSION['idiomas'])) {
            define("E_LAN", $language);
        } else {
            define("E_LAN", E_LANG);
        }
        $_SESSION['lan'] = E_LAN;
    }
}

/**
 * Devuelve el nombre del idioma a partir de la clave
 * @param string $idioma
 */
function nombreIdioma($idioma)
{
    $idiomas = [
        "es" => "español",
        "en" => "english",
        "ru" => "pусский",
        "fr" => "français",
        "it" => "italiano",
        "de" => "deutsch",
        "pt" => "portugues"
    ];

    return $idiomas[$idioma];
}

function sinAcento($cadena)
{
    $acentos = ["á","é","í","ó","ú","ä","ë","ï","ö","ü","â","ê","î","ô","û","ñ","Á","É","Í","Ó","Ú","Ä","Ë","Ï","Ö","Ü","Â","Ê","Î","Ô","Û","Ñ"];
    $noAcentos = ["a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","n","A","E","I","O","U","A","E","I","O","U","A","E","I","O","U","N"];
    return str_replace($acentos, $noAcentos, $cadena);
}

function sinEspacio($cadena)
{
    $respuesta = trim($cadena);
    return str_replace(" ", "", $respuesta);
}

/**
 * Toma un array con las varientes según idioma y genera contantes para cada valor
 *
 * EJEMPLO DE ARRAY A INGRESAR
 *		 $textosView = [
 *				"profesores" => ["es"=>'Profesores invitados', "en"=>'Guest profesors'],
 *				"hospedaje" => ["es"=>'Hospedaje', "en"=>'Hodging']
 *			]
 *
 *	Para mostrar el valor correcto según idioma y partiendo del ejemplo anterior,
 *	se llamará a:
 *
 *	L_PROFESORES
 *	L_HOSPEDAJE
 *
 * @param $a
 */
function traduce($a)
{
    if(defined("E_LAN"))
    {
        foreach($a as $tViewId => $tView)
        {
            define("L_".strtoupper($tViewId), $tView[E_LAN]);
        }
    }
    else
    {
        foreach($a as $tViewId => $tView)
        {
            define("L_".strtoupper($tViewId), $tView[E_LANG]);
        }
    }
}


switch(E_LAN){
    case "es":
        setlocale(LC_TIME, 'Spanish');

        // menu
        define("L_MENU_INICIO","Inicio");
        define("L_MENU_SOMOS","Somos");
        define("L_MENU_SERVICIOS","Servicios");
        define("L_MENU_NOTICIAS","Noticias");
        define("L_MENU_CONTACTO","Contacto");

        define("L_BTN_ACEPTAR","Aceptar");
        define("L_BTN_ENVIAR","Enviar");
        define("L_BTN_CANCELAR","Cancelar");
        define("L_BTN_SIGUIENTE","Siguiente");
        define("L_BTN_ANTERIOR","Anterior");
        define("L_BTN_SALIDA","Salir");


        define("L_TEXT_ASISTENCIA","Con la asistencia de");
        define("L_TEXT_LEER_MAS","LEER MAS");

        break;
    case "en":
        setlocale(LC_TIME, 'English');

        // menu
        define("L_MENU_INICIO","Home");
        define("L_MENU_SOMOS","About us");
        define("L_MENU_SERVICIOS","Services");
        define("L_MENU_NOTICIAS","News");
        define("L_MENU_CONTACTO","Contact");

        define("L_BTN_ACEPTAR","Aceptar");
        define("L_BTN_ENVIAR","Enviar");
        define("L_BTN_CANCELAR","Cancelar");
        define("L_BTN_SIGUIENTE","Siguiente");
        define("L_BTN_ANTERIOR","Anterior");
        define("L_BTN_SALIDA","Go out");

        define("L_TEXT_ASISTENCIA","With the assistance of");
        define("L_TEXT_LEER_MAS","READ MORE");

        break;
    default:
        setlocale(LC_TIME, 'Spanish');

        // menu
        define("L_MENU_INICIO","Inicio");
        define("L_MENU_SOMOS","Somos");
        define("L_MENU_SERVICIOS","Servicios");
        define("L_MENU_NOTICIAS","Noticias");
        define("L_MENU_CONTACTO","Contacto");

        define("L_BTN_ACEPTAR","Aceptar");
        define("L_BTN_ENVIAR","Enviar");
        define("L_BTN_CANCELAR","Cancelar");
        define("L_BTN_SIGUIENTE","Siguiente");
        define("L_BTN_ANTERIOR","Anterior");
        define("L_BTN_SALIDA","Salir");


        define("L_TEXT_ASISTENCIA","Con la asistencia de");
        define("L_TEXT_LEER_MAS","LEER MAS");
}
