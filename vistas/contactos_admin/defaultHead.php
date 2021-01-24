<?php

try {
    $condef_mensajes = Mensaje::orderBy('created_at', 'DESC')->get();
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}