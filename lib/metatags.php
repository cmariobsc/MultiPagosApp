<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: grupomodo.com
 * Date: 5/24/2018
 * Time: 7:07 PM
 */
?>
<meta name="MobileOptimized" content="width" />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="author" content="elapez@gmail.com">


<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">


<?php

if(!empty($vistaActual->claves))
{
    echo '<meta name="keywords" content="'.$vistaActual->claves.'">'.PHP_EOL;
}
else
{
    echo  defined("E_KEYWORDS") ? '<meta name="keywords" content="'.E_KEYWORDS.'">'.PHP_EOL : "";
}

if(!empty($vistaActual->describir))
{
    echo '<meta name="description" content="'.$vistaActual->describir.'">'.PHP_EOL;
}
else
{
    echo defined(E_DESCRIPTION) ? '<meta name="description" content="'.E_DESCRIPTION.'">'.PHP_EOL : "";
}

