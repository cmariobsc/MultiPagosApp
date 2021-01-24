<?php

$parts = ["new", "select", "update", "delete", "resetPass"];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {
    include($subFileLoad);
}