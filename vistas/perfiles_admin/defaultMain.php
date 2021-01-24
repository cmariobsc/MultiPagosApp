<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 6/7/2019
 * Time: 4:04
 * Proyecto: lx_multipagos.eqadoor.com
 */

echo migas(["Perfiles"]);
echo tBack("Gestión de perfiles");

?>
<div class="eInt3 mAA10">
    <div class="row">
        <div class="col s12 fColor3">
            <ul class="tabs">
                <li class="tab col s6 l2"><a href="#perfilNuevo">Nuevo</a></li>
                <li class="tab col s6 l2"><a class="active" href="#perfilConocido">Actuales</a></li>
            </ul>
        </div>
        <div id="perfilNuevo" class="col s12 fColor3">
            <form method="post">
                <div class="mAA10 eInt3">
                    <div class="row">
                        <?php
                        //echo mat_select("Nuevo tipo de cliente", "tipo", mat_select_list("EmpTipos"), "col s10 offset-s1");
                        echo mat_input("Nuevo tipo de cliente", "tipo", ["envoltura"=>"col s10 offset-s1", "required"=>""]);
                        echo mat_textarea("Comentarios relativos a este perfil", "texto", "col s10 offset-s1");
                        ?>
                    </div>
                </div>
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
<!--                            <th>Comentarios</th>-->
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach($servicios as $pst): ?>
                    <?php if($pst->segmento_id): ?>
                        <tr>
                            <td><a><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="oscuro" ><?= $pst->proveedor()->nombre ?></a></td>
                            <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="oscuro" ><?= $pst->segmento()->nombre ?></a></td>
                            <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="oscuro" ><?= $pst->nombre ?></a></td>
                            <td><?= mat_input("Comisión In", "comision_in_" . $pst->id, ["id"=>uniqid()]) ?></td>
                            <td><?= mat_input("Comisión Out", "comision_out_" . $pst->id, ["id"=>uniqid()]) ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="btn waves-effect waves-light" <?= altImg("valores pendientes de ingreso") ?> ><i class="material-icons">autorenew</i></a></td>
                            <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="btn waves-effect waves-light" <?= altImg("valores pendientes de ingreso") ?> ><i class="material-icons">autorenew</i></a></td>
                            <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="oscuro" ><?= $pst->nombre ?></a></td>
                            <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="btn waves-effect waves-light" <?= altImg("valores pendientes de ingreso") ?> ><i class="material-icons">autorenew</i></a></td>
                            <td><a href="<?= E_URL . E_VIEW ?>?a=select&id=<?= $pst->id ?>" class="btn waves-effect waves-light" <?= altImg("valores pendientes de ingreso") ?> ><i class="material-icons">autorenew</i></a></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                </tbody>
                </table>
                <div class="mAA10 der">
                    <button type="submit" class="btn">Crear perfil</button>
                </div>
                <input type="hidden" name="a" value="new" />
            </form>
        </div>
        <div id="perfilConocido" class="col s12 fColor3">
            <div class="eInt3 mAA10">
                <?= $listaPerfiles ?>
            </div>
        </div>
    </div>
</div>

<div id="modalComisiones" class="modal">
    <div class="modal-content">
        <div class="mAbajo10">
            <h4>Actualizar comisiones</h4>
        </div>
        <div class="row">
            <?php
            echo mat_input("Comisión In", "nuevaComIn", ["envoltura"=>"col s10 offset-s1"]);
            echo mat_input("Comisión Out", "nuevaComOut", ["envoltura"=>"col s10 offset-s1"]);
            ?>
        </div>
    </div>
    <div class="modal-footer cen">
        <a class="modal-close waves-effect waves-green btn" onclick="actualiza()">Actualizar</a>
    </div>
</div>