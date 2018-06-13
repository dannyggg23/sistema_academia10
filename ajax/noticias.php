<?php 
require_once "../modelos/Noticias.php";

$noticia=new Noticia();

$idnoticias=isset($_POST["idnoticias"])? limpiarCadena($_POST["idnoticias"]):"";
$titulo=isset($_POST["titulo"])? limpiarCadena($_POST["titulo"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/noticias/" . $imagen);
			}
		}
		if (empty($idnoticias)){
			$rspta=$noticia->insertar($titulo,$fecha,$descripcion,$imagen);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$noticia->editar($idnoticias,$titulo,$fecha,$descripcion,$imagen);
			echo $rspta ? "Datos actualizados" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$noticia->desactivar($idnoticias);
 		echo $rspta ? "Datos Desactivados" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$noticia->activar($idnoticias);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$noticia->mostrar($idnoticias);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$noticia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idnoticias.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idnoticias.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idnoticias.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idnoticias.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->titulo,
 				"2"=>$reg->fecha,
 				"3"=>$reg->descripcion,
 				"4"=>"<img src='../files/noticias/".$reg->imagen."' height='50px' width='50px' >",
 				"5"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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