<?= tBack("Gestión de roles") ?>

<div class="row">
    <div class="col s6">
        <div class="card">
            <form id="nuevo-rol" name="nuevo-rol" method="post">
                <div class="card-content">
                    <h5 class="letra3 izq">Crear nuevo rol</h5>
                    <div class="row">
                        <?php
                        echo mat_input("Nombre", "slug", ["required"=>""]);
                        echo mat_input("Descripción", "nombre", ["required"=>""]);
                        echo mat_select("Vista", "vista", mat_select_list("Vista"), "", 8);
                        ?>
                    </div>
                    <div class="card-action der">
                        <button type="submit" class="waves-effect waves-light btn">Crear</button>
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