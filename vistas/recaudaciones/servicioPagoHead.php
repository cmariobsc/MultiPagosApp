<?php
//echo  "nombre: ".$_POST["a"]." y numero: ".$_POST["b"]." codigo servicio:".$_POST["c"];
// data: { a: "servicioPago", b: referencia, c:codigoProducto, v:CampoEspecial, fn:firstname, ln:lastname, //t:document.getElementById('total').value,d:document.getElementById('txtidentifinput').value, trx:document.getElementById('trx').innerText, z:'' }

$codserv=$_POST["c"];
$referencia=$_POST["b"];
//$referencia="032680083";
$pts_CodigoProducto=$_POST["c"];
//$pts_CodigoProducto="68";
//$pts_CodigoProducto="296";
$pts_OrigenTransaccion="API";
$pts_IDCliente="wqe";
$CampoEspecial=$_POST["v"];
//$pts_CamposAdicionales=$CampoEspecial.str_replace(",","|",$CampoEspecial);
$pts_CamposAdicionales=$CampoEspecial;

$pts_IDCliente=$_POST["z"];
$pts_ValorTotal=$_POST["t"];
$pts_Factura_NombreCliente=$_POST["fn"];
$pts_Factura_ApellidoCliente=$_POST["ln"];
$pts_Factura_IdentificacionCliente=$_POST["d"];
$pts_Factura_DireccionCliente="";
$pts_CodigoTRX=$_POST["trx"];
$valorTotal=0;
$valorComision=0;
	
try{
	
	

	//$params=[];
	
	$params=[
		"pts_Usuario"=>"22104",
		"pts_Clave"=>"Cristian2825",
		"pts_Referencia"=>$referencia,
		"pts_CodigoProducto"=>$pts_CodigoProducto,
		"pts_OrigenTransaccion"=>$pts_OrigenTransaccion,
		"pts_CamposAdicionales"=>$pts_CamposAdicionales
	];
	
	//$url="https://181.198.23.114:442/WCFEmpresasSVP/TransaccionSvp.svc?wsdl";
	$url="http://abcell-recargas.com/webservicePuntoAgil/WS_API_Productos.asmx?wsdl";

 $pago = new EmpPagos();
 $pts_IDCliente=$pago->id;
 
 
  $paquetes = new TNT_variables();
  
    $soapClient = new SoapClient($url);
   //$respuesta = $soapClient->Consulta_Servicios_Test($varTemporal)->Consulta_Servicios_TestResult;
   //$respuesta = $soapClient->Consulta_Servicios_Test($varTemporal);
   $respuesta = $soapClient->Pago_Servicios(array("pts_Usuario" => $paquetes->strUsuario, "pts_Clave" => $paquetes->strContrasena,"pts_Referencia"=>$referencia,"pts_CodigoProducto"=>$pts_CodigoProducto,"pts_OrigenTransaccion"=>$pts_OrigenTransaccion,"pts_IDCliente"=>$pts_IDCliente,"pts_ValorTotal"=>$pts_ValorTotal,"pts_Factura_NombreCliente"=>$pts_Factura_NombreCliente,"pts_Factura_ApellidoCliente"=>$pts_Factura_ApellidoCliente,"pts_Factura_IdentificacionCliente"=>$pts_Factura_IdentificacionCliente,"pts_Factura_DireccionCliente"=>$pts_Factura_DireccionCliente,"pts_CodigoTRX"=>$pts_CodigoTRX,"pts_CamposAdicionales"=>$pts_CamposAdicionales))->Pago_ServiciosResult;
    $resp=$respuesta->any;
    $opciones = new SimpleXMLElement($resp);
	$datos = $opciones->NewDataSet->Table;
	
	
   $resp=$respuesta->any;
  
  
    $opciones = new SimpleXMLElement($resp);
	$datos = $opciones->NewDataSet->Table;

	
	$cad="{";
	$info=array();
	$count =0;
	
	 foreach($datos as $listaPak)
     {
		$cad .="\"Codigo\":\"". $listaPak->pts_CodigoRespuesta . "\",\"Mensaje\":\"". $listaPak->pts_MensajeRespuesta ."\",\"Transaccion\":\"". $listaPak->pts_CodigoTRX ."\",\"Autorizacion\":\"". $listaPak->pts_Autorizacion ."\",\"Fecha\":\"". $listaPak->pts_FechaTransaccion ."\",\"ValorSC\":\"". $listaPak->pts_ValorSinComision ."\"";
		$cad .=" ,\"ValorComision\":\"". $listaPak->pts_ValorComision ."\",\"ValorTotal\":\"". $listaPak->pts_ValorTotal ."\",\"Proveedor\":\"". $listaPak->pts_ProveedorTRX ."\",\"Recibo\":\"". $listaPak->pts_Recibo ."\"";
		$valorTotal=$listaPak->pts_ValorTotal;
		$valorComision=$listaPak->pts_ValorComision;
     }
	 //$cad =substr($cad,0,-1);
					$cad .="}";

var_dump($cad);
exit();
				return $cad;
					

                    $pago->proveedor_id = "6";
                    $pago->segmento_id = $pts_CodigoProducto;
                    $pago->valor = $valorTotal;
                    $pago->com_in =$valorComision;
                    $pago->com_out = $valorComision;
                    $pago->utilidad_in =  0;     // Utilidad para nosotros//$procesoOrigen == "sal" ? porciento($comision_in,$recargaValor) :0;
                    $pago->utilidad_out = 0;   // Utilidad para el punto de venta //$procesoOrigen == "sal" ? porciento($comision_out,$recargaValor) : 0;
                    $pago->usuario_id = $usuario->id;
					
					$pago->save();
					var_dump($cad);
exit();
				return $cad;
                  
	//exit();
	 //return $listaServicios;
} catch (Exception $e) {
   echo $e->getMessage();
   //echo '0Se produjo un error grave, inténtelo más tarde.<br />'; // .$e
   exit();
}

?>