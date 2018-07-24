<?php
require_once "../modelos/Ficha_entrenador.php";

$ficha_entrenador=new Ficha_entrenador();

$idficha_entrenador=isset($_POST["idficha_entrenador"])? limpiarCadena($_POST["idficha_entrenador"]):"";
$idsucursal_categorias=isset($_POST["idsucursal_categorias"])? limpiarCadena($_POST["idsucursal_categorias"]):"";

$entrenador_identrenador=isset($_POST["entrenador_identrenador"])? limpiarCadena($_POST["entrenador_identrenador"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idficha_entrenador)){
			$rspta=$ficha_entrenador->insertar($entrenador_identrenador,$idsucursal_categorias);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$ficha_entrenador->editar($idficha_entrenador,$numeroFicha_entrenador, $fechaApertura_entrenador,$entrenador_identrenador,$sucursal_categorias_idsucursal_categorias);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ficha_entrenador->desactivar($idficha_entrenador,$idsucursal_categorias);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$ficha_entrenador->activar($idficha_entrenador,$idsucursal_categorias);
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
 				"0"=>($reg->estado)?
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idficha_entrenador.','.$reg->idsucursal_categorias.')"><i class="fa fa-close"></i></button>':
 		            ' <button class="btn btn-primary" onclick="activar('.$reg->idficha_entrenador.','.$reg->idsucursal_categorias.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->cedula_entrenador,
 				"2"=>$reg->nombre_entrenador,
       			"3"=>$reg->nombre_sucursal,
       			"4"=>$reg->nombre_categoria,
       			"5"=>$reg->nombre,
       			"6"=>$reg->hora_inicio.'|'.$reg->hora_fin,
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
		echo "<option > -- SELECCIONE --- </option>";


		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->identrenador . '>' . $reg->cedula_entrenador ." | ".$reg->nombre_entrenador. '</option>';
				}
	break;

	///SELEC
	case "selectSucursal":
		require_once "../modelos/Sucursal.php";
		$sucursal = new Sucursal();

		$rspta = $sucursal->select();

		echo "<option > -- SELECCIONE --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal . '>' . $reg->nombre_sucursal . '</option>';
				}
	break;
	

	case "selectCategoria":
		require_once "../modelos/Chsucursales.php";
		$sucursal = ($_GET["sucursalCategoria"]);
		$categoria=new Chsucursales;

		$rspta=$categoria->categoriasSucursal($sucursal);

		echo "<option > -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->categoria_idcategoria . '>' . $reg->nombre_categoria . '</option>';
				}
	break;

	case "selectHorario":
		require_once "../modelos/Chsucursales.php";
		$idsucursal = ($_GET["sucursalCategoria"]);
		$idcategoria = ($_GET["horarioCategoria"]);

		$categoria=new Chsucursales;

		$rspta=$categoria->horarioCategoriaSucursal($idsucursal,$idcategoria);

		echo "<option> -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal_categorias . '>' . $reg->nombre . '</option>';
				}
	break;


	case "selectCategorias":
		require_once "../modelos/Chsucursales.php";
	
		$categoria=new Chsucursales;

		$rspta=$categoria->selectCategoriass();

		echo "<option> -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->categoria_idcategoria . '>' . $reg->nombre_categoria . '</option>';
				}
	break;



	case "selectHorarios":
		require_once "../modelos/Chsucursales.php";
	

		$categoria=new Chsucursales;

		$rspta=$categoria->selectHorarios();

		echo "<option> -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal_categorias . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>
