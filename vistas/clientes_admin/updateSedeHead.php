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

//    sedeNombre ---> Los ríos
//    sedematriz ---> on
//    sedeActividad ---> transporte
//    sedeDireccion ---> fg gdfjg df g
//    sedeNotas ---> nx vjsd v vfd
//    a ---> updateSede
//    sedeId ---> 55

try{
    $modeloId = isset_post("sedeId", 1);
    if($modeloId)
    {
        $sede = EmpSucursales::find($modeloId);

        if($sede)
        {
            Capsule::beginTransaction();

            $sede->nombre = isset_post("sedeNombre");
            $sede->actividad = isset_post("sedeActividad");
            $sede->direccion = isset_post("sedeDireccion");
            $sede->notas = isset_post("sedeNotas");

            $matriz = isset_post("sedematriz");

            if($matriz)
            {
                EmpSucursales::where("empresa_id", $sede->empresa_id)->update(["matriz" => 0]);
            }

            $sede->matriz = 1;

            if($sede->save())
            {
                Capsule::commit();
                $_SESSION['mensajeSistema'] = ["Actualización exitosa"];
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
            else
            {
                Capsule::rollback();
                $_SESSION['mensajeSistema'] = "Ha sido imposible actualizar";
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
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />"; // .$e
    header("Location:" . E_URL . E_VIEW);
    exit();
}


