<?php
session_start();
date_default_timezone_set("America/Guayaquil");
define("E_ID_SESSION", session_id());
//echo DATE_ATOM; exit();
/**
 * VARIABLE DE CONTROL DE ERRORES
 */
$mal = 0;

//phpinfo(); exit();
/**
 * CONSTANTES GLOBALES INICIALES
 */
define('DS', DIRECTORY_SEPARATOR);
define("E_RAIZ", dirname(__DIR__) . DS);
define("E_CONFIG", E_RAIZ . "ini" . DS);
define("E_LIB", E_RAIZ . "lib" . DS);
define('E_PUBLIC', E_RAIZ . "public_html" . DS);
define("E_VISTAS", E_RAIZ . "vistas" . DS);
define("E_INDEX_ADMIN", "inicio_admin");
define("E_INDEX_USER", "inicio_usuarios");
define("E_INDEX_PUBLIC", "inicio");
define("E_ESPACIO", chr(32));
define("E_CS", chr(39));                    // comilla sencilla
define("E_CD", chr(34));                    // comilla doble
define("E_LF", chr(10));
define("E_VT", chr(11));
define("E_FECHA", date("Ymd"));             // ISO  20110528
define("E_TIEMPO", date("YmdHis"));         // ISO TIMESTAMP 20110829100201 en DB seria 2011-08-29 10:02:01



/**
 * FUNCIONES DE CONTROL, REVISIÓN Y DESARROLLO
 */
require_once E_LIB . "debug.php";


/**
 * Dominio y sistema de archivos
 */
require_once E_CONFIG . "globalesDominio.php";


/**
 * CONFIGURACIÓN DE LA DB
 */
require_once E_CONFIG . "db.php";

/**
 * FOTO INEXISTENTE
 */
define("E_NOFOTO", E_URL . "public/img/noFoto.png");

/**
 * CONEXIÓN A LA DB
 */
require_once E_CONFIG . "conect.php";


/**
 * OTROS VALORES GLOBALES
 */
require_once E_CONFIG . "Parametros.php";



/**
 *  CLASE PARA EL MANEJO DE VISTAS
 */
require_once E_LIB."models".DS."vistas.php";

/**
 *  CLASES PARA EL MANEJO DE CLIENTES
 */
require_once E_VISTAS . "clientes_admin" . DS . "models.php";


/**
 *  CLASES PARA EL MANEJO DE USUARIOS
 */
require_once E_LIB . 'models'.DS.'usuarios.php';



/**
 * MANEJO DE SESIONES
 */
require_once E_LIB . 'sesiones.php';



/**
 * MANEJO DE RUTAS Y VISTAS
 */
require_once E_LIB . 'rutas.php';



/**
 * RESOLUCIÓN Y MANEJO DE IDIOMA
 */
require_once E_LIB . "idioma.php";


/**
 * FUNCIONES GLOBALES
 */
require_once E_LIB . "funciones.php";

/**
 * FUNCIONES PARA REPOSITORIO DE WS
 */
require_once E_LIB . "wsRepository.php";

/**
 * Estilos generados o calculados desde el servidor
 */
require_once E_LIB . "estilos.php";


/**
 * DETECCION DE TIPO DE DISPOSITIVOS
 */
$dispositivoTipo = new Mobile_Detect;		// Detección de tipo de dispositivo (cell, tablet, pc)
$deviceType = $dispositivoTipo->isMobile() ? ($dispositivoTipo->isTablet() ? 'Tab' : 'Tel') : 'Pc';
define("E_DEVICE_TYPE", $deviceType);

/**
 *     FUNCIONES PARA ESTILOS MATERIALIZECSS
 */
require_once E_LIB . "materializecss.php";



/**
 * INSTANCIAS GLOBALES
 */
require_once E_LIB . "class" . DS . "class.bloque.php";
$b = new Bloque();											// instancia de la clase Bloque				





/**
 * CONTENIDOS PARA LA VISTA
 */
