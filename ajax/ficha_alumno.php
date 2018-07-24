<?php
require_once "../modelos/Ficha_alumno.php";

$ficha_alumno=new Ficha_alumno();

$idficha_alumno=isset($_POST["idficha_alumno"])? limpiarCadena($_POST["idficha_alumno"]):"";
$numeroFicha_alumno=isset($_POST["numeroFicha_alumno"])? limpiarCadena($_POST["numeroFicha_alumno"]):"";
$fechaApertura_alumno=isset($_POST["fechaApertura_alumno"])? limpiarCadena($_POST["fechaApertura_alumno"]):"";
$alumno_idalumno=isset($_POST["alumno_idalumno"])? limpiarCadena($_POST["alumno_idalumno"]):"";
$sucursal_categorias_idsucursal_categorias=isset($_POST["sucursal_categorias_idsucursal_categorias"])? limpiarCadena($_POST["sucursal_categorias_idsucursal_categorias"]):"";
$descuento_ficha_alumno=isset($_POST["descuento_ficha_alumno"])? limpiarCadena($_POST["descuento_ficha_alumno"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idficha_alumno)){
			$rspta=$ficha_alumno->insertar($numeroFicha_alumno,$fechaApertura_alumno,$alumno_idalumno,$sucursal_categorias_idsucursal_categorias,$descuento_ficha_alumno);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$ficha_alumno->editar($idficha_alumno,$numeroFicha_alumno,$fechaApertura_alumno,$alumno_idalumno,$sucursal_categorias_idsucursal_categorias,$descuento_ficha_alumno);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ficha_alumno->desactivar($idficha_alumno);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$ficha_alumno->activar($idficha_alumno);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$ficha_alumno->mostrar($idficha_alumno);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$ficha_alumno->listar();
 		//Vamos a declarar un array
		 $data= Array();
		 
		 $url='../reportes/ficha_alumno.php?id=';

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				 "0"=>($reg->estado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idficha_alumno.')"><i class="fa fa-pencil"></i></button>'.
				    '<a target="_blank" href="'.$url.$reg->idficha_alumno.'"> <button class="btn btn-info btn-xs"> <i class="fa fa-file"></i> </button></a>'.	
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idficha_alumno.')"><i class="fa fa-close"></i></button>':
					 '<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idficha_alumno.')"><i class="fa fa-pencil"></i></button>'.
					 '<a target="_blank" href="'.$url.$reg->idficha_alumno.'"> <button class="btn btn-info btn-xs"> <i class="fa fa-file"></i> </button></a>'.	
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idficha_alumno.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->numeroFicha_alumno,
 				"2"=>$reg->nombre_alumno,
 				"3"=>$reg->genero_alumno,
 				"4"=>$reg->nombre_sucursal,
 				"5"=>$reg->nombre_categoria,
       			"6"=>$reg->horario,
       			"7"=>$reg->hora_inicio."|".$reg->hora_fin,
       			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
       			"9"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
				"10"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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
 
	case "selectAlumno":
		require_once "../modelos/Alumno.php";
		$alumno = new Alumno();

		$rspta = $alumno->select();

		echo '<option value="" >--Seleccione--</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idalumno . '>' . $reg->cedula_alumno . '</option>';
				}
	break;

	/////DATOS DE LAS SUCURSALES CATEGORIAS Y HORARIOS

	case "selectSucursal":
		require_once "../modelos/Sucursal.php";
		$sucursal = new Sucursal();

		$rspta = $sucursal->select();

		echo "<option value='' > -- SELECCIONE --- </option>";
		

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

		echo "<option value='' > -- Seleccione --- </option>";
		

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

		$rspta=$categoria->horarioCategoriaSucursalAlumno($idsucursal,$idcategoria);

		echo "<option value=''> -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal_categorias . '>' . $reg->nombre . '</option>';
				}
	break;


	case "selectCategorias":
		require_once "../modelos/Chsucursales.php";
	
		$categoria=new Chsucursales;

		$rspta=$categoria->selectCategoriass();

		echo "<option value=''> -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->categoria_idcategoria . '>' . $reg->nombre_categoria . '</option>';
				}
	break;



	case "selectHorarios":
		require_once "../modelos/Chsucursales.php";
	

		$categoria=new Chsucursales;

		$rspta=$categoria->selectHorarios();

		echo "<option value=''> -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal_categorias . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>
