<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 6/10/2019
 * Time: 12:33
 * Proyecto: lx_redmultipago.com
 */

class RA_variables{

    public $servicio;                   // Id en la tabla "emp_servicios"
    public $metodo;                     // Método que se está ejecutando

    public $countryCode;
    public $stateCode;
    public $cityCode;
    public $currencyCode;

    /**
     * VALORES A ENTREGAR A LA API
     */
//·         INICIAL DE CARRIER:        PA
//          CÓDIGO DE AGENCIA:         6916
//·         NÚMERO DE OPERADOR:        1M02
//·         NÚMERO DE TERMINAL:        KF15
//·         CÓDIGO CARRIER:            72

    /**
     * Enterprise
     */
    public $H2HEnterprisesId = "82616ede-f979-44b3-af80-5e1deb4cdc73";
    public $H2Hid = "82616ede-f979-44b3-af80-5e1deb4cdc73";
    public $H2HUser = "AGILAUSE3RMOC";
    public $H2HPassword = "@NET2019GIL11";
    public $H2HCode = "PUN@GG11LL";
//    public $H2HUpLowTime = date("c");
//    public $H2HUpHighTime = date("c");

    /**
     * Brand
     */
    public $brdName = "WU";
    public $brdCountry = "EC";
    public $brdCode = "WES19998";

    /**
     * Common
     */

    /**
     * VALORES A RECIBIR DE LA API
     */
//    public $strIDCliente;                   // Número de transacción Interna del Cliente que fue enviado en la petición de la recarga
//    public $dtmFechaValor;                  // Fecha Valor de la transacciónque fueenviadaen la solicitud de recargaenformatoyyyy-mm-dd
//    public $dtmFechaProceso;                // FechaProceso de la transacción que fueenviadaen la solicitud de recargaenenformatoyyyy-mm-dd

    /**
     * URL de acceso
     */
    public $url_wsdl = 'https://serviciosdev.redesactiva.com/TransferRedWS/';

    /**
     * XML de respuesta
     */
    public $respuestaXML;


    /**
     *      URLs DE LOS MÉTODOS
     */
    public $HeartBeat = "Tra_HeartBeat.asmx?wsdl";                                          // Verificación de conexión
    public $GetH2HCountries = "Tra_DAS.asmx?wsdl";                                          // Catálogos de procesos diarios
    public $GetH2HStates = "Tra_DAS.asmx?wsdl";
    public $GetH2HCities = "Tra_DAS.asmx?wsdl";
    public $GetH2HCountryCurrencies = "Tra_DAS.asmx?wsdl";
    public $GetH2HEconomicActivity = "Tra_DAS.asmx?wsdl";
    public $GetH2HGentilicios = "Tra_DAS.asmx?wsdl";
    public $GetH2HCatalogCompilanceTemplate = "Tra_DAS.asmx?wsdl";
    public $GetH2HDeliveryServicesCuba = "Tra_DAS.asmx?wsdl";
    public $GetH2HDeliveryOptionTemplateCuba = "Tra_DAS.asmx?wsdl";
    public $FeeInquiryService = "FeeInquiryService.asmx?wsdl";                              // Cantidad máxima de pago
    public $Tra_DeliveryServices = "Tra_DeliveryServices.asmx?wsdl";                        // Servicios de entrega
    public $Tra_TransactionCustomerService = "Tra_TransactionCustomerService.asmx?wsdl";    // CLIENTE (BENEFICIARIO EN PAGO, REMITENTE EN ENVÍO)
    public $Tra_TransactionAssociateService = "Tra_TransactionAssociateService.asmx?wsdl";  // ASOCIADO (BENEFICIARIO EN ENVÍO, REMITENTE EN PAGO)
    public $Tra_FileService = "Tra_FileService.asmx?wsdl";                                  // Verificcación de personas impedidas de enviar (INTERDICCIÓN / NEGATIVO)
    public $SendMoneyService = "SendMoneyService.asmx?wsdl";                                // VALIDACIÓN Y ENVÍO DE TRANSFERENCIA WESTERN UNION


    /**
     *      MÉTODOS DISPONIBLES
     */
    public function params()
    {
        $m = $this->metodo;
        return $this->$m();
    }

    public function gURL()
    {
        $m = $this->metodo;
        return $this->url_wsdl . $this->$m;
    }

    /**
     * -----------------------------------------------------------
     *      HEARTBEAT
     * -----------------------------------------------------------
     */

