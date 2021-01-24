<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 3/9/2019
 * Time: 09:29
 * Proyecto: lx_redmultipago.com
 */

?>

<script type="text/javascript">
    // $(function() {
    //     // Handler for .ready() called.
    // });
    function acredita(id)
    {
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            url: "<?= E_URL . E_VIEW ?>",
            data: {
                a: "acredita",
                b: id
            },
            success: function(result)
            {
                // M.toast({html: 'Respuesta recibida', displayLength: 2000});
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    $("#ac" + id).detach();
                    if($('.filasAc').length == 0)
                    {
                        var newRowAcredita = '<tr><td colspan="6" class="cen">Sin acreditaciones pendientes de aprobación</td></tr>';
                        $('#tbAcredita').append(newRowAcredita);
                    }
                    M.toast({html: 'Acreditación registrada correctamente', displayLength: 2000});
                }
                else
                {
                    alert(d);
                }
            }
        });
    }

    function anula(id)
    {
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            url: "<?= E_URL . E_VIEW ?>",
            data: {
                a: "anula",
                b: id
            },
            success: function(result)
            {
                // M.toast({html: 'Respuesta recibida', displayLength: 2000});
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    $("#ac" + id).detach();
                    if($('.filasAc').length == 0)
                    {
                        var newRowAcredita = '<tr><td colspan="6" class="cen">Sin acreditaciones pendientes de aprobación</td></tr>';
                        $('#tbAcredita').append(newRowAcredita);
                    }
                    M.toast({html: 'Acreditación anulada', displayLength: 2000});
                }
                else
                {
                    alert(d);
                }
            }
        });
    }
</script>
