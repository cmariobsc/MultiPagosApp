<?php
require_once E_LIB . "class" . DS . "class.menuprin.php";


//    "giros" => [
//        "i"=>"monetization_on",
//        "n"=>"Giros",
//        "l"=>"giros"
//    ],

$menuPrincipal = [
    "inicio_usuarios"=>[
        "i"=>"star",
        "n"=>"Inicio"
    ],
    "procesos"=>[
        "i"=>"all_inclusive",
        "n"=>'Procesos',
        "c"=>[
            "recargas" => [
                "i"=>"mobile_friendly",
                "n"=>"Recargas",
                "l"=>"recargas"
            ],
            "girosven" => [
                "i"=>"local_atm",
                "n"=>"Venezuela",
                "l"=>"giros_venezuela"
            ],
            "recaudaciones" => [
                "i"=>"local_atm",
                "n"=>"Recaudaciones",
                "l"=>"recaudaciones"
            ],
            "bancos" => [
                "i"=>"account_balance",
                "n"=>"Bancarias",
                "l"=>"bancos"
            ],
            "consultas" => [
                "i"=>"report",
                "n"=>"Consultas",
                "l"=>"consultas"
            ],
            "reversos" => [
                "i"=>"rotate_left",
                "n"=>"Reversos",
                "l"=>"reversos",
                "u"=>[5]
            ]
        ]
    ],
    "settings"=>[
        "i"=>"settings",
        "n"=>'Configuración',
        "c"=>[
            "usuarios" => [
                "i"=>"account_box",
                "n"=>"Usuarios",
                "l"=>"usuarios_admin",
                "u"=>[5]
            ],
            "acreditaciones" => [
                "i"=>"note_add",
                "n"=>"Acreditar",
                "l"=>"acreditaciones",
                "u"=>[3,5]
            ],
            "cuentas" => [
                "i"=>"attach_money",
                "n"=>"Cuentas de banco",
                "l"=>"cuentas_admin",
                "u"=>[5]
            ]
        ]
    ],
    "salir"=>[
        "i"=>"star",
        "n"=>"Salir"
    ]
];
//<i class="material-icons">settings</i>
$MP = new MenuPrin();
$MP->b = $b;
$MP->userTipo = $userTipo;
$MP->m = $menuPrincipal;
$MP->d = E_DEVICE_TYPE == "Pc" ? "" : "v";

?>
<div class="row">
    <div class="col s6 l3 izq">
        <a href="<?= E_URL . E_INDEX ?>" ><img class="mArriba10" src="<?= E_URL ?>public/img/logoSitio.png" <?= altImg(E_DOMINIO) ?> /></a>
    </div>
    <div class="col s6 der tColor4 hide-on-large-only">
        <div class="row">
            <div class="col s12 m6">
                <?= $uExt->usuario_actual() ?>
            </div>
            <div class="col s12 m6">
                <div class="der">WhatsApp y PBX: <br />
                    <a href="https://api.whatsapp.com/send?phone=593969870104" target="_blank" >+593 96 987 0104</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m6 l5 tipo5 cen">
        <div <?= E_DEVICE_TYPE == "Pc" ? 'class="valign-wrapper" style="height: 126px; margin-right: 2em;"' : '' ?> >
            <?= $MP->mmPrin() ?>
        </div>
    </div>
    <div class="col l4 der tColor4 hide-on-med-and-down">
        <div class="row">
            <div class="col s12 l6">
                <?php if(E_DEVICE_TYPE == "Pc"){include E_VISTAS . "procesos" . DS . "estados.php";} ?>
            </div>
            <div class="col s12 l6">
                <?= $uExt->usuario_actual() ?>
                <div class="der mArriba10">WhatsApp y PBX: <br />
                    <a href="https://api.whatsapp.com/send?phone=593969870104" <?= altImg("Contáctos") ?> target="_blank" >+593 96 987 0104</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col s10 tipo4 hide-on-large-only">
        <?php if(E_DEVICE_TYPE != "Pc"){include E_VISTAS . "procesos/noticias.php";} ?>
    </div>
    <div class="col s2 hide-on-large-only">
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="small material-icons">menu</i></a>
    </div>
</div>



