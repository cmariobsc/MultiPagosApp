<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 5/7/2019
 * Time: 12:47
 * Proyecto: lx_multipagos.eqadoor.com
 */

$segmentos = EmpSegmentos::all();


if($segmentos->count() > 0)
{
    $listaT = [];
    foreach($segmentos as $segmento)
    {
        $listaSegDetalles = [];

        array_push($listaSegDetalles, $segmento->nombre);

        $tempForm = '<div class="col s12 der">';
        $tempForm .= '<a class="waves-effect waves-light btn" onClick="return confirma(\'Desea realmente borrar esta entrada\r\nEsta acción es irreversible\')" href="' . E_URL . E_VIEW . '/borrar?id=' . $segmento->id . '"><i class="material-icons left">delete</i>Eliminar segmento</a>';
        $tempForm .= '</div>';
        $tempForm .= mat_input("Nombre", "nombre", ["value"=>$segmento->nombre, "id"=>uniqid()]);
        $tempForm .= mat_textarea("Comentarios", "texto", "", $segmento->texto, uniqid(), "materialize-textarea", 255);
        $tempForm .= $b->blk('<button class="btn" type="submit">Actualizar</button>', ["class"=>"col s12 der"]);

        $tempForm = $b->blk($tempForm, ["class"=>"row"]);

        $abreForm = '<form method="post"  action="' . E_URL . E_VIEW . '">';
        $cierraForm = '<input type="hidden" name="a" value="update" /><input type="hidden" name="id" value="'.$segmento->id.'" /></form>';

        array_push($listaSegDetalles, $abreForm . $tempForm . $cierraForm);

        array_push($listaT, $listaSegDetalles);

        unset($listaSegDetalles);
    }


    $listaSegmentos = collapsible($listaT, ["cssB"=>"ftColor7"]);
}
else
{
    $listaSegmentos = $b->blk("No se encontraron segmentos declarados", ["class"=>"col s12 cen"]);
}