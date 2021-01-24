<script type="text/javascript">
var evaluaForm = [];
evaluaForm[0] = []; // evalúa null (select)
evaluaForm[1] = []; // evalúa ""
var sede = <?= $cantidadSedes ?>;

function newPass(a)
{
    $('#' + a).next().addClass("active");
    $('#' + a).val(genPass());
}

function addSede(obj)
{
    var defecto = {
        destino: "listaSedes",
        entorno: "col s12 l6",
        formulario: false
    };
    var obj = obj || defecto;
    var a = sede++;
    var d = obj.destino ? obj.destino : defecto.destino;    // Destino para insertar el resultado
    var e = obj.entorno ? obj.entorno : defecto.entorno;    // Entorno
    var f = obj.formulario ? obj.formulario : defecto.formulario;   // Es para definir si trae su propio formulario
    var r = "";

    r += '<article id="sede' + (sede) + '" class="' + e + '">';
    r += '<fieldset>';
    r += '<legend>Agencia ' + (sede) + '</legend>';
    r += f ? '<form method="post">' : "";
    r += '<div class="row">';
    r += MATCSS.input("Nombre de la sede", "sedeNombre[]", {env: "col s12 l6", req:"", id: MATCSS.sid()});
    r += '<div class="input-field col s11 offset-s1 l5 offset-l1">';
    r += MATCSS.checkbox("Es casa matriz", "sedematriz[]", {value: a, id: MATCSS.sid()});
    r += '</div>';
    r += MATCSS.textarea("Actividad", "sedeActividad[]", {dl: 255, id: MATCSS.sid()});
    r += MATCSS.textarea("Dirección", "sedeDireccion[]", {dl: 255, id: MATCSS.sid()});
    r += MATCSS.textarea("Comentarios", "sedeNotas[]", {id: MATCSS.sid()});

    r += f==1 ? '<div class="eInt3 mAA10 cen">' : "";
    r += f==1 ? '<button type="submit" class="btn" >Guardar Agencia</button>' : "";
    r += f==1 ? '</div>' : "";
    r += f==1 ? '<input type="hidden" name="a" value="updateAgencia" />' : "";
    r += f==1 ? '<input type="hidden" name="agenciaId" value="' + a + '" />' : "";
    r += f==1 ? '</form>' : "";

    r += '<div class="col s12" id="contactos' + a + '"></div>';
    r += '<div class="col s12 der" >';
    r += '<button class="btn waves-effect waves-light" type="button" onclick="addContacto(' + a + ')" >Nuevo Contacto <i class="material-icons right">add</i></button>';
    r += '</div>';
//    r += '<div class="col s6 der" >';
//    r += '<button class="btn waves-effect waves-light" type="button" onclick="guardarSede(' + a + ')" >Guardar Sede <i class="material-icons right">check_box</i></button>';
//    r += '</div>';
    r += '</div>';

    r += f==2 ? '<div class="eInt3 mAA10 cen">' : "";
    r += f==2 ? '<button type="submit" class="btn" >Guardar Agencia</button>' : "";
    r += f==2 ? '</div>' : "";
    r += f==2 ? '<input type="hidden" name="a" value="newSede" />' : "";
    r += f==2 ? '<input type="hidden" name="clienteId" value="<?= $clienteId ?>" />' : "";
    r += f==2 ? '</form>' : "";

    r += '</fieldset>';
    r += '</article>';

    $('#' + d).append(r);

    addContacto(a);

    $('textarea').characterCounter();

}

function addContacto(a, f)
{
    var f = f || false;
    var retorno = '<div class="card blue-grey lighten-4">';
    retorno += '<div class="card-content">';
    retorno += '<div class="card-title">Contacto</div>';
    retorno += f ? '<form method="post">' : "";
    retorno += '<div class="row">';
    retorno += MATCSS.input("Nombre(s)", "contactoNombre[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("Apellido(s)", "contactoApellido[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("Teléfono fijo", "contactoTelefonoFijo[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("Teléfono Móvil", "contactoTelefonoMovil[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("E-Mail", "contactoCorreo[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("Cargo", "contactoCargo[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.textarea("Notas", "contactoNotas[]", {env: "col s12", id: MATCSS.sid()});
    retorno += '</div>';

    <?php if($uExt->role_slug() == "Master" || $uExt->role_slug() == "Administrador"): ?>
    tmpId = MATCSS.sid();
    retorno += '<fieldset class="eInt3">';
    retorno += '<legend>Crear Usuario</legend>';
    retorno += '<div class="row">';
    retorno += MATCSS.select("Seleccionar rol de usuario", "contactoRol[]", {env: "col s10 offset-s1", id: MATCSS.sid(), cont: <?= $objRoles ?>, value: "Usuario"});
    retorno += '</div>';
    retorno += '</fieldset>';
    <?php endif ?>

    retorno += '<div class="eInt3 mAA10 cen">';
    retorno += f ? '<button type="submit" class="btn" >Guardar contacto</button>' : "";
    retorno += '</div>';
    retorno += f ? '<input type="hidden" name="a" value="newContacto" />' : "";
    retorno += f ? '<input type="hidden" name="agencia" value="' + a + '" />' : "";
    retorno += f ? '</form>' : "";
    retorno += '</div>';
    retorno += '</div>';

    $("#contactos" + a).append(retorno);
    $('select').formSelect();
    $('textarea').characterCounter();
}
</script>