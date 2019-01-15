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
if($_SESSION['noticias']==1)
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
                          <h1 class="box-title">Noticias <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Titulo</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Sucursal</th>
                            <th>Categoría</th>
                            <th>Horario</th>
                            <th>Hora</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Titulo</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Sucursal</th>
                            <th>Categoría</th>
                            <th>Horario</th>
                            <th>Hora</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Titulo(*):</label>
                            <input type="hidden" name="idnoticias" id="idnoticias">
                            <input type="text" class="form-control" name="titulo" id="titulo" minlength="3" maxlength="100" placeholder="Título de la noticia" required>
                          </div>


                      
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha(*):</label>
                              <input type="date" class="form-control" name="fecha" id="fecha"  required>
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción(*):</label>
                              <textarea rows="1"   type="text" class="form-control" name="descripcion" id="descripcion" maxlength="500" placeholder="Descripción de la noticia" required></textarea>
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                          </div>

    

                           <div  id="ocultar" name="ocultar" class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Sucursal(*):</label>
                           
                            <select id="sucursal_idsucursal" name="sucursal_idsucursal" class="form-control selectpicker" data-live-search="true"  onchange="cargarCategorias(this.value)"></select>
                           
                          </div>

                          <div id="ocultar1" name="ocultar1" class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Categoría(*):</label>
                            <select id="categoria_idcategoria" name="categoria_idcategoria" class="form-control selectpicker" data-live-search="true"  onchange="cargarHorario(this.value)"></select>
                          </div>

                          <div id="ocultar2" name="ocultar2" class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Horario(*):</label>
                            <select id="sucursal_categorias_idsucursal_categorias" name="sucursal_categorias_idsucursal_categorias" class="form-control selectpicker" data-live-search="true"></select>
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

<script type="text/javascript" src="scripts/noticias.js"></script>

<?php
}

ob_end_flush();

 ?>
