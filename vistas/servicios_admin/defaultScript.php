<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 5/2/2020
 * Time: 19:20
 * Proyecto: lx_redmultipago.com
 */
?>
<script type="text/javascript">
    $(function() {
        $('#codigo').change(function(){
            var c = $(this).val();

            $.ajax({
                type: "POST",
                dataType: "text",
                async: true,
                beforeSend: function()
                {
                    M.toast({html: 'Verificando código ingresado', displayLength: 2000});
                },
                url: "<?= E_URL . E_VIEW ?>",
                data: {
                    a: "verCodigo",
                    b: c
                },
                success: function(result)
                {
                    //M.toast({html: 'Respuesta recibida', displayLength: 2000});
                    var r = parseInt(result.substr(0,1));
                    var d = result.substr(1);
                    if(r!=1)
                    {
                        alert("El códio ya existe, ingrese uno distinto");
                        $('#codigo').val("");
                        $('#codigo').focus();
                    }
                },
                error: function()
                {
                    M.toast({html:'Imagen imposible de subir'}, 3000, 'rounded');
                }
            });
        });
    });
</script>
