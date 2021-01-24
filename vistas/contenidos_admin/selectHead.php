<?php

try {
    $consel_contenidos = [];

    if (isset_get('id')) {
        $consel_main = Contenido::findOrFail(isset_get('id'));

        if ($consel_main == null) {
            $mal = 'Contenido inexistente.';
        } else {
            $consel_contenidos[E_LANG] = $consel_main;
            $consel_langs = array_diff($_SESSION['idiomas'], [E_LANG]);
            foreach ($consel_langs as $consel_lang) {
                $consel_tmp_cnt = new Contenido();
                $consel_tmp_cnt->setTable('vistas_cont_' . $consel_lang);
                $consel_cnt = $consel_tmp_cnt->findOrFail($consel_main->id);
                if ($consel_cnt) {
                    $consel_contenidos[$consel_lang] = $consel_cnt;
                }
            }
        }
    } else {
        $mal = 'La selección no existe';
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}