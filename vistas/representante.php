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
                          <h1 class="box-title">Representante <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                          <ul class="nav nav-tabs pull-right">
                           <li ><a href="alumno.php">Alumno</a></li>
                           <li ><a href="ficha_alumno.php">Ficha</a></li>
                           <li class="active"><a href="representante.php">Representante</a></li>
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
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Cédula(*):</label><label class="checkbox-inline">(   <input type="checkbox" name="checkbox2" id="checkbox2">Pasaporte)</label>
                            <input type="hidden" name="idrepresentante" id="idrepresentante">
                            <input type="text" class="form-control" name="cedula_representante" id="cedula_representante" onblur="validarcedula()" placeholder="Documento de identidad" maxlength="13" minlength="10" required>
                          </div>

                        

                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="text" class="form-control" name="nombre_representante" id="nombre_representante" placeholder="Ingrese los Apellidos y Nombres" maxlength="70" minlength="10" required>
                          </div>

                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Cédula Cónyugue(*):</label><label class="checkbox-inline">(<input type="checkbox" name="checkbox3" id="checkbox3">P)</label>
                            <input type="text" class="form-control" name="cedula_conyugue_representante" id="cedula_conyugue_representante" onblur="validarcedula1()" placeholder="Documento de identidad" maxlength="13" minlength="10" required>
                          </div>
                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Nombre Cónyugue(*):</label>
                            <input type="text" class="form-control" name="nombre_conyugue_representante" id="nombre_conyugue_representante" placeholder="Ingrese los Apellidos y Nombres" maxlength="70" minlength="10" required>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Género(*):</label>
                            <select id="genero_representante" name="genero_representante" class="form-control selectpicker"  placeholder="Seleccione un item" required>
                            <option value="" >--  Seleccione  --</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Email(*):</label>
                            <input type="email" class="form-control" placeholder="Email del representante" name="email_representante" id="email_representante" maxlength="50" minlength="5"  required>
                          </div>

                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Teléfono(*):</label>
                            <input type="text" class="form-control" name="telefono_representante" id="telefono_representante" placeholder="Teléfono del representante" maxlength="9" minlength="9"  required>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Celular:</label>
                            <input type="text" class="form-control" name="celular_representante" id="celular_representante" placeholder="Celular del representante" maxlength="10" minlength="10">
                          </div>


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Dirección(*):</label>
                            <input type="text" class="form-control" name="direccion_representante" id="direccion_representante" placeholder="Dirección del representante" maxlength="70" required>
                          </div>

                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Barrio(*):</label>
                            <input type="text" class="form-control" name="barrio_representante" id="barrio_representante" placeholder="Barrio del representante" maxlength="50"  required>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Ciudad(*):</label>
                            <select id="ciudad_representante" name="ciudad_representante" class="form-control selectpicker"  data-live-search="true" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Fecha Nacimiento(*):</label>
                              <input type="date" class="form-control" name="fecha_nacimiento_representante" id="fecha_nacimiento_representante" required>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Parentesco(*):</label>
                            <input type="text" class="form-control" name="parentesco_respresentante" id="parentesco_respresentante" placeholder="Parentezco con el alumno" maxlength="50" required>
                          </div>
                          
                           <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Lugar de Trabajo(*):</label>
                            <input type="text" class="form-control" name="lugar_trabajo_representante" id="lugar_trabajo_representante" placeholder="Lugar de trabajo del representante" maxlength="70"  required>
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
<script type="text/javascript" src="scripts/representante.js"></script>
<?php
}

ob_end_flush();

 ?>
