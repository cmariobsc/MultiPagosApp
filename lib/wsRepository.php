<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$urlWS="http://190.216.208.196:2698/SWBUS_Integracion/SWSBFacilito.svc?wsdl";

function SWSBFacilito_Consulta($idProducto, $referencia)
{
    $soapClient = new SoapClient($GLOBALS['urlWS']);
    
    $params = array(
        'RequestConsulta' => array(
            "Canal" => "WEB",
            'DatosSeguridad' => array(
                "Clave" => "@MULTIPAGOS",
                "TokenData" => "001T1006004109",
                "Usuario" => "MULTIPAGOS"),
            "IDAgencia" => "F23C6750-91C8-46E7-80AF-E572577FD82F",
            "IDEntidad" => "5D03F427-532E-43A5-BD8E-B82F0C49276A",
            "IDProducto" => $idProducto,
            "Referencia" => $referencia
        ));
    
    $respuesta = $soapClient->Consulta($params)->ConsultaResult;
    $jsonResult = json_encode((array)$respuesta);
    return $jsonResult;
}

function SWSBFacilito_Confirmacion($idTransaccion, $dataPago)
{
    $soapClient = new SoapClient($GLOBALS['urlWS']);
    
    $params = array(
        'RequestPgo' => array(
            "DataPago" => $dataPago,
            'DatosSeguridad' => array(
                "Clave" => "@MULTIPAGOS",
                "TokenData" => "001T1006004109",
                "Usuario" => "MULTIPAGOS"),
            "IDTransaccion" => $idTransaccion
        ));
    
    $respuesta = $soapClient->Confirmacion($params)->ConfirmacionResult;
    $jsonResult = json_encode((array)$respuesta);
    return $jsonResult;
}

function SWSBFacilito_Pago($idTransaccion, $dataPago)
{
    $soapClient = new SoapClient($GLOBALS['urlWS']);
    
    $params = array(
        'RequestPago' => array(
            "DataPago" => $dataPago,
            'DatosSeguridad' => array(
                "Clave" => "@MULTIPAGOS",
                "TokenData" => "001T1006004109",
                "Usuario" => "MULTIPAGOS"),
            "IDTransaccion" => $idTransaccion
        ));
    
    $respuesta = $soapClient->Pago($params)->PagoResult;
    $jsonResult = json_encode((array)$respuesta);
    return $jsonResult;
}

if(isset($_POST['action'])) {
    $function = $_POST['action'];
    $params = $_POST['parameters'];
    if(function_exists($function)) {        
        echo call_user_func_array($function, $params);
    } else {
        echo 'Function Not Exists!';
    }
}
