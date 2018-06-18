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
$cedularepresentante;
$logo = "logo.jpg";
$ext_logo = "jpg";
$empresa = "NOMBRE EMPRESA";
$documento = "DUCUMENTO DE IDENTIDAD";
$direccion = "DIRECCION";
$telefono = "TELEFONO";
$email = "EMAIL";

//Obtenemos los datos de la cabecera de la venta actual

require_once "../modelos/Pago.php";
$venta= new Pago();

$rsptav = $venta->pagocabecera($_GET["id"]);
//Recorremos todos los valores obtenidos


$regv = $rsptav->fetch_object();

$cedularepresentante=$regv->cedula_representante;

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

//Enviamos los datos de la empresa al método addSociete de la clase Factura
$pdf->addSociete(utf8_decode($empresa),
                  $documento."\n" .
                  utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
                  utf8_decode("Teléfono: ").$telefono."\n" .
                  "Email : ".$email,$logo,$ext_logo);
$pdf->fact_dev( "$regv->tipo_documento ", "$regv->serie_comprobante-$regv->num_comprobante" );
$pdf->temporaire( "" );
$pdf->addDate( $regv->fecha);

//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
$pdf->addClientAdresse(utf8_decode($regv->nombre_representante),"Domicilio: ".utf8_decode($regv->direccion_representante),utf8_decode("Cédula: ").$regv->cedula_representante,"Email: ".$regv->email_representante,"Telefono: ".$regv->telefono_representante);

//Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta

$cols=array( "FICHA"=>30,
             "DESCRIPCION"=>71,
             "N.MESES"=>22,
             "P.M."=>25,
             "DSCTO"=>20,
             "SUBTOTAL"=>22);
$pdf->addCols( $cols);
$cols=array( "FICHA"=>"L",
             "DESCRIPCION"=>"L",
             "N.MESES"=>"C",
             "P.M."=>"R",
             "DSCTO" =>"R",
             "SUBTOTAL"=>"C");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//Actualizamos el valor de la coordenada "y", que será la ubicación desde donde empezaremos a mostrar los datos
$y= 89;

//Obtenemos todos los detalles de la venta actual
$rsptad = $venta->pagodetalle($_GET["id"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "FICHA"=> "$regd->numeroFicha_alumno",
                "DESCRIPCION"=> utf8_decode("$regd->cedula_alumno"." "."$regd->nombre_alumno".""),
                "N.MESES"=> "$regd->numero_meses_pago",
                "P.M."=> "$regd->precio_pago",
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
$pdf->addTVAs( $regv->impuesto, $regv->total,"$ ");
$pdf->addCadreEurosFrancs("IVA"." $regv->impuesto %");

//$pdf->Output('Reporte de Venta','I');

//////////EMAIL

$pdf->Output();

$pdf->Output('F','facturas/'.$cedularepresentante.'.pdf');

require_once ('../vendor/phpmailer/phpmailer/src/Exception.php');
require_once ('../vendor/phpmailer/phpmailer/src/OAuth.php');
require_once ('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once ('../vendor/phpmailer/phpmailer/src/SMTP.php');
require_once ('../vendor/phpmailer/phpmailer/src/POP3.php');

$mail = new PHPMailer\PHPMailer\PHPMailer();
//$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

$body ="Danny García";

try {
     //$mail->Host       = "mail.gmail.com"; // SMTP server
      $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
      $mail->SMTPAuth   = true;                  // enable SMTP authentication
      $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
      $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
      $mail->Port       = 465;   // set the SMTP port for the GMAIL server
      $mail->SMTPKeepAlive = true;
      $mail->Mailer = "smtp";
      $mail->Username   = "dannyggg23@gmail.com";  // GMAIL username
      $mail->Password   = "..Danny..3Burguer";            // GMAIL password
      $mail->AddAddress('azdannyggg23@gmail.com', 'abc');
      $mail->SetFrom('dannyggg23@gmail.com', 'Admin');
      $mail->addAttachment('facturas/'.$cedularepresentante.'.pdf');         // Add attachments
      $mail->Subject = 'PHPMailer Test Subject via mail(), advanced';
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