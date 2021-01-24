<?php
use Illuminate\Database\Capsule\Manager as Capsule;
//
//nombre ---> ssss
//roles ---> array(2) { [0]=> string(1) "2" [1]=> string(1) "3" }
//icono ---> ffff
//titular ---> hhhh
//a ---> new


try {
    if(isset_post("nombre") && isset_post("roles"))
    {
        /**
         * Iniciamos la transaccion
         */
        Capsule::beginTransaction();

        /**
         * Instanciamos el nuevo modelo
         */
        $visnew_vista = new Vista;

        if ($visnew_vista)
        {
            $posNombre = isset_post("nombre");
            if($posNombre){
                $visnew_vista->nombre = $posNombre;
            }

            $posRoles = isset_post("roles");
            if($posRoles){
                $visnew_vista->permisos = json_encode($posRoles);
            }

            $posIcono = isset_post("icono");
            $posTitular = isset_post("titular");
            if($posIcono && $posTitular){
                $visnew_vista->menu = json_encode([$posIcono, $posTitular]);
            }

            $posClave = isset_post("claves");
            if($posClave){
                $visnew_vista->claves = $posClave;
            }

            $posDescribir = isset_post("describir");
            if($posDescribir){
                $visnew_vista->describir = $posDescribir;
            }

            $path = $visnew_vista->carpeta();

            if (!file_exists($path) && mkdir($path, 0755))
            {

                /**
                 *      CREACIÓN DE ARCHIVO main.php
                 *
                 *      Creamos el archivo main.php en primer lugar porque es el único imprescindible
                 *      Su ausencia equivaldría a que no haya una vista que mostrar y en tal caso se
                 *      mostraría la vista de página en construcción
                 *
                 *      La única excepción es cuando el request es una llamada ajax .. en cuyo caso
                 *      sólo se carga el archivo head que en tal caso siempre terminará en un "exit()"
                 *
                 */
                if(isset_post("sub"))
                {

                    $creaMain = '<?php //creado auntomáticamente desde ' . E_DOMINIO.PHP_EOL.PHP_EOL;
                    $creaMain .= '$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));'.PHP_EOL;
                    $creaMain .= 'if (!empty($subFileLoad)) {include($subFileLoad);}'.PHP_EOL;
                }
                else
                {
                    $creaMain = '<?php //creado auntomáticamente desde ' . E_DOMINIO.PHP_EOL.PHP_EOL;
                }

                if ($visnew_fp = fopen($path . DS . "main.php", "w"))
                {

                    fputs($visnew_fp, $creaMain);
                    fclose($visnew_fp);

                    if (!$visnew_vista->save())
                    {
                        $mal = 'No se pudo crear la vista';
                        rmdir($path );
                    }

                }
                else
                {
                    $mal = "la vista ya existe, el archivo de referencia no puede crearse";
                }


                /**
                 *      CREACIÓN DE ARCHIVO models.php
                 *
                 *      Sólo será creado si se recibe un valor para la variable $_POST["modelo"]
                 *
                 *      Por defecto "head.php" incluirá el modelo a gestionar en la vista
                 *      por ese motivo se crea el archivo "models.php"  antes de "head.php"
                 *
                 */
                $modeloNombre = isset_post("modelo");
                if($modeloNombre)
                {
                    $tablaNombre = isset_post("tabla");
                    if($tablaNombre)
                    {
                        $tablaModelo = $tablaNombre;
                    }
                    else
                    {
                        if(substr($modeloNombre,-1) == "s")
                        {
                            $tablaModelo = $modeloNombre;
                        }
                        else
                        {
                            $tablaModelo = $modeloNombre."s";
                        }
                    }

                    $creaModels = '<?php //creado auntomáticamente desde ' . E_DOMINIO.PHP_EOL.PHP_EOL;
                    $creaModels .= '//use Cartalyst\Sentinel\Users\EloquentUser;'.PHP_EOL;
                    $creaModels .= '//use Cartalyst\Sentinel\Roles\EloquentRole;'.PHP_EOL;
                    $creaModels .= 'use Illuminate\Database\Eloquent\Model;'.PHP_EOL;
                    $creaModels .= '//--------------------------------------------------------------------'.PHP_EOL;
                    $creaModels .= 'class ' . ucfirst($modeloNombre) . ' extends Model'.PHP_EOL;
                    $creaModels .= '{'.PHP_EOL;
                    $creaModels .= chr(9) . '//protected $table = \'' . $tablaModelo . '\';'.PHP_EOL;
                    $creaModels .= chr(9) . '//protected $primaryKey = \'id\';'.PHP_EOL;
                    $creaModels .= chr(9) . '//protected $fillable = [\'nombre\',\'descripcion\'];'.PHP_EOL;
                    $creaModels .= chr(9) . '//public $timestamps = false;'.PHP_EOL;
                    $creaModels .= '}'.PHP_EOL;

                    if ($visnew_fp = fopen($path . DS . "models.php", "w"))
                    {

                        fputs($visnew_fp, $creaModels);
                        fclose($visnew_fp);

//                        if (!$visnew_vista->save())
//                        {
//                            $mal = 'No se pudo crear el archivo de modelos';
//                            rmdir($path );
//                        }

                    }
                    else
                    {
                        $mal = "la archivo de modelos ya existe, la nueva referencia no puede crearse";
                    }
                }



                /**
                 *      Se incluirá el código de las sub-vistas sólo en caso de ser solicitado
                 */
                if(isset_post("sub"))
                {

                    $subFilesHead = '$parts = ["new", "select", "update", "delete"];'.PHP_EOL;
                    $subFiles = '$subFileLoad = loadPart($parts, basename(__FILE__, ".php"));'.PHP_EOL;
                    $subFiles .= 'if (!empty($subFileLoad)) {include($subFileLoad);}'.PHP_EOL;
                }
                else
                {
                    $subFilesHead = "";
                    $subFiles = "";
                }



                /**
                 *      CREACIÓN DE ARCHIVO head.php
                 */
                $creaHead  = '<?php //creado auntomáticamente desde ' . E_DOMINIO.PHP_EOL.PHP_EOL;

                if($modeloNombre)
                {
                    $creaHead .= 'require_once \'models.php\';'.PHP_EOL.PHP_EOL;
                }
                else
                {
                    $creaHead .= '//require_once \'models.php\';'.PHP_EOL.PHP_EOL;
                }

                $creaHead .= $subFilesHead;
                $creaHead .= $subFiles;

                if ($visnew_fp = fopen($path . DS . "head.php", "w"))
                {

                    fputs($visnew_fp, $creaHead);
                    fclose($visnew_fp);

//                    if (!$visnew_vista->save())
//                    {
//                        $mal = 'No se pudo crear la vista';
//                        rmdir($path );
//                    }

                }
                else
                {
                    $mal = "El archivo de encabezado ya existe, la referencia no puede crearse";
                }


                /**
                 *      CREACIÓN DE ARCHIVO script.php
                 */
                if(isset_post("js"))
                {
                    $creaJs = '<?php //creado auntomáticamente desde ' . E_DOMINIO.PHP_EOL.PHP_EOL;
                    $creaJs .= $subFiles;

                    if ($visnew_fp = fopen($path . DS . "script.php", "w"))
                    {

                        fputs($visnew_fp, $creaJs);
                        fclose($visnew_fp);

                    }
                    else
                    {
                        $mal = "El archivo de javascript ya existe, la referencia no puede crearse";
                    }
                }


                /**
                 *      CREACIÓN DE ARCHIVO css.php
                 */
                if(isset_post("css"))
                {
                    $creaCss = '<?php //creado auntomáticamente desde ' . E_DOMINIO.PHP_EOL.PHP_EOL;
                    $creaCss .= $subFiles;

                    if ($visnew_fp = fopen($path . DS . "css.php", "w"))
                    {

                        fputs($visnew_fp, $creaCss);
                        fclose($visnew_fp);

                    }
                    else
                    {
                        $mal = "El archivo de estilos ya existe, la referencia no puede crearse";
                    }
                }

            }
            else
            {
                $visnew_compruebaVista = Vista::where("nombre", $visnew_vista->nombre)->count();

                if ($visnew_compruebaVista > 0 || !$visnew_vista->save())
                {
                    $mal = 'La vista ' . $visnew_vista->nombre . ' ya existe,<br />No puede ser creada';
                }
            }

        }
        else
        {
            $mal = 'La página seleccionada no existe';
        }
    }
    else
    {
        $mal = "El nombre de la vista y los roles de usuario admitidos son obligatorios";
    }

    /**
     * Si no ocurrieron errores asumo que la acción fue correcta y recargo la vista
     */
    if ($mal === 0) {
        Capsule::commit();
        $_SESSION['mensajeSistema'] = ["Vista añadida correctamente"];
        header("Location:" . E_URL . E_VIEW);
        exit();
    } else {
        Capsule::rollback();
        $_SESSION['mensajeSistema'] = $mal;
        header("Location:" . E_URL . E_VIEW);
        exit();
    }

} catch (Exception $e) {
    Capsule::rollback();
    $_SESSION['mensajeSistema'] = 'Se produjo un error grave, inténtelo más tarde.';
    header("Location:" . E_URL . E_VIEW);
    exit();
}