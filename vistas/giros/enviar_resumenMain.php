<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 5/3/2020
 * Time: 20:12
 * Proyecto: lx_redmultipago.com
 */
?>
<form method="post" action="<?= E_URL . E_VIEW ?>/enviar_confirmacion">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Resumen del envío</div>
            <div class="eInt3">
                <h2 class="bordeAbajo letra3 tipo3">Datos del cliente</h2>
                <div class="row">
                    <div class="col s12 l6">
                        <div class="row">
                            <div class="col s12 l6">Nombre / R. Social</div>
                            <div class="col s12 l6">&nbsp;</div>
                            <div class="col s12 l6">C.I. / RUC</div>
                            <div class="col s12 l6">&nbsp;</div>
                            <div class="col s12 l6">Provincia</div>
                            <div class="col s12 l6">&nbsp;</div>
                            <div class="col s12 l6">Dirección</div>
                            <div class="col s12 l6">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col s12 l6">
                        <div class="row">
                            <div class="col s12 l6">Teléfono fijo</div>
                            <div class="col s12 l6">&nbsp;</div>
                            <div class="col s12 l6">Ciudad</div>
                            <div class="col s12 l6">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <h2 class="bordeAbajo letra3 tipo3">Datos del asociado</h2>
                <div class="row">
                    <div class="col s12 l6">
                        <div class="row">
                            <div class="col s12 l6">Nombre</div>
                            <div class="col s12 l6">&nbsp;</div>
                            <div class="col s12 l6">País</div>
                            <div class="col s12 l6">&nbsp;</div>
                            <div class="col s12 l6">Ciudad</div>
                            <div class="col s12 l6">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col s12 l6">
                        <div class="row">
                            <div class="col s12 l6">Provincia / Estado</div>
                            <div class="col s12 l6">&nbsp;</div>
                            <div class="col s12 l6">Dirección</div>
                            <div class="col s12 l6">&nbsp;</div>
                            <div class="col s12 l6">Teléfono</div>
                            <div class="col s12 l6">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <h2 class="bordeAbajo letra3 tipo3">Datos de la transferencia</h2>
                <div class="row">
                    <div class="input-field col s12 l3">MTCN: </div>
                    <div class="input-field col s12 l3">Tipo de transacción: SEND</div>
                    <?= mat_select("Estado / Provincia Origen", "provOrigen", [], "col s12 l6") ?>
                    <div class="input-field col s12 l3 tColor2 tipo3 letra3">4545 54 54 54</div>
                    <div class="input-field col s12 l3">Valor:</div>
                    <?= mat_select("Ciudad Origen", "ciudadOrigen", [], "col s12 l6") ?>
                </div>
                <h2 class="bordeAbajo letra3 tipo3">Servicios</h2>
                <div class="row">
                    <div class="input-field col s12 l3">
                        D2B No disponible
                    </div>
                    <?php
                    echo mat_input("Activo", "D2B_activo", ["envoltura"=>"col s12 l3", "value"=>"NO", "readonly"=>"1"]);
                    ?>
                    <div class="input-field col s12 l3">
                        <?= mat_check("Pago por D2B", "D2B_pago") ?>
                    </div>
                    <?php
                    echo mat_input("Valor", "D2B_valor", ["envoltura"=>"col s12 l3", "value"=>"$ 0.00", "readonly"=>"1"])
                    ?>
                    <div class="input-field col s12 l3">
                        DINERO PROTEGIDO ACTIVA
                    </div>
                    <?php
                    echo mat_input("Activo", "DPA_activo", ["envoltura"=>"col s12 l3", "value"=>"NO", "readonly"=>"1"]);
                    ?>
                    <div class="input-field col s12 l3">
                        <?= mat_check("Adhesión", "DPA_adhesion") ?>
                    </div>
                    <?php
                    echo mat_input("Valor", "DPA_valor", ["envoltura"=>"col s12 l3", "value"=>"$ 0.00", "readonly"=>"1"])
                    ?>
                </div>
            </div>
        </div>
        <div class="card-action der"><button type="submit" class="btn">Confirmar</button></div>
    </div>
</form>
