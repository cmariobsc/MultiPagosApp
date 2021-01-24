<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 9/7/2019
 * Time: 11:17
 * Proyecto: lx_multipagos.eqadoor.com
 */
?>
<script type="text/javascript">
    var perfilUpdate = 0;
    function newComision(a,b,c) {
        $('#nuevaComIn').val(b);
        $('#nuevaComOut').val(c);
        $('#nuevaComIn').next().addClass("active");
        $('#nuevaComOut').next().addClass("active");

        perfilUpdate = a;
    }

    function actualiza()
    {
        var coIn = $('#nuevaComIn').val();
        var coOut = $('#nuevaComOut').val();

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
                a: "update",
                id: perfilUpdate,
                comIn: coIn,
                comOut: coOut
            },
            success: function(result)
            {
                //M.toast({html: 'Respuesta recibida', displayLength: 2000});
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    $('#cIn' + perfilUpdate).text(coIn);
                    $('#cOut' + perfilUpdate).text(coOut);
                    //$('#cIn' + perfilUpdate).parentsUntil("td").addClass("ftColor1").delay(5000).removeClass("ftColor1");
                    //$('#cOut' + perfilUpdate).parentsUntil("td").addClass("ftColor1").delay(5000).removeClass("ftColor1");
                    M.toast({html: d, displayLength: 3000});
                }
                else
                {
                    alert(d);
                }
            }
        });
    }
</script>
