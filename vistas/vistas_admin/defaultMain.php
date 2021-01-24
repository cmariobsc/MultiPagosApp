<?= tBack("Gestión de vistas") ?>

<div class="row">
    <div class="col s12 l6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Nueva vista</span>
                <form method="post" action="<?= E_VIEW ?>">
                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input id="nombre" name="nombre" type="text" class="validate" required="" placeholder="Nombre de la vista en la URL" />
                            <label for="nombre">Nombre de la vista</label>
                        </div>
                        <div class="col s10 offset-s2 l6">
                            <?= $ususel_roles_html ?>
                        </div>

                        <div class="input-field col s12 l6">
                            <input id="icono" name="icono" type="text" class="validate" placeholder="Ícono del enlace" />
                            <label for="icono">Icono</label>
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="titular" name="titular" type="text" class="validate" placeholder="Texto visible en el enlace" />
                            <label for="titular">Titular</label>
                        </div>
                        <div class="input-field col s12 l6">
                            <input id="modelo" name="modelo" type="text" class="validate" placeholder="Nombre del modelo" />
                            <label for="modelo">Nombre del modelo</label>
                            <small class="tColor6">El modelo debería ir en singular</small>
                        </div>
                        <div class="input-field col s12 l6 oculto" id="tablaContenido">
                            <input id="tabla" name="tabla" type="text" class="validate" placeholder="Nombre de la tabla" />
                            <label for="tabla">Nombre de la tabla</label>
                            <small class="tColor6">La tabla debería ser el valor del modelo + "s"</small>
                        </div>
                        <div class="col s12">
                            <div class="row">
                                <div class="input-field col s12 l4">
                                    <?= mat_check("Incluir sub-vistas", "sub") ?>
                                </div>
                                <div class="input-field col s12 l4">
                                    <?= mat_check("Incluir JS", "js") ?>
                                </div>
                                <div class="input-field col s12 l4">
                                    <?= mat_check("Incluir CSS", "css") ?>
                                </div>
                            </div>
                        </div>
                        <?= mat_textarea("Descripción de la vista", "describir", "col s12") ?>
                        <?= mat_textarea("Palabras claves", "claves", "col s12") ?>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="waves-effect waves-light btn">Aceptar</button>
                    </div>
                    <input type="hidden" name="a" value="new"/>
                </form>
            </div>
        </div>
    </div>
    <div class="col s12 l6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Vistas actuales</span>
                <?= $visdef_show ?>
            </div>
        </div>
    </div>
</div>