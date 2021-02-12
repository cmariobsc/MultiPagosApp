<?php

$Routes = array();

/**
 * RESOLUCIÓN DE NOMBRE DE DOMINIO
 */
if (isset($_SESSION['nombreDominio'])) {
    define("E_DOMINIO", $_SESSION['nombreDominio']);
} else {
    if (strtoupper(substr($_SERVER['SERVER_NAME'], 0, 3)) == "WWW" && substr($_SERVER['SERVER_NAME'], 3, 1) == ".") {
        define("E_DOMINIO", strtolower(substr($_SERVER['SERVER_NAME'], 4)));
    } else {
        define("E_DOMINIO", strtolower($_SERVER['SERVER_NAME']));
    }

    $_SESSION['nombreDominio'] = E_DOMINIO;
}


/**
 * Esta funcion devuelve un array con los nombres de archivos existentes en una carpeta
 * se excluyen los tipos "." ".." así como los archivos que inicien con "_"
 * La variable $decide sirve para decidir si el arreglo resultante de esta función
 * debe incluir o no las extensiones del parámetro "$extensiones"
 *
 * @param $carpeta
 * @param string $decide
 * @param array $extensiones
 * @return array
 */
function listaDir($carpeta, $decide = "excluye", $extensiones = ["htm", "html"])
{
    $resultado = [];

    // Prefijos excluidos
    // Esto elmiminará del resultado, elementos que inicien con ".","_"
    $prefijos = [".", "_"];

    if (is_dir($carpeta)) {
        if ($gestor = opendir($carpeta)) {

            // El ciclo que sige devuelve uno a uno el nombre de los elementos de la carpeta
            // hasta que no encuentra nuevo elemento y entonces devuelve falso
            // por este motivo la condicional es "!== false" en vez de "=== true"
            while (($miembro = readdir($gestor)) !== false) {

                // reviso si el elemento de directorio no cuenta con un prefijo de exclusión
                if (!in_array(substr($miembro, 0, 1), $prefijos)) {

                    // leo la extensión del archivo evaluado en la iteración
                    $om = substr(strrchr(strtolower($miembro), "."), 1);

                    // Determino que elementos serán incluidos
                    switch ($decide) {
                        case "excluye":
                            // se excluirán los archivos de las extensiones presentes en "$extensiones"
                            // si las extensión $om [NO ESTÁ] en el arreglo de estensiones
                            if (!in_array($om, $extensiones)) {
                                array_push($resultado, $miembro);
                            }
                            break;
                        case "incluye":
                            // Sólo se incluirán los archivos con extensiones en "$extensiones"
                            // si las extensión $om [ESTÁ] en el arreglo de estensiones
                            if (in_array($om, $extensiones)) {
                                array_push($resultado, $miembro);
                            }
                            break;
                        case "dir":
                            // si el elemento a evaluar es una carpeta
                            if (is_dir($carpeta . DIRECTORY_SEPARATOR . $miembro)) {
                                array_push($resultado, $miembro);
                            }
                            break;
                        case "file":
                            // si el elemento a evaluar es un archivo
                            if (is_file($carpeta . DIRECTORY_SEPARATOR . $miembro)) {
                                array_push($resultado, $miembro);
                            }
                            break;
                        default:
                            // se incluirán todos los archivos
                            array_push($resultado, $miembro);
                    }
                }
            }

            closedir($gestor);
        }
    }
    return $resultado;
}

