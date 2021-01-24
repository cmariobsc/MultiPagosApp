<?php
/**
 * Created by PhpStorm.
 * User: elapez@gmail.com
 * Date: 1/12/2018
 * Time: 6:46 PM
 *
 * Parámetros de conexión a la DB
 */
//---------------------------------<BASES DE DATOS>--------------------------------------
define('E_DB_HST', 'localhost');

//$prot = explode("/", $_SERVER['SERVER_PROTOCOL']);
$rutt = explode("/", $_SERVER['REQUEST_URI']);

if ($_SERVER['SERVER_NAME'] == "127.0.0.1" || strtolower($_SERVER['SERVER_NAME']) == "localhost" ||  substr($_SERVER['SERVER_NAME'],0,7)=="192.168")
{
    /**
     * CONEXIÓN LOCAL
     */
    error_reporting(E_ALL);
    //ini_set("error_reporting", E_ALL);

    define("E_DB_NAM", "lx_multipagos");
    define("E_DB_USR", "root");
    define("E_DB_PWD", "cmario1989");

    define("E_DB_NAM2", "lx_multipagos");
    define("E_DB_USR2", "root");
    define("E_DB_PWD2", "cmario1989");

    define("E_ORIGEN", "local");
    //define("E_URL", strtolower($prot[0] . "://" . E_DOMINIO . "/" . $rutt[1] . "/" . $rutt[2] ."/"));
	define("E_URL", strtolower("http://" . E_DOMINIO . "/" . $rutt[1] . "/" . $rutt[2] ."/"));
}
else
{
    /**
     * CONEXIÓNES REMOTA (PRODUCCIÓN)
     */
    define("E_DB_NAM", "mesopotamia");
    define("E_DB_USR", "mANOLITO");
    define("E_DB_PWD", "bGjn_+diT2%H6D)(yn");

    define("E_DB_NAM2", "mesopotamia");
    define("E_DB_USR2", "miGuelit0");
    define("E_DB_PWD2", "bGjnH7tTw2%H6D.?yn");

    define("E_ORIGEN", "remoto");
    //define("E_URL", strtolower($prot[0] . "://" . E_DOMINIO  . "/"));
	define("E_URL", strtolower("https://" . E_DOMINIO  . "/"));
}

//unset($prot);
unset($rutt);


