<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 4/3/2020
 * Time: 12:19
 * Proyecto: lx_redmultipago.com
 */
?>
<form id="form1" method="post" action="<?= E_URL . E_VIEW ?>/enviar_resumen">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Destinatario / Beneficiario</div>
            <div class="eInt3">
                <div class="row">
                    <div class="col col s12 l2 offset-l6 der">
                        <?= mat_radio("Primer/Último", "tipo", "1", "", "with-gap", "1") ?>
                    </div>
                    <div class="col col s12 l2 der">
                        <?= mat_radio("Negocios", "tipo") ?>
                    </div>
                    <div class="col col s12 l2 der">
                        <?= mat_radio("Paterno/Materno", "tipo") ?>
                    </div>
                    <div class="col s12"></div>
                    <?php
                    echo mat_input("Empresa", "empresa");
                    echo mat_input("Atención", "atencion");
                    echo mat_input("Nombre(s)", "nombre", ["envoltura"=>"col s12 l4"]);
                    echo mat_input("Apellido paterno", "apellido1", ["envoltura"=>"col s12 l4"]);
                    echo mat_input("Apellido materno", "apellido2", ["envoltura"=>"col s12 l4"]);
                    echo mat_input("Identificación", "ident", ["envoltura"=>"col s12 l3"]);
                    echo mat_input("Telef. Convencional", "telefono2", ["envoltura"=>"col s12 l3"]);
                    echo mat_input("Telef. Celular", "telefono1", ["envoltura"=>"col s12 l3"]);
                    echo mat_select("Sexo", "sexo", ["M"=>"Masculino","F"=>"Femenino"], "col s12 l3");
                    echo mat_input("Dirección", "direccion");
                    echo mat_select("País", "pais", [], "col s12 l4");
                    echo mat_select("Estado/Provincia", "provincia", [], "col s12 l4");
                    echo mat_select("Ciudad", "ciudad", [], "col s12 l4");
                    ?>
                </div>
            </div>
        </div>
        <div class="card-action der"><button class="btn" type="submit">Continuar</button></div>
    </div>
</form>
