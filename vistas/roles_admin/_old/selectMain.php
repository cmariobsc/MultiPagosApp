<div class="row"><br/>
    <div class="col s6">
        <div class="card">
            <form id="editar-rol" name="editar-rol" method="post">
                <div class="card-content">
                    <h5 class="collection-header">Editar rol</h5>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="slug" name="slug" type="text" value="<?= $rolsel_rol['slug'] ?>" class="validate"
                                   required/>
                            <label for="slug">Nombres</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="nombre" name="nombre" type="text" value="<?= $rolsel_rol['name'] ?>"
                                   class="validate"
                                   required/>
                            <label for="nombre">Descripción</label>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="waves-effect waves-light btn">Aceptar</button>
                    </div>
                </div>
                <input type="hidden" name="a" value="update"/>
            </form>
        </div>
    </div>
</div>