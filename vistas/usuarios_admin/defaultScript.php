<script type="text/javascript">

    //var elem = document.querySelector('select');
    //var instanciaSelect = M.Select.init(elem, options);

//    var listaUsuarios = document.querySelector('.collapsible');
//    var instanciaListaUsuarios = M.Collapsible.init(listaUsuarios);

    $(function() {
        //$('select').material_select();

        $('#btnActual').click(function(){
            $('#<?= cNom("contNew") ?>').slideUp();
            $('#<?= cNom("contActual") ?>').slideDown();
        });

        $('#btnNew').click(function(){
            $('#<?= cNom("contActual") ?>').slideUp();
            $('#<?= cNom("contNew") ?>').slideDown();
        });

        //$('.collapsible').collapsible();

        $('#sendForm').click(function(){
           $('#nuevo-usuario').submit();
        });
    });

    function borrarUsuario(a, b)
    {
        if(confirma('Confirma borrar el usuario '+b))
        {
            window.location.assign("<?= E_VIEW ?>?a=delete&id="+a)
        }
    }

</script>