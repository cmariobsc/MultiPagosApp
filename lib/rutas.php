<?php
/**
 * Created by Eric Larrea
 * email: elapez@gmail.com
 * Date: 1/12/2018
 */


/**
 * RUTAS Y VISTAS
 * Creo un arreglo con las vistas disponibles del sitio
 */
$_SITE_VIEWS = Vista::vistas();


if (isset($_GET['url']))
{

    // Saneo la URL
    $_PPGG_ORIGEN = filter_var($_GET['url'], FILTER_SANITIZE_URL);

    // Trato de determinar si la URL trae "/"
    $_PPGG = strpos($_PPGG_ORIGEN, "/");


    if ($_PPGG !== false)
    {
        /**
         * la URL ingresada trae slaches "/"
         */
        $_VER_LISTA = explode("/",$_GET['url']);

        /**
         * sustraemos el primer elemento y lo consideramos como la vista a mostrar
         */
        $_PPGG_VIEW = array_shift($_VER_LISTA);


        if(!empty($_VER_LISTA[0]))
        {
            /**
             * si la parte sobrante de la URL no está vacía entonces es que trae alguna "sub-vista"
             * o incluso también un título personalizado para la misma
             * Ej.: //dominio/vista/sub-vista
             *      //dominio/vista/sub-vista/titulo-personalizado-de-la-vista
             *
             * Lo primero sería determinar la "sub-vista"
             */
			$_PPGG_SUB_VIEW = array_shift($_VER_LISTA);

			/**
             * Indico que el título es la sub-vista
             */
            $_PPGG_VIEW_TITLE = $_PPGG_SUB_VIEW;

            /**
             * Eventualmente podria venir un título personalizado
             * en dicho caso, debemos volver a preguntar
             * por el valor que pasó a tener el primer índice en $_VER_LISTA[]
             */
			if(!empty($_VER_LISTA[0]))
			{
				/**
                 * Si no es vacio entonces es que trae un titulo personalizado
                 * Ej.: //dominio/vista/subVista/titulo-personalizado-de-la-vista
                 */
				$_PPGG_VIEW_TITLE = $_VER_LISTA[0];
			}

        }
        else
        {
            /**
             * No hay sub-vista, sólo que al final de la URL viene un "/"
             * Ej.: //dominio/vista/
             */
            $_VER_LISTA = [];

            /**
             * El título de la vista será el nombre de la misma
             */
            $_PPGG_VIEW_TITLE = $_PPGG_VIEW;
        }
    }
    else
    {
        /**
         * la URL ingresada no tiene slaches
         */
        $_VER_LISTA = [];
        $_PPGG_VIEW = $_GET['url'];
        $_PPGG_VIEW_TITLE = $_PPGG_VIEW;
    }



    /**
     * Averiguo si la vista solicitada está en el arreglo de vistas
     */
    if (in_array($_PPGG_VIEW, $_SITE_VIEWS))
    {

        define("E_VIEW", $_PPGG_VIEW);
        define("E_TITLE", $_PPGG_VIEW_TITLE);

        if(isset($_PPGG_SUB_VIEW))
        {
            $_REQUEST["a"] = $_PPGG_SUB_VIEW;
        }

			
            $vistaActual = Vista::where("nombre", strtolower(E_VIEW))->first();



            if(!$vistaActual->hay_permiso($userTipo))
            {
                /**
                 * No hay permisos, no se dará acceso
                 */
                redir();
            }

    }
    else
    {
        /**
         * Si la página llamada no existe en el arreglo de páginas del sitio
         * el visitante debería ser redirigido a la página de inicio del sitio
         * o en su defecto a la vista de contenido en construcción
         */
        include(E_LIB . "inicioObligado.php");
    }
}
else
{
    /**
     * Si la página llamada no existe en el arreglo de páginas del sitio
     * el visitante debería ser redirigido a la página de inicio del sitio
     * o en su defecto a la vista de contenido en construcción
     */
    include(E_LIB . "inicioObligado.php");
}
