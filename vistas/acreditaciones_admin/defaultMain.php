<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 3/9/2019
 * Time: 01:08
 * Proyecto: lx_redmultipago.com
 */

echo migas(["acreditaciones"]);
echo tBack("Control de acreditaciones");
?>
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Acreditaciones pendientes de aprobación</div>
                <div class="eInt3">
                    <table id="tbAcredita">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Empresa</th>
                                <th>Origen</th>
                                <th>Comprobante</th>
                                <th>Destino</th>
                                <th>Valor</th>
                                <th>Fecha</th>
                                <th class="cen">Confirmación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($empHijos as $empId=>$empHijo)
                            {
                                $acreditaciones = EmpMovimientos::where([["empresa_origen_id", $empId],["aprobada", null]])->orderBy("id","desc")->get();
                                if($acreditaciones->count() > 0)
                                {
                                    $empTotalHijos++;
                                    foreach($acreditaciones as $acreditacion)
                                    {
                                        $cOrigen = !empty($acreditacion->cuenta_origen_id) ? BancoCuenta::find($acreditacion->cuenta_origen_id)->numero : "-";
                                        $cDestino = !empty($acreditacion->cuenta_destino_id) ? BancoCuenta::find($acreditacion->cuenta_destino_id)->numero : "-";
                                        echo '<tr class="filasAc" id="ac'.$acreditacion->id.'">';
                                        echo $b->blk($acreditacion->id,[],"td");
                                        echo $b->blk($empHijo,[],"td");
                                        echo $b->blk($cOrigen,[],"td");
                                        echo $b->blk($acreditacion->comprobante,[],"td");
                                        echo $b->blk($cDestino,[],"td");
                                        echo $b->blk($acreditacion->valor,[],"td");
                                        echo $b->blk($acreditacion->fecha,[],"td");
                                        echo '<td class="cen">';
                                        echo '<button type="button" class="btn" onclick="acredita('.$acreditacion->id.')" ><i class="material-icons lime-text text-accent-3" '.altImg("Aprobar").' >done_all</i></button>';
                                        echo ' <button type="button" class="btn" onclick="anula('.$acreditacion->id.')" ><i class="material-icons red-text text-lighten-1" '.altImg("Anular").' >close</i></button>';
                                        echo '</tr>';
                                    }
                                }
                            }

                            if($empTotalHijos == 0)
                            {
                                echo '<tr><td colspan="6" class="cen">Sin acreditaciones pendientes de aprobación</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
