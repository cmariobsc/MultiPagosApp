<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 7/7/2019
 * Time: 2:38
 * Proyecto: lx_multipagos.eqadoor.com
 */


//    tipo ---> 1
//    segmento ---> 1
//    servicio ---> 1
//    proveedor ---> 1
//    comision_in ---> 0.20000
//    comision_out ---> 0.18000
//    texto ---> Explicación
//    a ---> update
//    id ---> 3


try{

    if(isAjax())
    {
        $modeloId = isset_post("id", 1);

        if($modeloId)
        {
            $perfilEmpresa = EmpPerfiles::find($modeloId);

            if($perfilEmpresa)
            {
                $comisionIn = isset_post("comIn");
                if($comisionIn)
                {
                    $perfilEmpresa->comision_in = $comisionIn;
                }

                $comisionOut = isset_post("comOut");
                if($comisionOut)
                {
                    $perfilEmpresa->comision_out = $comisionOut;
                }

                /**
                 *  Si llega acá es que "all" está bien y guardamos el perfil
                 */
                if($perfilEmpresa->save())
                {
                    echo "1Actualización satisfactoria";
                    exit();
                }
                else
                {
                    echo "0Ha sido imposible guardar el perfil";
                    exit();
                }
            }
            else
            {
                echo "0El perfil no existe";
                exit();
            }
        }
        else
        {
            echo "0Se desconoce el perfil";
            exit();
        }
    }
    else
    {
        echo "Petición incorrecta";
        exit();
    }

} catch (Exception $e) {
    echo "0Se produjo un error grave, inténtelo más tarde."; // .$e
    exit();
}