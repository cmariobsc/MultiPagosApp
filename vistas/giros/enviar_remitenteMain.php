<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 4/3/2020
 * Time: 00:47
 * Proyecto: lx_redmultipago.com
 */
?>
<form id="form1" method="post" action="<?= E_URL . E_VIEW ?>/enviar_cotizar">
<div class="card">
    <div class="card-content">
        <div class="card-title">Remitente</div>
        <div class="row">
            <?= mat_select("Tipo de identidad", "tipoIden", ["ide"=>"Identidad", "pas"=>"Pasaporte", "ruc"=>"RUC"], "col s12 l3") ?>
            <?= mat_input("Identidad", "iden", ["envoltura"=>"col s12 l4"]) ?>
            <div class="input-field col s12 l2">
                <button class="btn waves-effect waves-light" type="button" name="action">
                    <i class="material-icons">find_replace</i>
                </button>
            </div>
            <div class="col s12 l3">
                <?php
                echo mat_radio("Persona Natural", "natural", "n");
                echo mat_radio("Persona Jurídica", "juridica", "j");
                ?>
            </div>
            <div class="col s12">
                <fieldset class="esquina5">
                    <legend>Datos conocidos</legend>
                    <div class="eInt3">
                        <div class="row">
                            <?php
                            echo mat_input("nombre(s)", "nombre", ["envoltura"=>"col s12 l3"]);
                            echo mat_input("Apellido paterno", "apellido1", ["envoltura"=>"col s12 l3"]);
                            echo mat_input("Apellido materno", "apellido2", ["envoltura"=>"col s12 l3"]);
                            ?>
                            <div class="input-field col s12 l1">
                                <button class="btn waves-effect waves-light" type="button" name="action">
                                    <i class="material-icons">find_replace</i>
                                </button>
                            </div>
                            <div class="input-field col s12 l2">
                                <button class="btn waves-effect waves-light" type="button" name="action">
                                    <i class="material-icons">find_replace</i>
                                </button>
                            </div>
                            <?php
                            echo mat_input("Razón social", "razon", ["envoltura"=>"col s12 l6"]);
                            echo mat_input("RUC", "ruc", ["envoltura"=>"col s12 l3"]);
                            ?>
                            <div class="input-field col s12 l1">
                                <button class="btn waves-effect waves-light" type="button" name="action">
                                    <i class="material-icons">find_replace</i>
                                </button>
                            </div>
                            <div class="input-field col s12 l2">
                                <button class="btn waves-effect waves-light" type="button" name="action">
                                    <i class="material-icons">find_replace</i>
                                </button>
                            </div>
                            <div class="col s12"></div>
                            <?php
                            echo mat_input("Identificación principal", "iPersonal", ["envoltura"=>"col s12 l3"]);
                            echo mat_input("Identificación alterna", "iAlterna",  ["envoltura"=>"col s12 l3"]);
                            echo mat_input("Teléfono convencional", "tfConvencional",  ["envoltura"=>"col s12 l3"]);
                            echo mat_input("Teléfono móvil", "tfMovil",  ["envoltura"=>"col s12 l3"]);
                            echo mat_input("Dirección", "direccion", ["envoltura"=>"col s12"]);
                            echo mat_input("Pais", "pais", ["envoltura"=>"col s12 l4"]);
                            echo mat_input("Estado/Provincia", "provincia", ["envoltura"=>"col s12 l4"]);
                            echo mat_input("Ciudad", "ciudad", ["envoltura"=>"col s12 l4"]);
                            echo mat_input("Moneda", "moneda", ["envoltura"=>"col s12 l4"]);
                            echo mat_input("País emisor del documento", "paisEmisor", ["envoltura"=>"col s12 l4"]);
                            ?>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="card-action der"><button class="btn" type="submit">Continuar</button></div>
</div>
</form>

