<?php
require('../fpdf181/fpdf.php');

$nombre="DANNY GUSTAVO GARCIA GALARZA";
$sexo="M";
$peso="170";
$talla="1,75";
$direccion="ciudadela vertiebtes del cotopaxyi";
$barrio="vertientes del cotopaxi";
$ciudad="LATACUNGA";
$telefono="032786536";
$fnacmiento="23-04-1993";
$edad="25";
$cedulaalumno="0504353210";
$representante="GALARZA CLAUDIO SEGUNDA GLORIA";
$cedularepresentante="0504836498";
$representante1="GALARZA CLAUDIO SEGUNDA GLORIA";
$cedularepresentante1="0504836498";

class PDF extends FPDF
{
// Cabecera de página


function Header()
{
    $logo="logo.jpg";
    // Logo
    $this->Image($logo,30,20,40);
    // Arial bold 15
    $this->SetFont('Arial','B',17);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(90,10,utf8_decode('ESCUELA DE FÚTBOL'),0,0,'C');
    // Salto de línea
    $this->Image('logo.jpg',235,20,30,40);

    $this->Ln(10);
    $this->SetFont('Arial','B',14);
    $this->Cell(250,5,utf8_decode('Fundada el 01 de Agosto del 2013'),0,1,'C');
    $this->Cell(250,5,utf8_decode('Ambato - Ecuador'),0,1,'C');
}


}

$pdf = new PDF('L','mm','A4');
#Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(25, 25 , 25); 

#Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true,25); 

$pdf->AddPage();
$pdf->ln(10);


$pdf->SetFont('Arial','U',17);
$pdf->Cell(250,15,utf8_decode('FICHA DE INSCRIPCIÓN'),0,1,'C');

///////////FILA 1
$pdf->SetFont('Arial','',12);
$pdf->Cell(10);
$pdf->Cell(18,7,utf8_decode('Nombre:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(130,7,utf8_decode($nombre),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(12,7,utf8_decode('Sexo:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(6,7,utf8_decode($sexo),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(12,7,utf8_decode('Peso:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,7,utf8_decode($peso),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(12,7,utf8_decode('Talla:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,7,utf8_decode($talla),1,1);

///////////FILA 2
$pdf->SetFont('Arial','',12);
$pdf->Cell(10);
$pdf->Cell(20,7,utf8_decode('Dirección:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(202,7,utf8_decode($direccion),1,1);

///////////FILA 3
$pdf->SetFont('Arial','',12);
$pdf->Cell(10);
$pdf->Cell(15,7,utf8_decode('Barrio:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(95,7,utf8_decode($barrio),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(17,7,utf8_decode('Ciudad:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,7,utf8_decode($ciudad),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(20,7,utf8_decode('Teléfono:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(27,7,utf8_decode($telefono),1,1);

///////////FILA 4
$pdf->SetFont('Arial','',12);
$pdf->Cell(10);
$pdf->Cell(45,7,utf8_decode('Fecha de nacimiento: '),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,7,utf8_decode($fnacmiento),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(13,7,utf8_decode('Edad: '),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(18,7,utf8_decode($edad),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(59,7,utf8_decode('Numero de cédula: '),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(49,7,utf8_decode($cedulaalumno),1,1);

///////////FILA 5
$pdf->SetFont('Arial','',12);
$pdf->Cell(10);
$pdf->Cell(35,7,utf8_decode('Representante:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(130,7,utf8_decode($representante),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(20,7,utf8_decode('Cédula:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(33,7,utf8_decode($cedularepresentante),1,1);

///////////FILA 6
$pdf->SetFont('Arial','',12);
$pdf->Cell(10);
$pdf->Cell(35,7,utf8_decode('Representante:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(130,7,utf8_decode($representante1),1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(2);
$pdf->Cell(20,7,utf8_decode('Cédula:'),1);

$pdf->Cell(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(33,7,utf8_decode($cedularepresentante1),1,1);






$pdf->Output();

?>