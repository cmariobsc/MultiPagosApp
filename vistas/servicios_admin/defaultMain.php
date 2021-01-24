<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 5/7/2019
 * Time: 12:21
 * Proyecto: lx_multipagos.eqadoor.com
 */
echo migas(["perfiles_admin"=>"Perfiles", "Servicios"]);
echo tBack("Manejo de Servicios");
?>
<div class="row">
    <div class="col s12 l6">
        <form method="post" action="<?= E_URL . E_VIEW ?>">
            <div class="card" >
                <div class="card-content">
                    <div class="card-title">Nuevo Servicio</div>
                    <div class="eInt3">
                        <div class="row">
                            <?php
                            echo mat_select("Proveedor", "proveedor", mat_select_list("EmpProveedores"));
                            echo mat_select("Segmento", "segmento", mat_select_list("EmpSegmentos"));
                            echo mat_input("Código", "codigo",["required"=>""]);
                            echo mat_input("Nombre", "nombre",["required"=>""]);
                            echo mat_textarea("Comentarios", "texto", "", "", "", "materialize-textarea", 255);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card-action der"><button class="btn" type="submit">Crear</button></div>
            </div>
            <input type="hidden" name="a" value="new" />
        </form>
    </div>
    <div class="col s12 l6">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Servicios conocidos</div>
                <div class="eInt3">
                    <div class="row">
                        <?= $listaSegmentos ?>
                    </div>
                </div>
            </div>
            <div class="card-action der">Seleccione el servicio a editar</div>
        </div>
    </div>
</div>
