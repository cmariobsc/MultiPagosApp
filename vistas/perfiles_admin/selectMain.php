<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 7/7/2019
 * Time: 1:47
 * Proyecto: lx_multipagos.eqadoor.com
 */

echo migas(["Perfil"]);
echo tBack("Perfil Seleccionado");
?>
<div class="row">
    <div class="col s12">
        <form method="post">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Perfil <?= $perfil->tipo()->nombre ?></div>
                    <div class="eInt3">
                            <div class="row">
                                <div class="col s12 l6" style="padding-top: 2em;">
                                    <div class="row">
                                        <?php
                                        echo mat_select("Tipo", "tipo", mat_select_list("EmpTipos"), "col s12 l11 offset-l1", $perfil->tipo_id);
                                        echo mat_select("Segmento", "segmento", mat_select_list("EmpSegmentos"),"col s12 l11 offset-l1", $perfil->segmento_id);
                                        echo mat_select("Servicio", "servicio", mat_select_list("EmpServicios"), "col s12 l11 offset-l1", $perfil->servicio_id);
                                        echo mat_select("Proveedor", "proveedor", mat_select_list("EmpProveedores"), "col s12 l11 offset-l1", $perfil->proveedor_id);
                                        ?>
                                    </div>
                                </div>
                                <div class="col s12 l6" style="padding-top: 2em;">
                                    <div class="row">
                                        <?php
                                        echo mat_input("Comisión recibida", "comision_in", ["envoltura"=>"col s12 l8 offset-l2", "value"=>$perfil->comision_in]);
                                        echo mat_input("Comisión entregada", "comision_out", ["envoltura"=>"col s12 l8 offset-l2", "value"=>$perfil->comision_out]);
                                        echo mat_textarea("Notas", "texto", "col s12 l8 offset-l2", $perfil->texto, "", "materialize-textarea", 255);
                                        ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card-action der"><button type="submit" class="btn">Actualizar Perfil</button></div>
            </div>
            <input type="hidden" name="a" value="update" />
            <input type="hidden" name="id" value="<?= $perfil->id ?>" />
        </form>
    </div>
</div>
