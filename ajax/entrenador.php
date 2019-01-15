<?php 
require_once "../modelos/Entrenador.php";

        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");


$entrenador=new Entrenador();

$identrenador=isset($_POST["identrenador"])? limpiarCadena($_POST["identrenador"]):"";

$cedula_entrenador=isset($_POST["cedula_entrenador"])? limpiarCadena($_POST["cedula_entrenador"]):"";

$nombre_entrenador=isset($_POST["nombre_entrenador"])? limpiarCadena($_POST["nombre_entrenador"]):"";

$direccion_entrenador=isset($_POST["direccion_entrenador"])? limpiarCadena($_POST["direccion_entrenador"]):"";

$email_entrenador=isset($_POST["email_entrenador"])? limpiarCadena($_POST["email_entrenador"]):"";

$telefono_entrenador=isset($_POST["telefono_entrenador"])? limpiarCadena($_POST["telefono_entrenador"]):"";

$celular_entrenador=isset($_POST["celular_entrenador"])? limpiarCadena($_POST["celular_entrenador"]):"";

$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$genero_entrenador=isset($_POST["genero_entrenador"])? limpiarCadena($_POST["genero_entrenador"]):"";
$titulo_entrenador=isset($_POST["titulo_entrenador"])? limpiarCadena($_POST["titulo_entrenador"]):"";
$fechanacimiento_entrenador=isset($_POST["fechanacimiento_entrenador"])? limpiarCadena($_POST["fechanacimiento_entrenador"]):"";
$idsucursal_categorias=isset($_POST["idsucursal_categorias"])? limpiarCadena($_POST["idsucursal_categorias"]):"";
$bandera=isset($_POST["bandera"])? limpiarCadena($_POST["bandera"]):"";

$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

$usuario=isset($_POST["usuario"])? limpiarCadena($_POST["usuario"]):"";

$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";

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
			$rspta=$entrenador->insertar($cedula_entrenador,
			$nombre_entrenador,
			$direccion_entrenador,
			$email_entrenador,
			$telefono_entrenador,
			$celular_entrenador,
			$imagen,
			$descripcion,
			$genero_entrenador,
			$titulo_entrenador,
			$fechanacimiento_entrenador,
			$idsucursal_categorias,
			$bandera);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$entrenador->editar($identrenador,
			$cedula_entrenador,
			$nombre_entrenador,
			$direccion_entrenador,$email_entrenador,$telefono_entrenador,$celular_entrenador,$imagen,$descripcion,$genero_entrenador,
			$titulo_entrenador,
			$fechanacimiento_entrenador);
			echo $rspta ? "Datos actualizados" : "No se pudo actualizar";
		}
	break;


    case 'actualizar_movil':
		$rspta=$entrenador->editar_movil($identrenador,
        $cedula_entrenador,
        $nombre_entrenador,
        $direccion_entrenador,
        $email_entrenador,
        $telefono_entrenador,
        $celular_entrenador,
        $descripcion,
        $genero_entrenador,
        $titulo_entrenador,
        $fechanacimiento_entrenador,
        $usuario,
        $clave);
 		echo $rspta ? "Datos Desactivados" : "No se puede desactivar";
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
				 "0"=>($reg->estado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->identrenador.')"><i class="fa fa-pencil"></i></button>'.
				    ' <button class="btn btn-success btn-xs" onclick="abrirmodal('.$reg->identrenador.')"><i class="fa fa-eye"></i></button> '.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->identrenador.')"><i class="fa fa-close"></i></button>':
					 ' <button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->identrenador.')"><i class="fa fa-pencil"></i></button>'.
					 ' <button class="btn btn-success btn-xs" onclick="abrirmodal('.$reg->identrenador.')"><i class="fa fa-eye"></i></button> '.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->identrenador.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->cedula_entrenador,
 				"2"=>$reg->nombre_entrenador,
 				"3"=>$reg->genero_entrenador,
 				"4"=>$reg->edad,
 				"5"=>$reg->titulo_entrenador,
 				"6"=>$reg->celular_entrenador,
 				"7"=>$reg->direccion_entrenador,
 				"8"=>$reg->email_entrenador,
 				"9"=>"<img class='thumbnail zoom' src='../files/entrenadores/".$reg->imagen_entrenador."' height='50px' width='50px' >",
 				"10"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

		echo "<option value='' > -- SELECCIONE --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal . '>' . $reg->nombre_sucursal . '</option>';
				}
	break;


	case "selectCategoria":
		require_once "../modelos/Chsucursales.php";
		$sucursal = ($_GET["sucursalCategoria"]);
		$categoria=new Chsucursales;

		$rspta=$categoria->categoriasSucursal($sucursal);

		echo "<option value='' > -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->categoria_idcategoria . '>' . $reg->nombre_categoria . '</option>';
				}
	    break;

	case "selectHorario":
		require_once "../modelos/Chsucursales.php";
		$idsucursal = ($_GET["sucursalCategoria"]);
		$idcategoria = ($_GET["horarioCategoria"]);

		$categoria=new Chsucursales;
 
		$rspta=$categoria->horarioCategoriaSucursal($idsucursal,$idcategoria);

		echo "<option value=''> -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal_categorias . '>' . $reg->nombre .' | '.$reg->hora_inicio.' - '.$reg->hora_fin.'</option>';
				}
	break;
}
?>