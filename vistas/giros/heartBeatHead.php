<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 16/9/2019
 * Time: 03:26
 * Proyecto: lx_redmultipago.com
 */

/**
 * Creo la instancia para la comprobación
 */
$giro = new RA_variables();

/**
 * Probando HeartBeat
 */
$meto = "HeartBeat";
$giro->metodo = $meto;
$params = $giro->params();
$urlGiro = $giro->gURL();
$soapOption = ["trace"=>true];
try{
    /**
     * Conexión al servicio y solicitud
     */
    $soap = new SoapClient($urlGiro, $soapOption);
    $data = $soap->$meto($params);

    /**
     *  XML DE RESPUESTA
     */
    $metodoRespuesta = $giro->opciones("response");
    $respuesta = $data->$metodoRespuesta;
    if($respuesta)
    {
        $codigoRespuesta = $respuesta->objError->erpCode;

        if($codigoRespuesta == "R0000")
        {
            $_SESSION['mensajeSistema'] = $respuesta->objError->erpDescription . "<br />El servicio funciona correctamente";
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Ocurrió un error: " . $respuesta->objError->erpDescription;
        }
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
    else
    {
        $_SESSION['mensajeSistema'] = "El sistema no obtuvo respuesta";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
}catch (SoapFault $fault){
//        <xmp> tag displays xml output in html
//        echo 'Request : <br/><xmp>';
//        echo "REQUEST-H:<br />" . $soap->__getLastRequestHeaders() . "<br/>";
//        echo "REQUEST-B:<br />" . $soap->__getLastRequest() . "<br/>";
//        echo "REQUEST-C:<br />" . var_dump($soap->__getFunctions()) . "<br/>";
//        echo "REQUEST-D:<br />" . $soap->__getLastResponse() . "<br/>";
//        echo '</xmp><br/><br/> Error Message : <br/>';

//    echo $fault->getMessage();
    $_SESSION['mensajeSistema'] = "ocurrió un error contactando al servicio";
    header("Location:" . E_URL . E_VIEW);
    exit();
}





