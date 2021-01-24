<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 14/8/2019
 * Time: 12:42
 * Proyecto: lx_redmultipago.com
 */
?>
<div class="row">
    <div id="clienteConocido" class="col s12">
        <?php if(count($clientesPropios) > 0): ?>
            <form method="post" id="form2" action="<?= E_URL . E_VIEW ?>">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">Acreditación manual</div>
                        <div class="row">
                            <?php
                            echo mat_select("Cliente", "cliente", $clientesPropios, "col s12 l6 offset-l3");
                            echo mat_input("Valor a acreditar", "valor", ["envoltura"=>"col s12 l6 offset-l3"]);
                            echo mat_select("Cuenta destino", "cuentaDestino", $listaCuentasDestino, "col s12 l6 offset-l3");
                            echo mat_select("Forma de pago", "formaPago", ["d"=>"Depósito bancario","t"=>"Transferencia bancaria","e"=>"Pago en efectivo"], "col s12 l6 offset-l3");
                            echo mat_input("Comprobante", "comprobante", ["envoltura"=>"col s12 l6 offset-l3"]);
                            echo mat_picker("Fecha", "fecha",["otherTrueId"=>"fecha","envoltura"=>"col s12 l6 offset-l3"]);
                            echo mat_textarea("Observaciones", "texto", "col s12 l6 offset-l3");
                            ?>
                        </div>
                    </div>
                    <div class="card-action der">
                        <input type="submit" name="userBtn" id="userBtn" class="btn" value="acreditar saldo" />
                    </div>
                </div>
                <input type="hidden" name="a" value="acreditar" />
            </form>
        <?php else: ?>
            <div class="card">
                <div class="card-content">
                    <div class="eInt3">
                        <h2 class="cen mAA10" >No se encontraron clientes</h2>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
