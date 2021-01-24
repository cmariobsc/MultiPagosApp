<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 24/1/2020
 * Time: 10:54
 * Proyecto: lx_redmultipago.com
 */
?>
<script type="text/javascript">
    var buscando = '<img src="<?= E_URL ?>public/img/bigWaiting.gif" <?= altImg("Esperando respuesta") ?> />';
    var recibido = '<i class="material-icons white-text">stars</i>';
    var catalogos = ["GetH2HCountries", "GetH2HStates", "GetH2HCities", "GetH2HCountryCurrencies", "GetH2HEconomicActivity", "GetH2HGentilicios", "GetH2HCatalogCompilanceTemplate", "GetH2HDeliveryServicesCuba", "GetH2HDeliveryOptionTemplateCuba"];
    var catalogoId = 0;

    $(function() {
        $('.dasCatE span.icw').html(buscando);

        buscarDas();
    });

    function buscarDas()
    {
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            url: "<?= E_URL ?>giros/" + catalogos[catalogoId],
            success: function(result)
            {
                //M.toast({html: 'Respuesta recibida', displayLength: 2000});
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    M.toast({html: 'Catálogo ' + catalogos[catalogoId] + ' actualizado', displayLength: 3000});
                    $('#' + catalogos[catalogoId] + ' span.icw').html(recibido);
                    $('#' + catalogos[catalogoId]).removeClass("dasCatE");
                    $('#' + catalogos[catalogoId]).addClass("dasCatR");

                    if(catalogos[++catalogoId])
                    {
                        buscarDas();
                    }
                    else
                    {
                        $('#showRegreso').removeClass("oculto");
                    }
                }
                else
                {
                    alert(d);
                }
            },
            error: function()
            {
                M.toast({html:'Imagen imposible de subir'}, 3000, 'rounded');
            }
        });
    }

    function buscarPais()
    {
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            beforeSend: function()
            {
                M.toast({html: 'Contactando al servidor', displayLength: 1000});
            },
            url: "<?= E_URL . E_VIEW ?>/lugarPais",
            success: function(result)
            {
                M.toast({html: 'Respuesta recibida', displayLength: 2000});
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    M.toast({html: 'Paises actualizados', displayLength: 3000});
                    $('#GetH2HCountries span.icw').html(recibido);
                    $('#GetH2HCountries').removeClass("dasCatE");
                    $('#GetH2HCountries').addClass("dasCatR");

                    buscarProvincia();
                }
                else
                {
                    alert(d);
                }
            },
            error: function()
            {
                M.toast({html:'Imagen imposible de subir'}, 3000, 'rounded');
            }
        });
    }

    function buscarProvincia()
    {
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            beforeSend: function()
            {
                M.toast({html: 'Contactando al servidor', displayLength: 1000});
            },
            url: "<?= E_URL . E_VIEW ?>/lugarProvincia",
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
                        env: "col s12 l4",
                        cont: JSON.parse(d),
                        fun: {f: "buscarCiudades", v: "$(this).val()"}
                    };
                    var listaProv = MATCSS.select("Provincia/Estado", "provincia", ob);
                    $('#selProvincia').html(listaProv);
                    $('select').formSelect();
                }
                else
                {
                    console.log(d);
                    alert(d);
                }
            },
            error: function()
            {
                M.toast({html:'Imagen imposible de subir'}, 3000, 'rounded');
            }
        });
    }

    function buscarCiudad(provincia)
    {
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            beforeSend: function()
            {
                M.toast({html: 'Contactando al servidor', displayLength: 1000});
            },
            url: "<?= E_URL . E_VIEW ?>/lugarCiudad",
            data: {
                p: provincia
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
                        env: "col s12 l4",
                        cont: JSON.parse(d)
                    };
                    var listaMun = MATCSS.select("Ciudad", "ciudad", ob);
                    $('#selMunicipio').html(listaMun);
                    $('select').formSelect();
                }
                else
                {
                    console.log(d);
                    alert(d);
                }
            },
            error: function()
            {
                M.toast({html:'Imagen imposible de subir'}, 3000, 'rounded');
            }
        });
    }
</script>
