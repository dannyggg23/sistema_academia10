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
                          <h1 class="box-title">Academia </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Título Factura</th>
                            <th>Nombre Propietario</th>
                            <th>Documento de identidad</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Serie Factura</th>
                            <th>Número Factura</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Título Factura</th>
                            <th>Nombre Propietario</th>
                            <th>Documento de identidad</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Serie Factura</th>
                            <th>Número Factura</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Título(*):</label>
                            <input type="hidden" name="iddatos_academia" id="iddatos_academia">
                            <input type="text" class="form-control" name="titulo_factura" id="titulo_factura"  maxlength="30"  required>
                          </div>


                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre del Propietario(*):</label>
                              <input type="text" class="form-control" name="nombre_propietario" id="nombre_propietario" maxlength="40"  required>
                          </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Documento de identidad(*):</label>
                              <input type="text" class="form-control" name="documento_identidad" id="documento_identidad" maxlength="20"  required>
                          </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección(*):</label>
                              <input type="text" class="form-control" name="direccion_academia" id="direccion_academia" maxlength="45" required>
                          </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Teléfono(*):</label>
                              <input type="text" class="form-control" name="telefono_academia" id="telefono_academia" maxlength="15" required>
                          </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email(*):</label>
                              <input type="text" class="form-control" name="email_academia" id="email_academia" maxlength="30" required>
                          </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Serie de factura(*):</label>
                              <input type="number" class="form-control" name="serie_factura" id="serie_factura"  required>
                          </div>

                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Número de factura(*):</label>
                              <input type="number" class="form-control" name="numero_factura" id="numero_factura"  required>
                          </div>



                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

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

<script type="text/javascript" src="scripts/academia.js"></script>
<?php
}

ob_end_flush();

 ?>
