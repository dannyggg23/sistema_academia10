<?php
require('../fpdf181/fpdf.php');

require_once "../modelos/Ficha_alumno.php";
$ficha_alumno=new Ficha_alumno();
$rspta=$ficha_alumno->listarfichaPDF($_GET['id']);

$reg=$rspta->fetch_object();

if(empty($reg))
{
    echo 'Verifique que la sucursal tenga un entrenador para generar la ficha';
}
else
{

    #######################33
    $nombre=$reg->nombre_alumno;
    if($reg->genero_alumno=="Masculino")
    {
        $sexo="M";
    }else
    {
        $sexo="F";
    }
    
    $peso=$reg->peso_alumno;
    $talla=$reg->talla_alumno;
    $direccion=$reg->direccion_representante;
    $barrio=$reg->barrio_representante;
    $ciudad=$reg->ciudad;
    $telefono=$reg->telefono_representante;
    $fnacmiento=$reg->fecha_nacimiento;
    $edad=$reg->edad;
    $cedulaalumno=$reg->cedula_alumno;
    $representante=$reg->nombre_representante;
    $cedularepresentante=$reg->cedula_representante;
    $representante1=$reg->nombre_conyugue_representante;
    $cedularepresentante1=$reg->cedula_conyugue_representante;
    $establecimientoeducativo=$reg->escuela_alumno;
    $horarioclases="";
    $comoseentero=$reg->informacion_alumno;
    $horarioentrenamiento=$reg->nombre_categoria.' '.$reg->horario;
    $entrenador=$reg->nombre_entrenador;
    $posicion=$reg->posicion_alumno;
    $fecha=$reg->fechaApertura_alumno;
    $parentezco=$reg->parentesco_respresentante;
    
    $email_representante=$reg->email_representante;
    
    class PDF extends FPDF
    {
    // Cabecera de página
    
    
    function Header()
    {
    
    require_once "../modelos/Ficha_alumno.php";
    $ficha_alumno=new Ficha_alumno();
    $rspta=$ficha_alumno->listarfichaPDF($_GET['id']);
    $reg=$rspta->fetch_object();
    $imagen=$reg->imagen_alumno;
    
        $logo="logo.jpg";
        // Logo
        $this->Image($logo,20,15,35);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Ln(20);
        $this->Cell(80);
      
    
        // Título
        $this->Cell(90,10,utf8_decode('ESCUELA DE FÚTBOL'),0,0,'C');
        // Salto de línea
        $this->Image('../files/alumnos/'.$imagen.'',235,15,30);
    
        $this->Ln(10);
        $this->SetFont('Arial','B',14);
        $this->Cell(250,5,utf8_decode('Fundada el 01 de Agosto del 2013'),0,1,'C');
        $this->Cell(250,5,utf8_decode('Ambato - Ecuador'),0,1,'C');
    }
    
    
    
    }
    
    $pdf = new PDF('L','mm','A4');
    #Establecemos los márgenes izquierda, arriba y derecha: 
    $pdf->SetMargins(20,0,0); 
    
    
    $pdf->AddPage();
    $pdf->ln(5);
    
    $pdf->SetFont('Arial','U',12);
    $pdf->Cell(250,10,utf8_decode('FICHA DE INSCRIPCIÓN'),0,1,'C');
    
    ///////////FILA 1
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(18,7,utf8_decode('Nombre:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(130,7,utf8_decode($nombre),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(12,7,utf8_decode('Sexo:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(6,7,utf8_decode($sexo),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(12,7,utf8_decode('Peso:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,7,utf8_decode($peso),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(12,7,utf8_decode('Talla:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,7,utf8_decode($talla),0,1,'C');
    
    ///////////FILA 2
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(20,7,utf8_decode('Dirección:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(202,7,utf8_decode($direccion),0,1,'C');
    
    ///////////FILA 3
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(15,7,utf8_decode('Barrio:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(95,7,utf8_decode($barrio),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(17,7,utf8_decode('Ciudad:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(40,7,utf8_decode($ciudad),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(17,7,utf8_decode('Teléfono:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(27,7,utf8_decode($telefono),0,1,'C');
    
    ///////////FILA 4
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(45,7,utf8_decode('Fecha de nacimiento: '),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,7,utf8_decode($fnacmiento),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(13,7,utf8_decode('Edad: '),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(18,7,utf8_decode($edad),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(74,7,utf8_decode('Numero de cédula: '),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(34,7,utf8_decode($cedulaalumno),0,1,'C');
    
    ///////////FILA 5
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(35,7,utf8_decode('Representante:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(130,7,utf8_decode($representante),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(20,7,utf8_decode('Cédula:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(33,7,utf8_decode($cedularepresentante),0,1,'C');
    
    ///////////FILA 6
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(35,7,utf8_decode('Representante:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(130,7,utf8_decode($representante1),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(20,7,utf8_decode('Cédula:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(33,7,utf8_decode($cedularepresentante1),0,1,'C');
    
    ///////////FILA 7
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(55,7,utf8_decode('Establecimiento educativo:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(110,7,utf8_decode($establecimientoeducativo),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(20,7,utf8_decode(''),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(33,7,utf8_decode($horarioclases),0,1,'C');
    
    
    ///////////FILA 8
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(75,7,utf8_decode('Como se enteró de la escuela del 10:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(147,7,utf8_decode($comoseentero),0,1,'C');
    
    ///////////FILA 9
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(55,7,utf8_decode('Horario de entrenamiento:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(55,7,utf8_decode($horarioentrenamiento),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(25,7,utf8_decode('Entrenador:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(83,7,utf8_decode($entrenador),0,1,'C');
    
    ///////////FILA 10
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10);
    $pdf->Cell(55,7,utf8_decode('Posicón dentro del juego:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(90,7,utf8_decode($posicion),0,0,'C');
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(2);
    $pdf->Cell(40,7,utf8_decode('Fecha de ingreso:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(33,7,utf8_decode($fecha),0,1,'C');
    
    //AUTORIZACION
    $pdf->SetFont('Arial','U',10);
    $pdf->Cell(250,15,utf8_decode('AUTORIZACIÓN DEL MENOR'),0,1,'C');
    
    //////
    ///////////
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(7,5,utf8_decode('Yo:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(90,5,utf8_decode($representante),0,0,'C');
    
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(2);
    $pdf->Cell(50,5,utf8_decode('con cédula de ciudadanía N°:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(25,5,utf8_decode($cedularepresentante),0,0,'C');
    
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(2);
    $pdf->Cell(25,5,utf8_decode('Parentezco:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(35,5,utf8_decode($parentezco),0,1,'C');
    
    
    
    ///////////
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(35,5,utf8_decode('AUTORIZO al menor:'),0);
    
    $pdf->Cell(2);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(90,5,utf8_decode($nombre),0,0,'C');
    
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(2);
    $pdf->Cell(113,5,utf8_decode('a matricularse y participar de todas las actividades promovidas por la'),0,1,'J');
    
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(242,5,utf8_decode('"Escuela del 10, y autorizo a utilizar la imagen del alumno para espacios publicitarios"'),0,1,'J');
    $pdf->ln(20);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(250,5,utf8_decode('---------------------------------------------'),0,1,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(250,5,utf8_decode('FIRMA RESPONSABLE'),0,1,'C');
    
    $pdf->Output();
    
    $pdf->Output('F','bookings/'.$cedulaalumno.'.pdf');
    
    
require_once ('../vendor/phpmailer/phpmailer/src/Exception.php');
require_once ('../vendor/phpmailer/phpmailer/src/OAuth.php');
require_once ('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once ('../vendor/phpmailer/phpmailer/src/SMTP.php');
require_once ('../vendor/phpmailer/phpmailer/src/POP3.php');
$mail = new PHPMailer\PHPMailer\PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch
    
    $mail->IsSMTP(); // telling the class to use SMTP
    
    $body =utf8_decode("TE DAMOS LA MAS CORDIAL BIENVENIDA A FORMAR PARTE DE LA ESCUELA DE FUTBOL CON MAYOR PROYECCION A NIVEL NACIONAL 'LA ESCUELA DEL 10' \n Adjuntamos tu hoja de inscripción \n Atentamente, \n La Gerencia \n www.escueladel10.com");
    
    try {
         //$mail->Host       = "mail.gmail.com"; // SMTP server
          $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
          $mail->SMTPAuth   = true;                  // enable SMTP authentication
          $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
          $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
         //$mail->Host       = "smtp.hotmail.com";      // sets GMAIL as the SMTP server
          $mail->Port       = 465;   // set the SMTP port for the GMAIL server
          $mail->SMTPKeepAlive = true;
          $mail->Mailer = "smtp";
          $mail->Username   = "gmail@gmail.com";  // GMAIL username   ######### CAMBIAR ##########
          $mail->Password   = "pass";            // GMAIL password    ######### CAMBIAR ##########
          $mail->AddAddress($email_representante, 'abc');
          $mail->SetFrom('gmail@gmail.com', 'Escuela del 10');        ######### CAMBIAR ##########
          $mail->addAttachment('bookings/'.$cedulaalumno.'.pdf');         // Add attachments
          $mail->Subject = 'Bienvenido a la Escuela del 10';
          $mail->AltBody = ''; // optional - MsgHTML will create an alternate automatically
          $mail->MsgHTML($body);
          $mail->Send();
          echo "Message Sent OK</p>\n";
    } catch (phpmailerException $e) {
          echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
          echo $e->getMessage(); //Boring error messages from anything else!
    }
    
    ############################
}
  

?>