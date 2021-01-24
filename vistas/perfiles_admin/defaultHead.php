<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 6/7/2019
 * Time: 4:01
 * Proyecto: lx_multipagos.eqadoor.com
 */

$empTipos = EmpTipos::all()->toArray();
$totalServicios = EmpServicios::all()->count();

if(count($empTipos) > 0)
{
    $listaPerfiles = '<ul class="collapsible">';
    foreach ($empTipos as $empTipo)
    {
        $listaPerfiles .= '<li>';
        $listaPerfiles .= '<div class="collapsible-header">' . $empTipo["nombre"] . '</div>';

        /**
         * Traigo todos los que pertenezcan a este tipo
         */


        $listaPerfiles .= '<div class="collapsible-body ftColor7 sombraArribaIn sombraAbajoIn">';

        /**
         * Creo un array de distintos segmentos para este tipo (Perfil)
         */
        $perfilesSegunTipo = EmpPerfiles::where("tipo_id", $empTipo["id"])->get();
        $totalPerfiles = $perfilesSegunTipo->count();


        if(!empty($totalPerfiles))
        {
            /**
             *  Evaluo el total de perfiles
             *  Si el total de perfiles = total de servicios
             *  entonces es que hay servicios no incluidos para el cliente
             *  y debe darse la oportunidad de añadirlos
             */
            if($totalServicios > $totalPerfiles)
            {
                $listaPerfiles .= '<form method="post">';
                $listaPerfiles .= '<div class="mAA10 eInt3 der">';
                $listaPerfiles .= '<button class="btn waves-effect waves-light" type="submit">';
                $listaPerfiles .= 'Añadir Servicios <i class="material-icons left">add</i>';
                $listaPerfiles .= '</button>';
                $listaPerfiles .= '</div>';
                $listaPerfiles .= '<input type="hidden" name="a" value="addServicios" />';
                $listaPerfiles .= '<input type="hidden" name="id" value="' . $empTipo["id"] . '" />';
                $listaPerfiles .= '</form>';
            }

            /**
             * Recorro el array para mostrar cada grupo
             */
            $listaPerfiles .= '<table class="highlight centered responsive-table">';
            $listaPerfiles .= '<thead>';
            $listaPerfiles .= '<tr class="tColor4">';
            $listaPerfiles .= '<th>Proveedor</th>';
            $listaPerfiles .= '<th>Segmento</th>';
            $listaPerfiles .= '<th>Servicio</td>';
            $listaPerfiles .= '<th>Comisión In</th>';
            $listaPerfiles .= '<th>Comisión Out</th>';
            $listaPerfiles .= '<th>&nbsp;</th>';
            $listaPerfiles .= '</tr>';
            $listaPerfiles .= '</thead>';
            $listaPerfiles .= '<tbody>';

            foreach($perfilesSegunTipo as $pst)
            {
                $servicioTemp = EmpServicios::find($pst->servicio_id);
                if($servicioTemp->segmento_id):
                    $listaPerfiles .= '<tr>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')">' . $servicioTemp->proveedor()->nombre . '</a></td>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')">' . $servicioTemp->segmento()->nombre . '</a></td>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')">' . $servicioTemp->nombre . '</a></td>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')"><span id="cIn'.$pst->id.'">'.$pst->comision_in.'</span></a></td>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')"><span id="cOut'.$pst->id.'">'.$pst->comision_out.'</span></a></td>';
                    $listaPerfiles .= '<td><a class="oscuro" href="' . E_URL . E_VIEW . '/delete?id='.$pst->id.'"><i class="material-icons red-text">delete_forever</i></a></td>';
                    $listaPerfiles .= '</tr>';
                else:
                    $listaPerfiles .= '<tr>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')">-</a></td>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')">-</a></td>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')">' . $servicioTemp->nombre . '</a></td>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')"><span id="cIn'.$pst->id.'">'.$pst->comision_in.'</span></a></td>';
                    $listaPerfiles .= '<td><a class="oscuro modal-trigger" href="#modalComisiones" onclick="newComision('.$pst->id.', \''.$pst->comision_in.'\', \''.$pst->comision_out.'\')"><span id="cOut'.$pst->id.'">'.$pst->comision_out.'</span></a></td>';
                    $listaPerfiles .= '<td><a class="oscuro" href="' . E_URL . E_VIEW . '/delete?id='.$pst->id.'"><i class="material-icons red-text">delete_forever</i></a></td>';
                    $listaPerfiles .= '</tr>';
                endif;

            }

            $listaPerfiles .= '</tbody>';
            $listaPerfiles .= '</table>';

        }
        else
        {
            $listaPerfiles .= '<form method="post">';
            $listaPerfiles .= '<div class="mAA10 eInt3 der">';
            $listaPerfiles .= '<button class="btn waves-effect waves-light" type="submit">';
            $listaPerfiles .= 'Añadir Servicios <i class="material-icons left">add</i>';
            $listaPerfiles .= '</button>';
            $listaPerfiles .= '</div>';
            $listaPerfiles .= '<input type="hidden" name="a" value="addServicios" />';
            $listaPerfiles .= '<input type="hidden" name="id" value="' . $empTipo["id"] . '" />';
            $listaPerfiles .= '</form>';

            $listaPerfiles .= '<h3 class="cen">No existen entradas para este perfil</h3>';
        }

        $listaPerfiles .= '</div>';
        $listaPerfiles .= '</li>';
    }
    $listaPerfiles .= '</ul>';
}
else
{
    $listaPerfiles = $b->blk("<h3>No existen perfiles</h3>", ["class"=>"cen"]);
}

$servicios = EmpServicios::all();


