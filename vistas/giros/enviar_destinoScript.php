<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 16/1/2020
 * Time: 11:51
 * Proyecto: lx_redmultipago.com
 */


?>
<script type="text/javascript">
    //var pProv = JSON.parse('<?php // json_encode($pSelPais) ?>');

    $(function() {
        $('#paisDestino').change(function () {
            var pais = $(this).val();
            switch (pais) {
                case "EC":      // EC 59
                case "US":      // US 69
                case "MX":      // MX 155
                //case "CA":      // CA
                    buscarProvincias(pais);
                    break;
                default:
                   datosRemitente();
            }

        });
    });

    function buscarProvincias(pais)
    {
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            beforeSend: function()
            {
                M.toast({html: 'Contactando al servidor', displayLength: 1000});
            },
            url: "<?= E_URL . E_VIEW ?>/provincia",
            data: {
                p: pais
            },
            success: function(result)
            {
                M.toast({html: 'Respuesta recibida', displayLength: 2000});
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    //console.log(d);
                    var ob = {
                        env: "col s12",
                        cont: JSON.parse(d),
                        fun: {f: "buscarCiudades", v: "$(this).val()"}
                    };
                    var listaProv = MATCSS.select("Provincia/Estado", "provincia", ob);
                    $('#selProvincia').html(listaProv);
                    $('select').formSelect();
                }
                else
                {
                    //console.log(d);
                    alert(d);
                }
            },
            error: function()
            {
                M.toast({html:'Imagen imposible de subir'}, 3000, 'rounded');
            }
        });
    }

    function buscarCiudades(provincia)
    {
        var pais = $('#paisDestino').val();
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            beforeSend: function()
            {
                M.toast({html: 'Contactando al servidor', displayLength: 1000});
            },
            url: "<?= E_URL . E_VIEW ?>/ciudad",
            data: {
                pro: provincia,
                pa: pais
            },
            success: function(result)
            {
                //M.toast({html: 'Respuesta recibida', displayLength: 2000});
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    //console.log(d);
                    var ob = {
                        env: "col s12",
                        cont: JSON.parse(d)
                    };
                    var listaMun = MATCSS.select("Ciudad", "ciudad", ob);
                    $('#selCiudad').html(listaMun);
                    $('select').formSelect();

                    datosRemitente();
                }
                else
                {
                    //console.log(d);
                    alert(d);
                }
            },
            error: function()
            {
                M.toast({html:'Imagen imposible de subir'}, 3000, 'rounded');
            }
        });
    }

    function datosRemitente()
    {
        $('#selRemitente').removeClass("oculto");
    }

    function continuar()
    {
        $('#pa').val();
        $('#pr').val();
        $('#ci').val();
        $('#form1').submit();
    }
</script>
