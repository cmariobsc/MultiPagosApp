<?php
/**
 * Creator: Cristian Perez
 * E-mail: copm20@outlook.com
 * From: www.emprende.la
 * Date: 02/06/2020
 * Time: 12:14
 * Proyecto: lx_redmultipago.com
 */
//$arreglo=$GLOBALS['info'];
//var_dump($GLOBALS['info']);
//echo (codigo);
// for ($row = 0; $row < count($GLOBALS['info'],COUNT_NORMAL); $row++) {
// echo "<p><b>Row number $row</b></p>";
// echo "<ul>";
// for ($col = 0; $col < 6; $col++) {
// echo "<li>".$GLOBALS['info'][$row][$col]."</li>";
// }
// echo "</ul>";
// }
//echo migas(["recargas"=>"Recargas", "Comprobante"]);
//echo tBack("Comprobante de recarga telefónica");
//$referencia = $_POST[0];
//echo $referencia;
?>
<script type="text/javascript">
    var data = [];
    var dataValues = [];
    $(function () {
        $("#formConsulta").submit(function (e) {
            e.preventDefault();
        });
        $("#formReverso").submit(function (e) {
            e.preventDefault();
        });
    });

    function Consulta()
    {
        $("#loading").attr("hidden", false);
        $('#error').text("");
        $('#error').attr("hidden", true);
        $('#estado').text("Sin Reversar");
        $('#estado').css('background-color', '');

        var idProducto = $("#productos option:selected").val();
        var proveedor = $("#productos option:selected").text();
        var referencia = $('#referencia').val();

        if (idProducto !== "")
        {
            $.ajax({
                type: "POST",
                url: "<?= E_URL . E_VIEW ?>",
                data: {a: "reversos", action: 'SWSBFacilito_Consulta', parameters: {idProducto, referencia}},
                success: function (result) {
                    data = JSON.parse(result.split('}<')[0] + '}');
                    $("loading").attr("hidden", true);

                    if (data.CodigoResultado !== '000') {
                        $('#error').text(data.Mensaje);
                        $('#error').attr("hidden", false);
                    } else {
                        $('#proveedor').text(proveedor);
                        $('#referencial').text(data.ObjRecuest.Referencia);
                        $('#identificacion').text(data.Identificacion);
                        $('#nombre').text(data.Nombre);

                        dataValues = data.DataConsulta["INT_ResplyConsulta.INT_DataConsulta"];

                        if (dataValues.length === undefined) {
                            dataValues = data.DataConsulta;
                        }

                        $('#tblValues tbody').empty();
                        var valor = 0;
                        $.each(dataValues, function (i, item) {
                            $('<tr>').append(
                                    $('<td>').text(item.Prioridad),
                                    $('<td>').text(item.Descripcion),
                                    $('<td>').text(item.Valor))
                                    .appendTo('#tblValues');

                            valor = valor + Number(item.Valor);
                            $('#comision').val(item.Comision);
                        });

                        $('#valor').val(parseFloat(valor.toFixed(2)));

                        var total = Number(valor) + Number($('#comision').val());
                        $('#total').val(parseFloat(total.toFixed(2)));

                        $('#modalConsulta').modal('open');
                    }
                    $("#loading").attr("hidden", true);
                }
            });
        } else {
            $("#loading").attr("hidden", true);
            $('#error').text(data.Mensaje);
            $('#error').attr("hidden", false);
        }
    }

    function Reverso()
    {
        $('#modalReverso').modal('open');
    }

    function ConfirmarReverso()
    {
        var idTransaccion = data.IDTransaccion;
        var motivo = $('#motivo').val();
        $.ajax({
            type: "POST",
            url: "<?= E_URL . E_VIEW ?>",
            data: {a: "reversos", action: 'SWSBFacilito_Reverso', parameters: {idTransaccion, motivo}},
            success: function (result) {
                var response = JSON.parse(result.split('}<')[0] + '}');
                $('#estado').text(response.Mensaje);
                if (response.CodigoResultado === "000") {
                    $('#estado').css('background-color', 'greenyellow');
                } else {
                    $('#estado').css('background-color', 'orange');
                }
                $('#modalReverso').modal('close');
            }
        });
    }
</script>
