<?php

try {
    $consel_contenidos = [];

    $condef_vistas = Vista::all()->sortBy("nombre");

    if (count($condef_vistas) > 0) {
        /**
         *    Creamos un listado de las vistas
         *
         */
        foreach ($condef_vistas as $condef_view) {

            $condef_cont = new Contenido();
            $condef_cont->setTable('vistas_cont_' . E_LANG);

            //$condef_cont = Contenido::class->setTable('vistas_cont_' . E_LANG);

            $condef_result_sv = $condef_cont->where('vistas_id', $condef_view->id)->get();


            if (count($condef_result_sv) > 0)
            {

                //$condef_contenidos_vvvv = "";
                $condef_contenidos_v = "";

                foreach ($condef_result_sv as $condef_row_sv) {

                    $condef_bti1 = '<i class="material-icons red-text">delete</i>';
                    $condef_bt1 = '<a onclick="cAccion(\''.E_VIEW.'?a=delete&id='.$condef_row_sv->id.'\',\'Confirma borrar esta entrada,\r\nuna vez borrado, el contenido no podrá recuperarse\')" class="secondary-content">'.$condef_bti1.'</a>';

                    $condef_bti2 = '<i class="material-icons blue-text">mode_edit</i>';
                    $condef_bt2 = '<a href="'.E_VIEW.'?a=select&id='.$condef_row_sv->id.'" class="secondary-content">'.$condef_bti2.'</a>';

                    $tCont = $condef_row_sv->vistaSub_id . E_ESPACIO . $condef_row_sv->titulo;
                    $eCont = '<small><i>(' . $condef_row_sv->explicados . ')</i></small>';

                    $cont = $b->blk($tCont . E_ESPACIO . $eCont,["href" => E_VIEW . "?a=select&id=" . $condef_row_sv->id, "class" => "oscuro"], "a");

                    $condef_contenidos_v .= $b->blk($cont . $condef_bt1 . $condef_bt2, ["class"=>"collection-item"]);

                }

                $consel_contenidos[$condef_view->id] = $b->blk($condef_contenidos_v, ["class"=>"collection"]);
            } else {
                $consel_contenidos[$condef_view->id] = '<div class="collection"><div class="collection-item red-text cen">No hay contenidos disponibles para esta vista.</div></div>';
            }
        }
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}