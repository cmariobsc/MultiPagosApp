<?php

use Illuminate\Database\Eloquent\Model;

//---------------------------------------------------------------------------

class Logg extends Model {
	protected $table = 'logs';
	protected $fillable = ['usuario','tabla','tablaId','accion','descripcion'];
}

function creaLog(array $dato)
{
	$LOG = new Log;
	
	global $sentinel;
	
	$arregloDatos = $LOG["fillable"];
	
	foreach($arregloDatos as $dat)
	{
		if($dat == "usuario")
		{
			$LOG->usuario = $sentinel->getSentinel()->check()->id;
		}
		else
		{
			$LOG->$dat = (isset($dato[$dat]) && !empty($dato[$dat])) ? $dato[$dat] : "";  
		}
	}
	
	if($LOG->save())
	{
		return true;
	}
	else
	{
		return false;
	}
	
//	$log = [
//		"tabla"=>"cotizaciones",
//		"tablaId"=>$aprueba->id,
//		"accion"=>"actualizar",
//		"descripcion"=>$aprueba->nombre
//	];
//	
//	creaLog($log);	

}