    public function HeartBeat($a=1)
    {
        $parametros = [
            "traRequest" => [
                "objEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HCode" => $this->H2HCode,
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "objBrand" => [
                    "brdName" => $this->brdName,
                    "brdCountry" => $this->brdCountry,
                    "brdCode" => $this->brdCode,
                    "brdId" => $this->H2HEnterprisesId,
                    "brdCreationDate" => date(DATE_ATOM),
                    "brdStatus" => "",
                    "brdDescription" => "",
                    "brdConnectionStatus" => "",
                ],
                "objCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "KF15",
                    "TerminalNameRemote" => "KF15",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "2013.1.0.0",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];

        return $a === 1 ? $parametros : $this->HeartBeat;
    }

    /**
     * -----------------------------------------------------------
     *      CATALOGOS DAS
     * -----------------------------------------------------------
     */

    public function GetH2HCountries($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HCountries;
    }

    public function GetH2HStates($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HStates;
    }

    public function GetH2HCities($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HCities;
    }

    public function GetH2HCountryCurrencies($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HCountryCurrencies;
    }

    public function GetH2HEconomicActivity($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HEconomicActivity;
    }

    public function GetH2HGentilicios($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HGentilicios;
    }

    public function GetH2HCatalogCompilanceTemplate($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HCatalogCompilanceTemplate;
    }

    public function GetH2HDeliveryServicesCuba($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HDeliveryServicesCuba;
    }

    public function GetH2HDeliveryOptionTemplateCuba($a=1)
    {
        $parametros = [
            "DasReq" => [
                "ObjEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HEnterprisesName" => "",
                    "H2HCode" => $this->H2HCode,
                    "H2HObservation" => "",
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "H2HPathFileDownload" => "",
                    "H2HFTPDownload" => "",
                    "IttId" => "",
                    "H2HTemplateWU" => "",
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "ObjCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "UserFullName" => "USUARIO TEST",
                    "UserFullNameRemote" => "USUARIO TEST",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "",
                    "TerminalNameRemote" => "",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "1",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];
        return $a === 1 ? $parametros : $this->GetH2HDeliveryOptionTemplateCuba;
    }

    /**
     * -----------------------------------------------------------
     *      F2ZOOM
     * -----------------------------------------------------------
     */

    public function F2ZoomMessage($a=1)
    {
        $parametros = [
            "traRequest" => [
                "objFeeInquiry" => [
                    "DES_Country_Code" => $this->countryCode,
                    "DES_Currency_Code" => $this->currencyCode,
                    "trnTypeServiceSFOrNP" => "000",
                    "Message_Details" => ""
                ],
                "objEnterprises" => [
                    "H2HEnterprisesId" => $this->H2HEnterprisesId,
                    "H2HUser" => $this->H2HUser,
                    "H2HPassword" => $this->H2HPassword,
                    "H2HCode" => $this->H2HCode,
                    "H2HStatus" => "",
                    "H2HUpLowTime" => date(DATE_ATOM),
                    "H2HUpHighTime" => date(DATE_ATOM),
                    "h2hTemplateWUValidDataAditional" => ""
                ],
                "objBrand" => [
                    "brdName" => $this->brdName,
                    "brdCountry" => $this->brdCountry,
                    "brdCode" => $this->brdCode,
                    "brdId" => $this->H2HEnterprisesId,
                    "brdCreationDate" => date(DATE_ATOM),
                    "brdStatus" => "",
                    "brdDescription" => "",
                    "brdConnectionStatus" => "",
                ],
                "objCommon" => [
                    "UserName" => "1M02",
                    "UserNameRemote" => "1M02",
                    "TerminalId" => "KF15",
                    "TerminalIdRemote" => "KF15",
                    "TerminalName" => "KF15",
                    "TerminalNameRemote" => "KF15",
                    "Agnid" => "6916",
                    "AgnIdRemote" => "6916",
                    "AgnName" => "GYE",
                    "AgnNameRemote" => "GYE",
                    "Version" => "2013.1.0.0",
                    "Password" => "?",
                    "Activate" => ""
                ]
            ]
        ];

        return $a === 1 ? $parametros : $this->FeeInquiryService;
    }

    public function GetDeliveryServices($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->Tra_DeliveryServices;
    }

    public function FeeInquiryTransaction($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->FeeInquiryService;
    }

    public function GetCustomerByDoc($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->Tra_TransactionCustomerService;
    }

    public function SaveCustomer($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->Tra_TransactionCustomerService;
    }

    public function UpdateCustomer($a=1)
    {
        // Este método no está disponible para los carriers
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->Tra_TransactionCustomerService;
    }

    public function SaveAssociate($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->Tra_TransactionAssociateService;
    }

    public function ReaderInterdictionFile($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->Tra_FileService;
    }

    public function ReaderNegativeFile($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->Tra_FileService;
    }

    public function SendMoneyValidation($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->SendMoneyService;
    }

    public function SendMoneyStore($a=1)
    {
        $parametros = [
        ];

        return $a === 1 ? $parametros : $this->SendMoneyService;
    }

//    public function estado()
//    {
//        switch ($this->strEstado)
//        {
//            case 200:
//                $retorno = "RecargaExitosa";
//                break;
//            case 201:
//                $retorno = "Error en la Transacción";
//                break;
//            case 205:
//                $retorno = "Saldo insuficiente en la cuenta para realizar la recarga";
//                break;
//            case 210:
//                $retorno = "Producto no admite decimales";
//                break;
//            case 300:
//                $retorno = "Transacción no existe en el sistema";
//                break;
//            case 230:
//                $retorno = "Valor de recargafuera del rango permitido";
//                break;
//            case 400:
//                $retorno = "Credenciales enviadas incorrectas";
//                break;
//            default:
//                $retorno = "Error desconocido";
//        }
//        return $retorno;
//    }

    public function opciones($a="valor")
    {
        $actualMetodo = $this->metodo;
        switch($actualMetodo)
        {
            case "HeartBeat":
                $request = "traRequest";
                $response = "HeartBeatResult";
                $url = $this->url_wsdl . $this->HeartBeat;
                break;
            case "GetH2HCountries":
            case "GetH2HStates":
            case "GetH2HCities":
            case "GetH2HCountryCurrencies":
            case "GetH2HEconomicActivity":
            case "GetH2HGentilicios":
            case "GetH2HCatalogCompilanceTemplate":
            case "GetH2HDeliveryServicesCuba":
            case "GetH2HDeliveryOptionTemplateCuba":
                $request = "traRequest";
                $response = $this->metodo . "Result";
                $url = $this->url_wsdl . $this->$actualMetodo;
                break;
        }

        switch($a)
        {
            case "request":
                $retorno = $request;
                break;
            case "response":
                $retorno = $response;
                break;
            case "url":
                $retorno = $url;
                break;
            default:
                $retorno = $this->metodo;
        }
        return $retorno;
    }

//    public function opciones($a="valor")
//    {
//        switch($this->metodo)
//        {
//            case "HeartBeat":
//                $request = "traRequest";
//                $response = "HeartBeatResult";
//                $url = $this->url_wsdl . $this->HeartBeat;
//                break;
//            case "GetH2HCountries":
//                $request = "traRequest";
//                $response = "GetH2HCountriesResult";
//                $url = $this->url_wsdl . $this->GetH2HCountries;
//                break;
//            case "GetH2HStates":
//                $request = "traRequest";
//                $response = "GetH2HStatesResult";
//                $url = $this->url_wsdl . $this->GetH2HStates;
//                break;
//            case "GetH2HCities":
//                $request = "traRequest";
//                $response = "GetH2HCitiesResult";
//                $url = $this->url_wsdl . $this->GetH2HCities;
//                break;
//            case "GetH2HCountryCurrencies":
//                $request = "traRequest";
//                $response = "GetH2HCountryCurrenciesResult";
//                $url = $this->url_wsdl . $this->GetH2HCountryCurrencies;
//                break;
//            case "GetH2HEconomicActivity":
//                $request = "traRequest";
//                $response = "GetH2HEconomicActivityResult";
//                $url = $this->url_wsdl . $this->GetH2HEconomicActivity;
//                break;
//            case "GetH2HGentilicios":
//                $request = "traRequest";
//                $response = "GetH2HGentiliciosResult";
//                $url = $this->url_wsdl . $this->GetH2HGentilicios;
//                break;
//            case "GetH2HCatalogCompilanceTemplate":
//                $request = "traRequest";
//                $response = "GetH2HCatalogCompilanceTemplateResult";
//                $url = $this->url_wsdl . $this->GetH2HCatalogCompilanceTemplate;
//                break;
//            case "GetH2HDeliveryServicesCuba":
//                $request = "traRequest";
//                $response = "GetH2HDeliveryServicesCubaResult";
//                $url = $this->url_wsdl . $this->GetH2HDeliveryServicesCuba;
//                break;
//            case "GetH2HDeliveryOptionTemplateCuba":
//                $request = "traRequest";
//                $response = "GetH2HDeliveryOptionTemplateCubaResult";
//                $url = $this->url_wsdl . $this->GetH2HDeliveryOptionTemplateCuba;
//                break;
//        }
//
//        switch($a)
//        {
//            case "request":
//                $retorno = $request;
//                break;
//            case "response":
//                $retorno = $response;
//                break;
//            case "url":
//                $retorno = $url;
//                break;
//            default:
//                $retorno = $this->metodo;
//        }
//        return $retorno;
//    }
}


