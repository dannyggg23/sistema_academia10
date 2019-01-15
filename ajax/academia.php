<?php
require_once "../modelos/Academia.php";

    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");

$academia=new Academia();
$iddatos_academia=isset($_POST["iddatos_academia"])? limpiarCadena($_POST["iddatos_academia"]):"";
$titulo_factura=isset($_POST["titulo_factura"])? limpiarCadena($_POST["titulo_factura"]):"";
$nombre_propietario=isset($_POST["nombre_propietario"])? limpiarCadena($_POST["nombre_propietario"]):"";
$documento_identidad=isset($_POST["documento_identidad"])? limpiarCadena($_POST["documento_identidad"]):"";
$direccion_academia=isset($_POST["direccion_academia"])? limpiarCadena($_POST["direccion_academia"]):"";
$telefono_academia=isset($_POST["telefono_academia"])? limpiarCadena($_POST["telefono_academia"]):"";
$email_academia=isset($_POST["email_academia"])? limpiarCadena($_POST["email_academia"]):"";
$serie_factura=isset($_POST["serie_factura"])? limpiarCadena($_POST["serie_factura"]):"";
$numero_factura=isset($_POST["numero_factura"])? limpiarCadena($_POST["numero_factura"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
    
			$rspta=$academia->editar($iddatos_academia,$titulo_factura,$nombre_propietario,$documento_identidad,
            $direccion_academia,$telefono_academia,$email_academia,$serie_factura,$numero_factura);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
	
	break;

	case 'mostrar':
		$rspta=$academia->mostrar($iddatos_academia);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrarSerieNumero':
		$rspta=$academia->mostrarSerieNumero();
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$academia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->iddatos_academia.')"><i class="fa fa-pencil"></i></button>',
 				"1"=>$reg->titulo_factura,
 				"2"=>$reg->nombre_propietario,
 				"3"=>$reg->documento_identidad,
 				"4"=>$reg->direccion_academia,
 				"5"=>$reg->telefono_academia,
 				"6"=>$reg->email_academia,
 				"7"=>$reg->serie_factura,
 				"8"=>$reg->numero_factura
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	
}
?>
