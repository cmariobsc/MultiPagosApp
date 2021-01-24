<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 21/1/2020
 * Time: 10:44
 * Proyecto: lx_redmultipago.com
 */

echo migas(["giros"=>"Giros", "Enviar dinero"]);
//echo tBack("Dinero en minutos");
?>

<form id="form1" method="post" action="<?= E_URL . E_VIEW ?>/enviar_remitente">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Datos del envío</div>
            <div class="row" id="destino">
                <div class="col s12 l4">
                    <p class="letra3">UBICACIÓN DESTINO</p>
                    <div class="row" id="selPais">
                        <?php
                        echo mat_select("País destino", "paisDestino", $listaResult);
                        ?>
                    </div>
                    <div class="row" id="selProvincia"></div>
                    <div class="row" id="selCiudad"></div>
                </div>
                <div class="col s12 l8 blue-grey lighten-5">
                    <div class="oculto eInt10" id="selRemitente">
                        <p class="letra3">DATOS DEL PAÍS</p>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-action der"><button class="btn" type="submit">Continuar</button></div>
    </div>
</form>

