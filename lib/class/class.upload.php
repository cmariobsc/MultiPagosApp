<?php

//require_once E_LIB . 'class/Parametros.php';

/**
 * Class Upload
 *
 *
 * $up = new Upload();
 * $file = $up->cargaFile();
 * if( $file != FALSE) {
 *    echo $file;
 * } else {
 *    echo "NO CARGADO";
 * }
 */
class Upload
{
    /**
     * Carpeta destino para el archivo subido
     * @var string
     */
    public $ruta;
    /**
     * "name" de campo input
     * @var string
     */
    public $campo;
    /**
     * El tipo de extrención aceptada en el archivo a cargar
     * @var string
     */
    public $tipo;
    /**
     * Arreglo de tipos de extención similares para comparar con el archivo subido
     * @var bool
     */
    public $patron;
    /**
     * Nombre a usar para guardar el archivo, si está vacío se usará el valor de sha1_file()
     * @var string
     */
    public $nombre;
    /**
     * Peso máximo que debe tener el archivo
     * @var int
     */
    public $pesoMax;
    /**
     * Indica opciones para cuando el archivo cargado ya exista en el servidor
     * @var string
     */
    public $reescribe;

    public $mime_img = [
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp'
    ];
    public $mime_doc = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'rtf' => 'application/rtf'
    ];
    public $mime_all = [
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',

        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet'
    ];

    public function __construct($nombre = "", $tipo = "", $reescribe = "", $ruta = "", $campo = "file", $pesoMax = E_PESO_ARCHIVO)
    {
        $this->ruta = $ruta ? $ruta : E_CONT_UPLOAD_DIR;
        $this->campo = $campo;
        $this->tipo = $tipo;                // Si está vacío, se  asumirá que tiene que ser una imagen como: $this->mime_images
        $this->nombre = $nombre;            // Nombre a usar para guardar el archivo, si está vacío se usará el valor de sha1_file()
        $this->pesoMax = $pesoMax;
        $this->reescribe = $reescribe;

        if (empty($tipo)) {
            // Si $tipo está vacío asumo que son imágenes "de las normalitas (jpg, png, gif, bmp)"
            $this->patron = $this->mime_img;
        } else {
            switch ($this->tipo) {
                case "img":
                    $this->patron = $this->mime_img;
                    break;
                case "doc":
                    $this->patron = $this->mime_doc;
                    break;
                case "all":
                    $this->patron = $this->mime_all;
                    break;
                default:
                    $this->patron = FALSE;
            }
        }
    }

    /**
     * Elimina caracteres raros
     * @param $cadena
     * @param string $reemplazo
     * @return string
     */
    public function quitaLetras($cadena, $reemplazo = "_")
    {
        // chr(32 espacio "   "
        // chr(39) Comilla simple " ' "
        // chr(34) Comilla Doble " " "
        // chr(92) Slash Invertido " \ "

        $quitar = array(chr(32), ",", ";", "!", "¡", "?", "¿", "*", ":", "-", "+", "(", ")", "[", "]", "/", chr(92), "|", "<", "=", ">", "@", "#", "$", "%", "&", "_", chr(34), chr(39));
        return strtolower(str_replace($quitar, $reemplazo, $cadena));
    }


    /**
     * Comprueba el tamaño del archivo
     * @return bool
     */
    public function validaPeso()
    {
        // Verifico que el tamaño sea el correcto
        if ($_FILES[$this->campo]['size'] > $this->pesoMax) {
            //throw new RuntimeException('Tamaño de archivo no permitido.');
            return FALSE;
        }
        return TRUE;
    }

    public function devMime($mimeCheck)
    {
        // Devuelve la extención del archivo cargado
        // siempre que la misma coincida con el la cadena MIME real del archivo

        // lee la extención que trae el archivo en su nombre
        $especular = strtolower(substr(strrchr($_FILES[$this->campo]['name'], "."), 1));

        foreach ($this->patron as $mimeId => $mimeVal) {
            if (($mimeCheck == $mimeId || $mimeCheck == $mimeVal) && $especular == $mimeId) {
                return $mimeId;
            }
        }

        return FALSE;
    }

    /**
     * Identifica si el archivo tiene algún error en su estructura para cualquiera de estos casos
     * Undefined (indefinido) | Multiple Files (Archivos múltiples) | $_FILES Corruption Attack (Archivo corrupto o no-válido)
     * @return bool
     */
    public function load()
    {
        // Si las condiciones siguientes fallan, el archivo debe ser tratado como incorrecto y no-válido.
        if (!isset($_FILES[$this->campo]['error']) || is_array($_FILES[$this->campo]['error'])) {
            // llega acá sólo si no existe el reporte de error
            // o si dicho reporte es un array
            // el valor para un archivo correcto sería la constante "UPLOAD_ERR_OK"
            //throw new RuntimeException('Parámetros inválidos.');
            $retorno = FALSE;
        }

        // Una vez comprobado que el aechivo no es corrupto
        // verifico si hubo algún tipo de error en la subida del archivo
        switch ($_FILES[$this->campo]['error']) {
            case UPLOAD_ERR_OK:
                $retorno = TRUE;
                break;
            case UPLOAD_ERR_NO_FILE:
                //throw new RuntimeException('El archivo no fue enviado.');
                $retorno = FALSE;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                //throw new RuntimeException('El archivo es mayor de lo esperado.'); // este error hace referencia al tamaño máximo que puede manejar PHP en su definición de php.ini
                $retorno = FALSE;
            default:
                //throw new RuntimeException('Error desconocido.');
                $retorno = FALSE;
        }

        return $retorno;
    }

    /**
     * Devuelve la extención real del archivo cargado
     * @return bool|int|string
     */
    public function ext()
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $ex = $this->devMime($finfo->file($_FILES[$this->campo]['tmp_name']));

        return $ex ? $ex : FALSE;
    }

    /**
     * Carga el archivo
     * @return bool|int|string
     */
    public function cargaFile()
    {
        if ($this->validaPeso() && $this->load()) {
            $extencion = $this->ext();

            if ($extencion) {
                if (!empty($this->ruta)) {
                    if (!file_exists($this->ruta)) {
                        mkdir($this->ruta, 0755);
                    }
                }

                //$nombreArchivo = !empty($this->nombre) ? $this->nombre . "." . $extencion : sha1_file($_FILES[$this->campo]['tmp_name']) . "." . $extencion;
                $this->nombre = !empty($this->nombre) ? $this->nombre . "." . $extencion : sha1_file($_FILES[$this->campo]['tmp_name']) . "." . $extencion;

                if (empty($this->reescribe)) {
                    // intento mover el archivo cargado al lugar
                    // si existe un archivo con el mismo nombre, el mismo será sobreescrito
                    $intentar = TRUE;
                } else {
                    // si "$this->reescribe" no está vacío entonces no debe ser sobreescrito
                    // Si el valor de "$this->reescribe" es diferente de 1 entonces no hacemos nada
                    switch ($this->reescribe) {
                        case 1:
                            // Si el valor de "$this->reescribe" es 1 entonces dejamos el archivo existente
                            // y generamos un nuevo nombre de archivo
                            if (file_exists($this->ruta . $this->nombre)) {
                                // hago un ciclo hasta que aparezca un valor distinto al existente en la carpeta escojida
                                // para el nombre del archivo cargado
                                do {
                                    $newNombre = substr($this->nombre, 0, strrpos($this->nombre, '.')) . "_" . rand(1, 1000) . strrchr($this->nombre, ".");
                                } while (file_exists($this->ruta . $newNombre));
                                $this->nombre = $newNombre;
                                $intentar = TRUE;
                            } else {
                                $intentar = TRUE;
                            }
                            break;
                        default:
                            $intentar = FALSE;
                    }
                }


                if ($intentar) {
                    // Si "$intentar" es TRUE entonces
                    if (move_uploaded_file($_FILES[$this->campo]['tmp_name'], $this->ruta . $this->nombre)) {
                        return $this->nombre;
                    }
                } else {
                    return 1;
                }
            }
        }
        return FALSE;
    }
}
