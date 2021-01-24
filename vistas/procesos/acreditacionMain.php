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
                <form method="post">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title" id="tituloMainCard">Solicitud de acreditación</div>
                            <div class="row">
                                <?php
                                /**
                                 * picker
                                 */
                                $pick = [
                                    "envoltura" => "col s12 l4",
                                    "value" => "2019/08/12"
                                ];

                                echo mat_select("Banco", "banco",[], "col s12 l6");
                                echo mat_select("Cuenta", "cuenta", [], "col s12 l6");
                                echo mat_input("Comprobante #", "comprobante", ["envoltura"=>"col s12 l4"]);
                                echo mat_input("Valor", "valor", ["envoltura"=>"col s12 l4"]);
                                echo mat_picker("Fecha de depósito", "fecha", $pick);
                                echo mat_textarea("Observaciones", "texto");

                                ?>
                            </div>
                        </div>
                        <div class="card-action der">
                            <button type="submit" class="btn">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
