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
if($_SESSION['ficha_entrenador']==1)
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
                          <h1 class="box-title">Ficha del Entrenador <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>

                            <th>Opciones</th>
                            <th>Ficha</th>
                            <th>Nombre</th>
                            <th>Sucursal</th>
                            <th>Categoria</th>
                            <th>Horario</th>
                            <th>Estado</th>

                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            
                          <th>Opciones</th>
                            <th>Ficha</th>
                            <th>Nombre</th>
                            <th>Sucursal</th>
                            <th>Categoria</th>
                            <th>Horario</th>
                            <th>Estado</th>

                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Número de ficha(*):</label>
                            <input type="hidden" name="idficha_entrenador" id="idficha_entrenador">
                            <label>Entrenador(*):</label>
                            <select id="entrenador_identrenador" name="entrenador_identrenador" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                      
                      <div  id="ocultar" name="ocultar" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Sucursal(*):</label>
                           
                            <select id="sucursal_idsucursal" name="sucursal_idsucursal" class="form-control selectpicker" data-live-search="true"  required onchange="cargarCategorias(this.value)"></select>
                           
                          </div>

                          <div id="ocultar1" name="ocultar1" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Categoría(*):</label>
                            <select id="categoria_idcategoria" name="categoria_idcategoria" class="form-control selectpicker" data-live-search="true" required onchange="cargarHorario(this.value)"></select>
                          </div>

                          <div id="ocultar2" name="ocultar2" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Horario(*):</label>
                            <select id="idsucursal_categorias" name="idsucursal_categorias" class="form-control selectpicker" required data-live-search="true"></select>
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

<script type="text/javascript" src="scripts/ficha_entrenador.js"></script>
<?php
}

ob_end_flush();

 ?>
