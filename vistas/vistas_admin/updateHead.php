<?php

//nombre ---> usuarios
//roles ---> array(2) { [0]=> string(1) "2" [1]=> string(1) "1" }
//icono ---> group
//titular ---> Usuarios
//a ---> update


try {
    if (isset_post('id', 1)) {

        $visupd_vista = Vista::findOrFail(isset_post('id'));

        if ($visupd_vista)
        {
            if(isset_post("nombre")){
                $visupd_vista->nombre = isset_post("nombre");
            }
            if(isset_post("roles")){
                $visupd_vista->permisos = json_encode(isset_post("roles"));
            }
            if(isset_post("icono") && isset_post("titular")){
                $visupd_vista->menu = json_encode([isset_post("icono"), isset_post("titular")]);
            }

            if (!$visupd_vista->save()) {
                $mal = 'Se produjo un error actualizando la página ' . $visupd_vista->nombre;
            }
        }
        else
        {
            $mal = 'La página seleccionada no existe';
        }
    }
	
    /**
     * Si no ocurrieron errores asumo que la acción fue correcta y recargo la vista
     */
    if ($mal === 0) {
        $_SESSION['mensajeSistema'] = ["Vista actualizada correctamente"];
        header("Location:" . E_URL . E_VIEW);
        exit();
    } 
    else 
    {
        $_SESSION['mensajeSistema'] = $mal;
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
    
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = 'Se produjo un error grave, inténtelo más tarde.';
    header("Location:" . E_URL . E_VIEW);
    exit();
}