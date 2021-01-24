<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 8/1/2020
 * Time: 17:22
 * Proyecto: lx_redmultipago.com
 */

try{

    if(isAjax())
    {
        /**
         * Creo la instancia para el envío
         */
        $giro = new RA_variables();

        /**
         * solicitud de provincias
         */
        $meto = basename(__FILE__, "Head.php");
        $giro->metodo = $meto;
        $params = $giro->params();
        $urlGiro = $giro->gURL();
        $soapOption = ["trace"=>true];
        $soap = new SoapClient($urlGiro, $soapOption);
        $data = $soap->$meto($params);
        $metodoRespuesta = $giro->opciones("response");
        $respuesta = $data->$metodoRespuesta;
        if($respuesta)
        {
            $codigoRespuesta = $respuesta->objError->erpCode;

            if($codigoRespuesta == "R0000")
            {
                if(isset($respuesta->H2HArrayStr->string))
                {
                    $listaResultante = DasCatalogo::where("titulo", $meto)->first();
                    $listaResultante->texto = json_encode($respuesta->H2HArrayStr->string);
                    if($listaResultante->save())
                    {
                        echo "1";
                    }
                    else
                    {
                        echo "0" . "Imposible actualizar datos en ". $meto;
                    }
                    exit();
                }
                else
                {
                    echo "0Ocurrió un error cargando el catálogo " . $meto;
                    exit();
                }
            }
            else
            {
                echo "0Ocurrió un error: " . $respuesta->objError->erpDescription;
                exit();
            }
        }
        else
        {
            echo "0El sistema no obtuvo respuesta para las provincias";
            exit();
        }
    }
    else
    {
       $_SESSION['mensajeSistema'] = "Solicitud incorrecta";
       header("Location:" . E_URL);
       exit();
    }

} catch (Exception $e) {
    echo "0Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    exit();
}
exit();


