<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: latinexus.net
 * Date: 3/9/2018
 * Time: 14:40
 */
echo migas(["Cuentas de banco"]);
?>
<div class="row">
    <div class="col s12 l6">
        <form method="post" action="<?= E_URL . E_VIEW ?>" >
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Ingresar nueva cuenta</div>
                    <div class="notas der">
                        <p>Las cuentas aqui manejadas son de la propia empresa <?= $uEmpresa->nombre ?></p>
                    </div>
                    <div class="row">
                        <?php
                        echo mat_input("Nombre", "nombre", ["required"=>""]);
                        echo mat_select("Banco", "banco", mat_select_list("Banco"));
                        echo mat_input("Número de cuenta", "numero", ["required"=>""]);
                        echo mat_select("Tipo", "tipo", mat_select_list("BancoCuentaTipo"), "", 1);
                        echo mat_select("Moneda", "moneda", mat_select_list("Moneda"), "", 1);
                        echo mat_textarea("Descripción", "texto", "col s12");
                        ?>
                    </div>
                </div>
                <div class="card-action der"><button type="submit" class="btn">Crear cuenta</button></div>
            </div>
            <input type="hidden" name="a" value="new" />
        </form>
    </div>
    <div class="col s12 l6">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Cuentas en el sistema</div>
                <div class="eInt3">
                    <ul class="collection">
                        <?= $listaCuentas ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
