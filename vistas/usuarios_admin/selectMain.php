<?= tBack("Cambiar datos del usuarios") ?>

<div class="bCen wcuarto1 cen">
    <img class="circle" style="max-width:120px;" src="<?= UserExt::carpeta() . $ususel_ext->avatar() ?>"/>
    <h4><?= $ususel_ext->nombre_completo() ?></h4>
</div>
<form id="editar-usuario" method="post" enctype="multipart/form-data">
    <div id="new" class="col s12">
        <div class="card">
            <div class="card-content">
                <span class="card-title letra3 izq">Actualizar usuario &quot;<?= $ususel_ext->nick ?>&quot;</span>
                <div class="row">
                    <?php
                    echo mat_input("Nombre(s)", "nombres", ["value"=>$ususel_usuario->first_name,"envoltura"=>"col s12 l6", "required"=>""]);
                    echo mat_input("Apellido(s)", "apellidos", ["value"=>$ususel_usuario->last_name,"envoltura"=>"col s12 l6", "required"=>""]);
                    echo mat_input("Correo", "correo", ["value"=>$ususel_ext->empresa_contacto()->correo,"envoltura"=>"col s12 l3", "required"=>"", "type"=>"email"]);
                    echo mat_input("Teléfono Móvil", "telefonoMovil", ["value"=>$ususel_ext->telefono,"envoltura"=>"col s12 l3"]);
                    echo mat_input("Teléfono fijo", "telefonoFijo", ["value"=>$ususel_ext->telefono2,"envoltura"=>"col s12 l3"]);
                    echo mat_input("Cargo", "cargo", ["value"=>$ususel_ext->empresa_contacto()->cargo,"envoltura"=>"col s12 l3"]);
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
                    echo mat_textarea("Resumen", "resumen", "col s12 l9", $ususel_ext->empresa_contacto()->notas);
                    ?>
                </div>
            </div>
            <div class="card-action der">
                <span class="waves-effect waves-light btn" id="sendForm">Actualizar usuario</span>
                <a href="<?= E_URL ?>clientes_admin/resetPass?id=<?= $ususelUsId ?>" onclick="return confirma('Confirma el reset de la contraseña ?')" class="waves-effect waves-light red accent-3 btn" id="resetPass"><i class="material-icons left">delete</i> Reset contraseña</a>
            </div>
        </div>
    </div>
    <input type="hidden" name="a" value="update" />
    <input type="hidden" name="id" value="<?= $ususel_usuario->id ?>" />
</form>