<div class="row"><br/>
    <div class="col s12">
        <div class="card letra3">
            <form id="editar-parametro" name="editar-parametro" method="post">
                <div class="card-content">
                    <h5 class="collection-header">Editar parametro</h5>
                    <div class="row">
                        <div class="input-field col s3">
                            <input id="clave" name="clave" type="text" value="<?= $parsel_param->clave ?>"
                                   class="validate"
                                   readonly="" required=""/>
                            <label for="clave">Clave</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="valor" name="valor" type="text" value="<?= $parsel_param->valor ?>"
                                   class="validate"
                                   required=""/>
                            <label for="valor">Valor</label>
                        </div>
                        <div class="input-field col s8">
                            <input id="explica" name="explica" type="text" value="<?= $parsel_param->explica ?>"
                                   class="validate" required=""/>
                            <label for="valor">Explicación</label>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="waves-effect waves-light btn">Aceptar</button>
                    </div>
                </div>
                <input type="hidden" name="a" value="update" />
                <input type="hidden" name="id" value="<?= $parsel_param->id ?>" />
            </form>
        </div>
    </div>
</div>