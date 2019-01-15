<?php
require_once "../modelos/Horario.php";

 header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");

$horario=new horario();

$idhorario=isset($_POST["idhorario"])? limpiarCadena($_POST["idhorario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$hora_inicio=isset($_POST["hora_inicio"])? limpiarCadena($_POST["hora_inicio"]):"";
$hora_fin=isset($_POST["hora_fin"])? limpiarCadena($_POST["hora_fin"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idhorario)){
			$rspta=$horario->insertar($nombre,$hora_inicio,$hora_fin);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$horario->editar($idhorario,$nombre,$hora_inicio,$hora_fin);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;

	case 'guardar':


		$rspta=$horario->insertar_modal($nombre,$hora_inicio,$hora_fin);
		echo $rspta;
	
    break;

	case 'desactivar':
		$rspta=$horario->desactivar($idhorario);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$horario->activar($idhorario);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$horario->mostrar($idhorario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$horario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idhorario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idhorario.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idhorario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idhorario.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->hora_inicio,
 				"3"=>$reg->hora_fin,
      			"4"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
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