<div id="modalCliente" class="modal">
    <div class="modal-content">
        <h4>Datos del nuevo cliente</h4>
        <fieldset class="esq5">
            <legend class="tipo4 letra1">Información básica</legend>
            <div class="row">
                <?php
                echo mat_input("nombre(s)", "m_nombre", ["envoltura"=>"col s12 l4"]);
                echo mat_input("Apellido paterno", "m_apellido1", ["envoltura"=>"col s12 l4"]);
                echo mat_input("Apellido materno", "m_apellido2", ["envoltura"=>"col s12 l4"]);
                echo mat_select("Sexo", "m_sexo", ["m"=>"Masculino", "f"=>"Femenino"], "col s12 l4");
                echo $b->blk("Fecha de nacimiento:", ["class"=>"col s12 l4 der", "style"=>"padding-top: 2rem;"]);
                echo mat_input("", "m_nacimiento", ["envoltura"=>"col s12 l4", "type"=>"date"]);
                ?>
                <div class="col s12"></div>
                <?php
                echo mat_select("Es PEP", "m_pep", ["n"=>"No", "s"=>"Si"], "col s12 l4");
                echo mat_input("Cargo", "m_cargo", ["envoltura"=>"col s12 l4"]);
                echo mat_input("Desde", "m_desde", ["envoltura"=>"col s6 l2"]);
                echo mat_input("Hasta", "m_hasta", ["envoltura"=>"col s6 l2"]);
                echo mat_select("País de nacimmiento", "m_paisNacimiento", [], "col s12 l6");
                ?>
            </div>
        </fieldset>
        <fieldset class="esq5">
            <legend class="tipo4 letra1">Identidad</legend>
            <div class="row">
                <div class="col s12 l6 push-l6">
                    <div class="row m">
                        <?= mat_file("Cargar Imagen", "m_iden", "col s12") ?>
                        <div class="input-field col s12 esq5 ftColor4 cen valign-wrapper" id="m_idenCargada">
                            <img class="materialboxed" src="" <?= altImg("Imagen cargada") ?> />
                        </div>
                    </div>
                </div>
                <div class="col s12 l6 pull-l6">
                    <div class="row m">
                        <?php
                        echo mat_select("Documento de identidad", "m_tipoIden", ["ide"=>"Identidad", "pas"=>"Pasaporte", "ruc"=>"RUC"]);
                        echo mat_input("Identidad", "m_iden", ["envoltura"=>"col s12"]);
                        echo $b->blk("Fecha Emisión", ["class"=>"col s12 l6", "style"=>"padding-top: 2rem;"]);
                        echo mat_input("", "m_fechaEmi", ["envoltura"=>"col s12 l6", "type"=>"date"]);
                        echo $b->blk("Fecha Expiración", ["class"=>"col s12 l6", "style"=>"padding-top: 2rem;"]);
                        echo mat_input("", "m_fechaExp", ["envoltura"=>"col s12 l6", "type"=>"date"]);
                        echo $b->blk("", ["class"=>"col s12"]);
                        ?>
                    </div>
                </div>
                <?= mat_select("País emisor", "m_paisEmisor", [], "col s12") ?>
            </div>
        </fieldset>
        <fieldset class="esq5">
            <legend class="tipo4 letra1">Localización</legend>
            <div class="row">
                <?php
                echo mat_input("Dirección", "m_direccion", ["envoltura"=>"col s12"]);
                echo mat_input("Pais", "m_pais", ["envoltura"=>"col s12 l4"]);
                echo mat_input("Estado/Provincia", "m_provincia", ["envoltura"=>"col s12 l4"]);
                echo mat_input("Ciudad", "m_ciudad", ["envoltura"=>"col s12 l4"]);
                echo mat_input("Teléfono convencional", "m_tfConvencional",  ["envoltura"=>"col s12 l4"]);
                echo mat_input("Teléfono móvil", "m_tfMovil",  ["envoltura"=>"col s12 l4"]);
                echo mat_select("Ocupación", "m_ocupacion", []);
                ?>
            </div>
        </fieldset>
        <fieldset class="esq5">
            <legend class="tipo4 letra1">Origen</legend>
            <div class="row">
                <?= mat_select("Nacionalidad", "m_nacionalidad", []); ?>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn">Crear</a>
    </div>
</div>
