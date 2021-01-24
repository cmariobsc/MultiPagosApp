<div class="row">
    <div class="col s12 l6 offset-l3">
        <form method="post">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Editar rol</div>
                    <div class="row">
                        <?php
                        echo mat_input("Nombre", "slug", ["required" => "", "value" => $rolsel_rol['slug']]);
                        echo mat_input("Descripción", "nombre", ["required" => "", "value" => $rolsel_rol['name']]);
                        echo mat_select("Vista", "vista", mat_select_list("Vista"), "", $vistaInicio);
                        ?>
                    </div>
                    <div class="card-action der">
                        <button type="submit" class="waves-effect waves-light btn">Actualizar</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="a" value="update"/>
            <input name="id" value="<?= $rolsel_rol->id ?>" type="hidden" />
        </form>
    </div>
</div>