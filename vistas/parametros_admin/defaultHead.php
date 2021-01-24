<?php

try {
    $pardef_listaParams = "";
    foreach ($parametros as $param) {
        $pardef_listaParams .= '<tr>';
        $pardef_listaParams .= '<td class="letra3"><a href="' . E_VIEW . '?a=select&id=' . $param->id . '" ' . altImg("Editar") . ' class="oscuro">' . $param->clave . '</a></td>';
        $pardef_listaParams .= '<td class="letra3"><a href="' . E_VIEW . '?a=select&id=' . $param->id . '" ' . altImg("Editar") . ' class="oscuro">' . $param->valor . '</a></td>';
        $pardef_listaParams .= '<td class="letra3"><a href="' . E_VIEW . '?a=select&id=' . $param->id . '" ' . altImg("Explicación") . ' class="oscuro">' . $param->explica . '</a></td>';
        $pardef_listaParams .= '<td><a href="' . E_VIEW . '?a=delete&id=' . $param->id . '" class="secondary-content"> <i class="material-icons red-text">delete</i> </a> <a href="' . E_VIEW . '?a=select&id=' . $param->id . '" class="secondary-content"> <i class="material-icons blue-text">mode_edit</i> </a></td>';
        $pardef_listaParams .= '</tr>';
    }
    unset($param);
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}