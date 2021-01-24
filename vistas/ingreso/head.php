<?php
require_once E_LIB . 'models' . DS . 'usuarios.php';

$parts = ["registro","pass","login"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));

if (!empty($subFileLoad)) {
    include($subFileLoad);
}