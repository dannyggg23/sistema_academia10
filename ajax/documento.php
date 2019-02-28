
<?php
    require_once "../modelos/Documento.php";
//if (strlen(session_id()) < 1)
//    session_start();
    
$documento=new Documento();

$id_documento=isset($_POST["id_documento"])? limpiarCadena($_POST["id_documento"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':

    if (!file_exists($_FILES["imagen"]["tmp_name"]) || !is_uploaded_file($_FILES["imagen"]["tmp_name"]))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES["imagen"]["type"] == "image/jpg" || $_FILES["imagen"]["type"] == "image/jpeg" || $_FILES["imagen"]["type"] == "image/png")
			{
				$imagen = round(microtime(true)) . "." . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/documento/" . $imagen);
			}
		}
    
    if (empty($id_documento)){
        $rspta=$documento->insertar($nombre,$descripcion,$tipo,$imagen);
        echo $rspta;
    }
    else {
        $rspta=$documento->editar($id_documento,$nombre,$descripcion,$tipo,$imagen);
        echo $rspta;
    }
    break;
    
    case 'desactivar':
		$rspta=$documento->desactivar($id_documento);
 		echo $rspta;
    break;
    
	case  'activar':
		$rspta=$documento->activar($id_documento);
 		echo $rspta;
	break;

	case 'mostrar':
		$rspta=$documento->mostrar($id_documento);
 		echo json_encode($rspta);
    break;
    
    case 'listar':
		$rspta=$documento->listar();
		 $data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				 "0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_documento.')"><i class="fa fa-pencil"></i></button>'.
				 ' <button class="btn btn-danger" onclick="desactivar('.$reg->id_documento.')"><i class="fa fa-close"></i></button>':
				 '<button class="btn btn-warning" onclick="mostrar('.$reg->id_documento.')"><i class="fa fa-pencil"></i></button>'.
				 ' <button class="btn btn-primary" onclick="activar('.$reg->id_documento.')"><i class="fa fa-check"></i></button>',
				 "1"=>$reg->nombre,"2"=>$reg->descripcion,"3"=>$reg->tipo,"4"=>'<img class="thumbnail zoom" src="../files/documento/'.$reg->imagen.'" height="50px" width="50px">',"5"=>($reg->estado)?'<span class="btn btn-sm btn-rounded btn-warning">Activado</span>':'<span class="btn btn-sm btn-rounded btn-danger">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, 
 			"iTotalRecords"=>count($data), 
 			"iTotalDisplayRecords"=>count($data), 
 			"aaData"=>$data);
 		echo json_encode($results);

    break;
    
    case 'mostrardocumento':
     $rspta=$documento->select();
     echo '<option value="" > -- SELECCIONE --- </option>';
     while ($reg = $rspta->fetch_object())
             {
               echo '<option value"'.$reg->id_documento.'">'.$reg->nombre.'</option>';

             }
	break;

}
    
?>
    