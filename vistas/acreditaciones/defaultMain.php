<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 31/8/2019
 * Time: 14:04
 * Proyecto: lx_redmultipago.com
 */
echo migas(["Acreditaciones"]);
echo tBack("Registro de depósitos");
?>
<div class="row">
    <div class="col s12 l6">
        <form method="post" >
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Nuevo depósito</div>
                    <div class="row">
                        <?php
                        echo mat_select("Cuenta origen", "cuentaOrigen", $listaCuentasOrigen, "col s12");
                        echo mat_select("Cuenta destino", "cuentaDestino", $listaCuentasDestino, "col s12");
                        echo mat_select("Forma de pago", "formaPago", ["d"=>"Depósito bancario","t"=>"Transferencia bancaria","e"=>"Pago en efectivo"], "col s6");
                        echo mat_picker("Fecha", "fecha",["otherTrueId"=>"fecha", "envoltura"=>"col s6"]);
                        echo mat_input("No. comprobante", "comprobante", ["envoltura"=>"col s12 l6"]);
                        echo mat_input("Valor", "valor", ["envoltura"=>"col s12 l6"]);
                        echo mat_textarea("Observaciones", "texto");
                        ?>
                    </div>
                </div>
                <div class="card-action der"><button type="submit" class="btn">Notificar</button></div>
            </div>
            <input type="hidden" name="a" value="new" />
        </form>
    </div>
    <div class="col s12 l6">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Histórico de Acreditaciones</div>
                <div class="contHistorico">
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Comprobante</th>
                                <th>Valor</th>
                                <th class="cen">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($listaDepositos as $listaDeposito)
                        {
                            switch ($listaDeposito->aprobada)
                            {
                                case "0":
                                    $dAprobado = '<i class="material-icons red-text" '.altImg("Anulada").'>backspace</i>';
                                    break;
                                case null:
                                    $dAprobado = '<i class="material-icons blue-text" '.altImg("Pendiente").'>alarm_on</i>';
                                    break;
                                default:
                                    $dAprobado = '<i class="material-icons green-text" '.altImg("Aprobada").'>beenhere</i>';
                            }

                            echo "<tr>";
                            echo "<td>" . $listaDeposito->fecha . "</td>";
                            echo "<td>" . $listaDeposito->comprobante . "</td>";
                            echo "<td>" . $listaDeposito->valor . "</td>";
                            echo '<td class="cen">' . $dAprobado . '</td>';
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

