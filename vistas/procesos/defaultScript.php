<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 21/7/2019
 * Time: 11:30
 * Proyecto: lx_multipagos.eqadoor.com
 */
?>
<script type="text/javascript">
$(function(){
    $('#segmento').change(function () {
        var segmento = parseInt($(this).val());

        switch (segmento) {
            case 9:
                //recargas
                window.location.assign("<?= E_URL ?>recargas");
                break;
            default:
                $.ajax({
                    type: "POST",
                    dataType: "text",
                    async: true,
                    beforeSend: function()
                    {
                        M.toast({html: 'Contactando al servidor', displayLength: 1000});
                    },
                    url: "<?= E_URL . E_VIEW ?>",
                    data: {
                        a: "servicio",
                        b: segmento
                    },
                    success: function(result)
                    {
                        var r = parseInt(result.substr(0,1));
                        var d = result.substr(1);
                        if(r==1)
                        {
                            newListaForm = JSON.parse(d);

                            listaServicios = "";
                            listaServicios += '<option value="" disabled="" selected="">Seleccionar</option>';
                            for (obj in newListaForm) {
                                listaServicios += '<option value="' + obj + '" >' + newListaForm[obj] + '</option>';
                            }
                            $('#servicio').html(listaServicios);
                            $('select').formSelect();
                            $('#servicio').parent().parent().removeClass("oculto");

                        }
                        else
                        {
                            alert(d);
                        }
                    }
                });
        }
    });

    $('#servicio').change(function(){
        var servicio = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            beforeSend: function()
            {
                M.toast({html: 'Contactando al servidor', displayLength: 1000});
            },
            url: "<?= E_URL . E_VIEW ?>",
            data: {
                a: "servicioForm",
                b: servicio
            },
            success: function(result)
            {
                M.toast({html: 'Respuesta recibida', displayLength: 2000});
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    //console.log(d);
                    $('#contFormCard').html(d);
                }
                else
                {
                    alert(d);
                }
            }
        });
    });
});
</script>
