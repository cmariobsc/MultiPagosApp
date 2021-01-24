<div class="row">
    <div class="card">
        <form id="nuevo" name="nuevo" method="post" enctype="multipart/form-data">
            <div class="card-content">
                <?php if (isset_get('id') && $connew_vista != null): ?>
                    <h5 class="letra3">Nuevo contenido para la vista &quot;<?= $connew_vista->nombre ?>&quot;</h5>
                    <?php
                    foreach ($_SESSION['idiomas'] as $connew_idim) {
                        $connew_showBlkIdim = $connew_idim != E_LANG ? " oculto" : "";
                        ?>
                        <div id="bloquesIdioma_<?= $connew_idim ?>" class="eInt3<?= $connew_showBlkIdim ?>">
                            <fieldset class="esquina5">
                                <legend class="letra1 tipo1"><?= nombreIdioma($connew_idim) ?></legend>
                                <div id="idi_<?= $connew_idim ?>" class="col s12 blue lighten-5 indigo-text text-darken-4">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="explicados_<?= $connew_idim ?>" name="explicados_<?= $connew_idim ?>" type="text" class="validate"/>
                                            <label for="explicados_<?= $connew_idim ?>">Explicación de este contenido (<?= nombreIdioma($connew_idim) ?>)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="titulo_<?= $connew_idim ?>" name="titulo_<?= $connew_idim ?>" type="text"/>
                                            <label for="titulo_<?= $connew_idim ?>">Título (<?= nombreIdioma($connew_idim) ?>)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea class="ckeditor" id="texto_<?= $connew_idim ?>" name="texto_<?= $connew_idim ?>" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 l6">
                                            <input id="link_<?= $connew_idim ?>" name="link_<?= $connew_idim ?>" type="text"/>
                                            <label for="link_<?= $connew_idim ?>">Enlace (<?= nombreIdioma($connew_idim) ?>)</label>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <input id="textoLink_<?= $connew_idim ?>" name="textoLink_<?= $connew_idim ?>" type="text"/>
                                            <label for="textoLink_<?= $connew_idim ?>">Texto del enlace (<?= nombreIdioma($connew_idim) ?>)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="alt_<?= $connew_idim ?>" name="alt_<?= $connew_idim ?>" type="text"/>
                                            <label for="alt_<?= $connew_idim ?>">Texto alternativo (<?= nombreIdioma($connew_idim) ?>)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                        	<input id="imagen_<?= $connew_idim ?>" name="imagen_<?= $connew_idim ?>" type="file"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <?php
                        if ($connew_idim == E_LANG)
                        {
                            echo '<div class="eInt3 mAA10">';
                            echo '<p>';
                            echo '<label for="soloIdioma">';
                            echo '<input type="checkbox" class="filled-in" checked="checked" name="soloIdioma" id="soloIdioma" value="1" />';
                            echo '<span>Ingresar sólo el texto en ' . nombreIdioma($connew_idim) . '</span>';
                            echo '</label>';
                            echo '</p>';
                            echo '</div>';

//                            <p>
//                                <label for="soloIdioma" >
//                                    <input type="checkbox" class="filled-in" name="soloIdioma" id="soloIdioma" checked="checked" />
//                                    <span>Filled in</span>
//                                </label>
//                            </p>

                        }

                    } ?>
                    <div class="row">
                        <div class="card-action">
                            <button type="submit" class="waves-effect waves-light btn">Aceptar</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <input type="hidden" name="a" value="crear"/>
        </form>
    </div>
</div>