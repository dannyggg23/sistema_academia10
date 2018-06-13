<?php 
session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";

$nombre_usuario=isset($_POST["nombre_usuario"])? limpiarCadena($_POST["nombre_usuario"]):"";

$cedula_usuario=isset($_POST["cedula_usuario"])? limpiarCadena($_POST["cedula_usuario"]):"";

$direccion_usuario=isset($_POST["direccion_usuario"])? limpiarCadena($_POST["direccion_usuario"]):"";

$telefono_usuario=isset($_POST["telefono_usuario"])? limpiarCadena($_POST["telefono_usuario"]):"";

$celular_usuario=isset($_POST["celular_usuario"])? limpiarCadena($_POST["celular_usuario"]):"";

$email_usuario=isset($_POST["email_usuario"])? limpiarCadena($_POST["email_usuario"]):"";

$cargo_usuario=isset($_POST["cargo_usuario"])? limpiarCadena($_POST["cargo_usuario"]):"";

$login_usuario=isset($_POST["login_usuario"])? limpiarCadena($_POST["login_usuario"]):"";

$clave_usuario=isset($_POST["clave_usuario"])? limpiarCadena($_POST["clave_usuario"]):"";

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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}


			//hash SHA256 en la contraseña
		$clavehash=hash("SHA256", $clave_usuario);



		if (empty($idusuario)){
			$rspta=$usuario->insertar($nombre_usuario,$cedula_usuario,$direccion_usuario,$telefono_usuario,$celular_usuario,$email_usuario,$cargo_usuario,$login_usuario,$clavehash,$imagen,$_POST["permiso"]);
			echo $rspta ? "Datos registrados" : "No se pudo registrar";
		}
		else {
			$rspta=$usuario->editar($idusuario,$nombre_usuario,$cedula_usuario,$direccion_usuario,$telefono_usuario,$celular_usuario,$email_usuario,$cargo_usuario,$login_usuario,$clavehash,$imagen,$_POST["permiso"]);
			echo $rspta ? "Datos actualizados" : "No se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($idusuario);
 		echo $rspta ? "Datos Desactivados" : "No se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
 		echo $rspta ? "Datos activados" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->cedula_usuario,
 				"2"=>$reg->nombre_usuario,
 				"3"=>$reg->direccion_usuario,
 				"4"=>$reg->telefono_usuario,
 				"5"=>$reg->celular_usuario,
 				"6"=>$reg->email_usuario,
 				"7"=>$reg->cargo_usuario,
 				"8"=>$reg->login_usuario,
 				"9"=>"<img src='../files/usuarios/".$reg->imagen_usuario."' height='50px' width='50px' >",
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

	case 'permisos':

	//Obtenemos todos los pemisos de la tabla permisos
	require_once "../modelos/Permiso.php";
	$permiso= new Permiso();
	$rspta=$permiso->listar();

	//obtener los permisos asisgnados al usuario
	$id=$_GET['id'];
	
	$marcados=$usuario->listarmarcados($id);
	//Declaramos el array para almacenar todos los permisos marcadoa
	$valores=array();


	//Almacenar los permisos asignados al usuario en el array
	while ($per=$marcados->fetch_object()) {

		array_push($valores, $per->permiso_idpermiso);
	}


	//Mostarmos la lsiat de permisos en la vista
	while ($reg=$rspta->fetch_object()) {
		
		$sw=in_array($reg->idpermiso, $valores)?'checked':'';

		echo '<li> <input type="checkbox"  '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
	
	}


	break;

	case 'verificar':

		$logina=$_POST['logina'];
		$clavea=$_POST['clavea'];

		//HASH SHA256 EN LA CONTRASEÑA
		$clavehash=hash("SHA256", $clavea);
		$rspta=$usuario->verificar($logina,$clavehash);
		$fetch=$rspta->fetch_object();
		if(isset($fetch))
		{
			//DECLARAMOS LAS VARIABLES DE SESIÓN
			$_SESSION['idusuario']=$fetch->idusuario;
			$_SESSION['nombre']=$fetch->nombre_usuario;
			$_SESSION['imagen']=$fetch->imagen_usuario;
			$_SESSION['login']=$fetch->login_usuario;

			//Obtenems los permisos del usuario
			$marcados=$usuario->listarmarcados($fetch->idusuario);

			//Declaramos un array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos en el array

			while ($per=$marcados->fetch_object()) {
				array_push($valores, $per->permiso_idpermiso);
				}

			//Determinamos los accesos del ususraio
			in_array(1, $valores)?$_SESSION['sucursal']=1:$_SESSION['sucursal']=0;
			in_array(2, $valores)?$_SESSION['categoria']=1:$_SESSION['categoria']=0;
			in_array(3, $valores)?$_SESSION['ficha_alumno']=1:$_SESSION['ficha_alumno']=0;
			in_array(4, $valores)?$_SESSION['ficha_entrenador']=1:$_SESSION['ficha_entrenador']=0;
			in_array(5, $valores)?$_SESSION['pagos']=1:$_SESSION['pagos']=0;
			in_array(6, $valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
			in_array(7, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(8, $valores)?$_SESSION['noticias']=1:$_SESSION['noticias']=0;

		}
		//echo $logina. " ".$clavehash;
		echo json_encode($fetch);
	break;

	case 'salir':

		//limpiamos las variables de session
	session_unset();

		//destruimos la session
	session_destroy();
		//Redireccionamos al login
	header("Location: ../index.php");

	break;





}
?>