<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 21/7/2019
 * Time: 8:03
 * Proyecto: lx_multipagos.eqadoor.com
 */
$ss_credito = $uEmpresa->comercial()->credito;
$ss_comision = $uEmpresa->comercial()->comision;
$ss_total = $ss_credito + $ss_comision;
?>
<!--  DESKTOP  -->
<div class="col s12 hide-on-med-and-down">
    <div class="mArriba10 eInt3">
        <ul class="tipo4">
            <li><p>Crédito: <span class="tColor2">$ <?= number_format($ss_credito, 2) ?></span></p></li>
            <li><p>Comisión: <span class="tColor2">$ <?= number_format($ss_comision, 2) ?></span></p></li>
            <li><p>Total: <span class="tColor2">$ <?= number_format($ss_total, 2) ?></span></p></li>
        </ul>
    </div>
</div>


<!--  MOVIL  -->
<div class="col s12 hide-on-large-only tColor4 tipo4 cen">
    <span class="mDer">Saldo: <?= $ss_credito ?></span>
    <span class="mIzq">Comisión: <?= $ss_comision ?></span> <br />
    <span>Total: <?= $ss_total ?></span>
</div>