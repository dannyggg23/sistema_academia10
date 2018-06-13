<?php
require_once "../modelos/Ficha_entrenador.php";

$ficha_entrenador=new Ficha_entrenador();

$idficha_entrenador=isset($_POST["idficha_entrenador"])? limpiarCadena($_POST["idficha_entrenador"]):"";
$numeroFicha_entrenador=isset($_POST["numeroFicha_entrenador"])? limpiarCadena($_POST["numeroFicha_entrenador"]):"";
$fechaApertura_entrenador=isset($_POST["fechaApertura_entrenador"])? limpiarCadena($_POST["fechaApertura_entrenador"]):"";
$entrenador_identrenador=isset($_POST["entrenador_identrenador"])? limpiarCadena($_POST["entrenador_identrenador"]):"";
$categoria_idcategoria=isset($_POST["categoria_idcategoria"])? limpiarCadena($_POST["categoria_idcategoria"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idficha_entrenador)){
			$rspta=$ficha_entrenador->insertar($numeroFicha_entrenador,$fechaApertura_entrenador,$entrenador_identrenador,$categoria_idcategoria);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$ficha_entrenador->editar($idficha_entrenador,$numeroFicha_entrenador, $fechaApertura_entrenador,$entrenador_identrenador,$categoria_idcategoria);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ficha_entrenador->desactivar($idficha_entrenador);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$ficha_entrenador->activar($idficha_entrenador);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$ficha_entrenador->mostrar($idficha_entrenador);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$ficha_entrenador->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idficha_entrenador.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idficha_entrenador.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idficha_entrenador.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idficha_entrenador.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->numeroFicha_entrenador,
 				"2"=>$reg->fechaApertura_entrenador,
 				"3"=>$reg->cedula_entrenador,
 				"4"=>$reg->nombre_entrenador . ' ' .$reg->apellido_entrenador,
       			"5"=>$reg->nombre_categoria,
       			"6"=>$reg->hora_inicio. ' | '.$reg->hora_fin,
      			"7"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case "selectEntrenador":
		require_once "../modelos/Entrenador.php";
		$entrenador = new Entrenador();

		$rspta = $entrenador->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->identrenador . '>' . $reg->cedula_entrenador . '</option>';
				}
	break;

	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre_categoria .' : '.$reg->hora_inicio.  ' | '. $reg->hora_fin. '</option>';
				}
	break;
}
?>
