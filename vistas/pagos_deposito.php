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
                          <h1 class="box-title">Depósitos </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Representante</th>
                            <th>Alumno</th>
                            <th>Descripción</th>
                            <th>Fecha Acceso</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Representante</th>
                            <th>Alumno</th>
                            <th>Descripción</th>
                            <th>Fecha Acceso</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div> 

                   <div class="panel-body" id="formularioregistros">
                      
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="text" class="form-control" name="fecha" id="fecha" >
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Representante(*):</label>
                            <input type="text" class="form-control" name="cedula_representante" id="cedula_representante" >
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Alumno(*):</label>
                            <input type="text" class="form-control" name="cedula_alumno" id="cedula_alumno" maxlength="100" >
                          </div>

                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de acceso(*):</label>
                            <input type="text" class="form-control" name="fecha_acceso" id="fecha_acceso" >
                          </div>
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Descripción(*):</label>
                            <textarea rows="4" cols="50" class="form-control" name="descripcion" id="descripcion"> </textarea>
                          </div>

                         
                          <div >
                            <img style="display:block;margin:auto;" class='thumbnail zoom' src="" width="300px" height="300px" id="imagenmuestra">
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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

<script type="text/javascript" src="scripts/pagos_deposito.js"></script>
<?php
}

ob_end_flush();

 ?>
