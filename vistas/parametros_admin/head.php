<?php

//--------------------------------------------------------------------

$parts = ["new", "select", "update", "delete"];
    $subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
    if (!empty($subFileLoad)) {
        include($subFileLoad);
    }
