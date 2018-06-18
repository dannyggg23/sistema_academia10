<?php
require_once "../modelos/Chsucursales.php";

$sucursal_categorias=new Chsucursales();

$idsucursal_categorias=isset($_POST["idsucursal_categorias"])? limpiarCadena($_POST["idsucursal_categorias"]):"";
$sucursal_idsucursal=isset($_POST["sucursal_idsucursal"])? limpiarCadena($_POST["sucursal_idsucursal"]):"";
$categoria_idcategoria=isset($_POST["categoria_idcategoria"])? limpiarCadena($_POST["categoria_idcategoria"]):"";
$horario_idhorario=isset($_POST["horario_idhorario"])? limpiarCadena($_POST["horario_idhorario"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idsucursal_categorias)){
			$rspta=$sucursal_categorias->insertar($sucursal_idsucursal, $categoria_idcategoria,$horario_idhorario);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$sucursal_categorias->editar($idsucursal_categorias,$sucursal_idsucursal, $categoria_idcategoria,$horario_idhorario);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$sucursal_categorias->desactivar($idsucursal_categorias);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$sucursal_categorias->activar($idsucursal_categorias);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$sucursal_categorias->mostrar($idsucursal_categorias);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$sucursal_categorias->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idsucursal_categorias.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idsucursal_categorias.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idsucursal_categorias.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idsucursal_categorias.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre_sucursal,
 				"2"=>$reg->nombre_categoria,
 				"3"=>$reg->nombre,
 				"4"=>$reg->hora_inicio." : ".$reg->hora_fin,
 				"5"=>($reg->disponible==1)?'SI':'NO',
      			"6"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

		echo '<option>--  Seleccione un horario  --</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idhorario . '>' . $reg->nombre." | ".$reg->hora_inicio." | ".$reg->hora_fin . '</option>';
				}
	break;

	
	case "selectSucursal":
		require_once "../modelos/Sucursal.php";
		$sucursal = new Sucursal();

		$rspta = $sucursal->select();

		echo '<option>--  Seleccione una Sucursal  --</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal . '>' . $reg->nombre_sucursal . '</option>';
				}
    break;
    
    case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$sucursal = new Categoria();

		$rspta = $sucursal->select();

		echo '<option>--  Seleccione una Categoría  --</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre_categoria . '</option>';
				}
	break;
}
?>
