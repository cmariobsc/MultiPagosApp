<?php

if(isset($mal) && $mal===0)
{

?>
 <div class="pagina">
    <div class="card">
        <div class="card-content">
            <span class="card-title">Actualizar vista</span>
            <div class="row">
                <div class="col s12">
                    <form method="post" action="<?= E_VIEW ?>">
                        <div class="row">
                            <div class="input-field col s12 l6">
                                <input id="nombre" name="nombre" type="text" class="validate" required="" value="<?= $datosVista->nombre ?>" placeholder="Nombre de la vista en la URL" />
                                <label for="nombre">Nombre de la vista</label>
                            </div>
                            <div class="col s10 offset-s2 l6">
                                <?= $ususel_roles_html ?>
                            </div>
                            <div class="col s12 mAA10 hide-on-med-and-down">&nbsp;</div>
                            <div class="input-field col s12 l6">
                                <input id="icono" name="icono" type="text" class="validate" value="<?= $menuVistaIcono ?>" placeholder="Ícono del enlace" />
                                <label for="icono">Icono</label>
                            </div>
                            <div class="input-field col s12 l6">
                                <input id="titular" name="titular" type="text" class="validate" value="<?= $menuVistaTitulo ?>" placeholder="Texto visible en el enlace" />
                                <label for="titular">Titular</label>
                            </div>
                            <?= mat_textarea("Descripción de la vista", "describir", "col s12", $datosVista->describir) ?>
                            <?= mat_textarea("Palabras claves", "claves", "col s12", $datosVista->claves) ?>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="waves-effect waves-light btn">Aceptar</button>
                        </div>
                        <input type="hidden" name="a" value="update"/>
                        <input type="hidden" name="id" value="<?= $datosVista->id ?>" />
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
<?php
}
else
{
    echo salioMal($mal,1);
}