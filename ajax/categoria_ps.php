<?php
require_once "../modelos/Categoria_ps.php";

$categoria=new Categoria_ps();
$idcategorias_productos_servicios=isset($_POST["idcategorias_productos_servicios"])? limpiarCadena($_POST["idcategorias_productos_servicios"]):"";
$nombre_categoria_productos=isset($_POST["nombre_categoria_productos"])? limpiarCadena($_POST["nombre_categoria_productos"]):"";
$descripcion_categoria_productos=isset($_POST["descripcion_categoria_productos"])? limpiarCadena($_POST["descripcion_categoria_productos"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idcategorias_productos_servicios)){

			$rspta=$categoria->insertar($nombre_categoria_productos,$descripcion_categoria_productos);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$categoria->editar($idcategorias_productos_servicios,$nombre_categoria_productos,$descripcion_categoria_productos);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;


	case 'desactivar':
		$rspta=$categoria->desactivar($idcategorias_productos_servicios);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$categoria->activar($idcategorias_productos_servicios);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$categoria->mostrar($idcategorias_productos_servicios);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$categoria->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategorias_productos_servicios.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategorias_productos_servicios.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategorias_productos_servicios.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcategorias_productos_servicios.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre_categoria_productos,
 				"2"=>$reg->descripcion_categoria_productos,
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
	
}
?>
