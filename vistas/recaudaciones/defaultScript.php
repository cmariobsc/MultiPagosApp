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
        $('#tblValues').on('click', 'input[type="checkbox"]', function () {
            var valor = 0;
            $('#valor').val(valor);
            $('#comision').val(valor);
            $('#total').val(valor);
            $('#tblValues input[type="checkbox"]:checked').each(function () {
                var idRubro = $(this).attr("id");
                $.each(dataValues, function (i, item) {
                    if (item.IDRubro === idRubro) {
                        valor = valor + Number(item.Valor);
                        $('#comision').val(item.Comision);
                        $('#valor').val(parseFloat(valor.toFixed(2)));
                        var total = Number(valor) + Number($('#comision').val());
                        $('#total').val(parseFloat(total.toFixed(2)));
                    }
                });
            });
        });
    });

    function Consulta()
    {
        $('#estado').text("Sin Verificar");
        $('#estado').css('background-color', '');
        $('#pagar').attr( "disabled", true);
        
        var idProducto = $("#productos option:selected").val();
        var proveedor = $("#productos option:selected").text();
        var referencia = $('#referencia').val();

        $.ajax({
            type: "POST",
            url: "http://localhost/puntoagil/lib/wsRepository.php",
            data: {action: 'SWSBFacilito_Consulta', parameters: {idProducto, referencia}},
            success: function (result) {
                data = JSON.parse(result);
                $('#error').text(data.Mensaje);
                $('#error').attr( "disabled", false);
                
                $('#proveedor').text(proveedor);
                $('#referencial').text(data.ObjRecuest.Referencia);
                $('#identificacion').text(data.Identificacion);
                $('#nombre').text(data.Nombre);

                dataValues = data.DataConsulta["INT_ResplyConsulta.INT_DataConsulta"];

                if (dataValues.length == undefined) {
                    dataValues = data.DataConsulta;
                }

                $('#tblValues tbody').empty();
                var valor = 0;
                $.each(dataValues, function (i, item) {
                    $('<tr>').append(
                            $('<td>').html("<label><input id='" + item.IDRubro + "' type='checkbox' class='filled-in' checked='checked' /><span></span></label>"),
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

                $('#modalConfirmacion').modal('open');
            }
        });
    }

    function Confirmacion()
    {
        var dataPago = [];
        $('#tblValues input[type="checkbox"]:checked').each(function () {
            var idRubro = $(this).attr("id");
            $.each(dataValues, function (i, item) {
                if (item.IDRubro === idRubro) {
                    dataPago.push({"IDRubro": item.IDRubro, "ValorConComision": item.ValorConComision});
                }
            });
        });

        var idTransaccion = data.IDTransaccion;
        $.ajax({
            type: "POST",
            url: "http://localhost/puntoagil/lib/wsRepository.php",
            data: {action: 'SWSBFacilito_Confirmacion', parameters: {idTransaccion, dataPago}},
            success: function (result) {
                var response = JSON.parse(result);
                $('#estado').text(response.Mensaje);
                $('#estado').css('background-color', 'greenyellow');
                $('#pagar').attr( "disabled", false);
            }
        });
    }
    
    function Pago()
    {
        var dataPago = [];
        $('#tblValues input[type="checkbox"]:checked').each(function () {
            var idRubro = $(this).attr("id");
            $.each(dataValues, function (i, item) {
                if (item.IDRubro === idRubro) {
                    dataPago.push({"IDRubro": item.IDRubro, "ValorConComision": item.ValorConComision});
                }
            });
        });

        var idTransaccion = data.IDTransaccion;
        $.ajax({
            type: "POST",
            url: "http://localhost/puntoagil/lib/wsRepository.php",
            data: {action: 'SWSBFacilito_Pago', parameters: {idTransaccion, dataPago}},
            success: function (result) {
                var response = JSON.parse(result);
                dataPayments = response.DataPago["INT_ResplyPago.INT_DataPago"];

                if (dataPayments.length == undefined) {
                    dataPayments = response.DataPago;
                }
                $.each(dataPayments, function (i, item) {
                    $('#factura').text(item.Factura);
                    $('#fecha').text(response.FechaHoraTransaccion);
                });
                $('#modalDetalle').modal('open');
            }
        });
    }
</script>
