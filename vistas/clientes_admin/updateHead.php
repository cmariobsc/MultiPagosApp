<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 20/4/2019
 * Time: 10:07
 * Proyecto: lx_cotizador.eqadoor.com
 */

use Illuminate\Database\Capsule\Manager as Capsule;

//    empresaNombre ---> Orion IT
//    rucTipo ---> R
//    empresaRuc ---> 454545454
//    empresaNotas ---> sdad as dasd as das
//    empresaCredito ---> 10000.00
//    empresaTipo ---> 2
//    empresaEstado ---> 1
//    id ---> 41
//    a ---> update

try{
    $modeloId = isset_post("id", 1);
    if($modeloId)
    {
        $cliente = Empresa::find($modeloId);

        if($cliente)
        {
            Capsule::beginTransaction();

            $cliente->nombre = isset_post("empresaNombre");
            $cliente->estado = isset_post("empresaEstado");

            if($cliente->save())
            {
                $clienteDatos = $cliente->datos();
                $clienteDatos->rucTipo = isset_post("rucTipo");
                $clienteDatos->ruc = isset_post("empresaRuc");
                $clienteDatos->notas = isset_post("empresaNotas");

                $clienteComercial = $cliente->comercial();
                if($clienteComercial)
                {
                    $clienteComercial->tipo_id = isset_post("empresaTipo");
                    $clienteComercial->credito = isset_post("empresaCredito");

                    if(!$clienteComercial->save())
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "Imposible actualizar el crédito";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }
                else
                {
                    $comercial = new EmpComercial();

                    $comercial->empresa_id = $cliente->id;
                    $comercial->credito = isset_post("empresaCredito");

                    if(!$comercial->save())
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "Imposible actualizar el crédito";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }


                if($clienteDatos->save())
                {
                    Capsule::commit();
                    $_SESSION['mensajeSistema'] = ["Actualización correcta"];
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
                else
                {
                    Capsule::rollback();
                    $_SESSION['mensajeSistema'] = "Imposible actualizar los datos";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                Capsule::rollback();
                $_SESSION['mensajeSistema'] = "Imposible actualizar el cliente";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El cliente no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el cliente";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />".$e; //
    header("Location:" . E_URL . E_VIEW);
    exit();
}


