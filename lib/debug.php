<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * email: elapez@gmail.com
 * Date: 1/12/2018
 * Time: 12:33 AM
 */


/**
 * Genera un texto aleatorio en latin
 * @param int $min
 * @param int $max
 * @return string
 */
function loren($min = 20, $max = 50)
{
    $palabras = ['a', 'ac', 'accumsan', 'ad', 'adipiscing', 'aliquam', 'am', 'amet', 'ante', 'aptent', 'at', 'augue', 'commodo', 'condimentum', 'consectetuer', 'consequat', 'conubia', 'dapibus', 'dictum', 'dictumst', 'dignissim', 'dolor', 'dui', 'ed', 'eget', 'eleifend', 'elit', 'erat', 'eros', 'estibulum', 'et', 'eu', 'facilisis', 'faucibus', 'feugiat', 'habitasse', 'hac', 'himenaeos', 'iaculis', 'id', 'imperdiet', 'in', 'inceptos', 'ipsum', 'justo', 'lacus', 'lass', 'lectus', 'leo', 'libero', 'ligula', 'liquam', 'litora', 'lobortis', 'lorem', 'magna', 'massa', 'mattis', 'mauris', 'metus', 'mi', 'mollis', 'n', 'nec', 'neque', 'nibh', 'nisl', 'non', 'nostra', 'nunc', 'odio', 'onec', 'orbi', 'orci', 'orem', 'pede', 'pellentesque', 'per', 'placerat', 'platea', 'porttitor', 'pretium', 'purus', 'quam', 'quis', 'raesent', 'ras', 'risus', 'roin', 'rutrum', 'sagittis', 'sed', 'semper', 'sit', 'sociosqu', 'sodales', 'sollicitudin', 'taciti', 'tempus', 'tiam', 'tincidunt', 'torquent', 'tortor', 'uisque', 'ulla', 'ullam', 'unc', 'uspendisse', 'ut', 'vestibulum', 'vitae', 'viverra', 'volutpat', 'vulputate'];
    $total_palabras = count($palabras);
    $generar_palabras = mt_rand($min, $max);
    $salida = array();

    for ($i = 0; $i < $generar_palabras; $i++) {
        $salida[] = $palabras[mt_rand(0, $total_palabras - 1)];
    }

    $salida[0] = ucfirst($salida[0]);
    return implode(' ', $salida);
}

/**
 * Función usada sólo para debug
 * Devuelve el valor de una variable dada o una marca de tiempo
 * @param mixed $a
 */
function ty($a="",$salir=true)
{
    echo empty($a) ? time() : var_dump($a);
    echo PHP_EOL;
    if($salir)
    {
        exit();
    }
}

/**
 * Identifica y muestra las variables globales
 * @param string $var
 */
function request($var="post")
{
    $revisar = ["post"=>$_POST, "get"=>$_GET, "request"=>$_REQUEST, "cookie"=>$_COOKIE, "session"=>$_SESSION, "server"=>$_SERVER];

    if(is_array($var))
    {
        foreach($var as $v)
        {
            if(array_key_exists($v, $revisar))
            {
                foreach($revisar[$v] as $rid => $rval)
                {
                    if(is_array($rval))
                    {
                        echo $rid . " ---> " . var_dump($rval) . "<br />" . PHP_EOL;
                    }
                    else
                    {
                        echo $rid . " ---> " . $rval . "<br />" . PHP_EOL;
                    }
                }
            }
        }
    }
    else
    {
        if(array_key_exists($var, $revisar))
        {
            foreach($revisar[$var] as $rid => $rval)
            {
                if(is_array($rval))
                {
                    echo $rid . " ---> " . var_dump($rval) . "<br />" . PHP_EOL;
                }
                else
                {
                    echo $rid . " ---> " . $rval . "<br />" . PHP_EOL;
                }
            }
        }
    }

    exit();
}




//function logger() {
//
//    /**
//     *  Añadir //$capsule::connection()->enableQueryLog();
//     *  Antes de llamar la función
//     */
//
//    $queries = \Illuminate\Database\Capsule\Manager::getQueryLog();
//    $formattedQueries = [];
//    foreach( $queries as $query ) :
//        $prep = $query['query'];
//        foreach( $query['bindings'] as $binding ) :
//            $prep = preg_replace("#\?#", $binding, $prep, 1);
//        endforeach;
//        $formattedQueries[] = $prep;
//    endforeach;
//    return $formattedQueries;
//}