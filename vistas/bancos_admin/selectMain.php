<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: latinexus.net
 * Date: 3/9/2018
 * Time: 13:48
 */
echo migas(["bancos"=>"Bancos", "banco"]);
echo tBack($ban->nombre);
?>
<div class="row">
    <div class="col s12 l6 offset-l3">
        <form method="post" action="<?= E_URL . E_VIEW ?>" >
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Actualizar banco</div>
                    <div class="row">
                        <?php
                        echo mat_input("Nombre", "nombre", ["value"=>$ban->nombre, "required"=>""]);
                        echo mat_textarea("Descripción", "texto", "col s12", $ban->texto);
                        ?>
                    </div>
                </div>
                <div class="card-action der"><button type="submit" class="btn">Actualizar banco</button></div>
            </div>
            <input type="hidden" name="a" value="update" />
            <input type="hidden" name="id" value="<?= $banco ?>" />
        </form>
    </div>
</div>

