<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 21/7/2019
 * Time: 8:06
 * Proyecto: lx_multipagos.eqadoor.com
 */
?>
<!--  DESKTOP  -->
<div class="col s12 hide-on-med-and-down">
    <div class="card">
        <div class="card-content">
            <div class="marqueeBox">
                <?php echo $contView[1]["texto"] ?>
            </div>
        </div>
    </div>
</div>


<!--  MOVIL  -->
<div class="hide-on-large-only marqueeBox">
    <?php echo $contView[1]["texto"] ?>
</div>
