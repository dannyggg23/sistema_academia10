<?php
//Activamos el alamaceamiento en el buffer
ob_start();
session_start();
if(!isset($_SESSION['nombre']))
{
  header("Location:login.html");
}
else
{

require 'header.php';

if($_SESSION['escritorio']==1)
{
    require_once "../modelos/Consultas.php";
    $consulta=new Consultas;
    $resptad=$consulta->NumDeudores();
    $regd=$resptad->fetch_object();
    $totald=$regd->deudores;

    $resptaa=$consulta->NumAlumnos();
    $rega=$resptaa->fetch_object();
    $totala=$rega->alumnos;

    $resptae=$consulta->NumEntrenadores();
    $rege=$resptae->fetch_object();
    $totale=$rege->entrenadores;
  

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Escritorio </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body" >

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="small-box bg-aqua">
                    <div class="inner">
                    <h4 style="font-size:17px;">
                    <strong> <?php  echo $totala; ?>  </strong>
                    </h4>
                    <p>Alumnos</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                    </div>
                    <a href="ficha_alumno.php" class="small-box-footer">Alumnos
                    <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    </div>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="small-box bg-green">
                    <div class="inner">
                    <h4 style="font-size:17px;">
                    <strong>  <?php  echo $totale; ?> </strong>
                    </h4>
                    <p>Entrenadores</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                    </div>
                    <a href="ficha_entrenador.php" class="small-box-footer">Entrenadores
                    <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    </div>
                    </div>

                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="small-box bg-red">
                    <div class="inner">
                    <h4 style="font-size:17px;">
                    <strong>  <?php  echo $totald; ?> </strong>
                    </h4>
                    <p>Deudores</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                    </div>
                    <a href="cdeudores.php" class="small-box-footer">Deudores
                    <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    </div>
                    </div>



                    </div>


                    <div class="panel-body" style="heigth: 400px" >
                    </div>


                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/categoria.js"></script>
<?php
}

ob_end_flush();

 ?>
