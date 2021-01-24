<?php

require_once E_LIB . 'class/class.upload.php';

try {
    if (isset($_POST['editar_cnt']) && isset_get('id')) {
        $conupd_img_name = null;

        foreach ($_SESSION['idiomas'] as $conupd_lang) {
            isset_post('soloIdioma') ? $conupd_lg = E_LANG : $conupd_lg = $conupd_lang;

            $conupd_tmp_cont = new Contenido();
            $conupd_tmp_cont->setTable('vistas_cont_' . $conupd_lang);
            $conupd_cnt = $conupd_tmp_cont->findOrFail(isset_get('id'));
            $conupd_cnt->setTable('vistas_cont_' . $conupd_lang);

            if ($conupd_cnt) {
                if (isset_post('titulo_' . $conupd_lg))
                    $conupd_cnt->titulo = isset_post('titulo_' . $conupd_lg);

                if (isset_post('texto_' . $conupd_lg))
                    $conupd_cnt->texto = isset_post('texto_' . $conupd_lg);

                if (isset_post('alt_' . $conupd_lg))
                    $conupd_cnt->alt = isset_post('alt_' . $conupd_lg);

                if (isset_post('explicados_' . $conupd_lg))
                    $conupd_cnt->explicados = isset_post('explicados_' . $conupd_lg);

                if (isset_post('link_' . $conupd_lg))
                    $conupd_cnt->link = isset_post('link_' . $conupd_lg);

                if (isset_post('textoLink_' . $conupd_lg))
                    $conupd_cnt->textoLink_ = isset_post('textoLink_' . $conupd_lg);

                if (isset_file('imagen_' . $conupd_lg) && $_FILES['imagen_' . $conupd_lg]['size']) {
                    if (isset_post('soloIdioma') && $conupd_img_name != null) {
                        $conupd_cnt->imagen = $conupd_img_name;
                    } else {
                        if (file_exists(Contenido::carpeta() . $conupd_cnt->imagen)) {
                            unlink(Contenido::carpeta() . $conupd_cnt->imagen);
                        }

                        $conupd_imagen = new Upload();
                        $conupd_imagen->campo = 'imagen_' . $conupd_lg;
                        $conupd_imagen->ruta = Contenido::carpeta();
                        if ($conupd_imagen->cargaFile()) {
                            $conupd_img_name = $conupd_imagen->nombre;
                            $conupd_cnt->imagen = $conupd_img_name;
                        } else {
                            $mal = 'Error cargando la imagen';
                        }
                    }
                }
                if (!$conupd_cnt->save()) {
                    $mal .= 'Error actualizando el contenido para el idioma ' . nombreIdioma($conupd_lg);
                }
            } else {
                $mal = 'El contenido que pretende editar no existe. Verifique sus datos por favor.';
            }
        }

        if ($mal === 0) {
            $_SESSION['mensajeSistema'] = "Actualización exitosa";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
} catch (Exception $e) {
    $mal = 'Se produjo un error grave, inténtelo más tarde.';
}