require_once E_LIB . 'models' . DS . 'vistas.php';
require_once E_LIB . 'models' . DS . 'contenidos.php';
$contView = Vista::where("nombre", E_VIEW)->first()->contenidos();



/**
 * INCLUIR SECCIÓN DE IDIOMA
 */
if (file_exists(E_VISTAS . E_VIEW . DS . $deviceType . DS . "lan.php"))
{
    include(E_VISTAS . E_VIEW . DS . $deviceType . DS . "lan.php");
}
else
{
    if (file_exists(E_VISTAS . E_VIEW . DS . "lan.php"))
    {
        include(E_VISTAS . E_VIEW . DS . "lan.php");
    }
}







/**
 * INCLUIR SECCIÓN SSI
 */
if (file_exists(E_VISTAS . E_VIEW . DS . $deviceType . DS . "head.php"))
{
    include(E_VISTAS . E_VIEW . DS . $deviceType . DS . "head.php");
}
else
{
    if (file_exists(E_VISTAS . E_VIEW . DS . "head.php"))
    {
        include(E_VISTAS . E_VIEW . DS . "head.php");
    }
}





/**
 * ENCABEZADO Y PIE DE PÁGINA
 */
$btn_login = '<a class="waves-effect waves-light btn-medium"><i class="material-icons left">person_pin_circle</i>Iniciar sesión</a>';
$btn_logout = '<a class="waves-effect waves-light btn-medium"><i class="material-icons left">person_pin_circle</i>Cerrar sesión</a>';



header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2017 05:00:00 GMT"); // Fecha en el pasado
?>
<!doctype html>
<html lang="<?= E_LAN; ?>">
<head>
<meta charset="utf-8">
<title><?= strtoupper(str_replace(["-","_"], " ", E_TITLE)); ?> -- <?= strtoupper(E_DOMINIO); ?></title>

<?php include(E_LIB . "metatags.php") ?>


<?= favicon() ?>


<!--ICONOS DE GOOGLE-->
<?php
if(E_ORIGEN == "local")
{
    echo '<link href="'.E_URL.'public/css/icon.css" rel="stylesheet">';
    echo '<link href="'.E_URL.'public/fonts/fonts.css" rel="stylesheet">';
}
else
{
    echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />';
    //<!--LETRAS EXTERNAS-->
    echo '<link href="https://fonts.googleapis.com/css?family=Roboto:100,400|Roboto+Condensed:300,400,700" rel="stylesheet" type="text/css" />';
}
?>


<!--ESTILOS GLOBALES-->
<?php
switch($userTipo)
{
    case 4:
        echo inCSS(["materialize"]);
    break;
    default:
        echo inCSS(["mat_privado"]);
}
echo inCSS(["bordes"]);
?>

<!--ESTILOS GLOBALES SEGÚN DISPOSITIVO-->
<?= inCSS([$deviceType]) ?>

<!--ESTILOS  DE LA VISTA-->
<?php
    if (file_exists(E_VISTAS . E_VIEW . DS . $deviceType . DS . "css.php"))
    {
        include(E_VISTAS . DS . E_VIEW . DS . $deviceType . DS . "css.php");
    }
    else
    {
        if (file_exists(E_VISTAS . E_VIEW . DS . "css.php"))
        {
            include(E_VISTAS . DS . E_VIEW . DS . "css.php");
        }
    }
?>

<?php
echo inJS(["jquery","materialize","latinexus","myMaterialize","jspdf"]);
?>

<style type="text/css">
<?= cols() ?>
<?= coloresApp($_SESSION['colores']) ?>
</style>

<script type="text/javascript">
	var autoId = 0;
	var E_FECHA = new Date();
	var E_URL = "<?= E_URL ?>";
    <?php if(E_VIEW=="contacto"): ?>
        var onloadCallback = function() {
            grecaptcha.render('chachacha', {
                'sitekey' : '6LcxaV0UAAAAAOj37bNH-BSSS2eGeOWwSUJscQTy',
                'hi' : '<?= E_LAN ?>'
            });
        };
    <?php endif ?>
