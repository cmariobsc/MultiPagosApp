/**
 * Created by Eric on 20/6/2019.
 */
function scroll(t){t = typeof t !== 'undefined' ?  t : "up";$('html,body').animate({scrollTop: $("#"+t).offset().top}, 2000);}
function capital(s){return s[0].toUpperCase() + s.slice(1);}
function BID(a,b){return $(a).attr("id").substr(b);}
function confirmaBorrar(a,b){if(confirm(a)){window.location.assign(b);}else{return false;}}
function confirma(a){if(confirm(a)){return true;}else{return false;}}
function cAccion(url, msg){if(confirma(msg)){window.location.assign(url);}return false;}
function soloNum(dato){a=dato.replace(/[^0-9/.?0-9]/g,'');return a;}
function soloVal(dato, regex){a=dato.replace(regex,'');return a;}
function alterna(n,claseColor){if(claseColor === undefined){var cl = " filaColor";}else{var cl = " "+claseColor;}if(n%2 != 0){return cl;} else {return "";}}
function cambiaClase(selector, clase){$(selector).toggleClass(clase);}
function vCorreo(correo) {var valRE = [/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/,/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/,/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/];if(correo !== ""){return valRE[0].test(correo);} else {return false;}}
function evalForm(f)
{

        /**
         *  evalForm tiene que ser global y estar definida en el script de la vista
         *
         *  Si no trae elparámetro "f" entonces es que la vista tiene un único formulario
         *  y no es necesario indicar el "id" del formulario que se debe evaluar
         *
         *  var evaluaForm = [];
         *  evaluaForm[0] = ["nombre","mensaje","imagen"]; // para campos select u otros que vacíos devuelvan "null"
         *  evaluaForm[1] = ["nombre","mensaje","imagen"]; // para campos input y otros que vacios devuelvan ""
         *
         *  <button onclick="return evalForm()"></button
         * ___________________________________________________________________
         *
         * Si por el contrario, trae el parámetro "f" entonces la vista tiene más de un formulario y será necesario
         * considerar cual será el formulario a evaluar, para ello las variables declaradas serán objetos
         * cuyas claves serán los "id" de los respectivos formularios
         * En cada formulario la evaluación será similar a la variante anterior sin parámetro "f", de manera tal que
         * el índice "0" será las evaluaciones que puedan arrojar "null", si no se necesita, deberá ser asignado "null"
         * el índice "1" será las evaluaciones que puedan arrojar "", si no se necesita, deberá ser asignado ""
         *
         var evaluaForm = {
             form1 : [
                 null,
                 ["nombre","mensaje","imagen"]
             ],
             form2 : [
                 ["nombre","mensaje","imagen"],
                 ""
             ]
         };
         */

    var f = f || null;
    var retorno = true;
    var msg = "";

    if(f)
    {
        if (f[0] != null) {
            $.each(f[0], function (a, b) {
                if ($('#' + b).val() == null) {
                    msg += "Debe incluir el valor de " + b + "\r\n";
                    retorno = false;
                }
            });
        }
        if (f[1] != "") {
            $.each(f[1], function (a, b) {
                if ($('#' + b).val() == "") {
                    msg += "Debe incluir el valor de " + b + "\r\n";
                    retorno = false;
                }
            });
        }
    }
    else
    {
        if (evaluaForm[0] != null) {
            $.each(evaluaForm[0], function (a, b) {
                if ($('#' + b).val() == null) {
                    msg += "Debe incluir el valor de " + b + "\r\n";
                    retorno = false;
                }
            });
        }
        if (evaluaForm[1] != "") {
            $.each(evaluaForm[1], function (a, b) {
                if ($('#' + b).val() == "") {
                    msg += "Debe incluir el valor de " + b + "\r\n";
                    retorno = false;
                }
            });
        }
    }

    if (!retorno) {
        alert(msg);
    }
    return retorno;
}
function genPass(largo, complejidad)
{
    var largo = largo || 8;
    var complejidad = complejidad || 3;
    var pass = "";

    switch (complejidad)
    {
        case 1:
            var caracteres = 'abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789!$%&/()=?¿*-+^{}[]¨@ç_¡';
            break;
        case 2:
            var caracteres = 'abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789';
            break;
        default:
            var caracteres = 'abcdefghijkmnpqrtuvwxyz';
    }

    for (i=0; i<largo; i++)
    {
        pass += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
    }
    return pass;
}
function porciento2($porC,$neto){
    // esta funcion arroja directamente el precio publico
    // a partir del precio neto y el % de utilidad y en formato de decimales
    return parseFloat($neto/((100-$porC)/100));
    //return $neto/((100-$porC)/100);
}
function porciento($porC,$neto){
    //return ($porC*$neto)/100;
    return parseFloat(($porC/100)*$neto);
}
function quePorciento($neto,$bruto){
    return parseFloat(($neto * 100)/$bruto);
}
	
	
	
	
	