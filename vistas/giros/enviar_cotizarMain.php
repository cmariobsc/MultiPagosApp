<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 4/3/2020
 * Time: 12:04
 * Proyecto: lx_redmultipago.com
 */
?>
<form id="form1" method="post" action="<?= E_URL . E_VIEW ?>/enviar_beneficiario">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Cotizar envío</div>
            <div class="eInt3">
                <div class="row">
                    <div class="col s12 l8">
                        <div class="row">
                            <?= mat_input("Importe enviado", "impEnviado", ["envoltura"=>"col s12 l6"]) ?>
                            <div class="col s12 l6 hide-on-med-and-down"></div>
                            <?= mat_input("Moneda", "monedaOut", ["envoltura"=>"col 12 l6", "value"=>"Dolar estadounidense", "readonly"=>"1"]) ?>
                            <div class="col s12 l6 hide-on-med-and-down"></div>
                            <?= mat_input("Valor en texto", "valText") ?>
                            <div class="divider"></div>
                            <?= mat_input("Importe destino", "impDestino", ["envoltura"=>"col s12 l6"]) ?>
                            <div class="input-field col s6 l3">
                                <div class="eInt3 cen">
                                    <?= mat_radio("Costos en destino", "as_opt") ?>
                                </div>
                            </div>
                            <div class="input-field col s6 l3">
                                <div class="eInt3 cen">
                                    <?= mat_radio("Costos en origen", "as_opt") ?>
                                </div>
                            </div>
                            <div class="col s12"></div>
                            <?= mat_input("Moneda", "monedaIn", ["envoltura"=>"col s12 l6"]) ?>
                            <?= mat_input("Pais", "paisDestino", ["envoltura"=>"col s12 l6"]) ?>
                        </div>
                    </div>
                    <div class="col s12 l4">
                        <h3 class="letra3">Resumen financiero</h3>
                        <div class="divider"></div>
                        <table class="rFin tipo4">
                            <tr>
                                <td>Tasa de cambio</td>
                                <td class="der"></td>
                            </tr>
                            <tr>
                                <td>Importe destino</td>
                                <td class="der"></td>
                            </tr>
                            <tr>
                                <td>Moneda origen</td>
                                <td class="der"></td>
                            </tr>
                        </table>
                        <div class="divider"></div>
                        <table class="rFin tipo4">
                            <tr>
                                <td>Importe enviado</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tarifa</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Gastos de importe</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Cargo mensaje</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Cargo entrega</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Cargo estatal</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>I.S.D.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>I.V.A.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Total impuestos</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Descuentos aplicados</td>
                                <td></td>
                            </tr>
                        </table>
                        <div class="divider"></div>
                        <table>
                            <tr>
                                <td>Importe a cobrar</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-action der"><button type="submit" class="btn">Continuar</button></div>
    </div>
</form>