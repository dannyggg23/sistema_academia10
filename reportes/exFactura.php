<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
if ($_SESSION['pagos']==1)
{
//Incluímos el archivo Factura.php
require('Factura.php');

//Establecemos los datos de la empresa

require_once "../modelos/Academia.php";
$iddatos_academia="1";
$racademia=new Academia();
$tablaAclademia=$racademia->mostrarfactura($iddatos_academia);

$respTablaAcademia=$tablaAclademia->fetch_object();

$cedularepresentante;
$email_representante;
$fecha_representante;
$logo = "logo.jpg";
$ext_logo = "jpg";
$empresa = $respTablaAcademia->titulo_factura;
$documento =$respTablaAcademia->documento_identidad;
$direccion = $respTablaAcademia->direccion_academia;
$telefono = $respTablaAcademia->telefono_academia;
$email = $respTablaAcademia->email_academia;
$gerentecab=$respTablaAcademia->nombre_propietario;
//Obtenemos los datos de la cabecera de la venta actual

require_once "../modelos/Pago.php";
$venta= new Pago();

$rsptav = $venta->pagocabecera($_GET["id"]);
//Recorremos todos los valores obtenidos


$regv = $rsptav->fetch_object();

$totalFactura;
$cedularepresentante=$regv->cedula_representante;
$email_representante=$regv->email_representante;
$fecha_representante=$regv->fecha;
$nombre_representante=$regv->nombre_representante;

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

//Enviamos los datos de la empresa al método addSociete de la clase Factura
$pdf->addSociete(utf8_decode($empresa),
                  $documento."\n" .
                  utf8_decode("Encargado: ").utf8_decode($gerentecab)."\n" .
                  utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
                  utf8_decode("Teléfono: ").$telefono."\n" .
                  "Email : ".$email,$logo,$ext_logo);
$pdf->fact_dev( "$regv->tipo_documento ", "$regv->serie_comprobante-$regv->num_comprobante" );
$pdf->temporaire( "" );
$pdf->addDate( $regv->fecha);

//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
$pdf->addClientAdresse(utf8_decode($regv->nombre_representante),"Domicilio: ".utf8_decode($regv->direccion_representante),utf8_decode("Cédula: ").$regv->cedula_representante,"Email: ".$regv->email_representante,"Telefono: ".$regv->telefono_representante);

//Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta



$cols=array( "PRODUCTO"=>34,
             "DESCRIPCION"=>75,
             "CANTIDAD"=>20,
             "PRECIO"=>23,
             "DSCTO"=>18,
             "SUBTOTAL"=>20);
$pdf->addCols( $cols);
$cols=array( "PRODUCTO"=>"L",
             "DESCRIPCION"=>"L",
             "CANTIDAD"=>"C",
             "PRECIO"=>"R",
             "DSCTO" =>"R",
             "SUBTOTAL"=>"C");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//Actualizamos el valor de la coordenada "y", que será la ubicación desde donde empezaremos a mostrar los datos
$y= 89;

//Obtenemos todos los detalles de la venta actual
$rsptad = $venta->pagodetalle($_GET["id"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "PRODUCTO"=> "$regd->nombre_productos_servicios",
                "DESCRIPCION"=> utf8_decode(""." "."$regd->nombre_alumno".""),
                "CANTIDAD"=> "$regd->numero_meses_pago",
                "PRECIO"=> "$regd->precio_pago",
                "DSCTO" => "$regd->descuento_pago",
                "SUBTOTAL"=> "$regd->subtotal");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 2;
}

//Convertimos el total en letras
require_once "Letras.php";
$V=new EnLetras(); 
$con_letra=strtoupper($V->ValorEnLetras($regv->total,"DOLARES"));
$pdf->addCadreTVAs("---".$con_letra);

//Mostramos el impuesto
$pdf->addTVAs( $regv->impuesto, $regv->subtotal,"$ ");

$pdf->addCadreEurosFrancs("IVA"." $regv->impuesto %");

//$pdf->Output('Reporte de Venta','I');

//////////EMAIL

$pdf->Output();

$factura_num='facturas/'.$cedularepresentante.$fecha_representante.'.pdf';

$pdf->Output('F',$factura_num);

require_once ('../vendor/phpmailer/phpmailer/src/Exception.php');
require_once ('../vendor/phpmailer/phpmailer/src/OAuth.php');
require_once ('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once ('../vendor/phpmailer/phpmailer/src/SMTP.php');
require_once ('../vendor/phpmailer/phpmailer/src/POP3.php');

$mail = new PHPMailer\PHPMailer\PHPMailer();
//$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP


################################################################################################

//COMPROBANTE

###############################################################################################

$body =utf8_decode("Saludos ".$nombre_representante.' el comprobante de pago a sido generado con éxito y se encuentra disponible');

try {
     //$mail->Host       = "mail.gmail.com"; // SMTP server
      $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
      $mail->SMTPAuth   = true;                  // enable SMTP authentication
      $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
      $mail->Host       = "mail.escueladel10.com";      // sets GMAIL as the SMTP server
      $mail->Port       = 465;   // set the SMTP port for the GMAIL server
      $mail->SMTPKeepAlive = true;
      $mail->Mailer = "smtp";
      $mail->Username   = "admin@escueladel10.com";  // GMAIL username  ######### CAMBIAR ##########
      $mail->Password   = "Admin_10.2018";    // GMAIL password           ######### CAMBIAR ##########
      $mail->AddAddress($email_representante, 'abc');
      $mail->SetFrom('admin@escueladel10.com', 'Escuela del 10');//     ######### CAMBIAR ##########
      $mail->addAttachment($factura_num);         // Add attachments
      $mail->Subject = 'Resivo de pago La Escuela del 10';
      $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
      $mail->MsgHTML($body);
      $mail->Send();
      echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
}


//////////////


}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>