<?php
require_once "../modelos/Ficha_alumno.php";

$ficha_alumno=new Ficha_alumno();
 
switch ($_GET["op"]){
	
	case 'listar':
		$rspta=$ficha_alumno->listarActivos();
 		//Vamos a declarar un array
 		$data= Array();

 
 		while ($reg=$rspta->fetch_object()){

 				$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

 			$data[]=array(

 				"0"=>$reg->numeroFicha_alumno,
				"1"=>$reg->nombre_alumno,
				"2"=>$reg->cedula_alumno,
				"3"=>$reg->genero_alumno,
 				"4"=>$reg->nombre_sucursal,
 				"5"=>$reg->nombre_categoria,
       			"6"=>$reg->horario,
       			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
       			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
       			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
       			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
       			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
      			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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
 				$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case 'listarDeudoresSucursal':

	    $id=$_GET['id'];

		$rspta=$ficha_alumno->listarDeudoresSucursales($id);
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
 				$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case 'listarDeudoresCategorias':

	    $id=$_GET['id'];
		$rspta=$ficha_alumno->listarDeudoresCategorias($id);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 				$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	

	case 'listarDeudoresSucursalCategorias':

	    $idsucursal=$_GET['idsucursal'];
	    $idcategoria=$_GET['idcategoria'];
		$rspta=$ficha_alumno->listarDeudoresSucursalCategorias($idsucursal,$idcategoria);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 				$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	
	case 'listarDeudoresHorario':

	    $id=$_GET['id'];
	  
		$rspta=$ficha_alumno->listarDeudoresHorario($id);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 				$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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
	
	case 'listarDeudoresCategoriaHorario':

	    $idcategoria=$_GET['idcategoria'];
	    $idhorario=$_GET['idhorario'];
	  
		$rspta=$ficha_alumno->listarDeudoresCategoriaHorario($idcategoria,$idhorario);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 				$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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
	
	case 'listarDeudoresSucursalesCategoriaHorario':

	    $idcategoria=$_GET['idcategoria'];
		$idhorario=$_GET['idhorario'];
		$idsucursal=$_GET['idsucursal'];
	   
	  
		$rspta=$ficha_alumno->listarDeudoresSucursalesCategoriaHorario($idsucursal,$idcategoria,$idhorario);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 				$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

 			$data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	#######################################################################################################
	case 'listarDeudoresSucursal1':

	$id=$_GET['id'];

	$rspta=$ficha_alumno->listarDeudoresSucursales1($id);
	 //Vamos a declarar un array
	 $data= Array();

 
	 while ($reg=$rspta->fetch_object()){
	 		$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

			 $data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

case 'listarDeudoresCategorias1':

	$id=$_GET['id'];
	$rspta=$ficha_alumno->listarDeudoresCategorias1($id);
	 //Vamos a declarar un array
	 $data= Array();

	 while ($reg=$rspta->fetch_object()){
	 		$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

			 $data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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



case 'listarDeudoresSucursalCategorias1':

	$idsucursal=$_GET['idsucursal'];
	$idcategoria=$_GET['idcategoria'];
	$rspta=$ficha_alumno->listarDeudoresSucursalCategorias1($idsucursal,$idcategoria);
	 //Vamos a declarar un array
	 $data= Array();

	 while ($reg=$rspta->fetch_object()){
	 		$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

			 $data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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


case 'listarDeudoresHorario1':

	$id=$_GET['id'];
  
	$rspta=$ficha_alumno->listarDeudoresHorario1($id);
	 //Vamos a declarar un array
	 $data= Array();

	 while ($reg=$rspta->fetch_object()){
	 		$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

			 $data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

case 'listarDeudoresCategoriaHorario1':

	$idcategoria=$_GET['idcategoria'];
	$idhorario=$_GET['idhorario'];
  
	$rspta=$ficha_alumno->listarDeudoresCategoriaHorario1($idcategoria,$idhorario);
	 //Vamos a declarar un array
	 $data= Array();

	 while ($reg=$rspta->fetch_object()){
	 		$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

			 $data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

case 'listarDeudoresSucursalesCategoriaHorario1':

	$idcategoria=$_GET['idcategoria'];
	$idhorario=$_GET['idhorario'];
	$idsucursal=$_GET['idsucursal'];
   
  
	$rspta=$ficha_alumno->listarDeudoresSucursalesCategoriaHorario1($idsucursal,$idcategoria,$idhorario);
	 //Vamos a declarar un array
	 $data= Array();

	 while ($reg=$rspta->fetch_object()){
	 		$nummeses=0;
 			$masnumero=0;
 			$bandera=false;

 			if($reg->num_meses=="0" && $reg->fecha_acceso <= $reg->fecha_actual)
 			{

 				$nummeses=1;

 			}

 			if($reg->num_meses<0)
 			{
 				$masnumero=$reg->num_meses*-1;
 				$nummeses="+ ".$masnumero;
 			$bandera=true;


 			}
 			if($reg->num_meses>0)
 			{
 				$nummeses=$reg->num_meses;
 			}

			 $data[]=array(
				"0"=>$reg->numeroFicha_alumno,
			"1"=>$reg->nombre_alumno,
			"2"=>$reg->cedula_alumno,
			"3"=>$reg->genero_alumno,
			"4"=>$reg->nombre_sucursal,
			"5"=>$reg->nombre_categoria,
		    "6"=>$reg->horario,
			"7"=>$reg->hora_inicio." | ".$reg->hora_fin,
			"8"=>($reg->fecha_acceso <= $reg->fecha_actual)?'<label class="btn btn-danger btn-xs">'.$reg->fecha_acceso.'</label>':'<label class="btn btn-info btn-xs">'.$reg->fecha_acceso.'</label>',
			"9"=>(!$bandera)?'<label class="btn btn-danger btn-xs">'.$nummeses.'</label>':'<label class="btn btn-info btn-xs">'.$nummeses.'</label>',
			"10"=>(!$reg->inscripcion)?'<label class="btn btn-danger btn-xs">NO</label>':'<label class="btn btn-info btn-xs">SI</label>',
			"11"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
			"12"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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
	########################################################################################################

}
?>
