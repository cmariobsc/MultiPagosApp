<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 5/7/2019
 * Time: 12:47
 * Proyecto: lx_multipagos.eqadoor.com
 */

$servicios = EmpServicios::all();


if($servicios->count() > 0)
{
    $listaT = [];
    foreach($servicios as $servicio)
    {
        $listaServDetalles = [];

        array_push($listaServDetalles, $servicio->nombre);

        $tempForm = '<div class="col s12 der">';
        $tempForm .= '<a class="waves-effect waves-light btn" onClick="return confirma(\'Desea realmente borrar esta entrada\r\nEsta acción es irreversible\')" href="' . E_URL . E_VIEW . '/borrar?id=' . $servicio->id . '"><i class="material-icons left">delete</i>Eliminar servicio</a>';
        $tempForm .= '</div>';
        $tempForm .= mat_select("Proveedor", "proveedor", mat_select_list("EmpProveedores"), "", $servicio->proveedor_id);
        $tempForm .= mat_select("Segmento", "segmento", mat_select_list("EmpSegmentos"), "", $servicio->segmento_id);
        $tempForm .= mat_input("Código", "codigo", ["value"=>$servicio->codigo, "id"=>uniqid()]);
        $tempForm .= mat_input("Nombre", "nombre", ["value"=>$servicio->nombre, "id"=>uniqid()]);
        $tempForm .= mat_textarea("Comentarios", "texto", "", $servicio->texto, uniqid(), "materialize-textarea", 255);
        $tempForm .= '<div class="col s12 der">';
        $tempForm .= '<button class="btn waves-effect waves-light" type="submit" ><i class="material-icons left">autorenew</i>Actualizar</button>';
        $tempForm .= '</div>';

            //$b->blk(' ', ["class"=>""]);

        $tempForm = $b->blk($tempForm, ["class"=>"row"]);

        $abreForm = '<form method="post"  action="' . E_URL . E_VIEW . '">';
        $abreForm .= '<input type="hidden" name="a" value="update" />';
        $cierraForm = '<input type="hidden" name="id" value="'.$servicio->id.'" /></form>';

        array_push($listaServDetalles, $abreForm . $tempForm . $cierraForm);

        array_push($listaT, $listaServDetalles);

        unset($listaServDetalles);
    }


    $listaSegmentos = collapsible($listaT, ["cssB"=>"ftColor7"]);
}
else
{
    $listaSegmentos = $b->blk("No se encontraron segmentos declarados", ["class"=>"col s12 cen"]);
}