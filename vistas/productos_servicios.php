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

if($_SESSION['productos_servicios']==1)
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
                          <h1 class="box-title">Productos-Servicios <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idproductos_servicios" id="idproductos_servicios">
                            <input type="text" class="form-control" name="nombre_productos_servicios" id="nombre_productos_servicios"  maxlength="45" placeholder="Nombre del Producto o Servicio" required>
                          </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Precio(*):</label>
                            <input type="number" class="form-control" name="precio_productos_servicios" id="precio_productos_servicios"  maxlength="45" placeholder="Precio del Producto o Servicio" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción(*):</label>
                              <textarea type="text" class="form-control" name="descripcion_productos_servicios" id="descripcion_productos_servicios" maxlength="200" placeholder="Ingrese la Descripción del Producto o Servicio" required></textarea>
                          </div>


                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Categoría(*):</label>
                            <select id="categorias_productos_servicios_idcategorias_productos_servicios" name="categorias_productos_servicios_idcategorias_productos_servicios" class="form-control selectpicker"  placeholder="Seleccione un item" required>
                            </select>
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

<script type="text/javascript" src="scripts/productos_servicios.js"></script>
<?php
}

ob_end_flush();

 ?>
