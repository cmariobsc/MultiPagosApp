<div class="pagina">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <?php foreach($menuPrincipal as $mPrinId => $mPrincipalIni): ?>
                    <?php if($mPrincipalIni["n"] != "Inicio" && $mPrincipalIni["n"] != "Salir"): ?>
                        <div class="col s12">
                            <fieldset>
                                <legend class="letra3"><?= $mPrincipalIni["n"] ?></legend>
                                <div class="mArriba10 cen">
                                    <?php
                                    if(isset($mPrincipalIni["c"])):
                                        foreach($mPrincipalIni["c"] as $mPrincipalOpt): ?>
                                            <a class="waves-effect waves-light btn mAbajo" href="<?= $mPrincipalOpt["l"] ?> ">
                                                <i class="material-icons left"><?= $mPrincipalOpt["i"] ?></i><?= $mPrincipalOpt["n"] ?></a>
                                        <?php endforeach;
                                    else: ?>
                                        <a class="waves-effect waves-light btn mAbajo" href="<?= $mPrinId ?> ">
                                            <i class="material-icons left"><?= $mPrincipalIni["i"] ?></i><?= $mPrincipalIni["n"] ?></a>
                                    <?php endif ?>
                                </div>
                            </fieldset>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>


    <?php if (check_acceso_rol('Master', false)): ?>

        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 l6">
                        <fieldset>
                            <legend class="letra3">Roles</legend>
                            <div class="mArriba10 cen">
                                <a class="waves-effect waves-light btn claro mAbajo" href="roles_admin"><i class="material-icons left">supervisor_account</i>Roles</a>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col s12 l6">
                        <fieldset>
                            <legend class="letra3">Contenidos</legend>
                            <div class="mArriba10 cen">
                                <a class="waves-effect waves-light btn claro mAbajo" href="textos_temas_admin"><i class="material-icons left">dashboard</i>Temas</a>
                                <a class="waves-effect waves-light btn claro mAbajo" href="textos_categorias_admin"><i class="material-icons left">settings</i>Categorías</a>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col s12">
                        <fieldset>
                            <legend class="letra3">Datos del sistema</legend>
                            <div class="mArriba10 cen">
                                <a class="waves-effect waves-light btn claro mAbajo" href="vistas_admin"><i class="material-icons left">dashboard</i>Vistas</a>
                                <a class="waves-effect waves-light btn claro mAbajo" href="parametros_admin"><i class="material-icons left">settings</i>Datos del sistema</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>