<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 5/7/2019
 * Time: 12:47
 * Proyecto: lx_multipagos.eqadoor.com
 */

$proveedores = EmpProveedores::all();


if($proveedores->count() > 0)
{
    $listaT = [];
    foreach($proveedores as $proveedor)
    {
        $listaProvDetalles = [];

        array_push($listaProvDetalles, $proveedor->nombre);

        $tempForm = '<div class="col s12 der">';
        $tempForm .= '<a class="waves-effect waves-light btn" onClick="return confirma(\'Desea realmente borrar esta entrada\r\nEsta acción es irreversible\')" href="' . E_URL . E_VIEW . '/borrar?id=' . $proveedor->id . '"><i class="material-icons left">delete</i>Eliminar segmento</a>';
        $tempForm .= '</div>';
        $tempForm .= mat_input("Nombre", "nombre", ["value"=>$proveedor->nombre, "id"=>uniqid()]);
        $tempForm .= mat_textarea("Comentarios", "texto", "", $proveedor->texto, uniqid(), "materialize-textarea", 255);
        $tempForm .= $b->blk('<button class="btn" type="submit">Actualizar</button>', ["class"=>"col s12 der"]);

        $tempForm = $b->blk($tempForm, ["class"=>"row"]);

        $abreForm = '<form method="post"  action="' . E_URL . E_VIEW . '">';
        $cierraForm = '<input type="hidden" name="a" value="update" /><input type="hidden" name="id" value="'.$proveedor->id.'" /></form>';

        array_push($listaProvDetalles, $abreForm . $tempForm . $cierraForm);

        array_push($listaT, $listaProvDetalles);

        unset($listaProvDetalles);
    }


    $listaProveedores = collapsible($listaT, ["cssB"=>"ftColor7"]);
}
else
{
    $listaProveedores = $b->blk("No se encontraron tipos declarados", ["class"=>"col s12 cen"]);
}