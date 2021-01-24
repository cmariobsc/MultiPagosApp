<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 21/7/2019
 * Time: 12:34
 * Proyecto: lx_multipagos.eqadoor.com
 */
if(isAjax())
{
    $serviciosId = isset_post("b");

    if($serviciosId)
    {
        $servicio = EmpServicios::find($serviciosId);

        if($servicio)
        {
            echo "1Exito"; // . $servicio->proveedor()->nombre;
        }
        else
        {
            echo "0El servicio indicado no existe";
        }
    }
    else
    {
        echo "0Se desconoce el servicio indicado";
    }
    exit();
}
else
{
    $_SESSION['mensajeSistema'] = "Petición incorrecta";
    header("Location:" . E_URL . E_VIEW);
    exit();
}