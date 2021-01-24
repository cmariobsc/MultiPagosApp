<?php
require_once E_VISTAS . "bancos_admin" . DS . "models.php";
require_once ("models.php");

$redesSociales = [
    "Facebook"=>"Facebook",
    "Instagram"=>"Instagram",
    "Twitter"=>"Twitter",
    "YouTube"=>"YouTube",
    "Pinterest"=>"Pinterest"
];

// ,"select","update", "updateSede", "updateContacto","updateNewSede","newSedeSelect","newContacto"
$parts = ["new","select","tipos", "newTipo", "newContacto", "newSede", "update", "updateTipo",
    "updateSede", "updateContacto", "acreditaciones", "acreditar", "resetPass"];
$subFileLoad= loadPart($parts, basename(__FILE__,".php"));
if(!empty($subFileLoad)){include ($subFileLoad);}