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
if($_SESSION['ficha_alumno']==1)
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
                          <h1 class="box-title">Alumno <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
                            <th>Edad</th>
                            <th>Posición</th>
                            <th>Representante</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Posición</th>
                            <th>Representante</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Cédula(*):</label>
                            <input type="hidden" name="idalumno" id="idalumno">
                            <button type="button" class="btn btn-primary btn-xs" onclick="validarcedula()">CI</button>
                            <input type="text" class="form-control" name="cedula_alumno" id="cedula_alumno" maxlength="13" minlength="10"  placeholder="Cédula" onkeyup = "if(event.keyCode == 13) validarcedula()" required>
                          </div>

                         
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Nombre(*):</label>
                              <input type="text" class="form-control" name="nombre_alumno" id="nombre_alumno" minlength="10" maxlength="70" placeholder="Nombre del alumno" required>
                          </div>


                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Género(*):</label>
                            <select id="genero_alumno" name="genero_alumno" class="form-control selectpicker"  placeholder="Seleccione un item" required>
                            <option value="1" >--Seleccione--</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Tipo de sangre(*):</label>
                              <input type="text" class="form-control" name="tipo_sangre_alumno" id="tipo_sangre_alumno" maxlength="50"  placeholder="Tipo de Sangre" required>
                          </div>

                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha Nacimiento(*):</label>
                              <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required>
                          </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Establecimiento educativo(*):</label>
                              <input type="text" class="form-control" name="escuela_alumno"	 id="escuela_alumno" maxlength="50" placeholder="Escuela de donde proviene" required>
                          </div>

                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Representante(*):</label><button type="button" id="modalrepresentante" name="modalrepresentante" class="btn btn-primary" >+</button>
                            <select id="representante_idrepresentante" name="representante_idrepresentante" class="form-control selectpicker" data-live-search="true" placeholder="Seleccione una opción" required></select>
                           
                          </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Posición(*):</label>
                              <input type="text" class="form-control" name="posicion_alumno" id="posicion_alumno" placeholder="Pocición en la que juega" maxlength="30" required>
                          </div>

                         

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Peso(*):</label>
                              <input type="text" class="form-control" name="peso_alumno" id="peso_alumno" placeholder="Peso" maxlength="20" required>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Talla(*):</label>
                              <input type="text" class="form-control" name="talla_alumno" id="talla_alumno" placeholder="Talla" maxlength="20" required>
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                          </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Como se entero de la Acdemia(*):</label>
                              <input type="text" class="form-control" name="informacion_alumno" id="informacion_alumno" placeholder="Cómo se entero de nuestra academia" maxlength="100" required>
                          </div>



                          <br>
                          <br>
                          <br>
                          
                          <div  class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>LLENAR CAMPOS DE FICHA :</label>

                            <input type="hidden" name="bandera" id="bandera">
                          
                          <input type="checkbox" name="acceptRules" class="inline checkbox" id="checkbox1" name="checkbox1" >
                           
                          
                          </div>

                          <div id="ocultar3" name="ocultar3" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Decuento(*):</label>
                            <input type="text" class="form-control" name="descuento_ficha_alumno" id="descuento_ficha_alumno" placeholder="Descuento %" maxlength="20" >
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
          <h4 class="modal-title" >Alumno</h4>
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
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="nombre_alumno1" name="nombre_alumno1">
    </div>

   

    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Cédula</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="cedula_alumno1" name="cedula_alumno1">
    </div>

     <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Género</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="genero_alumno1" name="genero_alumno1">
    </div>

    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Tipo de sangre</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="tipo_sangre_alumno1" name="tipo_sangre_alumno1">
    </div>

     <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Escuela de donde proviene</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="escuela_alumno1" name="escuela_alumno1">
    </div>

    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Fecha de nacimiento</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="fecha_nacimiento1" name="fecha_nacimiento1">
    </div>

    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Posición de juego</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="posicion_alumno1" name="posicion_alumno1">
    </div>

      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Peso</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="peso_alumno1" name="peso_alumno1">
          <span class="input-group-addon" id="sizing-addon2">Talla</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="talla_alumno1" name="talla_alumno1">
    </div>

  

    
    <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Como se entero de la escuela</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="informacion_alumno1" name="informacion_alumno1">
    </div>

     
     <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Representante</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="representante" name="representante">
    </div>

      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Nombre</span>
          <input type="text" class="form-control"  aria-describedby="sizing-addon2" id="nombrerepresentante" name="nombrerepresentante">
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

<script type="text/javascript" src="scripts/alumno.js"></script>

<?php
}

ob_end_flush();

 ?>
