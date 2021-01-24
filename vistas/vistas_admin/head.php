<?php
require_once E_LIB . 'models' . DS . 'vistas.php';


$parts = ["new", "select", "update", "delete", "local", "localUpdate"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {
    include($subFileLoad);
}
