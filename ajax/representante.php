<?php
require_once "../modelos/Representante.php";

$representante=new Representante();

$idrepresentante=isset($_POST["idrepresentante"])? limpiarCadena($_POST["idrepresentante"]):"";
$cedula_representante=isset($_POST["cedula_representante"])? limpiarCadena($_POST["cedula_representante"]):"";
$nombre_representante=isset($_POST["nombre_representante"])? limpiarCadena($_POST["nombre_representante"]):"";
$email_representante=isset($_POST["email_representante"])? limpiarCadena($_POST["email_representante"]):"";
$direccion_representante=isset($_POST["direccion_representante"])? limpiarCadena($_POST["direccion_representante"]):"";
$telefono_representante=isset($_POST["telefono_representante"])? limpiarCadena($_POST["telefono_representante"]):"";
$genero_representante=isset($_POST["genero_representante"])? limpiarCadena($_POST["genero_representante"]):"";
$fecha_nacimiento_representante=isset($_POST["fecha_nacimiento_representante"])? limpiarCadena($_POST["fecha_nacimiento_representante"]):"";
$parentesco_respresentante=isset($_POST["parentesco_respresentante"])? limpiarCadena($_POST["parentesco_respresentante"]):"";
$celular_representante=isset($_POST["celular_representante"])? limpiarCadena($_POST["celular_representante"]):"";
$lugar_trabajo_representante=isset($_POST["lugar_trabajo_representante"])? limpiarCadena($_POST["lugar_trabajo_representante"]):"";
$cedula_conyugue_representante=isset($_POST["cedula_conyugue_representante"])? limpiarCadena($_POST["cedula_conyugue_representante"]):"";
$nombre_conyugue_representante=isset($_POST["nombre_conyugue_representante"])? limpiarCadena($_POST["nombre_conyugue_representante"]):"";
$barrio_representante=isset($_POST["barrio_representante"])? limpiarCadena($_POST["barrio_representante"]):"";
$ciudad_representante=isset($_POST["ciudad_representante"])? limpiarCadena($_POST["ciudad_representante"]):"";


$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idrepresentante)){
			$rspta=$representante->insertar($cedula_representante,$nombre_representante,$email_representante,$direccion_representante,$telefono_representante,$genero_representante,$fecha_nacimiento_representante,$parentesco_respresentante,$celular_representante,$lugar_trabajo_representante,$cedula_conyugue_representante,$nombre_conyugue_representante,$barrio_representante,$ciudad_representante);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$representante->editar($idrepresentante,$cedula_representante,$nombre_representante,$email_representante,$direccion_representante,$telefono_representante,$genero_representante,$fecha_nacimiento_representante,$parentesco_respresentante,$celular_representante,$lugar_trabajo_representante,$cedula_conyugue_representante,$nombre_conyugue_representante,$barrio_representante,$ciudad_representante);
			echo $rspta ? "Datos actualizados" : "No se pudo actualizar";
		}
	break;

	case 'guardar':

			$rspta=$representante->insertarModal($cedula_representante,$nombre_representante,$email_representante,$direccion_representante,$telefono_representante,$genero_representante,$fecha_nacimiento_representante,$parentesco_respresentante,$celular_representante,$lugar_trabajo_representante,$cedula_conyugue_representante,$nombre_conyugue_representante,$barrio_representante,$ciudad_representante);
			echo $rspta;
	
	break;

	    case 'validarcedula':
	    //Cargar el autoload de composer
         require '../vendor/autoload.php';
        // Crear nuevo objeto
         $validador = new Tavo\ValidadorEc;

		 if ($validador->validarCedula($cedula_representante)) {
			echo 'Cédula válida';
		} else {
			echo 'Cédula incorrecta: '.$validador->getError();
		}
 		
	break;
	case 'validarRUC':
	//Cargar el autoload de composer
	 require '../vendor/autoload.php';
	// Crear nuevo objeto
	 $validador = new Tavo\ValidadorEc;

	 if ($validador->validarRucSociedadPublica($cedula_representante)) {
		echo 'RUC válida';
	} else {
		echo 'RUC incorrecta: '.$validador->getError();
	}
	 
break;

case 'validarRUCP':
//Cargar el autoload de composer
 require '../vendor/autoload.php';
// Crear nuevo objeto
 $validador = new Tavo\ValidadorEc;

 if ($validador->validarRucSociedadPrivada($cedula_representante)) {
	echo 'RUC válida';
} else {
	echo 'RUC incorrecta: '.$validador->getError();
}
 
break;
	

	case 'desactivar':
		$rspta=$representante->desactivar($idrepresentante);
 		echo $rspta ? "Datos desactivados" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$representante->activar($idrepresentante);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$representante->mostrar($idrepresentante);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$representante->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idrepresentante.')"><i class="fa fa-pencil"></i></button> '.
 				    '<button class="btn btn-success btn-xs" onclick="ver('.$reg->idrepresentante.')"><i class="fa fa-eye"></i></button> '.
 					'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idrepresentante.')"><i class="fa fa-close"></i></button> ':
					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idrepresentante.')"><i class="fa fa-pencil"></i></button> '.
 				    '<button class="btn btn-success btn-xs" onclick="ver('.$reg->idrepresentante.')"><i class="fa fa-eye"></i></button> '.					 
 					'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idrepresentante.')"><i class="fa fa-check"></i></button> ',
 				"1"=>$reg->cedula_representante,
				"2"=>$reg->nombre_representante,
				"3"=>$reg->telefono_representante,				 
 				"4"=>$reg->email_representante,
       			"5"=>$reg->direccion_representante,
      			"6"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

		echo '<option >-- Seleccione --</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idCiudad . '>' . $reg->ciudad . '</option>';
				}
	break;

	case "selectidciudad":
		require_once "../modelos/Ciudad.php";
		$ciudad = new Ciudad();
		$rspta = $ciudad->selectidciudad($_POST["ciudad"]);
		echo json_encode($rspta);
		
	break;

}
?>
