<div class="row">
    <div class="col s12">
        <div>
            <h4>Parámetros del sistema</h4>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="izq eInt10"><a href="<?= E_VIEW ?>?a=new" class="btn-floating btn waves-effect waves-light"><i
                            class="material-icons">add</i></a></div>
                <table class="highlight responsive-table">
                    <thead class="letra3">
                    <tr>
                        <th data-field="id">Clave</th>
                        <th data-field="name">Valor</th>
                        <th data-field="name">Explicación</th>
                        <th data-field="price" class="der">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?= $pardef_listaParams ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>