<?php
require_once "../modelos/Ficha_alumno.php";

$ficha_alumno=new Ficha_alumno();

switch ($_GET["op"]){
	
	case 'listar':
		$rspta=$ficha_alumno->listarActivos();
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(

 				"0"=>$reg->numeroFicha_alumno,
 				"1"=>$reg->nombre_alumno,
 				"2"=>$reg->nombre_sucursal,
 				"3"=>$reg->nombre_categoria,
       			"4"=>$reg->horario,
       			"5"=>$reg->fecha_acceso,
       			"6"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",

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


	case 'listarDeudores':
		$rspta=$ficha_alumno->listarDeudores();
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
				"2"=>$reg->nombre_sucursal,
				"3"=>$reg->nombre_categoria,
				  "4"=>$reg->horario,
				  "5"=>$reg->fecha_acceso,
				  "6"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",

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

}
?>
