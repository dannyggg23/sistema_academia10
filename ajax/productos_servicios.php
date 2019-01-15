<?php
require_once "../modelos/Productos_servicios.php";

$categoria=new Productos_servicios();
$idproductos_servicios=isset($_POST["idproductos_servicios"])? limpiarCadena($_POST["idproductos_servicios"]):"";
$nombre_productos_servicios=isset($_POST["nombre_productos_servicios"])? limpiarCadena($_POST["nombre_productos_servicios"]):"";
$precio_productos_servicios=isset($_POST["precio_productos_servicios"])? limpiarCadena($_POST["precio_productos_servicios"]):"";
$descripcion_productos_servicios=isset($_POST["descripcion_productos_servicios"])? limpiarCadena($_POST["descripcion_productos_servicios"]):"";
$categorias_productos_servicios_idcategorias_productos_servicios=isset($_POST["categorias_productos_servicios_idcategorias_productos_servicios"])? limpiarCadena($_POST["categorias_productos_servicios_idcategorias_productos_servicios"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idproductos_servicios)){

			$rspta=$categoria->insertar($nombre_productos_servicios,
            $precio_productos_servicios,
            $descripcion_productos_servicios,
            $categorias_productos_servicios_idcategorias_productos_servicios);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$categoria->editar($idproductos_servicios,
            $nombre_productos_servicios,
            $precio_productos_servicios,
            $descripcion_productos_servicios,
            $categorias_productos_servicios_idcategorias_productos_servicios);
			echo $rspta ? "Datos actualizado" : "No se pudo actualizar";
		}
	break;


	case 'desactivar':
		$rspta=$categoria->desactivar($idproductos_servicios);
 		echo $rspta ? "Datos Desactivado" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$categoria->activar($idproductos_servicios);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$categoria->mostrar($idproductos_servicios);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$categoria->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(

				 "0"=>($reg->idproductos_servicios==1 || $reg->idproductos_servicios==2 )?'<button class="btn btn-warning" onclick="mostrar('.$reg->idproductos_servicios.')"><i class="fa fa-pencil"></i></button>':(
				 ($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idproductos_servicios.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idproductos_servicios.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idproductos_servicios.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idproductos_servicios.')"><i class="fa fa-check"></i></button>'),
 				"1"=>$reg->nombre_productos_servicios,
 				"2"=>$reg->precio_productos_servicios,
 				"3"=>$reg->descripcion_productos_servicios,
 				"4"=>$reg->nombre_categoria_productos,
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
    
	case "selectCategoria_ps":
    require_once "../modelos/Categoria_ps.php";
    $categoria_ps = new Categoria_ps();
    $rspta = $categoria_ps->select();
    echo "<option value=''> -- Seleccione una Categoria --- </option>";
    while ($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idcategorias_productos_servicios . '>' . $reg->nombre_categoria_productos. '</option>';
            }
break;
	
}
?>
