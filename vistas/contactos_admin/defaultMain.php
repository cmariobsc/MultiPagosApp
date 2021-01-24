<?= tBack("Gestión de contenidos") ?>

<div class="pagina">
<ul class="collapsible">
    <?php if (count($condef_mensajes) > 0): ?>
        <?php foreach ($condef_mensajes as $mensaje): ?>
            <li>
                <div class="collapsible-header light-green-text text-darken-4">
                    <div class="noDiv col2 cen"><i class="material-icons">email</i></div>
                    <div class="noDiv col14 letra2 izq"><?= $mensaje->nombre . ' (' . $mensaje->correo . ')' ?></div>
                    <div class="noDiv col2 cen">
                        <span class="badge"><?= $mensaje->created_at ?></span><?php //$mensaje->created_at->diffForHumans() ?>
                    </div>
                </div>
                <div class="collapsible-body">
                    <p>Remitente: <?= $mensaje->nombre ?></p>
                    <p>Correo: <?= $mensaje->correo ?></p>
                    <p>Asunto: <?= $mensaje->asunto ?></p>
                    <p>Mensaje:<?= $mensaje->texto ?> </p>
                </div>
            </li>
        <?php endforeach ?>
    <?php else: ?>
        <li>
            <div class="collapsible-header"><i class="material-icons">filter_drama</i>Aun no existe contenidos.</div>
        </li>
    <?php endif ?>
</ul>
</div>