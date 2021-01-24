<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: latinexus.net
 * Date: 3/9/2018
 * Time: 14:40
 */


//$listaCuentas = mat_colection("BancoCuenta", ["delete"=>1]);

$cuentasPropias = BancoCuenta::where("empresa_id", $uEmpresa->id)->get();

$listaCuentas = "";

if($cuentasPropias->count() > 0)
{
    foreach($cuentasPropias as $cuentaPropia)
    {
        $listaCuentas .= '<li class="collection-item">';
        $listaCuentas .= '<div>';
        $listaCuentas .= '<a href="'.E_URL.E_VIEW.'/select?id='.$cuentaPropia->id.'">'.$cuentaPropia->nombre.'</a>';
        $listaCuentas .= '<a href="'.E_URL.E_VIEW.'/delete?id='.$cuentaPropia->id.'" onclick="return confirma(\'Realmente desea borrar esta entrada\')" class="secondary-content"><i class="material-icons red-text">delete</i></a>';
        $listaCuentas .= '<a href="'.E_URL.E_VIEW.'/select?id='.$cuentaPropia->id.'" class="secondary-content"><i class="material-icons green-text">edit</i></a>';
        $listaCuentas .= '</div>';
        $listaCuentas .= '</li>';
    }
}
else
{
    $listaCuentas .= "No se encontraron cuentas para " . $uEmpresa->nombre;
}


