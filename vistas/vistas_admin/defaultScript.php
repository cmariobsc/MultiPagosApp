<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: grupomodo.com
 * Date: 5/24/2018
 * Time: 11:51 AM
 */
?>
<script type="text/javascript">

    $(function () {
        $('#modelo').focus(function () {
            $('#tablaContenido').removeClass("oculto");
        })
        $('#modelo').change(function () {
            var valTabla = $('#modelo').val();
            $('#tabla').val(valTabla+"s");
        })
    })

</script>
