<?php

$menuPrincipal = [
    "inicio_admin"=>[
        "i"=>"star",
        "n"=>"Inicio"
    ],
    "clientes_admin"=>[
        "i"=>"assignment_ind",
        "n"=>"Clientes",
        "c"=>[
            "clientes" => [
                "i"=>"account_circle",
                "n"=>"Clientes",
                "l"=>"clientes_admin"
            ],
            "tipos" => [
                "i"=>"assignment_ind",
                "n"=>"Tipos",
                "l"=>"tipos_admin"
            ],
            "acreditaciones" => [
                "i"=>"attach_money",
                "n"=>"Acreditaciones",
                "l"=>"clientes_admin/acreditaciones"
            ],
            "contenidos" => [
                "i"=>"subtitles",
                "n"=>"Contenidos",
                "l"=>"contenidos_admin"
            ],
            "bancos" => [
                "i"=>"account_balance",
                "n"=>"Bancos",
                "l"=>"bancos_admin"
            ],
            "cuentas" => [
                "i"=>"attach_money",
                "n"=>"Cuentas",
                "l"=>"cuentas_admin"
            ]
        ]
    ],
    "config_admin"=>[
        "i"=>"gamepad",
        "n"=>"Configuraciones",
        "c"=>[
            "perfiles" => [
                "i"=>"folder_shared",
                "n"=>"Perfiles",
                "l"=>"perfiles_admin"
            ],
            "servicios" => [
                "i"=>"gamepad",
                "n"=>"Servicios",
                "l"=>"servicios_admin"
            ],
            "segmentos" => [
                "i"=>"format_line_spacing",
                "n"=>"Segmentos",
                "l"=>"segmentos_admin"
            ],
            "proveedores" => [
                "i"=>"exit_to_app",
                "n"=>"Proveedores",
                "l"=>"proveedores_admin"
            ],
            "giros" => [
                "i"=>"send",
                "n"=>"Giros",
                "l"=>"giros_admin"
            ]
        ]
    ],
    "usuarios_admin"=>[
        "i"=>"group",
        "n"=>"Usuarios"
    ],
    "salir"=>[
        "i"=>"star",
        "n"=>"Salir"
    ]
];
?>
<div class="row">
    <div class="col s6 offset-s3 l2 cen">
        <?= E_DEVICE_TYPE != "Pc" ? "<p>&nbsp;</p>" : "" ?>
        <a href="<?= E_URL ?>inicio_admin" ><img src="<?= E_URL ?>public/img/logoSitio.png" <?= altImg(E_DOMINIO) ?> /></a>
    </div>
    <div class="col s12 l6 cen">
        <div>&nbsp;</div>
        <div class="eInt3">
            <?= mmPrin($menuPrincipal ) ?>
        </div>
    </div>
    <div class="col s12 l2">
        <div class="eInt3 tipo5">
            <fieldset>
                <legend>Saldos</legend>
                <ul class="black-text">
                    <li>Bwise: $ 2000.00</li>
                    <li>Red Activa: $ 3000.00</li>
                    <li>Pacífico: $ 1000.00</li>
                    <li>Total: $ 6000.00</li>
                </ul>
            </fieldset>
        </div>
    </div>
    <div class="col s12 m6 l2 der tColor4">
        <?= $uExt->usuario_actual() ?>
        <?php
        $alertasEstaEmpresa = $uEmpresa->alertas();
        if($alertasEstaEmpresa->count() > 0): ?>
        <div>
            <div class="right" style="width: 30px;"><img src="<?= E_URL ?>public/img/alerta.gif" onclick="$('#showAlertaCampanita').slideDown()" /></div>
            <div class="clear"></div>
            <div class="wtodo pRel">
                <div class="pAbs eInt tipo4 cen white sombraBox oculto" style="right: 1px; z-index: 50;" id="showAlertaCampanita">
                    <?php foreach ($alertasEstaEmpresa as $aee): ?>
                    <a href="<?= E_URL . $aee->vista ?>"><?= $aee->nombre ?></a><br />
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>



