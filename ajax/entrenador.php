<?php 
require_once "../modelos/Entrenador.php";

$entrenador=new Entrenador();

$identrenador=isset($_POST["identrenador"])? limpiarCadena($_POST["identrenador"]):"";

$cedula_entrenador=isset($_POST["cedula_entrenador"])? limpiarCadena($_POST["cedula_entrenador"]):"";

$nombre_entrenador=isset($_POST["nombre_entrenador"])? limpiarCadena($_POST["nombre_entrenador"]):"";

$apellido_entrenador=isset($_POST["apellido_entrenador"])? limpiarCadena($_POST["apellido_entrenador"]):"";

$direccion_entrenador=isset($_POST["direccion_entrenador"])? limpiarCadena($_POST["direccion_entrenador"]):"";

$email_entrenador=isset($_POST["email_entrenador"])? limpiarCadena($_POST["email_entrenador"]):"";

$telefono_entrenador=isset($_POST["telefono_entrenador"])? limpiarCadena($_POST["telefono_entrenador"]):"";


$celular_entrenador=isset($_POST["celular_entrenador"])? limpiarCadena($_POST["celular_entrenador"]):"";


$sucursal_idsucursal=isset($_POST["sucursal_idsucursal"])? limpiarCadena($_POST["sucursal_idsucursal"]):"";

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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/entrenadores/" . $imagen);
			}
		}
		if (empty($identrenador)){
			$rspta=$entrenador->insertar($cedula_entrenador,$nombre_entrenador,$apellido_entrenador,$direccion_entrenador,$email_entrenador,$telefono_entrenador,$celular_entrenador,$imagen,$sucursal_idsucursal);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$entrenador->editar($identrenador,$cedula_entrenador,$nombre_entrenador,$apellido_entrenador,$direccion_entrenador,$email_entrenador,$telefono_entrenador,$celular_entrenador,$imagen,$sucursal_idsucursal);
			echo $rspta ? "Datos actualizados" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$entrenador->desactivar($identrenador);
 		echo $rspta ? "Datos Desactivados" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$entrenador->activar($identrenador);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$entrenador->mostrar($identrenador);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$entrenador->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->identrenador.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->identrenador.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->identrenador.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->identrenador.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->cedula_entrenador,
 				"2"=>$reg->nombre_entrenador. ' '.$reg->apellido_entrenador,
 				"3"=>$reg->direccion_entrenador,
 				"4"=>$reg->email_entrenador,
 				"5"=>$reg->telefono_entrenador,
 				"6"=>$reg->celular_entrenador,
 				"7"=>$reg->nombre_sucursal,
 				"8"=>"<img src='../files/entrenadores/".$reg->imagen_entrenador."' height='50px' width='50px' >",
 				"9"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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


	case "selectSucursal":
		require_once "../modelos/Sucursal.php";
		$sucursal = new Sucursal();

		$rspta = $sucursal->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal . '>' . $reg->nombre_sucursal . '</option>';
				}
	break;
}
?>