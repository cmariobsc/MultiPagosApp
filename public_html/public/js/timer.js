/**
 * Created by Eric on 30/12/2018.
 */
function timerA(tiempo, destino, mensaje, st)
{
    /**
     *  TEMPORIZADOR
     *  tiempo --- Fecha límite del temporizador
     *  destino --- Elemento html donde se mostrará el mensaje de salida del timeOut
     *  mensaje --- Mensaje a mostrar una vez concluido el timer
     *  st --- estilo que se le aplicará al temporizador
     */

        // Mensaje por defecto
    var mensaje = mensaje || "TIEMPO EXPIRADO";

    // st es el estilo para las nomenclaturas
    var st = st || "tColor1";

    // Esta es la fecha hacia la que se quiere llegar
    var countDownDate = new Date(tiempo).getTime(); //"2019-04-03 15:37:25"

    // Actualizamos los valores cada un segundo
    var x = setInterval(function() {

        // Obtenemos fecha y hora actual
        var ahora = new Date().getTime();

        // encontramos la diferencia de tiempo entre la fecha actual y la fecha destino
        var intervalo = countDownDate - ahora;

        // Calculamos el tiempo faltante en dias, horas, minutos, segundos
        var days = Math.floor(intervalo / (1000 * 60 * 60 * 24));
        var hours = Math.floor((intervalo % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((intervalo % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((intervalo % (1000 * 60)) / 1000);

        // Mostramos el tiempo faltante dentro de un elemento HTML
        var cadTiempo = days + '<small class="'+st+'">d</small> ';
        cadTiempo += hours + '<small class="'+st+'">h</small> ';
        cadTiempo += minutes + '<small class="'+st+'">m</small> ';
        cadTiempo += seconds + '<small class="'+st+'">s</small> ';
        document.getElementById(destino).innerHTML = cadTiempo;

        // Si el tiempo ha expirado mostramos un texto
        if (intervalo < 0) {
            clearInterval(x);
            document.getElementById(destino).innerHTML = mensaje;
            $('#pruebaVictoria').slideDown("slow");
        }
    }, 1000);
}

function timerS(tiempo, destino, tipo)
{
    /**
     *  TEMPORIZADOR SEPARADOS POR UNIDAD DE TIEMPO, HORAS, MINUTOS, SEGUNDOS, etc.
     *  tiempo --- Fecha límite del temporizador
     *  destino --- Elemento html donde se mostrará el mensaje de salida del timeOut
     *  tipo --- Unidad de tiempo
     */
    var countDownDate = new Date(tiempo).getTime();
    var x = setInterval(function(){
        var ahora = new Date().getTime();
        var intervalo = countDownDate - ahora;
        switch (tipo)
        {
            case "d":
                var val = Math.floor(intervalo / (1000 * 60 * 60 * 24));
                break;
            case "h":
                var val = Math.floor((intervalo % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                break;
            case "m":
                var val = Math.floor((intervalo % (1000 * 60 * 60)) / (1000 * 60));
                break;
            case "s":
                var val = Math.floor((intervalo % (1000 * 60)) / 1000);
        }
        if (intervalo >= 0)
        {
            document.getElementById(destino).innerHTML = val;
        }
        else
        {
            clearInterval(x);
            document.getElementById(destino).innerHTML = "00";
        }
    }, 1000);
}

function timerMake(f,t)
{
    /**
     * Verifica estado de los integrantes del clan cada cierto intervalo de tiempo
     * f - Funcion a ejecutar
     * t - Tiempo de espera
     */
    f();
    var t = t || 60000;
    var conteo = new Date().getTime() + t;
    var x = setInterval(function(){
        var ahora = new Date().getTime();
        var intervalo = conteo - ahora;
        if (intervalo < 0)
        {
            f();
            conteo = ahora + t;
        }
    }, 1000);
}