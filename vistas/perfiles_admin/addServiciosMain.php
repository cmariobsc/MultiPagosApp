<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 10/7/2019
 * Time: 11:23
 * Proyecto: lx_multipagos.eqadoor.com
 */
echo migas(["perfiles_admin"=>"Perfiles", "Adición de servicios al perfil"]);
echo tBack("Nuevos servicios");

?>
<div class="eInt3 mAA10">
    <div class="row">
        <div class="col s12 fColor3">
            <form method="post">
                <div class="mAA10 eInt3 der">
                    <div class="row">
                        <div class="col s10 offset-s1">
                            <p class="notas">Los servicios que no ingresen valores, no serán agregados al nuevo perfil</p>
                        </div>
                    </div>
                </div>
                <table class="highlight centered responsive-table">
                    <thead>
                    <tr class="tColor4">
                        <th>Proveedor</th>
                        <th>Segmento</th>
                        <th>Servicio</th>
                        <th>Comisión In</th>
                        <th>Comisión Out</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($servicios as $pst):
                        $existe = EmpPerfiles::where([["tipo_id",$tipoId],["servicio_id",$pst->id]])->count();
                        if($existe == 0):
                            if($pst->segmento_id):
                            ?>
                                <tr>
                                    <td><a><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="oscuro" ><?= $pst->proveedor()->nombre ?></a></td>
                                    <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="oscuro" ><?= $pst->segmento()->nombre ?></a></td>
                                    <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="oscuro" ><?= $pst->nombre ?></a></td>
                                    <td><?= mat_input("Comisión In", "comision_in_" . $pst->id, ["id"=>uniqid()]) ?></td>
                                    <td><?= mat_input("Comisión Out", "comision_out_" . $pst->id, ["id"=>uniqid()]) ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td><a class="btn waves-effect waves-light" <?= altImg("valores pendientes de ingreso") ?> href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" ><i class="material-icons">autorenew</i></a></td>
                                    <td><a class="btn waves-effect waves-light" <?= altImg("valores pendientes de ingreso") ?> href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" ><i class="material-icons">autorenew</i></a></td>
                                    <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="oscuro" ><?= $pst->nombre ?></a></td>
                                    <td><a class="btn waves-effect waves-light" <?= altImg("valores pendientes de ingreso") ?> href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" ><i class="material-icons">autorenew</i></a></td>
                                    <td><a class="btn waves-effect waves-light" <?= altImg("valores pendientes de ingreso") ?> href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" ><i class="material-icons">autorenew</i></a></td>
                                </tr>
                            <?php
                            endif;
                        endif;
                    endforeach
                    ?>
                    </tbody>
                </table>
                <div class="mAA10 der">
                    <button type="submit" class="btn">Actualizar perfil</button>
                </div>
                <input type="hidden" name="a" value="saveServicios" />
                <input type="hidden" name="id" value="<?= $tipoId ?>" />
            </form>
        </div>
    </div>
</div>

