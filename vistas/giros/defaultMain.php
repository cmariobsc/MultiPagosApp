<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 16/9/2019
 * Time: 03:26
 * Proyecto: lx_redmultipago.com
 */

echo migas(["Envios de dinero"]);
echo tBack("Dinero en minutos");
?>
<div class="row">
    <div class="col s12 l6 offset-l3">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Seleccione una opción</div>
                <div class="eInt3 cen">
                    <a href="<?= E_URL . E_VIEW ?>/heartBeat" class="waves-effect waves-light btn-large"><i class="material-icons left">check_circle</i> Comprobar sistema</a>
                </div>
                <div class="eInt3 cen">
                    <a href="<?= E_URL . E_VIEW ?>/enviar_destino" class="waves-effect waves-light btn-large"><i class="material-icons left">file_upload</i> Enviar dinero</a>
                </div>
                <div class="eInt3 cen">
                    <a href="<?= E_URL . E_VIEW ?>/recibir" class="waves-effect waves-light btn-large"><i class="material-icons left">file_download</i> Recibir dinero</a>
                </div>
            </div>
        </div>
    </div>
</div>















