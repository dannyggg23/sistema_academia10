<?php
require_once "../modelos/Factura.php";
if (strlen(session_id()) < 1)
	session_start();

$pago=new Factura(); 
$idpago=isset($_POST["idpago"])? limpiarCadena($_POST["idpago"]):"";

$representante_idrepresentante=isset($_POST["representante_idrepresentante"])? limpiarCadena($_POST["representante_idrepresentante"]):"";

$usuario_idusuario=$_SESSION['idusuario'];

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";

$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";

$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";


$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";

$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";

$subtotal=isset($_POST["subtotal1"])? limpiarCadena($_POST["subtotal1"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idpago)){
			$rspta=$pago->insertar($representante_idrepresentante,$usuario_idusuario,$fecha,$total,$tipo_documento,$serie_comprobante,$num_comprobante,$impuesto,$subtotal,$_POST["ficha_alumno_idficha_alumno"],$_POST["numero_meses_pago"],$_POST["precio_pago"],$_POST["descuento_pago"],$_POST["productos_servicios_idproductos_servicios"]);
			echo $rspta;
		}
		else {
			
		}
	break;

	case 'anular':
		$rspta=$pago->anular($idpago);
 		echo $rspta ? "Datos anulados" : "No se puede anular";
	break;


	case 'mostrar':
		$rspta=$pago->mostrar($idpago);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		$id=$_GET['id'];

		$rspta=$pago->listarDetalle($id);
		$rtotal=0;

		echo '<thead style="background-color: #A9D0F5">
							  <th>Opciones</th>
							  <th>Producto-Servicio</th>
							  <th>Cantidad</th>
							  <th>Precio</th>
							  <th>Descuento</th>
							  <th>Alumno</th>
							  <th>Subtotal</th>
                              </thead>';

		while($reg=$rspta->fetch_object())
		{
			$sub=$reg->numero_meses_pago * $reg->precio_pago;
			$subtotal=$sub-$reg->descuento_pago;

			echo '<tr class="filas" ><td></td><td>'.$reg->nombre_productos_servicios.'</td><td>'.$reg->numero_meses_pago.'</td><td>'.$reg->precio_pago.'</td><td>'.$reg->descuento_pago.'</td><td>'.$reg->numeroFicha_alumno.'</td><td>'.$subtotal.'</td></tr>';
			$rtotal=$rtotal+$subtotal;
			$sub=0;
			$subtotal=0;
			
			
		}

		echo '<tfoot>
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total_compra">$/. '.$rtotal.'</h4> <input type="hidden" name="total" id="total"></th>
                              </tfoot>';
         $rtotal=0;
 		
	break;


	case 'listar':
		$rspta=$pago->listar();
 		//Vamos a declarar un array
		 $data= Array();
		 
 		while ($reg=$rspta->fetch_object()){

			if($reg->tipo_documento=='Ticket'){

				$url='../reportes/exTicket.php?id=';
			}else{

				$url='../reportes/exFactura.php?id=';

			}

 			$data[]=array(

 				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning" onclick="mostrar('.$reg->idpago.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="anular('.$reg->idpago.')"><i class="fa fa-close"></i></button>':
					 '<button class="btn btn-warning" onclick="mostrar('.$reg->idpago.')"><i class="fa fa-pencil"></i> </button>' ).
					 '<a target="_blank" href="'.$url.$reg->idpago.'"> <button class="btn btn-info"> <i class="fa fa-file"></i> </button></a>',
 				"1"=>$reg->fecha,
 				"2"=>$reg->cedula_representante,
 				"3"=>$reg->nombre_representante,
       			"4"=>$reg->nombre_usuario,
       			"5"=>$reg->tipo_documento,
 				"6"=>$reg->serie_comprobante.'-'.$reg->num_comprobante,
 				"7"=>$reg->total,
      			"8"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>'
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

		echo '<option value="">--Seleccione--</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value='.$reg->idrepresentante.'>'.$reg->cedula_representante.' | '.$reg->nombre_representante.'</option>';
					
				}
		break;
		
		case "selectFicha":
		require_once "../modelos/Ficha_alumno.php";
		$representante = new Ficha_alumno();
		$id=$_GET['id'];

		$rspta = $representante->listarFicha_Representante($id);

		echo '<option value="">--Seleccione--</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value='.$reg->idficha_alumno.'>'.$reg->numeroFicha_alumno.' | '.$reg->nombre_alumno.' | '.$reg->descuento_ficha_alumno.' %</option>';
				}
	    break;

	case "listarFichas":
		require_once "../modelos/Productos_servicios.php";
		$categoria = new Productos_servicios();
      

		$rspta=$categoria->listar_modal();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idproductos_servicios.',\''.$reg->nombre_productos_servicios.'\',\''.$reg->precio_productos_servicios.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre_productos_servicios,
 				"2"=>$reg->precio_productos_servicios,
 				"3"=>$reg->descripcion_productos_servicios,
 				"4"=>$reg->nombre_categoria_productos
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	
	break;

	
	case "selectFichaDescuento":
	require_once "../modelos/Factura.php";
	$representante = new Factura();
	$id=$_GET['id'];

	$rspta = $representante->listarFicha_descuento($id);

	$reg = $rspta->fetch_object();
	
		if(empty($reg))
		{
			echo 0;
		}
		else
		{
			echo $reg->descuento_ficha_alumno;

		}
				
	break;


}
?>
