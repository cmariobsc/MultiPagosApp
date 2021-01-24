<?php
require_once E_LIB . 'models' . DS . 'vistas.php';
require_once E_LIB . 'models' . DS . 'contenidos.php';


$parts = ["new", "select", "update", "delete", "crear"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {
    include($subFileLoad);
}
