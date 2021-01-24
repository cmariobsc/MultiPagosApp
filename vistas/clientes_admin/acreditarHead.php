<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 14/8/2019
 * Time: 12:54
 * Proyecto: lx_redmultipago.com
 */
use Illuminate\Database\Capsule\Manager as Capsule;

//    cliente ---> 11
//    valor ---> 5000
//    cuentaDestino ---> 5
//    formaPago ---> e
//    comprobante --->  562314
//    fecha ---> 09 Sep, 2019
//    datepickerTruefecha ---> 2019-09-09T05:00:00.000Z
//    texto ---> sin obsrvaciones
//    userBtn ---> acreditar saldo
//    a ---> acreditar


try{
    $clienteId = isset_post("cliente");

    if($clienteId)
    {
        $mEmpresa = Empresa::find($clienteId);

        if($mEmpresa)
        {
            $mValor =  isset_post("valor");

            if($mValor)
            {
                $mCuentaDestino = isset_post("cuentaDestino");

                if($mCuentaDestino)
                {
                    Capsule::beginTransaction();

                    $movimiento = new EmpMovimientos();

                    $movimiento->tipo = "ingreso";
                    $movimiento->valor = $mValor;
                    $movimiento->empresa_origen_id = $clienteId;
                    $movimiento->empresa_destino_id = $uEmpresa->id;
                    $movimiento->cuenta_destino_id = $mCuentaDestino;
                    $movimiento->fecha = isset_post("datepickerTruefecha");
                    $movimiento->comprobante = isset_post("comprobante");
                    $movimiento->forma_pago = isset_post("formaPago");
                    $movimiento->user_id = $usuario->id;
                    $movimiento->aprobada = 1;
                    $movimiento->observaciones = isset_post("texto");

                    if($movimiento->save())
                    {
                        $empComercial = $mEmpresa->comercial();
                        $empComercial->credito += isset_post("valor");
                        if($empComercial->save())
                        {
                            Capsule::commit();
                            $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                        else
                        {
                            Capsule::rollback();
                            $_SESSION['mensajeSistema'] = "Fue imposible acreditar el nuevo saldo";
                            header("Location:" . E_URL . E_VIEW);
                            exit();
                        }
                    }
                    else
                    {
                        Capsule::rollback();
                        $_SESSION['mensajeSistema'] = "Ha sido imposible registrar el movimiento";
                        header("Location:" . E_URL . E_VIEW);
                        exit();
                    }
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "Se desconoce la cuenta destino";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Se desconoce el valor del depósito";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "";
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