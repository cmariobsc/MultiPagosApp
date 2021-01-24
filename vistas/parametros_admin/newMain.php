<div class="row"><br/>
    <div class="col s12">
        <div class="card">
            <form id="nuevo-parametro" name="nuevo-parametro" method="post">
                <div class="card-content">
                    <h5 class="collection-header">Nuevo parametro</h5>
                    <div class="row">
                        <div class="input-field col s3">
                            <input id="clave" name="clave" type="text" class="validate" required=""/>
                            <label for="clave">Clave</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="valor" name="valor" type="text" class="validate" required=""/>
                            <label for="valor">Valor</label>
                        </div>
                        <div class="input-field col s8">
                            <input id="explica" name="explica" type="text" class="validate" required=""/>
                            <label for="valor">Explicación</label>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="waves-effect waves-light btn">Aceptar</button>
                    </div>
                </div>
                <input type="hidden" name="a" value="new"/>
            </form>
        </div>
    </div>
</div>