<div class="row">
    <div class="card">
        <form id="nuevo" name="nuevo" method="post" enctype="multipart/form-data">
            <div class="card-content">
                <?php if (isset_get('id')): ?>
                    <h5 class="letra3">Editar contenido</h5>
                    <?php foreach ($_SESSION['idiomas'] as $consel_idim): ?>
                        <div id="bloquesIdioma_<?= $consel_idim ?>" class="eInt3">
                            <fieldset class="esquina5">
                                <legend class="letra1 tipo1"><?= nombreIdioma($consel_idim) ?></legend>
                                <div id="idi_<?= $consel_idim ?>"
                                     class="col s12 blue lighten-5 indigo-text text-darken-4">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="explicados_<?= $consel_idim ?>"
                                                   name="explicados_<?= $consel_idim ?>"
                                                   type="text" class="validate"
                                                   value="<?= $consel_contenidos[$consel_idim]->explicados ?>"/>
                                            <label for="explicados_<?= $consel_idim ?>">Explicación de este contenido
                                                (<?= nombreIdioma($consel_idim) ?>)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="titulo_<?= $consel_idim ?>" name="titulo_<?= $consel_idim ?>"
                                                   type="text"
                                                   value="<?= $consel_contenidos[$consel_idim]->titulo ?>"/>
                                            <label for="titulo_<?= $consel_idim ?>">Título
                                                (<?= nombreIdioma($consel_idim) ?>)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea class="ckeditor" id="texto_<?= $consel_idim ?>"
                                                      name="texto_<?= $consel_idim ?>"
                                                      rows="10">
                                                <?= $consel_contenidos[$consel_idim]->texto ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 l6">
                                            <input id="link_<?= $consel_idim ?>" name="link_<?= $consel_idim ?>" type="text"/>
                                            <label for="link_<?= $consel_idim ?>">Enlace (<?= nombreIdioma($consel_idim) ?>)</label>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <input id="textoLink_<?= $consel_idim ?>" name="textoLink_<?= $consel_idim ?>" type="text"/>
                                            <label for="textoLink_<?= $consel_idim ?>">Texto del enlace (<?= nombreIdioma($consel_idim) ?>)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="alt_<?= $consel_idim ?>" name="alt_<?= $consel_idim ?>"
                                                   type="text"
                                                   value="<?= $consel_contenidos[$consel_idim]->alt ?>"/>
                                            <label for="alt_<?= $consel_idim ?>">Texto alternativo
                                                (<?= nombreIdioma($consel_idim) ?>
                                                )</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="cen eInt3">
                                            <img src="<?= Contenido::carpeta() . $consel_contenidos[$consel_idim]->imagen ?>" <?= altImg($consel_contenidos[$consel_idim]->alt) ?> />
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="imagen_<?= $consel_idim ?>" name="imagen_<?= $consel_idim ?>"  type="file"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <?php if ($consel_idim == E_LANG):
                            echo '<div class="eInt3 mAA10">';
                            echo '<p>';
                            echo '<label for="soloIdioma">';
                            echo '<input type="checkbox" class="filled-in" name="soloIdioma" id="soloIdioma" value="1" />';
                            echo '<span>Ingresar sólo el texto en ' . nombreIdioma($consel_idim) . '</span>';
                            echo '</label>';
                            echo '</p>';
                            echo '</div>';
                            endif; ?>
                    <?php endforeach; ?>
                    <div class="row">
                        <div class="card-action">
                            <button type="submit" name="editar_cnt" class="waves-effect waves-light btn">Aceptar
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <input type="hidden" name="a" value="update"/>
        </form>
    </div>
</div>