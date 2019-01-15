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
                          <h1 class="box-title">Entrenador <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>

                          <ul class="nav nav-tabs pull-right">
                           <li class="active"><a href="entrenador.php">Entrenador</a></li>
                           <li><a href="ficha_entrenador.php">Asignar Categorias</a></li>
                           </ul>
                       


                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Género</th>
                            <th>Edad</th>
                            <th>Título</th>
                            <th>Celular</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Género</th>
                            <th>Edad</th>
                            <th>Título</th>
                            <th>Celular</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Cédula(*):</label><label class="checkbox-inline">(<input type="checkbox" name="checkbox2" id="checkbox2">Pasaporte)</label>
                            <input type="hidden" name="identrenador" id="identrenador">
                            <input type="text" class="form-control" onblur="validarcedula()" name="cedula_entrenador" id="cedula_entrenador" minlength="10" maxlength="13" placeholder="Cédula" required>
                          </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Nombre(*):</label>
                              <input type="text" class="form-control" name="nombre_entrenador" id="nombre_entrenador" minlength="" maxlength="40" placeholder="Nombre" required>
                          </div>


                    
                      
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Email(*):</label>
                              <input type="email" class="form-control" name="email_entrenador" id="email_entrenador" maxlength="40" placeholder="Email" >
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Teléfono:</label>
                              <input type="text" class="form-control" name="telefono_entrenador" id="telefono_entrenador" maxlength="9" placeholder="Teléfono">
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Celular(*):</label>
                              <input type="text" class="form-control" name="celular_entrenador" id="celular_entrenador" maxlength="10" placeholder="Celular" >
                          </div>

                      
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Género(*):</label>
                            <select id="genero_entrenador" name="genero_entrenador" class="form-control selectpicker" data-live-search="true" >
                            <option value="">--Seleccione--</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            </select>
                          </div>

                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Título(*):</label>
                              <input type="text" class="form-control" name="titulo_entrenador" id="titulo_entrenador" placeholder="Título del entrenador" maxlength="40" >
                          </div>

                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha nacimiento(*):</label>
                              <input type="date" class="form-control" name="fechanacimiento_entrenador" id="fechanacimiento_entrenador"  >
                          </div>

                           <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <label>Dirección(*):</label>
                              <input type="text" class="form-control" name="direccion_entrenador" id="direccion_entrenador" placeholder="Ingrese su dirección de domicilio" maxlength="200" >
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción:</label>
                              <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Breve descripción del entrenador" maxlength="500"></textarea>
                          </div>



                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                          </div>


                           <br>
                          <br>
                          <br>

                          
                          <div id="ocultar_ficha" name="ocultar_ficha"  class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <label class="container">LLenar campos de Ficha
                          <input type="hidden" name="bandera" id="bandera">
                            <input type="checkbox" id="checkbox1" name="checkbox1">
                            <span class="checkmark"></span>
                          </label>
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
                            <select id="idsucursal_categorias" name="idsucursal_categorias" class="form-control selectpicker" data-live-search="true"></select>
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" >Entrenador</h4>
        </div>
        <div class="modal-body">

        <style>
   .input-group-addon{
    font-weight: bold;
   }
   .imagen{
    text-align: center;
   }

   </style>

        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 imagen">
        <img src="" width="150px" height="120px" id="imagenmodal">
        </div>

         <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Nombre</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="nombre_entrenador1" name="nombre_entrenador1">
    </div>

   

    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Cédula</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="cedula_entrenador1" name="cedula_entrenador1">
    </div>

     <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Género</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="genero_entrenador1" name="genero_entrenador1">
    </div>

    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Email</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="email_entrenador1" name="email_entrenador1">
    </div>

     <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Teléfono</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="telefono_entrenador1" name="telefono_entrenador1">
    </div>

    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Celular</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="celular_entrenador1" name="celular_entrenador1">
    </div>

    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Titulo</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="titulo_entrenador1" name="titulo_entrenador1">
    </div>

      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Fecha de nacimiento</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="fechanacimiento_entrenador1" name="fechanacimiento_entrenador1">

    </div>

  

    
    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Direccion</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="direccion_entrenador1" name="direccion_entrenador1">
    </div>

     
     <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Descripcion</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="descripcion1" name="descripcion1">
    </div>

    


    

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!--Fin-Modal-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/entrenador.js"></script>
<?php
}

ob_end_flush();

 ?>
