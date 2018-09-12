<?php
require_once "../modelos/Categoria.php";

 header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");

$categoria=new Categoria();
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre_categoria=isset($_POST["nombre_categoria"])? limpiarCadena($_POST["nombre_categoria"]):"";
$descripcion_categoria=isset($_POST["descripcion_categoria"])? limpiarCadena($_POST["descripcion_categoria"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idcategoria)){
			$rspta=$categoria->insertar($nombre_categoria,$descripcion_categoria);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$categoria->editar($idcategoria,$nombre_categoria,$descripcion_categoria);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;

	case 'guardar':
			$rspta=$categoria->insertar_modal($nombre_categoria,$descripcion_categoria);
			echo $rspta;
	break;

	case 'desactivar':
		$rspta=$categoria->desactivar($idcategoria);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$categoria->activar($idcategoria);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$categoria->mostrar($idcategoria);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$categoria->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre_categoria,
 				"2"=>$reg->descripcion_categoria,
      			"3"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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
	

	case "selectHorario":
		require_once "../modelos/Horario.php";
		$horario = new Horario();

		$rspta = $horario->select();

		echo '<option value="0">--  Seleccione un horario  --</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idhorario . '>' . $reg->nombre." | ".$reg->hora_inicio." | ".$reg->hora_fin . '</option>';
				}
	break;

	
	case "selectSucursal":
		require_once "../modelos/Sucursal.php";
		$sucursal = new Sucursal();

		$rspta = $sucursal->select();

		echo '<option value="0">--  Seleccione una Sucursal  --</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal . '>' . $reg->nombre_sucursal . '</option>';
				}
	break;
}
?>
