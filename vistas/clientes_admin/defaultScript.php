<script type="text/javascript">
    var evaluaForm = [];
    evaluaForm[0] = []; // evalúa null (select)
    evaluaForm[1] = []; // evalúa ""
    var sede = 0;
    var redSocial = 1;
    var marcaRegistrada = 1;

$(function(){

    addSede(); //{destino: "listaSedes", entorno: "col s12 l6"}

    $('#addSede').click(function () {
        addSede(); //{destino: "listaSedes", entorno: "col s12 l6"}
    });
    $('#userBtn').click(function() {
        if($('#cliente').val() != null){
            $('#form2').submit();
        } else {
            alert("Debe seleccionar un cliente");
        }
    });
    $('textarea').characterCounter();
});


function addSede(obj)
{
    var defecto = {
        destino: "listaSedes",
        entorno: "col s12 l6",
        formulario: false
    };
    var obj = obj || defecto;
    var a = sede++;
    var d = obj.destino;    // Destino para insertar el resultado
    var e = obj.entorno;    // Entorno
    var f = obj.formulario;   // Es para definir si trae su propio formulario
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

    r += f ? '<div class="eInt3 mAA10 cen">' : "";
    r += f ? '<button type="submit" class="btn" >Guardar Agencia</button>' : "";
    r += f ? '</div>' : "";
    r += f ? '<input type="hidden" name="a" value="updateAgencia" />' : "";
    r += f ? '<input type="hidden" name="agenciaId" value="' + a + '" />' : "";
    r += f ? '</form>' : "";

    r += '<div class="col s12" id="contactos' + a + '"></div>';
    r += '<div class="col s12 der" >';
    r += '<button class="btn waves-effect waves-light" type="button" onclick="addContacto(' + a + ')" >Nuevo contacto <i class="material-icons right">add</i></button>';
    r += '</div>';
    r += '</div>';
    r += '</fieldset>';
    r += '</article>';

    $('#' + d).append(r);

    addContacto(a);

    $('textarea').characterCounter();

}

function addContacto(a, f)
{
    var f = f || false; // Es para definir si trae su propio formulario
    var retorno = '<div class="card blue-grey lighten-4">';
    retorno += '<div class="card-content">';
    retorno += '<div class="card-title">Contacto</div>';
    retorno += f ? '<form method="post">' : "";
    retorno += '<div class="row">';
    retorno += MATCSS.input("Nombre(s)", "contactoNombre_" + a + "[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("Apellido(s)", "contactoApellido_" + a + "[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("Teléfono fijo", "contactoTelefonoFijo_" + a + "[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("Teléfono Móvil", "contactoTelefonoMovil_" + a + "[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("E-Mail", "contactoCorreo_" + a + "[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.input("Cargo", "contactoCargo_" + a + "[]", {env: "col s12 l6", id: MATCSS.sid()});
    retorno += MATCSS.textarea("Notas", "contactoNotas_" + a + "[]", {env: "col s12", id: MATCSS.sid()});
    retorno += '</div>';

    <?php if($uExt->role_slug() == "Master" || $uExt->role_slug() == "Administrador"): ?>
    tmpId = MATCSS.sid();
    retorno += '<fieldset class="eInt3">';
    retorno += '<legend>Crear Usuario</legend>';
    retorno += '<div class="row">';
    // retorno += '<div class="col s10 offset-s1">';
    // retorno += '<p class="notas tColor2 cen">Ingresar contraseña y rol de usuario, sólo si el presente contacto debe convertirse en usuario autorizado del sistema</p>';
    // retorno += '</div>';
    // retorno += MATCSS.input("Contraseña", "contactoPass_" + a + "[]", {env: "col s5 offset-s1", id: tmpId, type: "password"});
    // retorno += '<div class="input-field col s5 izq">';
    // retorno += '<button class="btn waves-effect waves-light" type="button" onclick="newPass(\'' + tmpId + '\')" >Generar <i class="material-icons left">fingerprint</i></button>';
    // retorno += '</div>';
    retorno += MATCSS.select("Seleccionar rol de usuario", "contactoRol_" + a + "[]", {env: "col s10 offset-s1", id: MATCSS.sid(), cont: <?= $objRoles ?>, value: "Usuario"});
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

function newPass(a)
{
    $('#' + a).next().addClass("active");
    $('#' + a).val(genPass());
}

function initMap()
{
    var myLatLng = {lat: -2.1326, lng: -79.9046};

    var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 12,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Set lat/lon values for this property',
        draggable: true
    });

    // marker drag event
    google.maps.event.addListener(marker, 'drag', function (event) {
        document.getElementById('lat').value = event.latLng.lat().toFixed(5);
        document.getElementById('lng').value = event.latLng.lng().toFixed(5);
    });

    //marker drag event end
    google.maps.event.addListener(marker, 'dragend', function (event) {
        document.getElementById('lat').value = event.latLng.lat().toFixed(5);
        document.getElementById('lng').value = event.latLng.lng().toFixed(5);
    });
}

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG-0Iktd8YvwKW_IPMy6KkP8jyy-qTbxU&signed_in=true&callback=initMap"></script>