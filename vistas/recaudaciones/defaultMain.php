<?php ?>
<div class="row">
    <div class="col s12 l3">
        <div class="row">
            <?php include "menu.php" ?>
        </div>
    </div>
    <div class="col s12 l9">
        <div class="row">
            <div class="row" style="margin-bottom: 0;">
                <div class="col s12">
                    <form method="post" id="form1">
                        <div class="card" id="card">
                            <div class="card-content">
                                <div class="card-title" id="tituloMainCard">Recaudaciones</div>
                                <div class="row" >
                                    <?= mat_select("Productos", "productos", mat_select_list("EmpProductos", "Identidad", "Nombre"), "col s12") ?>
                                    <div class="col s6">
                                        <label for="referencia">Referencia</label>
                                        <input id="referencia" name="referencia" type="text" required="" class="validate">
                                    </div>
                                </div>
                                <div class="row" >
                                    <p style="text-align: center; color: red; font-weight: bold;" id="error" disabled></p>
                                </div>
                                <div class="card-action der">
                                    <button type="button" id="btnSend" onclick="Consulta()" class="btn">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalConfirmacion" class="modal">
    <div class="modal-content gradFondo">
        <div class="row">
            <div class="col s12">
                <h3 style="font-size: 1.6em; margin: 0.4em 0 0.4em 0.4em; text-align: center; color: red; font-weight: bold;">CONFIRMACIÓN DE DATOS</h3>
            </div>
        </div>
        <div class="row">
            <div class="col l3 hide-on-med-and-down" style="margin-top: 5%;">
                <img src="<?= E_URL ?>public/img/logoSitio.png" <?= altImg(E_DOMINIO) ?> />
            </div>
            <div class="col s12 l9">
                <div class="row">
                    <div class="col s4">PROVEEDOR:</div>
                    <div class="col s8" style="color: black; font-weight: bold;"><p id="proveedor"></p></div>
                </div>
                <div class="row">
                    <div class="col s4">REFERENCIA:</div>
                    <div class="col s8" style="color: black; font-weight: bold;"><p id="referencial"></p></div>
                </div>
                <div class="row">
                    <div class="col s4">IDENTIFICACIÓN:</div>
                    <div class="col s8" style="color: black; font-weight: bold;"><p id="identificacion"></p></div>
                </div>
                <div class="row">
                    <div class="col s4">CLIENTE:</div>
                    <div class="col s8" style="color: black; font-weight: bold;"><p id="nombre"></p></div>
                </div>
                <table id="tblValues" class="responsive-table highlight centered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>PRIORIDAD</th>
                            <th>PERIODO</th>
                            <th>VALOR FACTURA</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col s2"><b>Valor:</b></div>
                    <div class="col s2">
                        <input id="valor" name="valor" required="" class="validate">
                    </div>
                    <div class="col s2"><b>Comisión:</b></div>
                    <div class="col s2">
                        <input id="comision" name="comision" required="" class="validate">
                    </div>
                    <div class="col s2" style="color: red; font-weight: bold;"><b>Total:</b></div>
                    <div class="col s2">
                        <input id="total" style="color: red; font-weight: bold;" name="total" required="" class="validate">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="waves-green btn" onclick="Confirmacion()"><i class="material-icons right">check</i>Verificar</a>
        <div id="estado" class="chip">Sin Verificar</div>
        <a id="pagar" class="modal-close waves-effect waves-green btn" onclick="Pago()" disabled><i class="material-icons right">attach_money</i>Pagar</a>
        <a class="modal-close waves-effect waves-green btn"><i class="material-icons right">cancel</i>Cancelar</a>
    </div>
</div>
<div id="modalDetalle" class="modal">
    <div class="modal-content gradFondo">
        <div class="row">
            <div class="col s12">
                <h3 style="font-size: 1.6em; margin: 0.4em 0 0.4em 0.4em; text-align: center; color: red; font-weight: bold;">Detalle del Pago</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s4">Se ha generado la factura:</div>
            <div class="col s8" style="color: black; font-weight: bold;"><p id="factura"></p></div>
        </div>
        <div class="row">
            <div class="col s4">Fecha y Hora:</div>
            <div class="col s8" style="color: black; font-weight: bold;"><p id="fecha"></p></div>
        </div>
    </div>
</div>

