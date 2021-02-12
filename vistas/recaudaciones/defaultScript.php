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
        $("#formRecaudacion").submit(function (e) {
            e.preventDefault();
        });
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
        $("#loading").attr("hidden", false);
        $('#error').text("");
        $('#error').attr("hidden", true);
        $('#estado').text("Sin Procesar");
        $('#estado').css('background-color', '');

        var idProducto = $("#productos option:selected").val();
        var proveedor = $("#productos option:selected").text();
        var referencia = $('#referencia').val();

        if (idProducto !== "")
        {
            $.ajax({
                type: "POST",
                url: "<?= E_URL . E_VIEW ?>",
                data: {a: "recaudaciones", action: 'SWSBFacilito_Consulta', parameters: {idProducto, referencia}},
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

    function Pago()
    {
        $("#loading").attr("hidden", false);

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
        console.log(idTransaccion);
        console.log(dataPago);
        $.ajax({
            type: "POST",
            url: "<?= E_URL . E_VIEW ?>",
            data: {a: "recaudaciones", action: 'SWSBFacilito_Pago', parameters: {idTransaccion, dataPago}},
            success: function (result) {
                var response = JSON.parse(result.split('}<')[0] + '}');
                var xmlDocument = $.parseXML(response.XMLRecibo);
                var jsonData = xml2json(xmlDocument);
                creaComprobante(jsonData.COMPROBANTE);
                $("#loading").attr("hidden", true);
            }
        });
    }

    function creaComprobante(comprobante) {
        console.log(comprobante);
        var opciones = {
            orientation: 'p',
            unit: 'mm',
            pagesplit: true,
            format: [240, 305]
        };
        var doc = new jsPDF(opciones);
        var pageWidth = doc.internal.pageSize.getWidth();

        if (comprobante.RECIBO.length !== undefined) {
            comprobante = comprobante.RECIBO;
        };
        
        $.each(comprobante, function (i, recibo) {
            doc.setFontSize(12);
            doc.text(pageWidth / 2, 10, 'MULTIPAGOS', 'center');

            doc.setFontSize(7);
            doc.text(pageWidth / 2, 15, 'Recibo de Pago de Servicios', 'center');
            doc.text(pageWidth / 2, 20, recibo.LINEA_3, 'center'); //RUC
            doc.text(pageWidth / 2, 25, recibo.LINEA_4, 'center'); //DETALLE COMPROBANTE
            doc.text(pageWidth / 2, 30, recibo.LINEA_5, 'center'); //Nº COMPROBANTE

            doc.text(9, 35, recibo.LINEA_7);  //TIPO RECAUDACIÒN
            doc.text(9, 40, recibo.LINEA_8);  //REFERENCIA
            doc.text(9, 45, recibo.LINEA_9);  //NOMBRE
            doc.text(9, 50, recibo.LINEA_10); //CEDULA
            doc.setLineWidth(0.1);
            doc.line(9, 55, 77, 55);
            for (var i in recibo) {
                if (recibo[i].match(/USUARIO/))
                    doc.text(9, 60, recibo[i]); //USUARIO
                if (recibo[i].match(/SEC LOC/))
                    doc.text(9, 65, recibo[i]); //SEC LOC/SW
                if (recibo[i].match(/FECHA HORA/))
                    doc.text(9, 70, recibo[i]); //FECHA HORA
                if (recibo[i].match(/CIUDAD/))
                    doc.text(9, 75, recibo[i]); //CIUDAD
                if (recibo[i].match(/VALOR RECAUDADO/)) {
                    doc.setLineWidth(0.1);
                    doc.line(9, 80, 77, 80);
                    doc.text(9, 85, recibo[i]);  //VALOR RECAUDADO
                }
                if (recibo[i].match(/COMISION/)) 
                    doc.text(9, 90, recibo[i]);  //COMISIÓN
                if (recibo[i].match(/TOTAL/)) 
                    doc.text(9, 95, recibo[i]);  //TOTAL
                if (recibo[i].match(/MENSAJE/)) 
                    doc.text(9, 100, recibo[i]);  //MENSAJE
                if (recibo[i].match(/FACTURA/)) 
                    doc.text(9, 105, recibo[i]); //FACTURA
            }
            doc.addPage();
        });
        var pageCount = doc.internal.getNumberOfPages();
        doc.deletePage(pageCount);

        doc.autoPrint();
        doc.output('dataurlnewwindow', {filename: 'comprobante.pdf'});
    }

    function xml2json(xml) {
        try {
            var obj = {};
            if (xml.children.length > 0) {
                for (var i = 0; i < xml.children.length; i++) {
                    var item = xml.children.item(i);
                    var nodeName = item.nodeName;

                    if (typeof (obj[nodeName]) === "undefined") {
                        obj[nodeName] = xml2json(item);
                    } else {
                        if (typeof (obj[nodeName].push) === "undefined") {
                            var old = obj[nodeName];

                            obj[nodeName] = [];
                            obj[nodeName].push(old);
                        }
                        obj[nodeName].push(xml2json(item));
                    }
                }
            } else {
                obj = xml.textContent;
            }
            return obj;
        } catch (e) {
            console.log(e.message);
        }
    }
</script>
