<?php
require_once "../modelos/pago_movil.php";

 header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
 header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
 header("Access-Control-Allow-Origin: *");


$pago=new Pago(); 
$idpago=isset($_POST["idpago"])? limpiarCadena($_POST["idpago"]):"";

$representante_idrepresentante=isset($_POST["representante_idrepresentante"])? limpiarCadena($_POST["representante_idrepresentante"]):"";


$usuario_idusuario=isset($_POST["usuario_idusuario"])? limpiarCadena($_POST["usuario_idusuario"]):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";

$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";

$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";

$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idpago)){
			$rspta=$pago->insertar($representante_idrepresentante,$usuario_idusuario,$fecha,$total,$tipo_documento,$serie_comprobante,$num_comprobante,$impuesto,$_POST["ficha_alumno_idficha_alumno"],$_POST["numero_meses_pago"],$_POST["precio_pago"],$_POST["descuento_pago"],$_POST["productos_servicios_idproductos_servicios"]);
			echo $rspta;
		}
		else {
			
		}
	break;
}

?>
