<?php

try {
    if (isset_get('id') && ($connew_vista = Vista::find(isset_get('id')))) {
        $connew_tabs_headers = '';
        $connew_tabs_bodies = '';
    } else {
        $mal = 'La selección no existe';
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}