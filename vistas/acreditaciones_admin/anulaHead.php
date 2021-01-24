<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 3/9/2019
 * Time: 09:34
 * Proyecto: lx_redmultipago.com
 */
use Illuminate\Database\Capsule\Manager as Capsule;


if(isAjax())
{
    try{
        $acreditacionId = isset_post("b");

        if($acreditacionId)
        {
            $acreditacion = EmpMovimientos::find($acreditacionId);

            if($acreditacion)
            {
                Capsule::beginTransaction();
                $acreditacion->aprobada = 0;

                if($acreditacion->save())
                {
                    /**
                     * Desactivo la alerta para esta entrada
                     */
                    $alertaActual = EmpAlerta::where([["vista",E_VIEW],["empresa_id",$uEmpresa->id]])->first();

                    if($alertaActual)
                    {
                        $alertaActual->delete();
                    }

                    echo "1Proceso exitoso";
                    Capsule::commit();
                    exit();
                }
                else
                {
                    Capsule::rollback();
                    echo "0Ha sido imposible registrar la acreditación";
                    exit();
                }
            }
            else
            {
                echo "0La acreditación indicada no existe";
                exit();
            }
        }
        else
        {
            echo "0Se desconoce la acreditación";
            exit();
        }

    } catch (Exception $e) {
        echo "0Se produjo un error grave, inténtelo más tarde."; // .$e
        exit();
    }
}
else
{
    $_SESSION['mensajeSistema'] = "Petición incorrecta";
    header("Location:" . E_URL . E_VIEW);
    exit();
}