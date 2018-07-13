<?php
require_once "../modelos/Sucursal.php";

$sucursal=new Sucursal();
$idsucursal=isset($_POST["idsucursal"])? limpiarCadena($_POST["idsucursal"]):"";
$nombre_sucursal=isset($_POST["nombre_sucursal"])? limpiarCadena($_POST["nombre_sucursal"]):"";
$direrccion_ducursal=isset($_POST["direrccion_ducursal"])? limpiarCadena($_POST["direrccion_ducursal"]):"";
$telefono_sucursal=isset($_POST["telefono_sucursal"])? limpiarCadena($_POST["telefono_sucursal"]):"";
$encargado_sucursal=isset($_POST["encargado_sucursal"])? limpiarCadena($_POST["encargado_sucursal"]):"";
$ciudad_idCiudad=isset($_POST["ciudad_idCiudad"])? limpiarCadena($_POST["ciudad_idCiudad"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$latitud_sucursal=isset($_POST["latitud_sucursal"])? limpiarCadena($_POST["latitud_sucursal"]):"";
$longitud_sucursal=isset($_POST["longitud_sucursal"])? limpiarCadena($_POST["longitud_sucursal"]):"";
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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/sucursales/" . $imagen);
			}
		}

		if (empty($idsucursal)){
			$rspta=$sucursal->insertar($nombre_sucursal,$direrccion_ducursal,$telefono_sucursal,$encargado_sucursal,$ciudad_idCiudad,$imagen,$latitud_sucursal,$longitud_sucursal);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$sucursal->editar($idsucursal,$nombre_sucursal,$direrccion_ducursal,$telefono_sucursal,$encargado_sucursal,$ciudad_idCiudad,$imagen,$latitud_sucursal,$longitud_sucursal);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$sucursal->desactivar($idsucursal);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$sucursal->activar($idsucursal);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$sucursal->mostrar($idsucursal);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$sucursal->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idsucursal.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idsucursal.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre_sucursal,
 				"2"=>$reg->direrccion_ducursal,
 				"3"=>$reg->telefono_sucursal,
       			"4"=>$reg->encargado_sucursal,
       			"5"=>$reg->ciudad,
				"6"=>$reg->provincia,
				"7"=>"<img src='../files/sucursales/".$reg->imagen."' height='50px' width='50px' >",
      			"8"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case "selectCiudad":
		require_once "../modelos/Ciudad.php";
		$ciudad = new Ciudad();

		$rspta = $ciudad->select();

		echo '<option value="0">--  Seleccione una ciudad  --</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idCiudad . '>' . $reg->ciudad . '</option>';
				}
	break;
}
?>