</script>
</head>
<body>
<div id="bodyInterior">
<a id="up"></a>
<?php

//if(E_DESTINO == "publico" && E_ORIGEN == "remoto"){include(E_LIB . "urchin.php");} // Para estadísticas de google
msgSystem(); // Mensaje de error ( si existe )


/**
 * Incluimos el encabezado
 */
if(file_exists(E_LIB . "zonas" . DS . E_VIEW . "Header.php"))
{
    include (E_LIB . "zonas" . DS . E_VIEW . "Header.php");
}
else
{
    if(file_exists(E_LIB . "zonas" . DS . "header.php"))
    {
        include (E_LIB . "zonas" . DS . "header.php");
    }
}
?>

<main id="principal">
    <div  class="pagina">
        <?php
        if(E_DEVICE_TYPE != "Pc")
        {
            if($userTipo == 3 || $userTipo == 5)
            {
                include E_VISTAS . "procesos" . DS . "estados.php";
            }
        }

        if (file_exists(E_VISTAS . E_VIEW . DS . $deviceType . DS . "main.php"))
        {
            include(E_VISTAS . E_VIEW . DS . $deviceType . DS . "main.php");
        }
        else
        {
            if (file_exists(E_VISTAS . E_VIEW . DS . "main.php"))
            {
                include(E_VISTAS . E_VIEW . DS . "main.php");
            }
            else
            {
                include(E_LIB."construccion.php");
            }
        }
        ?>
    </div>
</main>

<?php
/**
 * Incluimos el pie de página
 */
if(file_exists(E_LIB . "zonas" . DS . E_VIEW . "Footer.php"))
{
    include (E_LIB . "zonas" . DS . E_VIEW . "Footer.php");
}
else
{
    if(file_exists(E_LIB . "zonas" . DS . "footer.php"))
    {
        include (E_LIB . "zonas" . DS . "footer.php");
    }
}
?>

<!--CIERRE DE "bodyInterior"   -->
</div>



<?php if(E_ORIGEN == "local"): ?>
<div class="row cen">
    <div class="col s12 l2 offset-l1">
        <?php for($i=1; $i<=count($_SESSION['colores']); $i++):?>
            <div class="fColor<?= $i ?>"><?= $_SESSION['colores'][$i] ?></div>
        <?php endfor; ?>
    </div>
    <div class="col s12 l2">
        <?php for($i=1; $i<=count($_SESSION['colores']); $i++):?>
            <div class="ftColor<?= $i ?>"><?= $_SESSION['colores'][$i] ?></div>
        <?php endfor; ?>
    </div>
    <div class="col s12 l2">
        <?php for($i=1; $i<=5; $i++):?>
            <div class="tipo<?= $i ?>"><?= "tipo".$i ?></div>
        <?php endfor; ?>
        <div class="notas">notas</div>
    </div>
    <div class="col s12 l2">
        <?php for($i=1; $i<=5; $i++):?>
            <div class="letra<?= $i ?>">Letra <?= $i ?></div>
        <?php endfor; ?>
    </div>
    <div class="col s12 l2">
        <?php for($i=1; $i<=5; $i++):?>
            <div><h<?= $i ?>>Titulo <?= $i ?></h<?= $i ?>></div>
        <?php endfor; ?>
    </div>
