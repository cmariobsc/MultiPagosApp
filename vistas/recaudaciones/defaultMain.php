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
                    <form method="post" id="formRecaudacion">
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
                                    <p style="text-align: center; color: red; font-weight: bold;" id="error" hidden></p>
                                </div>
                                <div id="loading" class="center" hidden>
                                    <div class="preloader-wrapper active">
                                        <div class="spinner-layer spinner-blue-only">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div><div class="gap-patch">
                                                <div class="circle"></div>
                                            </div><div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action der">
                                    <button type="submit" id="btnSend" onclick="Consulta()" class="btn">Continuar</button>
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
        <a class="waves-effect waves-green btn" onclick="Confirmacion()"><i class="material-icons right">check</i>Verificar</a>
        <div id="estado" class="chip">Sin Verificar</div>
        <a id="reversar" class="waves-effect waves-green btn" onclick="Reverso()"><i class="material-icons right">replay</i>Reversar</a>
        <a id="pagar" class="modal-close waves-effect waves-green btn" onclick="Pago()" disabled><i class="material-icons right">attach_money</i>Pagar</a>
        <a class="modal-close waves-effect waves-green btn"><i class="material-icons right">cancel</i>Cancelar</a>
    </div>
</div>
<div id="modalReverso" class="modal">
    <form method="post" id="formReverso">
        <div class="modal-content gradFondo">
            <div class="row">
                <div class="col s12">
                    <h3 style="font-size: 1.6em; margin: 0.4em 0 0.4em 0.4em; text-align: center; color: red; font-weight: bold;">Petición de Reverso</h3>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l9">
                    <div class="row">
                        <div class="col s4">Motivo:</div>
                        <div class="col s8"><input id="motivo" name="motivo" type="text" required="" class="validate"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" onclick="ConfirmarReverso()" class="waves-effect waves-green btn"><i class="material-icons right">check</i>Confirmar</button>
            <a class="modal-close waves-effect waves-green btn"><i class="material-icons right">cancel</i>Cancelar</a>
        </div>
    </form>
</div>

