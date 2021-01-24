<?php

require_once E_LIB . '/class/class.upload.php';

try {
    if (isset_get('id'))
    {
        if (isset_post('titulo_' . E_LANG) || isset_post('texto_' . E_LANG) || isset_file('imagen_' . E_LANG))
        {
            $concre_img_name = null;
            $concre_id = null;
            foreach ($_SESSION['idiomas'] as $concre_lang) {
                isset_post('soloIdioma') ? $concre_lg = E_LANG : $concre_lg = $concre_lang;

                $concre_tmp_cont = new Contenido();
                $concre_tmp_cont->setTable('vistas_cont_' . $concre_lang);

                //$concre_ = $concre_tmp_cont->where('id', isset_get('id'))->get()->count();
				//$concre_ = $concre_tmp_cont->where('vistas_id', isset_get('id'))->count();
                $concre_ = $concre_tmp_cont->where('vistas_id', isset_get('id'))->max("vistaSub_id");
				
                $concre_contenido = new Contenido([
                    'vistas_id' => isset_get('id'),
                    'vistaSub_id' => $concre_ + 1,
                    'titulo' => isset_post('titulo_' . $concre_lg),
                    'texto' => isset_post('texto_' . $concre_lg),
                    'link' => isset_post('link_' . $concre_lg),
                    'textoLink' => isset_post('textoLink_' . $concre_lg)
                ]);
                if (isset_file('imagen_' . $concre_lg)) {
                    if (isset_post('soloIdioma') && $concre_img_name != null) {
                        $concre_contenido->imagen = $concre_img_name;
                    } else {
                        $concre_imagen = new Upload();
                        $concre_imagen->campo = 'imagen_' . $concre_lg;
                        $concre_imagen->ruta = Contenido::carpeta();
                        if ($concre_imagen->cargaFile()) {
                            $concre_img_name = $concre_imagen->nombre;
                            $concre_contenido->imagen = $concre_img_name;
                        } else {
                            $mal = 'Error cargando la imagen';
                        }
                    }
                }
                if (isset_post('alt_' . $concre_lg))
                    $concre_contenido->alt = isset_post('alt_' . $concre_lg);
                if (isset_post('explicados_' . $concre_lg))
                    $concre_contenido->explicados = isset_post('explicados_' . $concre_lg);

                $concre_contenido->setTable('vistas_cont_' . $concre_lang);

                if ($concre_id != null) {
                    $concre_contenido->contenidoId = $concre_id;
                }

                if (!$concre_contenido->save()) {
                    $mal = 'No se pudo crear el contenido';
                } else {
                    if (isset_post('soloIdioma') && $concre_id == null) {
                        $concre_id = $concre_contenido->contenidoId;
                    }
                }
            }

            if ($mal === 0) {
                $_SESSION['mensajeSistema'] = "Ingreso exitoso";
                header("Location:" . E_URL . E_VIEW);
                exit();
            }
        }
        else
        {
            $_SESSION['mensajeSistema'] = "El contenido a ingresar debe tener al menos un título, un texto o una foto";
            header("Location:" . E_URL . E_VIEW);
            exit();
        }
    }
    else
    {
        $_SESSION['mensajeSistema'] = "La selección no existe";
        header("Location:" . E_URL . E_VIEW);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['mensajeSistema'] = "Se produjo un error grave, inténtelo más tarde.";
    header("Location:" . E_URL . E_VIEW);
    exit();
}