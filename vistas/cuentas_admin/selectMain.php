<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 27/8/2019
 * Time: 20:23
 * Proyecto: lx_redmultipago.com
 */
echo migas(["Cuenta"]);
//echo tBack("Cuenta seleccionada");
?>
<div class="row">
    <div class="col s12 l6 offset-l3">
        <form method="post" action="<?= E_URL . E_VIEW ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Cuenta seleccionada</div>
                    <div class="row">
                        <?php
                        echo mat_input("Nombre", "nombre", ["required"=>"", "value"=>$cuenta->nombre]);
                        echo mat_input("Número de cuenta", "numero", ["required"=>"", "value"=>$cuenta->numero]);
                        echo mat_select("Tipo", "tipo", mat_select_list("BancoCuentaTipo"), "", $cuenta->tipo_id);
                        echo mat_select("Banco", "banco", mat_select_list("Banco"), "", $cuenta->banco_id);
                        echo mat_select("Moneda", "moneda", mat_select_list("Moneda"), "", $cuenta->moneda_id);
                        echo mat_textarea("Descripción", "texto", "col s12", $cuenta->descripcion);
                        ?>
                    </div>
                </div>
                <div class="card-action der"><button type="submit" class="btn">Actualizar</button></div>
            </div>
            <input type="hidden" name="id" value="<?= $modeloId ?>" />
            <input type="hidden" name="a" value="update" />
        </form>
    </div>
</div>


