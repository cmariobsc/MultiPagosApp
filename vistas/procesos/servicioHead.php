<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 21/7/2019
 * Time: 11:45
 * Proyecto: lx_multipagos.eqadoor.com
 */
if(isAjax())
{
    $segmentoId = isset_post("b");
    if($segmentoId)
    {
        $segmento = EmpSegmentos::find($segmentoId);

        if($segmento)
        {
            $servicios = $segmento->servicios()->pluck("nombre", "id")->toJson();
            echo "1" . $servicios;
        }
        else
        {
            echo "0El valor indicado no existe";
        }
    }
    else
    {
        echo "0Se desconoce el valor indicado";
    }
    exit();
}
else
{
    $_SESSION['mensajeSistema'] = "Petición incorrecta";
    header("Location:" . E_URL . E_VIEW);
    exit();
}