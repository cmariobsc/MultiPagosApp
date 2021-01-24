<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 13/4/2019
 * Time: 11:58
 * Proyecto: mn_coffee.eqadoor.com
 */
?>
<script type="text/javascript">
    $(function() {
        $('#ref').keyup(function () {
            var newVal = soloVal($(this).val(), /[^A-Za-z0-9_]/g);
            $(this).val(newVal)
        });
    });

    function actualiza(b,c,d)
    {
        $.ajax({
            type: "POST",
            dataType: "text",
            async: true,
            url: "<?= E_URL . E_VIEW ?>",
            data: {
                a: "localUpdate",
                b: b,
                c: c,
                d: $('#'+d).val()
            },
            success: function(result)
            {
                var r = parseInt(result.substr(0,1));
                var d = result.substr(1);
                if(r==1)
                {
                    M.toast({html: d, displayLength: 2000});
                }
                else
                {
                    alert(d);
                }
            }
        });
    }
</script>
