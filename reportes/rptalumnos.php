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
if ($_SESSION['ficha_alumno']==1)
{

//Inlcuímos a la clase PDF_MC_Table
require('PDF_MC_Table.php');
 
//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();
 
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
 
//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',12);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE ALUMNOS',1,0,'C'); 
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232); 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,utf8_decode('Nº Ficha'),1,0,'C',1); 
$pdf->Cell(50,6,utf8_decode('Alumno'),1,0,'C',1);
$pdf->Cell(40,6,utf8_decode('Categoría'),1,0,'C',1);
$pdf->Cell(30,6,'Horario',1,0,'C',1);
$pdf->Cell(30,6,'Acceso',1,0,'C',1);

 
$pdf->Ln(10);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modelos/Ficha_alumno.php";
$articulo = new Ficha_alumno();

$rspta = $articulo->listar();

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30,50,40,30,30));

while($reg= $rspta->fetch_object())
{  
  $numeroFicha_alumno = $reg->numeroFicha_alumno;
    $nombreAlumno = $reg->nombreAlumno;
    $nombre_categoria = $reg->nombre_categoria;
    $horario =$reg->horario;
    $fecha_acceso = $reg->fecha_acceso;
    
 	
 	$pdf->SetFont('Arial','',10);
    $pdf->Row(array(utf8_decode($numeroFicha_alumno),utf8_decode($nombreAlumno),utf8_decode($nombre_categoria),utf8_decode($horario),utf8_decode($fecha_acceso)));
}
 
//Mostramos el documento pdf
$pdf->Output();

?>
<?php
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>