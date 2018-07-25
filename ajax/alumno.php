<?php 
require_once "../modelos/Alumno.php";

$alumno=new Alumno();
$idalumno=isset($_POST["idalumno"])? limpiarCadena($_POST["idalumno"]):"";
$cedula_alumno=isset($_POST["cedula_alumno"])? limpiarCadena($_POST["cedula_alumno"]):"";
$nombre_alumno=isset($_POST["nombre_alumno"])? limpiarCadena($_POST["nombre_alumno"]):"";
$genero_alumno=isset($_POST["genero_alumno"])? limpiarCadena($_POST["genero_alumno"]):"";
$imagen=isset($_POST["imagen_alumno"])? limpiarCadena($_POST["imagen_alumno"]):"";
$representante_idrepresentante=isset($_POST["representante_idrepresentante"])? limpiarCadena($_POST["representante_idrepresentante"]):"";
$tipo_sangre_alumno=isset($_POST["tipo_sangre_alumno"])? limpiarCadena($_POST["tipo_sangre_alumno"]):"";
$escuela_alumno=isset($_POST["escuela_alumno"])? limpiarCadena($_POST["escuela_alumno"]):"";
$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? limpiarCadena($_POST["fecha_nacimiento"]):"";
$posicion_alumno=isset($_POST["posicion_alumno"])? limpiarCadena($_POST["posicion_alumno"]):"";
$peso_alumno=isset($_POST["peso_alumno"])? limpiarCadena($_POST["peso_alumno"]):"";
$talla_alumno=isset($_POST["talla_alumno"])? limpiarCadena($_POST["talla_alumno"]):"";
$informacion_alumno=isset($_POST["informacion_alumno"])? limpiarCadena($_POST["informacion_alumno"]):"";
$idsucursal_categorias=isset($_POST["idsucursal_categorias"])? limpiarCadena($_POST["idsucursal_categorias"]):"";
$descuento_ficha_alumno=isset($_POST["descuento_ficha_alumno"])? limpiarCadena($_POST["descuento_ficha_alumno"]):"";

$bandera=isset($_POST["bandera"])? limpiarCadena($_POST["bandera"]):"";

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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/alumnos/" . $imagen);
			}
		}
		if (empty($idalumno)){
			$rspta=$alumno->insertar($cedula_alumno,
			$nombre_alumno
			,$genero_alumno,
			$imagen,
			$representante_idrepresentante,
			$tipo_sangre_alumno,
			$escuela_alumno,
			$fecha_nacimiento,
			$posicion_alumno,
			$peso_alumno,
            $talla_alumno,
            $informacion_alumno,
			$idsucursal_categorias,
			$descuento_ficha_alumno,
			$bandera
			);
			echo $rspta;
		}
		else {
			$rspta=$alumno->editar($idalumno,
			$cedula_alumno,
			$nombre_alumno,
			$genero_alumno,
			$imagen,
			$representante_idrepresentante,
			$tipo_sangre_alumno,
			$escuela_alumno,
			$fecha_nacimiento,
			$posicion_alumno,
			$peso_alumno,
            $talla_alumno,
            $informacion_alumno);
			echo $rspta ? "Datos actualizados" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$alumno->desactivar($idalumno);
 		echo $rspta ? "Datos Desactivados" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$alumno->activar($idalumno);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$alumno->mostrar($idalumno);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$alumno->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				 "0"=>($reg->estado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idalumno.')"><i class="fa fa-pencil"></i></button> '.
				 '<button class="btn btn-success btn-xs" onclick="abrirmodal('.$reg->idalumno.')"><i class="fa fa-eye"></i></button> '.				 
 				 '<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idalumno.')"><i class="fa fa-close"></i></button> ':
				 '<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idalumno.')"><i class="fa fa-pencil"></i></button> '.
 				 '<button class="btn btn-success btn-xs" onclick="abrirmodal('.$reg->idalumno.')"><i class="fa fa-eye"></i></button> '.					 
 				 '<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idalumno.')"><i class="fa fa-check"></i></button> ',
 				"1"=>$reg->cedula_alumno,
 				"2"=>$reg->nombre_alumno,
 				"3"=>$reg->genero_alumno,
 				"4"=>$reg->edad,
 				"5"=>$reg->posicion_alumno,
 				"6"=>$reg->peso_alumno." KG",
 				"7"=>$reg->talla_alumno." M",
 				"8"=>$reg->tipo_sangre_alumno,
 				"9"=>$reg->nombre_representante,
 				"10"=>"<img src='../files/alumnos/".$reg->imagen_alumno."' height='50px' width='50px' >",
 				"11"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case "selectRepresentante":
		require_once "../modelos/Representante.php";
		$representante = new Representante();

		$rspta = $representante->select();

		echo "<option value=''> -- Seleccione un Representante --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idrepresentante . '>' . $reg->cedula_representante ." | ".$reg->nombre_representante. '</option>';
				}
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

		$rspta=$categoria->horarioCategoriaSucursalAlumno($idsucursal,$idcategoria);

		echo "<option value=''> -- Seleccione --- </option>";
		

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal_categorias . '>' . $reg->nombre . '| '.$reg->hora_inicio.'-'.$reg->hora_fin.'</option>';
				}
	break;
}
?>