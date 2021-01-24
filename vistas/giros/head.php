<?php //creado auntomáticamente desde localhost

// $paises = ["EC"=>59,"US"=>69,"MX"=>155];

require_once E_VISTAS . 'clientes_admin' . DS . 'models.php';
require_once 'variables.php';
require_once 'models.php';

// "GetH2HCountries", "GetH2HStates", "GetH2HCities", "GetH2HCountryCurrencies", "GetH2HEconomicActivity", "GetH2HGentilicios", "GetH2HCatalogCompilanceTemplate", "GetH2HDeliveryServicesCuba", "GetH2HDeliveryOptionTemplateCuba"
$parts = [
    "provincia",
    "ciudad",
    "enviar_destino",
    "enviar_remitente",
    "enviar_cotizar",
    "enviar_beneficiario",
    "enviar_resumen",
    "enviar_confirmacion",
    "recibir",
    "heartBeat",
    "GetH2HCountries",
    "GetH2HStates",
    "GetH2HCities",
    "GetH2HCountryCurrencies",
    "GetH2HEconomicActivity",
    "GetH2HGentilicios",
    "GetH2HCatalogCompilanceTemplate",
    "GetH2HDeliveryServicesCuba",
    "GetH2HDeliveryOptionTemplateCuba"
];
$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));
if (!empty($subFileLoad)) {include($subFileLoad);}

