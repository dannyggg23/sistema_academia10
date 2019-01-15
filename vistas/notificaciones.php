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
if($_SESSION['Configuracion']==1)
{
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
                          <h1 class="box-title">Notificaciones </h1>

                           <ul class="nav nav-tabs pull-right">
                           <li class="active"><a href="notificaciones.php">Todos</a></li>
                           <li><a href="notificaciones_sucursal.php">Sucursal</a></li>
                           <li><a href="notificaciones_curso.php">Curso</a></li>
                           </ul>
                        <div class="box-tools pull-right">
                       
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                  

                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                         
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Titulo(*):</label>
                            
                            <input type="text" class="form-control" name="titulo" id="titulo" minlength="5" maxlength="100" placeholder="Título de la notificación" required>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Subtítulo(*):</label>
                              <input type="text" class="form-control" name="subtitulo" id="subtitulo" placeholder="Subtítulo de la notificación (DISPOSITIVOS IOS)"  required>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Mensaje(*):</label>
                              <textarea rows="1"   type="text" class="form-control" name="mensaje" id="mensaje" maxlength="200" placeholder="Escriba el mensaje de la notificación" required></textarea>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                          </div>
                        </form>
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

<script type="text/javascript" src="scripts/notificaciones.js"></script>

<?php
}

ob_end_flush();

 ?>
