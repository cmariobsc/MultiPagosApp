<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 14/2/2020
 * Time: 01:09
 * Proyecto: lx_redmultipago.com
 */
use Illuminate\Database\Eloquent\Model;

//    GetH2HCountries.-  Devuelve el listado de países para procesar transacciones WU.
//      AF|Afganistán
//      ‘AF’: Código país (ISO 2 letras)
//      ‘Afganistán‘: Descripción país
//    GetH2HStates.- Devuelve una lista de los estados/provincia de Ecuador, EEUU y México
//      EC|GU|GUAYAS|09
//      US|FL|FLORIDA|
//      ‘EC‘: Código país (ISO 2 letras)
//      ‘GU’: Código estado/provincia
//      ‘GUAYAS’: Descripción de estado/provincia
//      ‘09’: Código SRI
//    GetH2HCities.- Devuelve una lista de ciudades en base a estado/provincia de Ecuador, EEUU y México.
//        1|EC|AZ|CUENCA|1
//        448|MX|SON|BAHIA DE KINO|0
//        ’1’:  Identificador de la ciudad
//        ‘EC’: Código país (ISO 2 letras)
//        ‘AZ’: Código estado/provincia
//        ‘CUENCA’: Descripción de la ciudad
//        ‘1’: Si es capital de la provincia
//    GetH2HCountryCurrencies.- Devuelve la lista de monedas asociadas a cada país.
//          RU|RUR|Rublo ruso|
//          RU|USD| Dólar estadounidense|
//          ‘RU’:  Código país (ISO 2 letras)
//          ‘RUR’: Código moneda
//          ‘Rublo ruso’: Descripción moneda
//    GetH2HEconomicActivity.- Devuelve el listado de las actividades económicas.
//            1237| Ama de Casa| Ama de Casa |A
//            ‘1237’: Código de la actividad económica.
//            ‘Ama de Casa’: Descripción de la actividad económica.
//            ‘Ama de Casa’: Alias de la actividad económica.
//            ‘A’: Indica el estado de la actividad (A=Activo,I=Inactivo)
//    GetH2HGentilicios.- Devuelve el listado de nacionalidades.
//
//    GetH2HCatalogCompilanceTemplate.- Devuelve el listado de los catálogos para el uso de datos adicionales del cliente
//            ARG | Algeria | COUNTRY |A |0
//            ‘AD’: Código país.
//            ‘Algeria’ : Descripción
//            ‘COUNTRY’: Identificador.
//            ‘A’: Indica el estado de la actividad (A=Activo,I=Inactivo)
//            ‘0’  Orden (aplica para el Identificador ANNUAL_INCOME)
//    GetH2HDeliveryServicesCuba.- Devuelve el listado de Servicios de Envío para Cuba
//            045|FAMILIAR-NO FAMILIAR(DONACION)|CUC|A
//            ‘045’:  Código de Servicio.
//            ‘FAMILIAR-…’: Descripción del servicio.
//            ‘CUC’: Tipo en este caso CUC perteneciente a CUBA.
//            ‘A’: Indica el estado del servicio (A=Activo,I=Inactivo)
//    GetH2HDeliveryOptionTemplateCuba.-  Devuelve un listado de líneas con el título o cabecera y cada pregunta detalle para realizar envíos a Cuba, las respuestas se cotejan por HIB en los métodos SendMoneyValidation y SendMoneyStore para el caso de envíos a Cuba.
//            dotId|dotDescription|dotType|
//            dotHIB|dotStatus
//            ‘1’: Código de línea de template.
//            ‘Instrucciones: El agente debe…’: Descripción de cada línea de template.
//            ‘HEADER: Tipo de línea de template, puede ser HEADER o DETAIL.
//            ‘00’: Código de HIB usado para proporcionar la respuesta a las preguntas enviadas en el tempate
//            ‘A’: Indica el estado de cada línea del template(A=Activo,I=Inactivo)



class DasCatalogo extends Model
{
    protected $table = 'das_catalogo';

    public function dato()
    {
        return json_decode($this->texto);
    }

    public function separa($a)
    {
        $retorno = [];
        foreach($a as $id=>$val)
        {
            $item = explode("|", $val);

            //if(substr($val, 0,2) == $r)
            if($r == $item[$l])
            {
                $retorno[$id] = $val;
                //$retorno[$id] = $item[$l];
            }
        }
        return $retorno;
    }

    public static function datos($m)
    {
        return self::where("titulo", $m)->first();
    }

    public static function catalogo($m, $formato = "json")
    {
        $retorno = [];
        $datos = self::datos($m);
        $resultados = json_decode($datos->texto, true);
        foreach($resultados as $resultado)
        {
            array_push($retorno, explode("|", $resultado));
        }
        return $formato == "json" ? json_encode($retorno) : $retorno;
    }
}


/*
class DasCountries extends Model
{
    protected $table = 'das_countries';
    //public $timestamps = false;

}

class DasStates extends Model
{
    protected $table = 'das_states';
    //public $timestamps = false;

}

class DasCities extends Model
{
    protected $table = 'das_cities';
    //public $timestamps = false;

}

class DasCountryCurrencies extends Model
{
    protected $table = 'das_country_currencies';
    //public $timestamps = false;

}

class DasEconomicActivity extends Model
{
    protected $table = 'das_economic_activity';
    //public $timestamps = false;

}

class DasGentilicios extends Model
{
    protected $table = 'das_gentilicios';
    //public $timestamps = false;

}

class DasCatalogCompilanceTemplate extends Model
{
    protected $table = 'das_catalog_compilance_template';
    //public $timestamps = false;

}

class DasDeliveryServicesCuba extends Model
{
    protected $table = 'das_delivery_services_cuba';
    //public $timestamps = false;

}

class DasDeliveryOptionTemplateCuba extends Model
{
    protected $table = 'das_delivery_option_template_cuba';
    //public $timestamps = false;

}



*/