/**
 * Created by Eric on 2/5/2019.
 */

var MATCSS = MATCSS || {};

MATCSS.sid = function()
{
    return Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
};

MATCSS.radio = function (label, name, obj)
{
    var label = obj.label || "";
    var value = obj.value || "";
    var destino = obj.destino || "";
    var name = obj.name || "radio";
    //var id = obj.id || obj.name;    // No la voy a usar, al menos no por ahora
    var clase = obj.clase || "with-gap";
    var check = obj.check != undefined ? ' checked=""' : "";
    var domDestino = obj.domDestino || "#";
    var caja = obj.caja != undefined ? true : false;
    var escribe = obj.escribe != undefined ? true : false; // "true" provoca una reescritura del contenido y "false" añade el contenido a los existente

    var retorno = '<p><label>';
    retorno += '<input class="'+clase+'" name="'+name+'" type="radio"'+check+' value="'+value+'" />';
    retorno += '<span>'+label+'</span>';
    retorno += '</label></p>';

    if(caja)
    {
        if(escribe)
        {
            $(domDestino + destino).empty();
        }
        $(domDestino + destino).append(retorno);
        return true;
    }
    else
    {
        return retorno;
    }
};

MATCSS.checkbox = function (label, name, obj)
{
    var label = label || "";
    var value = obj.value || 1;
    var destino = obj.destino || "";
    var name = name || "radio";
    var id = obj.id || name;
    var clase = obj.clase || "filled-in";
    var check = obj.check != undefined ? ' checked=""' : "";
    var domDestino = obj.domDestino || "#";
    var caja = obj.caja != undefined ? true : false;
    var escribe = obj.escribe != undefined ? true : false; // "true" provoca una reescritura del contenido y "false" añade el contenido a los existente

    var retorno = '<p><label>';
    retorno += '<input class="'+clase+'" id="'+id+'" name="'+name+'" type="checkbox"'+check+' value="'+value+'" />';
    retorno += '<span>'+label+'</span>';
    retorno += '</label></p>';

    if(caja)
    {
        if(escribe)
        {
            $(domDestino + destino).empty();
        }
        $(domDestino + destino).append(retorno);
        return true;
    }
    else
    {
        return retorno;
    }
};

MATCSS.input = function (label, name, obj)
{
    var id = obj.id || name;
    var valor = obj.value || "";
    var type = obj.type || "text";
    var required = obj.req ? ' required=""' : "";
    var readonly = obj.rea ? ' readonly=""' : "";
    var disabled = obj.dis ? ' disabled=""' : "";
    var env = obj.env ? " " + obj.env : " col s12";

    if(obj.sinEnv == undefined)
    {
        retorno = '<div class="input-field' + env + '">';
        retorno += '<input value="' + valor + '" name="' + name + '" id="' + id + '" type="' + type + '" ' + required + readonly + disabled + ' class="validate">';
        retorno += '<label for="' + id + '">' + label + '</label>';
        retorno += '</div>';
    }
    else
    {
        retorno = '<input value="' + valor + '" name="' + name + '" id="' + id + '" type="' + type + '" ' + required + readonly + disabled + ' class="validate">';
        retorno += '<label for="' + id + '">' + label + '</label>';
    }


    return retorno;
};

MATCSS.select = function (label, name, obj)
{
    var id = obj.id || name;
    var extra = obj.extra || "";
    var cont = obj.cont || {};
    var value = obj.value || "";
    var env = obj.env || "col s12";
    var fun = obj.fun || "";

    if(value!="")
    {
        var contView = "";
    }
    else
    {
        var contView = '<option value="" disabled="" selected="">Seleccionar</option>';
    }

    if(fun != "")
    {
        if(fun.v)
        {
            var func = ' onchange="' + fun.f + '('+fun.v+')"';
        }
        else
        {
            var func = ' onchange="' + fun + '()"';
        }
    }
    else
    {
        var func = "";
    }

    if(obj.def == undefined)
    {
        var sel = '<select name="' + name + '" id="' + id + '"' + func + ' ' + extra + '>';
        var label = '<label for="' + id + '">' + label + '</label>';
        var envView = 'input-field ';
    }
    else
    {
        var sel = '<label>' + label + '</label>';
        sel += '<select name="' + name + '" class="browser-default"' + func + ' ' + extra + '>';
        var label = "";
        var envView = "";
    }

    for (p in cont)
    {
        contView += p == value ? '<option value="' + p + '" selected="">' + cont[p] + '</option>' : '<option value="' + p + '">' + cont[p] + '</option>';
    }

    sel += contView;
    sel += '</select>';
    sel += label;

    var retorno = '<div class="' + envView + env +'">';
    retorno += sel;
    retorno += '</div>';

    if(obj.destino)
    {
        $(obj.destino).append(retorno);
        return true;
    }
    else
    {
        return retorno;
    }

};

MATCSS.textarea = function (label, name, obj)
{
    var id = obj.id || name;
    var valor = obj.value || "";
    var required = obj.req ? ' required=""' : "";
    var readonly = obj.rea ? ' readonly=""' : "";
    var disabled = obj.dis ? ' disabled=""' : "";
    var env = obj.env ? " " + obj.env : " col s12";
    var clas = obj.clas ? " " + obj.clas : "";
    var dl = obj.dl ? ' data-length="' + obj.dl + '"' : "";

    retorno = '<div class="input-field' + env + '">';
    retorno += '<textarea id="' + id + '" class="materialize-textarea' + clas + '" name="' + name + '" ' + required + readonly + disabled + dl + '>' + valor + '</textarea>';
    retorno += '<label for="' + id + '">' + label + '</label>';
    retorno += '</div>';

    return retorno;
};

MATCSS.file = function(label, name, obj)
{
    var label = obj.label || '<i class="material-icons">perm_media</i>';
    var name = obj.name || "imagen";
    var id = obj.id || name;
    var env = obj.env || "col s12 l6";
    var placeholder = obj.placeholder || "Cargar imagen";

    var retorno = '<div class = "input-field file-field ' + env + '" id="' + this.sid() + '">';
    retorno += '<div class="btn">';
    retorno += '<span>' + label + '</span>';
    retorno += '<input id="' + id + '" name="' + name + '" type="file" />';
    retorno += '</div>';
    retorno += '<div class="file-path-wrapper">';
    retorno += '<input id="file-wrapper" class="file-path validate" type="text" placeholder="' + placeholder + '" />';
    retorno += '</div>';
    retorno += '</div>';

    return retorno;
};





