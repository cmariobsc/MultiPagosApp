<?= tBack("Gestión de roles") ?>

<div class="row">
    <div class="col s6">
        <div class="card">
            <form id="nuevo-rol" name="nuevo-rol" method="post">
                <div class="card-content">
                    <h5 class="letra3 izq">Crear nuevo rol</h5>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="slug" name="slug" type="text" class="validate" required=""/>
                            <label for="slug">Nombre</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="nombre" name="nombre" type="text" class="validate" required=""/>
                            <label for="nombre">Descripción</label>
                        </div>
                    </div>
                    <div class="row">
                        <?= mat_select("Pagina inicial", "pagina", $listaPaginas) ?>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="waves-effect waves-light btn">Insertar</button>
                    </div>
                </div>
                <input type="hidden" name="a" value="new"/>
            </form>
        </div>
    </div>
    <div class="col s6">
        <div class="card">
            <div class="card-content">
                <h5 class="letra3 izq">Roles actuales</h5>
                <ul class="collection">
                <?= $ususel_roles_html ?>
                </ul>
            </div>
        </div>
    </div>
</div>