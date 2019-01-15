<?php
require_once "../modelos/Pagos_deposito.php";

$pagos_deposito=new Pagos_deposito();
$idpagos_deposito=isset($_POST["idpagos_deposito"])? limpiarCadena($_POST["idpagos_deposito"]):"";

switch ($_GET["op"]){
	

	case 'desactivar':
		$rspta=$pagos_deposito->desactivar($idpagos_deposito);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$pagos_deposito->activar($idpagos_deposito);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;
	
	case 'mostrar':
		$rspta=$pagos_deposito->mostrar($idpagos_deposito);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$pagos_deposito->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado_aprobada)?'<button class="btn btn-warning " onclick="mostrar('.$reg->idpagos_deposito.')"><i class="fa fa-pencil"></i></button> '.
					 ' <button class="btn btn-danger" onclick="desactivar('.$reg->idpagos_deposito.')"><i class="fa fa-close"></i></button>':
					 '<button class="btn btn-warning " onclick="mostrar('.$reg->idpagos_deposito.')"><i class="fa fa-pencil"></i></button> '.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idpagos_deposito.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->fecha,
 				"2"=>$reg->cedula_representante." - ".$reg->nombre_representante,
 				"3"=>$reg->cedula_alumno." - ".$reg->nombre_alumno,
 				"4"=>$reg->descripcion,
 				"5"=>$reg->fecha_acceso,
                "6"=>"<img class='thumbnail zoom' src='../files/imgpagos/".$reg->imagen."' height='50px' width='50px'>",
      			"7"=>($reg->estado_aprobada)?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Rechazado</span>'
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
