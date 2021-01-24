<?= tBack("Gestión de contenidos") ?>

<div class="pagina">
    <ul class="collapsible">
        <?php if (count($condef_vistas) > 0): ?>
            <?php foreach ($condef_vistas as $condef_vista): ?>
                <?php if($condef_vista->is_cliente()): ?>
                <li>
                    <div class="collapsible-header light-green-text text-darken-4">
                            <div class="col2 cen"><i class="material-icons">view_module</i></div>
                            <div class="col14 letra2 izq"><?= $condef_vista->nombre ?></div>
                            <div class="col2 cen">
                                <a href="<?= E_VIEW ?>?a=new&id=<?= $condef_vista->id ?>" onclick="" class="oscuro">
                                    <i class="material-icons">note_add</i>
                                </a>
                            </div>
                    </div>
                    <div class="collapsible-body">
                        <?= $consel_contenidos[$condef_vista->id] ?>
                    </div>
                </li>
                <?php endif ?>
            <?php endforeach ?>
        <?php else: ?>
            <li>
                <div class="collapsible-header"><i class="material-icons">filter_drama</i>Aun no existe contenidos.</div>
            </li>
        <?php endif ?>
    </ul>
</div>

