<div class="row">
    <div class="col s12 l3">
        <div class="row">
            <?php include "menu.php" ?>
        </div>
    </div>
    <div class="col s12 l9">
        <div class="row">
            <?php if(E_DEVICE_TYPE == "Pc"){include "noticias.php";} ?>
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">Opciones principales</div>
                        <div class="eInt3">
                            <div class="row" style="margin-bottom: 0;">
                                <div class="col s6 l3">
                                    <a href="<?= E_URL ?>recargas/claro" >
                                        <div class="card">
                                            <div class="card-content">
                                                <img src="<?= E_URL ?>public/img/servicios/claro_200.png" <?= altImg("Claro") ?> />
                                                <div class="cen">Claro</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col s6 l3">
                                    <a href="<?= E_URL ?>recargas/movistar" >
                                        <div class="card">
                                            <div class="card-content"><img src="<?= E_URL ?>public/img/servicios/movistar_200.png" <?= altImg("Movistar") ?> />
                                                <div class="cen">Movistar</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col s6 l3">
                                    <a href="<?= E_URL ?>recargas/tuenti" >
                                        <div class="card">
                                            <div class="card-content"><img src="<?= E_URL ?>public/img/servicios/tuenti_200.png" <?= altImg("Tuenti") ?> />
                                                <div class="cen">Tuenti</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col s6 l3">
                                    <a href="<?= E_URL ?>recargas/cnt" >
                                        <div class="card">
                                            <div class="card-content"><img src="<?= E_URL ?>public/img/servicios/cnt_200.png" <?= altImg("CNT") ?> />
                                                <div class="cen">CNT</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6 l3 offset-l3">
                                    <a href="<?= E_URL ?>recaudaciones" >
                                        <div class="card">
                                            <div class="card-content"><img src="<?= E_URL ?>public/img/servicios/recaudaciones_200.png" <?= altImg("Recaudaciones") ?> />
                                                <div class="cen">Recaudaciones</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col s6 l3">
                                    <a href="<?= E_URL ?>bancos" >
                                        <div class="card">
                                            <div class="card-content"><img src="<?= E_URL ?>public/img/servicios/bancos_200.png" <?= altImg("Bancarias") ?> />
                                                <div class="cen">Bancarias</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!--
                                <div class="col s6 l3">
                                    <a href="<?= E_URL ?>" >
                                        <div class="card">
                                            <div class="card-content"><img src="<?= E_URL ?>public/img/servicios/westerunion_200.png" <?= altImg("Envio de dinero") ?> />
                                                <div class="cen">Western Union</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title" id="tituloMainCard">Recaudaciones</div>
                        <div class="eInt3" id="contMainCard">
                            <div class="row">

                            </div>
                            <div id="contFormCard"></div>
                        </div>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>