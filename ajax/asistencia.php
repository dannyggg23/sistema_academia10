<?php
require_once "../modelos/Asistencia.php";

require_once "../modelos/Alumno.php";
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");

$ficha_alumno=new Asistencia();

$asistencia_alumno=isset($_POST["asistencia_alumno"])? limpiarCadena($_POST["asistencia_alumno"]):"";
$fecha_asistencia=isset($_POST["fecha_asistencia"])? limpiarCadena($_POST["fecha_asistencia"]):"";
$ficha_alumno_idficha_alumno=isset($_POST["ficha_alumno_idficha_alumno"])? limpiarCadena($_POST["ficha_alumno_idficha_alumno"]):"";



switch ($_GET["op"]){

	case 'guardaryeditar':

		if (empty($idcategoria)){
			$rspta=$ficha_alumno->insertar($asistencia_alumno, $fecha_asistencia,$ficha_alumno_idficha_alumno);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$ficha_alumno->editar($idasistencia,$asistencia_alumno, $fecha_asistencia,$ficha_alumno_idficha_alumno);
			echo $rspta ? "Datos actualizados" : "No se pudo actualizar";
		}
	break;

	
	case 'listar':
		$rspta=$ficha_alumno->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(

 				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
		 }
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
    break;
    
    case 'listarAsistenciaSucursal':

	    $id=$_GET['id'];

		$rspta=$ficha_alumno->listarAsistenciaSucursales($id);
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listarAsistenciaCategorias':

	    $id=$_GET['id'];
		$rspta=$ficha_alumno->listarAsistenciaCategorias($id);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	

	case 'listarAsistenciaSucursalCategorias':

	    $idsucursal=$_GET['idsucursal'];
	    $idcategoria=$_GET['idcategoria'];
		$rspta=$ficha_alumno->listarAsistenciaSucursalCategorias($idsucursal,$idcategoria);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	
	case 'listarAsistenciaHorario':

	    $id=$_GET['id'];
	  
		$rspta=$ficha_alumno->listarAsistenciaHorario($id);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	
	case 'listarAsistenciaCategoriaHorario':

	    $idcategoria=$_GET['idcategoria'];
	    $idhorario=$_GET['idhorario'];
	  
		$rspta=$ficha_alumno->listarAsistenciaCategoriaHorario($idcategoria,$idhorario);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	
	case 'listarAsistenciaSucursalesCategoriaHorario':

	    $idcategoria=$_GET['idcategoria'];
		$idhorario=$_GET['idhorario'];
		$idsucursal=$_GET['idsucursal'];
	   
	  
		$rspta=$ficha_alumno->listarAsistenciaSucursalesCategoriaHorario($idsucursal,$idcategoria,$idhorario);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;
    
    

    case 'listarFecha':

    $finicio=$_GET['finicio'];
    $ffin=$_GET['ffin'];
	   
		$rspta=$ficha_alumno->listarFecha($finicio,$ffin);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;

    case 'listarfechaRepresentante':

    $finicio=$_GET['finicio'];
	$ffin=$_GET['ffin'];
	$alumno=$_GET['idrepresentante'];
	   
		$rspta=$ficha_alumno->listarfechaRepresentante($finicio,$ffin,$alumno);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_asistencia,
       			"6"=>($reg->asistencia_alumno)?'<span class="label bg-green">SI</span>':'<span class="label bg-red">NO</span>',
       			"7"=>$reg->nombre_entrenador
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;

    

    case "selectFichaAlumno":
		require_once "../modelos/Ficha_alumno.php";
		$representante = new Ficha_alumno();

		$rspta = $representante->listarActivos();
		echo '<option value="">--Seleccione--</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value='.$reg->idficha_alumno.'>'.$reg->nombre_alumno.'</option>';
				}
	break;

}
?>
