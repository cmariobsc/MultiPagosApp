<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 3/7/2019
 * Time: 3:37
 * Proyecto: lx_multipagos.eqadoor.com
 */
echo migas(["clientes_admin"=>"Clientes", "Tipos"]);
echo tBack("Clasificación de puntos de venta");
?>
<div class="row">
    <div class="col s12 l6">
        <form method="post" action="<?= E_URL . E_VIEW ?>">
            <div class="card" >
                <div class="card-content">
                    <div class="card-title">Nuevo Tipo</div>
                    <div class="eInt3">
                        <div class="row">
                            <?php
                            echo mat_input("Nombre", "nombre");
                            echo mat_textarea("Comentarios", "texto", "", "", "", "materialize-textarea", 255);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card-action der"><button class="btn" type="submit" >Crear</button></div>
            </div>
            <input type="hidden" name="a" value="new" />
        </form>
    </div>
    <div class="col s12 l6">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Tipos conocidos</div>
                <div class="eInt3">
                    <div class="row">
                        <?= $listaTipos ?>
                    </div>
                </div>
            </div>
            <div class="card-action der">Seleccione el tipo a editar</div>
        </div>
    </div>
</div>
