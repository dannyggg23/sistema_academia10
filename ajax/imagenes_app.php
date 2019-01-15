<?php
require_once "../modelos/Imagenes_app.php";

        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

$imagenes_app=new Imagenes_app();
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$idimagenes_app=isset($_POST["idimagenes_app"])? limpiarCadena($_POST["idimagenes_app"]):"";

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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/img_app/" . $imagen);
			}
		}

		if (empty($idimagenes_app)){
			$rspta=$imagenes_app->insertar($imagen);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$imagenes_app->editar($imagen,$idimagenes_app);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$imagenes_app->desactivar($idimagenes_app);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$imagenes_app->activar($idimagenes_app);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$imagenes_app->mostrar($idimagenes_app);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$imagenes_app->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idimagenes_app.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idimagenes_app.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idimagenes_app.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idimagenes_app.')"><i class="fa fa-check"></i></button>',
				"1"=>"<img class='thumbnail zoom' src='../files/img_app/".$reg->imagen."' height='80px' width='80px' >",
      			"2"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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
