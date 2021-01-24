<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 21/7/2019
 * Time: 8:30
 * Proyecto: lx_multipagos.eqadoor.com
 */
?>
<div class="row">
    <div class="col s12 l3">
        <div class="row">
            <?php include "estados.php" ?>
            <?php include "menu.php" ?>
        </div>
    </div>
    <div class="col s12 l9">
        <div class="row">
            <?php include "noticias.php" ?>
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title" id="tituloMainCard">Recargas</div>
                        <div class="eInt3" id="contMainCard">
                            <div class="row">
                                <?= mat_select("Servicio de recargas", "servicio", $listaServicios, "col s12 l6") ?>
                            </div>
                            <div id="contFormCard"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
