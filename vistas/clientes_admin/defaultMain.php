<?php
echo migas(["Clientes"]);
echo tBack("Gestión de clientes");
?>
<div class="eInt3 mAA10">
    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s6 l2"><a href="#clienteNuevo">Nuevo</a></li>
                <li class="tab col s6 l2"><a class="active" href="#clienteConocido">Actuales</a></li>
            </ul>
        </div>
        <div id="clienteNuevo" class="col s12">
            <form method="post" id="form1" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">Nuevo cliente de <?= $propio->nombre ?></div>
                        <div class="eInt3">
                            <div class="row">
                                <div class="col s12 l6">
                                    <div class="row">
                                        <?php
                                        echo mat_input("Nombre de la empresa cliente", "empresaNombre", ["required"=>""]);

                                        echo '<div class="col s11 offset-s1 l3">';
                                        echo mat_radio("RUC", "rucTipo", "R", "", "with-gap",1);
                                        echo mat_radio("Cédula", "rucTipo", "C");
                                        echo mat_radio("Pasaporte", "rucTipo", "P");
                                        echo '</div>';
                                        echo mat_input("No. de Identidad", "empresaRuc", ["envoltura"=>"col s12 l9"]);

                                        echo mat_textarea("Notas", "empresaNotas");
                                        ?>
                                    </div>
                                </div>

                                <div class="col s12 l3">
                                    <fieldset>
                                        <legend>CRÉDITO</legend>
                                        <div class="row">
                                            <?= mat_input("Crédito", "empresaCredito", ["envoltura"=>"col s10 offset-s1"]) ?>
                                            <div class="col s12 cen notas">
                                                Sólo números y punto (.) como separador decimal
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s10 offset-s1">
                                                <?= $eTipo ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col s12 l3 cen">
                                    <fieldset>
                                        <legend>Activación</legend>
                                        <div class="mAA10">
                                            <div>&nbsp;</div>
                                            <?= mat_check("Activar", "empresaEstado", "1", "empresaEstado", "filled-in", "1") ?>
                                            <aside class="eInt notas mArriba">Si desactiva este cliente, toda la información relativa al mismo dejará de ser mostrada.</aside>
                                            <div>&nbsp;</div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <section class="col s12">
                                    <div class="row" id="listaSedes"></div>
                                </section>
                                <section class="col s12">
                                    <article class="der eInt3">
                                        <button class="btn waves-effect waves-light" id="addSede" type="button" >Nueva Agencia
                                            <i class="material-icons right">add</i>
                                        </button>
                                    </article>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="card-action der">
                        <button type="submit" onclick="return evalForm()" class="btn">Crear Cliente</button>
                    </div>
                </div>
                <input type="hidden" name="propio" value="<?= $propio->id ?>" />
                <input type="hidden" name="a" value="new" />
            </form>
        </div>
        <div id="clienteConocido" class="col s12">
            <?php if(count($clientesPropios) > 0): ?>
                <form method="post" id="form2" action="<?= E_URL . E_VIEW ?>">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">Clientes</div>
                            <div class="eInt3">
                                <div class="row">
                                    <?= mat_select("Cliente", "cliente", $clientesPropios) ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-action der">
                            <input type="button" name="userBtn" id="userBtn" class="btn" value="SELECCIONAR CLIENTE" />
                        </div>
                    </div>
                    <input type="hidden" name="a" value="select" />
                </form>
            <?php else: ?>
                <div class="card">
                    <div class="card-content">
                        <div class="eInt3">
                            <h2 class="cen mAA10" >No se encontraron clientes</h2>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?php
/*
<div id="modalGeo" class="modal">
    <div class="modal-content">
        <h4 class="collection-header">Geolocalización</h4>
        <div class="row">
            <div class="input-field col s12">
                <div>Arrastre el marcador en el mapa hasta la ubicación de su negocio</div>
                <div id="mapa" style="text-align: center;width: 100%;height: 20em;" class="mArriba10"></div>
            </div>
        </div>
        <div class="row">
            <div class="input-field col 6 s6">
                <input readonly type="text" name="lat" id="lat" required="">
                <label class="active" for="lat">Latitud</label>
            </div>
            <div class="input-field col 6 s6">
                <input readonly type="text" name="lng" id="lng" required="">
                <label class="active" for="lng">Longitud</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="modal-close waves-effect waves-light btn">Aceptar</button>
    </div>
</div>

*/

