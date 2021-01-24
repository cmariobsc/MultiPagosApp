<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

//Importamos el archivo autoload.php presente en nuestro directorio vendor
require E_RAIZ . "vendor/autoload.php";


// Para consultas directas a la base
$mysqli = new mysqli(E_DB_HST, E_DB_USR, E_DB_PWD, E_DB_NAM);

if ($mysqli->connect_errno) {
    echo "Ha sido imposible conectar a las base de datos, Inténtelo mas tarde";
    exit();
}

$mysqli->set_charset("utf8");

/**
 * Creamos la instancia que albergará Eloquent ORM
 */
$capsule = new Capsule;

/**
 * Creamos conector a la DB
 */
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => E_DB_HST,
	'port' => 3306,
    'database' => E_DB_NAM,
    'username' => E_DB_USR,
    'password' => E_DB_PWD,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);

/**
 * iniciamos Sentinel para la total gestión de usuarios y permisos
 */
$sentinel = new Sentinel();

/**
 * Para añadir más de una conexión a eloquentORM, se usa el mismo método "addConnection"
 * pero pasándole como segundo parámetro el nombre que identificará la nueva conexión
 * Si el segundo parámetro no es incluido, eloquent asumirá que es la conexión por defecto
 */

 $capsule->addConnection([
    'driver' => 'mysql',
    'host' => E_DB_HST,
    'port' => 3306,
    'database' => E_DB_NAM2,
    'username' => E_DB_USR2,
    'password' => E_DB_PWD2,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
 ], "segura");

 /**
 * Iniciamos Eloquent ORM
 */
$capsule->setAsGlobal();
$capsule->bootEloquent();