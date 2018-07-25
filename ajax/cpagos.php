<?php
require_once "../modelos/Pago.php";

$pago=new Pago();
$idpago=isset($_POST["idpago"])? limpiarCadena($_POST["idpago"]):"";

switch ($_GET["op"]){

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
                                <th>Ficha</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th>Servicio</th>
                                <th>Subtotal</th>
                              </thead>';

		while($reg=$rspta->fetch_object())
		{
			$sub=$reg->numero_meses_pago * $reg->precio_pago;
			$subtotal=$sub-$reg->descuento_pago;

			echo '<tr class="filas" ><td></td><td>'.$reg->numeroFicha_alumno.'</td><td>'.$reg->numero_meses_pago.'</td><td>'.$reg->precio_pago.'</td><td>'.$reg->descuento_pago.'</td><td>'.$reg->nombre_productos_servicios.'</td><td>'.$subtotal.'</td></tr>';
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
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idpago.')"><i class="fa fa-pencil"></i></button>',
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

	case 'listarFecha':

	$finicio=$_GET['finicio'];
	$ffin=$_GET['ffin'];

		$rspta=$pago->listarFecha($finicio,$ffin);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idpago.')"><i class="fa fa-pencil"></i></button>',
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
	
	case 'listarfechaRepresentante':

	$finicio=$_GET['finicio'];
	$ffin=$_GET['ffin'];
	$idrepresentante=$_GET['idrepresentante'];

		$rspta=$pago->listarfechaRepresentante($finicio,$ffin,$idrepresentante);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idpago.')"><i class="fa fa-pencil"></i></button>',
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
		echo '<option>--Seleccione--</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value='.$reg->idrepresentante.'>'.$reg->cedula_representante.' | '.$reg->nombre_representante.'</option>';
				}
	break;

	case "selectRepresentante2":
		require_once "../modelos/Representante.php";
		$representante = new Representante();

		$rspta = $representante->select();
		echo '<option>--Seleccione--</option>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value='.$reg->idrepresentante.'>'.$reg->cedula_representante.' | '.$reg->nombre_representante.'</option>';
				}
	break;


}
?>