</div>
<?php 
endif;
?>
<script type="text/javascript">
    var dateSpanish = {
        clear:'Borrar',
        today:'Hoy',
        done:'Ok',
        previousMonth:'‹',
        nextMonth:'›',
        months:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthsShort:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        weekdays:['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        weekdaysShort:['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
        weekdaysAbbrev:['D','L','M','M','J','V','S']
    };
    var timeSpanish = {
        clear:'Limpiar',
        cancel:'Cancelar',
        done:'Ok'
    };
    var dateIngles = {
        clear:'Clear',
        today:'Today',
        done:'Ok',
        previousMonth:'‹',
        nextMonth:'›',
        months:[
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ],
        monthsShort:[
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        weekdays:[
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ],
        weekdaysShort:[
            'Sun',
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat'
        ],
        weekdaysAbbrev:[
            'S','M','T','W','T','F','S'
        ]
    };
    var timeIngles = {
        clear:'Clear',
        cancel:'Cancel',
        done:'Ok'
    };
    var wAncho = window.innerWidth;
    var wAlto = window.innerHeight;
    var mAncho = window.outerWidth;
    var mAlto = window.outerHeight;
    var pAncho = screen.width;
    var pAlto = screen.height;
	
	document.addEventListener('DOMContentLoaded', function() {
        // DROP-DOWN
        var elemsDD = document.querySelectorAll('.dropdown-trigger');
        var instancesDD = M.Dropdown.init(elemsDD, {
            coverTrigger: false,
            constrainWidth: false
        });

        // DATE PICKER
        var elemsFecha = document.querySelectorAll('.datepicker');
        var instanciaFecha = M.Datepicker.init(elemsFecha, {
            autoClose:true,
            firstDay:1,
            format:'dd mmm, yyyy',
            i18n:dateSpanish,
            onClose:function()
            {
                var ele = this.el.id;
                var fechaIso = JSON.stringify(this.date);

                if(fechaIso !== undefined)
                {
                    $('#datepickerTrue'+ele).val(JSON.parse(fechaIso));
                }
            }
        });

        // TIME PICKER
        var tPicker = document.querySelectorAll('.timepicker');
        var instance_pick_time = M.Timepicker.init(tPicker,{
            twelveHour:false,
            i18n:timeSpanish,
            showClearBtn: true,
            autoClose: true,
            onSelect:function(h,m)
            {
                var ele = this.el.id;
                $('#timepickerTrue'+ele).val(h+":"+m);
            }
        });

        // COLLAPSIBLE
        var elemsColapso = document.querySelectorAll('.collapsible');
        var instanciaColapso = M.Collapsible.init(elemsColapso, {
            inDuration: 300
        });

        // FLOATING ACTION BUTTON
        var elemsFloatingActionButton = document.querySelectorAll('.fixed-action-btn');
        var instancesFAB = M.FloatingActionButton.init(elemsFloatingActionButton, {
            hoverEnabled: true
        });

    });

    $(function() {
        $('select').formSelect();
        $('.sidenav').sidenav();
        $('.modal').modal();
        $('.materialboxed').materialbox();
        $('.tabs').tabs();
		
        // Manejo de las dimensiones de la vista
        $(window).resize(function(){
            wAncho = window.innerWidth;
            wAlto = window.innerHeight;
            mAncho = window.outerWidth;
            mAlto = window.outerHeight;
        });
    });
</script>
<?php

//SCRIPTS GLOBALES SEGÚN DISPOSITIVO-->
echo inJS([$deviceType]).PHP_EOL;


//SCRIPTS LOCALES-->
if (file_exists(E_VISTAS . E_VIEW . DS . $deviceType . DS . "script.php"))
{
    include(E_VISTAS . DS . E_VIEW . DS . $deviceType . DS . "script.php");
}
else
{
    if (file_exists(E_VISTAS . E_VIEW . DS . "script.php"))
    {
        include(E_VISTAS . DS . E_VIEW . DS . "script.php");
    }
}

?>

</body>
</html>
<?php
if (file_exists(E_VISTAS . E_VIEW . DS . $deviceType . DS . "pie.php"))
{
    include(E_VISTAS . E_VIEW . DS . $deviceType . DS . "pie.php");
}
else
{
    if (file_exists(E_VISTAS . E_VIEW . DS . "pie.php"))
    {
        include(E_VISTAS . E_VIEW . DS . "pie.php");
    }
}
//rutaSeccion("pie");
// cierro cualquier conexión existente a DB
if(isset($mysqli)) {
    $mysqli->close();
}

// Guardamos el nombre de la vista previa
// para la próxima
$_SESSION['pOld'] = E_VIEW;