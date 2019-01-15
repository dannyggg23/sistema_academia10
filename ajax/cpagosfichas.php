<?php
require_once "../modelos/Ficha_alumno.php";

$ficha_alumno=new Ficha_alumno();
 
switch ($_GET["op"]){
	
	case 'listar':
		$rspta=$ficha_alumno->listarActivos();
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){

            // $anio = explode("-", $reg->fecha_actual);
            // $ano=$anio[0];

           // $anio2=$anio[0]-1;

        $ano=$reg->ano_actual;

            $enero1=($ano."-01-01");
            $enero11=($ano."-01-30");
            $mes2=($ano."-02-01");
            $mes22=($ano."-02-28");
            $mes3=($ano."-03-01");
            $mes33=($ano."-03-31");
            $mes4=($ano."-04-01");
            $mes44=($ano."-04-30");
            $mes5=($ano."-05-01");
            $mes55=($ano."-05-31");
            $mes6=($ano."-06-01");
            $mes66=($ano."-06-30");
            $mes7=($ano."-07-01");
            $mes77=($ano."-07-31");
            $mes8=($ano."-08-01");
            $mes88=($ano."-08-31");
            $mes9=($ano."-09-01");
            $mes99=($ano."-09-30");
            $mes10=($ano."-10-01");
            $mes1010=($ano."-10-31");
            $mes11=($ano."-11-01");
            $mes1111=($ano."-11-30");
            $mes12=($ano."-12-01");
            $mes1212=($ano."-12-31");
            $fechaacceso=date_create($reg->fecha_acceso);
 			$data[]=array(
                 
 				"0"=>$reg->numeroFicha_alumno,
                "1"=>$reg->nombre_alumno,
                "2"=>($reg->inscripcion)?'X':"",
				"3"=>($reg->fecha_acceso >= $enero1 && $reg->fecha_acceso >= $enero11 && $reg->fechaApertura_alumno <= $enero11 )?'X':"",
				"4"=>($reg->fecha_acceso >= $mes2 && $reg->fecha_acceso >= $mes22 && $reg->fechaApertura_alumno <= $mes22 )?'X':"",
				"5"=>($reg->fecha_acceso >= $mes3 && $reg->fecha_acceso >= $mes33 && $reg->fechaApertura_alumno <= $mes33 )?'X':"",
				"6"=>($reg->fecha_acceso >= $mes4 && $reg->fecha_acceso >= $mes44 && $reg->fechaApertura_alumno <= $mes44 )?'X':"",
				"7"=>($reg->fecha_acceso >= $mes5 && $reg->fecha_acceso >= $mes55 && $reg->fechaApertura_alumno <= $mes55 )?'X':"",
				"8"=>($reg->fecha_acceso >= $mes6 && $reg->fecha_acceso >= $mes66 && $reg->fechaApertura_alumno <= $mes66 )?'X':"",
				"9"=>($reg->fecha_acceso >= $mes7 && $reg->fecha_acceso >= $mes77 && $reg->fechaApertura_alumno <= $mes77 )?'X':"",
				"10"=>($reg->fecha_acceso >= $mes8 && $reg->fecha_acceso >= $mes88 && $reg->fechaApertura_alumno <= $mes88 )?'X':"",
				"11"=>($reg->fecha_acceso >= $mes9 && $reg->fecha_acceso >= $mes99 && $reg->fechaApertura_alumno <= $mes99 )?'X':"",
				"12"=>($reg->fecha_acceso >= $mes10 && $reg->fecha_acceso >= $mes1010 && $reg->fechaApertura_alumno <= $mes1010 )?'X':"",
				"13"=>($reg->fecha_acceso >= $mes11 && $reg->fecha_acceso >= $mes1111 && $reg->fechaApertura_alumno <= $mes1111 )?'X':"",
                "14"=>($reg->fecha_acceso >= $mes12 && $reg->fecha_acceso >= $mes1212 && $reg->fechaApertura_alumno <= $mes1212 )?'X':""
                 );
         }
         
		  
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;

    //##############################################################################################################################################

    case 'listarDeudoresSucursal1':

	$id=$_GET['id'];

	$rspta=$ficha_alumno->listarDeudoresSucursales1($id);
	 //Vamos a declarar un array
	 $data= Array();

 
	 while ($reg=$rspta->fetch_object()){
         
		$anio = explode("-", $reg->fecha_actual);
            $ano=$anio[0];

             $enero1=($ano."-01-01");
            $enero11=($ano."-01-30");
            $mes2=($ano."-02-01");
            $mes22=($ano."-02-28");
            $mes3=($ano."-03-01");
            $mes33=($ano."-03-31");
            $mes4=($ano."-04-01");
            $mes44=($ano."-04-30");
            $mes5=($ano."-05-01");
            $mes55=($ano."-05-31");
            $mes6=($ano."-06-01");
            $mes66=($ano."-06-30");
            $mes7=($ano."-07-01");
            $mes77=($ano."-07-31");
            $mes8=($ano."-08-01");
            $mes88=($ano."-08-31");
            $mes9=($ano."-09-01");
            $mes99=($ano."-09-30");
            $mes10=($ano."-10-01");
            $mes1010=($ano."-10-31");
            $mes11=($ano."-11-01");
            $mes1111=($ano."-11-30");
            $mes12=($ano."-12-01");
            $mes1212=($ano."-12-31");
            $fechaacceso=date_create($reg->fecha_acceso);
 			$data[]=array(
                 
 				"0"=>$reg->numeroFicha_alumno,
                "1"=>$reg->nombre_alumno,
                "2"=>($reg->inscripcion)?'X':"",

				"3"=>($reg->fecha_acceso >= $enero1 && $reg->fecha_acceso >= $enero11 && $reg->fechaApertura_alumno <= $enero11 )?'X':"",
				"4"=>($reg->fecha_acceso >= $mes2 && $reg->fecha_acceso >= $mes22 && $reg->fechaApertura_alumno <= $mes22 )?'X':"",
				"5"=>($reg->fecha_acceso >= $mes3 && $reg->fecha_acceso >= $mes33 && $reg->fechaApertura_alumno <= $mes33 )?'X':"",
				"6"=>($reg->fecha_acceso >= $mes4 && $reg->fecha_acceso >= $mes44 && $reg->fechaApertura_alumno <= $mes44 )?'X':"",
				"7"=>($reg->fecha_acceso >= $mes5 && $reg->fecha_acceso >= $mes55 && $reg->fechaApertura_alumno <= $mes55 )?'X':"",
				"8"=>($reg->fecha_acceso >= $mes6 && $reg->fecha_acceso >= $mes66 && $reg->fechaApertura_alumno <= $mes66 )?'X':"",
				"9"=>($reg->fecha_acceso >= $mes7 && $reg->fecha_acceso >= $mes77 && $reg->fechaApertura_alumno <= $mes77 )?'X':"",
				"10"=>($reg->fecha_acceso >= $mes8 && $reg->fecha_acceso >= $mes88 && $reg->fechaApertura_alumno <= $mes88 )?'X':"",
				"11"=>($reg->fecha_acceso >= $mes9 && $reg->fecha_acceso >= $mes99 && $reg->fechaApertura_alumno <= $mes99 )?'X':"",
				"12"=>($reg->fecha_acceso >= $mes10 && $reg->fecha_acceso >= $mes1010 && $reg->fechaApertura_alumno <= $mes1010 )?'X':"",
				"13"=>($reg->fecha_acceso >= $mes11 && $reg->fecha_acceso >= $mes1111 && $reg->fechaApertura_alumno <= $mes1111 )?'X':"",
                "14"=>($reg->fecha_acceso >= $mes12 && $reg->fecha_acceso >= $mes1212 && $reg->fechaApertura_alumno <= $mes1212 )?'X':""
                 );
            $anio ="";
            $ano="";
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
		$anio = explode("-", $reg->fecha_actual);
            $ano=$anio[0];

            $enero1=($ano."-01-01");
            $enero11=($ano."-01-30");
            $mes2=($ano."-02-01");
            $mes22=($ano."-02-28");
            $mes3=($ano."-03-01");
            $mes33=($ano."-03-31");
            $mes4=($ano."-04-01");
            $mes44=($ano."-04-30");
            $mes5=($ano."-05-01");
            $mes55=($ano."-05-31");
            $mes6=($ano."-06-01");
            $mes66=($ano."-06-30");
            $mes7=($ano."-07-01");
            $mes77=($ano."-07-31");
            $mes8=($ano."-08-01");
            $mes88=($ano."-08-31");
            $mes9=($ano."-09-01");
            $mes99=($ano."-09-30");
            $mes10=($ano."-10-01");
            $mes1010=($ano."-10-31");
            $mes11=($ano."-11-01");
            $mes1111=($ano."-11-30");
            $mes12=($ano."-12-1");
            $mes1212=($ano."-12-31");
            $fechaacceso=date_create($reg->fecha_acceso);
 			$data[]=array(
                 
 				"0"=>$reg->numeroFicha_alumno,
                "1"=>$reg->nombre_alumno,
                "2"=>($reg->inscripcion)?'X':"",
				"3"=>($reg->fecha_acceso >= $enero1 && $reg->fecha_acceso >= $enero11 && $reg->fechaApertura_alumno <= $enero11 )?'X':"",
				"4"=>($reg->fecha_acceso >= $mes2 && $reg->fecha_acceso >= $mes22 && $reg->fechaApertura_alumno <= $mes22 )?'X':"",
				"5"=>($reg->fecha_acceso >= $mes3 && $reg->fecha_acceso >= $mes33 && $reg->fechaApertura_alumno <= $mes33 )?'X':"",
				"6"=>($reg->fecha_acceso >= $mes4 && $reg->fecha_acceso >= $mes44 && $reg->fechaApertura_alumno <= $mes44 )?'X':"",
				"7"=>($reg->fecha_acceso >= $mes5 && $reg->fecha_acceso >= $mes55 && $reg->fechaApertura_alumno <= $mes55 )?'X':"",
				"8"=>($reg->fecha_acceso >= $mes6 && $reg->fecha_acceso >= $mes66 && $reg->fechaApertura_alumno <= $mes66 )?'X':"",
				"9"=>($reg->fecha_acceso >= $mes7 && $reg->fecha_acceso >= $mes77 && $reg->fechaApertura_alumno <= $mes77 )?'X':"",
				"10"=>($reg->fecha_acceso >= $mes8 && $reg->fecha_acceso >= $mes88 && $reg->fechaApertura_alumno <= $mes88 )?'X':"",
				"11"=>($reg->fecha_acceso >= $mes9 && $reg->fecha_acceso >= $mes99 && $reg->fechaApertura_alumno <= $mes99 )?'X':"",
				"12"=>($reg->fecha_acceso >= $mes10 && $reg->fecha_acceso >= $mes1010 && $reg->fechaApertura_alumno <= $mes1010 )?'X':"",
				"13"=>($reg->fecha_acceso >= $mes11 && $reg->fecha_acceso >= $mes1111 && $reg->fechaApertura_alumno <= $mes1111 )?'X':"",
                "14"=>($reg->fecha_acceso >= $mes12 && $reg->fecha_acceso >= $mes1212 && $reg->fechaApertura_alumno <= $mes1212 )?'X':""
                 );
            $anio ="";
            $ano="";
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
		$anio = explode("-", $reg->fecha_actual);
            $ano=$anio[0];

            $enero1=($ano."-01-01");
            $enero11=($ano."-01-30");
            $mes2=($ano."-02-01");
            $mes22=($ano."-02-28");
            $mes3=($ano."-03-01");
            $mes33=($ano."-03-31");
            $mes4=($ano."-04-01");
            $mes44=($ano."-04-30");
            $mes5=($ano."-05-01");
            $mes55=($ano."-05-31");
            $mes6=($ano."-06-01");
            $mes66=($ano."-06-30");
            $mes7=($ano."-07-01");
            $mes77=($ano."-07-31");
            $mes8=($ano."-08-01");
            $mes88=($ano."-08-31");
            $mes9=($ano."-09-01");
            $mes99=($ano."-09-30");
            $mes10=($ano."-10-01");
            $mes1010=($ano."-10-31");
            $mes11=($ano."-11-01");
            $mes1111=($ano."-11-30");
            $mes12=($ano."-12-1");
            $mes1212=($ano."-12-31");
            $fechaacceso=date_create($reg->fecha_acceso);
 			$data[]=array(
                 
 				"0"=>$reg->numeroFicha_alumno,
                "1"=>$reg->nombre_alumno,
                "2"=>($reg->inscripcion)?'X':"",
				"3"=>($reg->fecha_acceso >= $enero1 && $reg->fecha_acceso >= $enero11 && $reg->fechaApertura_alumno <= $enero11 )?'X':"",
				"4"=>($reg->fecha_acceso >= $mes2 && $reg->fecha_acceso >= $mes22 && $reg->fechaApertura_alumno <= $mes22 )?'X':"",
				"5"=>($reg->fecha_acceso >= $mes3 && $reg->fecha_acceso >= $mes33 && $reg->fechaApertura_alumno <= $mes33 )?'X':"",
				"6"=>($reg->fecha_acceso >= $mes4 && $reg->fecha_acceso >= $mes44 && $reg->fechaApertura_alumno <= $mes44 )?'X':"",
				"7"=>($reg->fecha_acceso >= $mes5 && $reg->fecha_acceso >= $mes55 && $reg->fechaApertura_alumno <= $mes55 )?'X':"",
				"8"=>($reg->fecha_acceso >= $mes6 && $reg->fecha_acceso >= $mes66 && $reg->fechaApertura_alumno <= $mes66 )?'X':"",
				"9"=>($reg->fecha_acceso >= $mes7 && $reg->fecha_acceso >= $mes77 && $reg->fechaApertura_alumno <= $mes77 )?'X':"",
				"10"=>($reg->fecha_acceso >= $mes8 && $reg->fecha_acceso >= $mes88 && $reg->fechaApertura_alumno <= $mes88 )?'X':"",
				"11"=>($reg->fecha_acceso >= $mes9 && $reg->fecha_acceso >= $mes99 && $reg->fechaApertura_alumno <= $mes99 )?'X':"",
				"12"=>($reg->fecha_acceso >= $mes10 && $reg->fecha_acceso >= $mes1010 && $reg->fechaApertura_alumno <= $mes1010 )?'X':"",
				"13"=>($reg->fecha_acceso >= $mes11 && $reg->fecha_acceso >= $mes1111 && $reg->fechaApertura_alumno <= $mes1111 )?'X':"",
                "14"=>($reg->fecha_acceso >= $mes12 && $reg->fecha_acceso >= $mes1212 && $reg->fechaApertura_alumno <= $mes1212 )?'X':""
                 );
            $anio ="";
            $ano="";
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
		$anio = explode("-", $reg->fecha_actual);
            $ano=$anio[0];

             $enero1=($ano."-01-01");
            $enero11=($ano."-01-30");
            $mes2=($ano."-02-01");
            $mes22=($ano."-02-28");
            $mes3=($ano."-03-01");
            $mes33=($ano."-03-31");
            $mes4=($ano."-04-01");
            $mes44=($ano."-04-30");
            $mes5=($ano."-05-01");
            $mes55=($ano."-05-31");
            $mes6=($ano."-06-01");
            $mes66=($ano."-06-30");
            $mes7=($ano."-07-01");
            $mes77=($ano."-07-31");
            $mes8=($ano."-08-01");
            $mes88=($ano."-08-31");
            $mes9=($ano."-09-01");
            $mes99=($ano."-09-30");
            $mes10=($ano."-10-01");
            $mes1010=($ano."-10-31");
            $mes11=($ano."-11-01");
            $mes1111=($ano."-11-30");
            $mes12=($ano."-12-1");
            $mes1212=($ano."-12-31");
            $fechaacceso=date_create($reg->fecha_acceso);
 			$data[]=array(
                 
 				"0"=>$reg->numeroFicha_alumno,
                "1"=>$reg->nombre_alumno,
                "2"=>($reg->inscripcion)?'X':"",
				"3"=>($reg->fecha_acceso >= $enero1 && $reg->fecha_acceso >= $enero11 && $reg->fechaApertura_alumno <= $enero11 )?'X':"",
				"4"=>($reg->fecha_acceso >= $mes2 && $reg->fecha_acceso >= $mes22 && $reg->fechaApertura_alumno <= $mes22 )?'X':"",
				"5"=>($reg->fecha_acceso >= $mes3 && $reg->fecha_acceso >= $mes33 && $reg->fechaApertura_alumno <= $mes33 )?'X':"",
				"6"=>($reg->fecha_acceso >= $mes4 && $reg->fecha_acceso >= $mes44 && $reg->fechaApertura_alumno <= $mes44 )?'X':"",
				"7"=>($reg->fecha_acceso >= $mes5 && $reg->fecha_acceso >= $mes55 && $reg->fechaApertura_alumno <= $mes55 )?'X':"",
				"8"=>($reg->fecha_acceso >= $mes6 && $reg->fecha_acceso >= $mes66 && $reg->fechaApertura_alumno <= $mes66 )?'X':"",
				"9"=>($reg->fecha_acceso >= $mes7 && $reg->fecha_acceso >= $mes77 && $reg->fechaApertura_alumno <= $mes77 )?'X':"",
				"10"=>($reg->fecha_acceso >= $mes8 && $reg->fecha_acceso >= $mes88 && $reg->fechaApertura_alumno <= $mes88 )?'X':"",
				"11"=>($reg->fecha_acceso >= $mes9 && $reg->fecha_acceso >= $mes99 && $reg->fechaApertura_alumno <= $mes99 )?'X':"",
				"12"=>($reg->fecha_acceso >= $mes10 && $reg->fecha_acceso >= $mes1010 && $reg->fechaApertura_alumno <= $mes1010 )?'X':"",
				"13"=>($reg->fecha_acceso >= $mes11 && $reg->fecha_acceso >= $mes1111 && $reg->fechaApertura_alumno <= $mes1111 )?'X':"",
                "14"=>($reg->fecha_acceso >= $mes12 && $reg->fecha_acceso >= $mes1212 && $reg->fechaApertura_alumno <= $mes1212 )?'X':""
                 );
            $anio ="";
            $ano="";
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
		$anio = explode("-", $reg->fecha_actual);
            $ano=$anio[0];

          $enero1=($ano."-01-01");
            $enero11=($ano."-01-30");
            $mes2=($ano."-02-01");
            $mes22=($ano."-02-28");
            $mes3=($ano."-03-01");
            $mes33=($ano."-03-31");
            $mes4=($ano."-04-01");
            $mes44=($ano."-04-30");
            $mes5=($ano."-05-01");
            $mes55=($ano."-05-31");
            $mes6=($ano."-06-01");
            $mes66=($ano."-06-30");
            $mes7=($ano."-07-01");
            $mes77=($ano."-07-31");
            $mes8=($ano."-08-01");
            $mes88=($ano."-08-31");
            $mes9=($ano."-09-01");
            $mes99=($ano."-09-30");
            $mes10=($ano."-10-01");
            $mes1010=($ano."-10-31");
            $mes11=($ano."-11-01");
            $mes1111=($ano."-11-30");
            $mes12=($ano."-12-1");
            $mes1212=($ano."-12-31");
            $fechaacceso=date_create($reg->fecha_acceso);
 			$data[]=array(
                 
 				"0"=>$reg->numeroFicha_alumno,
                "1"=>$reg->nombre_alumno,
                "2"=>($reg->inscripcion)?'X':"",
				"3"=>($reg->fecha_acceso >= $enero1 && $reg->fecha_acceso >= $enero11 && $reg->fechaApertura_alumno <= $enero11 )?'X':"",
				"4"=>($reg->fecha_acceso >= $mes2 && $reg->fecha_acceso >= $mes22 && $reg->fechaApertura_alumno <= $mes22 )?'X':"",
				"5"=>($reg->fecha_acceso >= $mes3 && $reg->fecha_acceso >= $mes33 && $reg->fechaApertura_alumno <= $mes33 )?'X':"",
				"6"=>($reg->fecha_acceso >= $mes4 && $reg->fecha_acceso >= $mes44 && $reg->fechaApertura_alumno <= $mes44 )?'X':"",
				"7"=>($reg->fecha_acceso >= $mes5 && $reg->fecha_acceso >= $mes55 && $reg->fechaApertura_alumno <= $mes55 )?'X':"",
				"8"=>($reg->fecha_acceso >= $mes6 && $reg->fecha_acceso >= $mes66 && $reg->fechaApertura_alumno <= $mes66 )?'X':"",
				"9"=>($reg->fecha_acceso >= $mes7 && $reg->fecha_acceso >= $mes77 && $reg->fechaApertura_alumno <= $mes77 )?'X':"",
				"10"=>($reg->fecha_acceso >= $mes8 && $reg->fecha_acceso >= $mes88 && $reg->fechaApertura_alumno <= $mes88 )?'X':"",
				"11"=>($reg->fecha_acceso >= $mes9 && $reg->fecha_acceso >= $mes99 && $reg->fechaApertura_alumno <= $mes99 )?'X':"",
				"12"=>($reg->fecha_acceso >= $mes10 && $reg->fecha_acceso >= $mes1010 && $reg->fechaApertura_alumno <= $mes1010 )?'X':"",
				"13"=>($reg->fecha_acceso >= $mes11 && $reg->fecha_acceso >= $mes1111 && $reg->fechaApertura_alumno <= $mes1111 )?'X':"",
                "14"=>($reg->fecha_acceso >= $mes12 && $reg->fecha_acceso >= $mes1212 && $reg->fechaApertura_alumno <= $mes1212 )?'X':""
                 );
            $anio ="";
            $ano="";
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
		$anio = explode("-", $reg->fecha_actual);
            $ano=$anio[0];

            $enero1=($ano."-01-01");
            $enero11=($ano."-01-30");
            $mes2=($ano."-02-01");
            $mes22=($ano."-02-28");
            $mes3=($ano."-03-01");
            $mes33=($ano."-03-31");
            $mes4=($ano."-04-01");
            $mes44=($ano."-04-30");
            $mes5=($ano."-05-01");
            $mes55=($ano."-05-31");
            $mes6=($ano."-06-01");
            $mes66=($ano."-06-30");
            $mes7=($ano."-07-01");
            $mes77=($ano."-07-31");
            $mes8=($ano."-08-01");
            $mes88=($ano."-08-31");
            $mes9=($ano."-09-01");
            $mes99=($ano."-09-30");
            $mes10=($ano."-10-01");
            $mes1010=($ano."-10-31");
            $mes11=($ano."-11-01");
            $mes1111=($ano."-11-30");
            $mes12=($ano."-12-1");
            $mes1212=($ano."-12-31");
            $fechaacceso=date_create($reg->fecha_acceso);
 			$data[]=array(
                 
 				"0"=>$reg->numeroFicha_alumno,
                "1"=>$reg->nombre_alumno,
                "2"=>($reg->inscripcion)?'X':"",
				"3"=>($reg->fecha_acceso >= $enero1 && $reg->fecha_acceso >= $enero11 && $reg->fechaApertura_alumno <= $enero11 )?'X':"",
				"4"=>($reg->fecha_acceso >= $mes2 && $reg->fecha_acceso >= $mes22 && $reg->fechaApertura_alumno <= $mes22 )?'X':"",
				"5"=>($reg->fecha_acceso >= $mes3 && $reg->fecha_acceso >= $mes33 && $reg->fechaApertura_alumno <= $mes33 )?'X':"",
				"6"=>($reg->fecha_acceso >= $mes4 && $reg->fecha_acceso >= $mes44 && $reg->fechaApertura_alumno <= $mes44 )?'X':"",
				"7"=>($reg->fecha_acceso >= $mes5 && $reg->fecha_acceso >= $mes55 && $reg->fechaApertura_alumno <= $mes55 )?'X':"",
				"8"=>($reg->fecha_acceso >= $mes6 && $reg->fecha_acceso >= $mes66 && $reg->fechaApertura_alumno <= $mes66 )?'X':"",
				"9"=>($reg->fecha_acceso >= $mes7 && $reg->fecha_acceso >= $mes77 && $reg->fechaApertura_alumno <= $mes77 )?'X':"",
				"10"=>($reg->fecha_acceso >= $mes8 && $reg->fecha_acceso >= $mes88 && $reg->fechaApertura_alumno <= $mes88 )?'X':"",
				"11"=>($reg->fecha_acceso >= $mes9 && $reg->fecha_acceso >= $mes99 && $reg->fechaApertura_alumno <= $mes99 )?'X':"",
				"12"=>($reg->fecha_acceso >= $mes10 && $reg->fecha_acceso >= $mes1010 && $reg->fechaApertura_alumno <= $mes1010 )?'X':"",
				"13"=>($reg->fecha_acceso >= $mes11 && $reg->fecha_acceso >= $mes1111 && $reg->fechaApertura_alumno <= $mes1111 )?'X':"",
                "14"=>($reg->fecha_acceso >= $mes12 && $reg->fecha_acceso >= $mes1212 && $reg->fechaApertura_alumno <= $mes1212 )?'X':""
                 );
            $anio ="";
            $ano="";
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