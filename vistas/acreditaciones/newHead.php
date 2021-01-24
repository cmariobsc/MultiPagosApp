<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 31/8/2019
 * Time: 19:49
 * Proyecto: lx_redmultipago.com
 */

//    cuentaOrigen ---> 6
//    cuentaDestino ---> 5
//    formaPago ---> d
//    fecha ---> 18 Sep, 2019
//    datepickerTruefecha ---> 2019-09-18T05:00:00.000Z
//    comprobante ---> 45545454
//    valor ---> 5000
//    texto ---> sin observaciones
//    a ---> new

try{

    $mValor =  isset_post("valor");
    if($mValor)
    {
        $mComprobante = isset_post("comprobante");
        if($mComprobante)
        {
            $movimiento = new EmpMovimientos();

            $movimiento->tipo = "ingreso";
            $movimiento->valor = $mValor;
            $movimiento->empresa_origen_id = $uEmpresa->id;
            $movimiento->empresa_destino_id = $uEmpresa->padre;
            $movimiento->fecha = isset_post("datepickerTruefecha");
            $movimiento->cuenta_origen_id = isset_post("cuentaOrigen");
            $movimiento->cuenta_destino_id = isset_post("cuentaDestino");
            $movimiento->comprobante = $mComprobante;
            $movimiento->forma_pago = isset_post("formaPago");
            $movimiento->user_id = $usuario->id;
            $movimiento->observaciones = isset_post("texto");

            if($movimiento->save())
            {
                /**
                 * Si la acreditación es guardada con éxito
                 * notificamos por correo y creamos una alerta
                 */
                $alerta = new EmpAlerta();

                $alerta->nombre = "Nueva acreditación";
                $alerta->vista = "acreditaciones_admin";
                $alerta->empresa_id = $uEmpresa->padre;

                $alerta->save();


                $mensajeBody = '<fieldset>';
                $mensajeBody .= '<legend>Mensaje de '.D_DOMINIO.'</legend>';
                $mensajeBody .= '<div style="padding: 10px; text-align: left;">';
                $mensajeBody .= '<h2>Notificación de depósito</h2>';
                $mensajeBody .= '<p>Empresa: '.$uEmpresa->nombre.'</p>';
                $mensajeBody .= '<p>Comprobante: '.$mComprobante.'</p>';
                $mensajeBody .= '<p>Valor: '.$mValor.'</p>';
                $mensajeBody .= '<p>Fecha: '.isset_post("fecha").'</p>';
                $mensajeBody .= '</div>';
                $mensajeBody .= '</fieldset>';

                if(enviaCorreo(E_CORREO_VENTAS, $mensajeBody, E_DOMINIO . ": Notificación de depósito"))
                {
                    $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
                else
                {
                    $_SESSION['mensajeSistema'] = "La notificación fue creada en línea pero el correo no pudo enviarse";
                    header("Location:" . E_URL . E_VIEW);
                    exit();
                }
            }
            else
            {
                $_SESSION['mensajeSistema'] = "Ha sido imposible registrar el ingreso";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "Se desconoce el comprobante";
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
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />".$e; //
    header("Location:" . E_URL . E_VIEW);
    exit();
}



