<?= tBack("Gestión de usuarios") ?>



<div class="row">
    <div class="col s12 izq">
        <span class="btn mAbajo10" id="btnActual" >Usuarios actuales</span>
        <span class="btn mAbajo10" id="btnNew" >Nuevo usuario</span>
    </div>
    <div class="oculto" id="<?= cNom("contNew") ?>" >
        <form id="nuevo-usuario" method="post" enctype="multipart/form-data">
            <div id="new" class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title letra3 izq">Crear nuevo usuario</span>
                        <div class="row">
                            <?php
                            echo mat_input("Nombre(s)", "nombres", ["envoltura"=>"col s12 l6", "required"=>""]);
                            echo mat_input("Apellido(s)", "apellidos", ["envoltura"=>"col s12 l6", "required"=>""]);
                            echo mat_input("Correo", "correo", ["envoltura"=>"col s12 l3", "required"=>"", "type"=>"email"]);
                            echo mat_input("Teléfono Móvil", "telefonoMovil", ["envoltura"=>"col s12 l3"]);
                            echo mat_input("Teléfono fijo", "telefonoFijo", ["envoltura"=>"col s12 l3"]);
                            echo mat_input("Cargo", "cargo", ["envoltura"=>"col s12 l3"]);
                            echo $listaEmpresaNewUser;
                            echo $listaSucursalNewUser;
                            ?>
                            <div class="input-field col s12 l3">
                                <fieldset class="esquina5 eInt10">
                                    <legend>Roles de usuario</legend>
                                    <?= $usudef_roles_html ?>
                                </fieldset>
                            </div>
                            <div class="col s12 l9">&nbsp;</div>
                            <?php
                            echo mat_file("Avatar", "avatar", "col s12 l9");
                            echo mat_textarea("Resumen", "resumen", "col s12 l9");
                            ?>
                        </div>
                    </div>
                    <div class="card-action der">
                        <span class="waves-effect waves-light btn" id="sendForm">Crear usuario</span>
                    </div>
                </div>
            </div>
            <input type="hidden" name="a" value="new"/>
        </form>
    </div>
    <div class="oculto" id="<?= cNom("contActual") ?>">
        <div id="actual" class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title letra3 izq bordeAbajo" >Usuarios</span>
                    <div id="listaUsuarios">
                        <?= $listaUsuarios_html ?>
                    </div>
                    <!--
                    <div class="mAA10">
                        <ul class="pagination">
                            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                            <li class="active"><a href="#!">1</a></li>
                            <li class="waves-effect"><a href="#!">2</a></li>
                            <li class="waves-effect"><a href="#!">3</a></li>
                            <li class="waves-effect"><a href="#!">4</a></li>
                            <li class="waves-effect"><a href="#!">5</a></li>
                            <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>




