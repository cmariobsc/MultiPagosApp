<?php

$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {
    include($subFileLoad);
}