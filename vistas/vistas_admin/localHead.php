<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 13/4/2019
 * Time: 12:05
 * Proyecto: mn_coffee.eqadoor.com
 */
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::beginTransaction();

//    vista ---> 2
//    ref ---> servicio_cliente
//    ref_es ---> SERVICIO AL CLIENTE
//    ref_en ---> CUSTOMER SERVICE
//    a ---> local

try{
    /**
     * Para el ingreso de un nuevo valor
     */
    $newVistaId = isset_post("vista");
    if($newVistaId)
    {
        $newVista = Vista::find($newVistaId);

        if($newVista)
        {
            $vistaNewTxt_es = new VistaText_es();
            $vistaNewTxt_es->vista_id = $newVistaId;
            $vistaNewTxt_es->referencia = isset_post("ref");
            $vistaNewTxt_es->texto = isset_post("ref_es");

            $vistaNewTxt_en = new VistaText_en();
            $vistaNewTxt_en->vista_id = $newVistaId;
            $vistaNewTxt_en->referencia = isset_post("ref");
            $vistaNewTxt_en->texto = isset_post("ref_en");

            if($vistaNewTxt_es->save() && $vistaNewTxt_en->save())
            {
                Capsule::commit();
                $_SESSION['mensajeSistema'] = ["Proceso exitoso"];
//                header("Location:" . E_URL . E_VIEW);
//                exit();
            }
            else
            {
                Capsule::rollback();
                $_SESSION['mensajeSistema'] = "La nueva entrada no pudo agregarse";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El valor indicado no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }

    /**
     * Para la lectura de los valores existentes
     */
    $vistaId = isset_get("id");
    if($vistaId)
    {
        $vista = Vista::find($vistaId);

        if($vista)
        {
            $lVista = $vista->getLocal();
            if($lVista->count() > 0)
            {
                $tablaIdim = "";
                foreach($_SESSION['idiomas'] as $idim)
                {
                    $listaVista = $vista->getLocal($idim);
                    $tablaIdim .= "<h2>Textos ".nombreIdioma($idim)."</h2>";
                    $tablaIdim .= '<div class="row">';
                    foreach($listaVista as $liVis)
                    {
                        $id_input = "id_" . uniqid();
                        $tablaIdim .= mat_input("Referencia", "ref",["id"=>"id_".uniqid(), "value"=>$liVis->referencia, "envoltura" => "col s12 l4", "disabled"=>""]);
                        $tablaIdim .= mat_input("Texto", "texto",["value"=>$liVis->texto, "id"=>$id_input, "envoltura" => "col s11 l7"]);
                        $tablaIdim .= '<div class="input-field col s1 l1">';
                        $tablaIdim .= '<button class="btn" onclick="actualiza(\''.$liVis->id.'\',\''.$idim.'\', \''.$id_input.'\')">';
                        $tablaIdim .= '<i class="material-icons">autorenew</i>';
                        $tablaIdim .= '</button>';
                        $tablaIdim .= '</div>';
                    }
                    $tablaIdim .= '</div>';
                }
            }
            else
            {
                $tablaIdim = '<div class="col s12 cen bordeCompleto">Sin contenidos de idioma</div>';
            }

        }
        else
        {
            $_SESSION['mensajeSistema'] = "La vista no existe";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "Se desconoce el valor indicado";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }

} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.<br />".$e; //
    header("Location:" . E_URL . E_VIEW);
    exit();
}