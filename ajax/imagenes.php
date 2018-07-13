<?php 
require_once "../modelos/Imagenes.php";

$imagenes=new Imagenes();
$idimagenes=isset($_POST["idimagenes"])? limpiarCadena($_POST["idimagenes"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$noticias_idnoticias=isset($_POST["noticias_idnoticias"])? limpiarCadena($_POST["noticias_idnoticias"]):"";



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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/imagenes/" . $imagen);
			}
		}
		if (empty($idimagenes)){
			$rspta=$imagenes->insertar($imagen,$noticias_idnoticias);
			echo $rspta ? "Datos insertados" : "No se pudo insertar";
		}
		else {
			$rspta=$imagenes->editar($idimagenes,$imagen,$noticias_idnoticias);
			echo $rspta ? "Datos actualizados" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$imagenes->desactivar($idimagenes);
 		echo $rspta ? "Datos Desactivados" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$imagenes->activar($idimagenes);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$imagenes->mostrar($idimagenes);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$imagenes->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				 "0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idimagenes.')"><i class="fa fa-pencil"></i></button>'.
                 ' <button class="btn btn-danger" onclick="desactivar('.$reg->idimagenes.')"><i class="fa fa-close"></i></button>':
                 '<button class="btn btn-warning" onclick="mostrar('.$reg->idimagenes.')"><i class="fa fa-pencil"></i></button>'.
                 ' <button class="btn btn-primary" onclick="activar('.$reg->idimagenes.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->titulo,
 				"2"=>"<img src='../files/imagenes/".$reg->imagen."' height='50px' width='50px' >",
 				"3"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case "selectNoticia":
		require_once "../modelos/Noticias.php";
		$representante = new Noticias();

		$rspta = $representante->select();

		echo "<option>--Seleccione---</option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idnoticias . '>' . $reg->titulo . '</option>';
				}
	break;

}
?>