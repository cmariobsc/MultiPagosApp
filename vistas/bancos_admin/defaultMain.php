<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: latinexus.net
 * Date: 3/9/2018
 * Time: 10:17
 */
echo migas(["Bancos"]);
echo tBack("Bancos")
?>
<div class="row">
    <div class="col s12 l6">
        <form method="post" action="<?= E_URL . E_VIEW ?>" >
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Ingresar nuevo banco</div>
                    <div class="row">
                        <?php
                        echo mat_input("Nombre", "nombre", ["required"=>""]);
                        echo mat_textarea("Descripción", "texto", "col s12");
                        ?>
                    </div>
                </div>
                <div class="card-action der"><button type="submit" class="btn">Crear banco</button></div>
            </div>
            <input type="hidden" name="a" value="new" />
        </form>
    </div>
    <div class="col s12 l6">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Bancos en el sistema</div>
                <div class="eInt3"><?= $listaBancos  ?></div>
            </div>
        </div>
    </div>
</div>
