<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 5/7/2019
 * Time: 12:21
 * Proyecto: lx_multipagos.eqadoor.com
 */
echo migas(["perfiles_admin"=>"Perfiles", "Proveedores"]);
echo tBack("Manejo de Proveedores");
?>
<div class="row">
    <div class="col s12 l6">
        <form method="post" action="<?= E_URL . E_VIEW ?>">
            <div class="card" >
                <div class="card-content">
                    <div class="card-title">Nuevo Proveedor</div>
                    <div class="eInt3">
                        <div class="row">
                            <?php
                            echo mat_input("Nombre", "nombre");
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
                <div class="card-title">Proveedores conocidos</div>
                <div class="eInt3">
                    <div class="row">
                        <?= $listaProveedores ?>
                    </div>
                </div>
            </div>
            <div class="card-action der">Seleccione el proveedor a editar</div>
        </div>
    </div>
</div>
