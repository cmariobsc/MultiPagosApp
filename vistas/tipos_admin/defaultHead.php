<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 3/7/2019
 * Time: 5:45
 * Proyecto: lx_multipagos.eqadoor.com
 */

$tipoEmpresas = EmpTipos::all();


if($tipoEmpresas->count() > 0)
{
    $listaT = [];
    foreach($tipoEmpresas as $tipoEmpresa)
    {
        $listaTiposDetalle = [];

        array_push($listaTiposDetalle, $tipoEmpresa->nombre);

        $tempForm = mat_input("Nombre", "nombre", ["value"=>$tipoEmpresa->nombre, "id"=>uniqid()]);
        $tempForm .= mat_textarea("Comentarios", "texto", "", $tipoEmpresa->texto, uniqid(), "materialize-textarea", 255);
        $tempForm .= '<div class="col s12 l6 cen">';
        $tempForm .= '<button class="btn" type="submit">Actualizar</button>';
        $tempForm .= '</div>';
        $tempForm .= '<div class="col s12 l6 cen">';
        $tempForm .= '<a class="waves-effect waves-light btn" onclick="return confirma(\'El tipo de cliente será eliminado\')" href="'.E_URL.E_VIEW.'/delete?id='. $tipoEmpresa->id.'"><i class="material-icons left red-text">delete_forever</i> Borrar</a>';
        $tempForm .= '</div>';

        $tempForm = $b->blk($tempForm, ["class"=>"row"]);

        $abreForm = '<form method="post"  action="' . E_URL . E_VIEW . '">';
        $cierraForm = '<input type="hidden" name="a" value="update" /><input type="hidden" name="id" value="'.$tipoEmpresa->id.'" /></form>';

        array_push($listaTiposDetalle, $abreForm . $tempForm . $cierraForm);

        array_push($listaT, $listaTiposDetalle);

        unset($listaTiposDetalle);
    }


    $listaTipos = collapsible($listaT, ["cssB"=>"ftColor7"]);
}
else
{
    $listaTipos = $b->blk("No se encontraron tipos declarados", ["class"=>"col s12 cen"]);
}