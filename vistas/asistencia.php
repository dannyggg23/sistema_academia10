<?php
//Activamos el alamaceamiento en el buffer

require 'headerconsultas.php';


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
                          <h1 class="box-title">Asistencia del Alumno </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Sucursal</label>
                            <select id="sucursal_idsucursal" name="sucursal_idsucursal" class="form-control selectpicker" data-live-search="true"  onchange="cargarAsistenciaSucursales(this.value)" required></select>
                      </div>

                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Categoria</label>
                            <select id="categoria_idcategoria" name="categoria_idcategoria" class="form-control selectpicker" data-live-search="true"  onchange="cargarAsistenciaCategorias(this.value)" required></select>
                         </div>

                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Horario</label>
                            <select id="horario_idhorario" name="horario_idhorario" class="form-control selectpicker" data-live-search="true"  onchange="cargarAsistenciaHorario(this.value)" required></select>
                         </div>

                        <div class="box-header with-border">
                          <h1 class="box-title">Listado Por fechas</h1>
                        <div class="box-tools pull-right"></div>
                        </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Desde:</label>
                              <input type="date" class="form-control" name="fechaDesde" id="fechaDesde">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Hasta:</label>
                              <input type="date" class="form-control" name="fechaHasta" id="fechaHasta" onchange="listarfecha()">
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Alumno:</label>
                            <input type="hidden" name="idpago" id="idpago">
                            <select id="idalumno" name="idalumno" class="form-control selectpicker" data-live-search="true" onchange="listarfechaRepresentante()" required></select>
                          </div>
                          <br>
                          <br>
                          <br>

                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
 
                            <th>Ficha</th>
                            <th>Alumno</th>
                            <th>Sucursal</th>
                            <th>Categoria</th>
                            <th>Horario</th>
                            <th>Fecha</th>
                            <th>Asistencia</th>
                            <th>Entrenador</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Ficha</th>
                            <th>Alumno</th>
                            <th>Sucursal</th>
                            <th>Categoria</th>
                            <th>Horario</th>
                            <th>Fecha</th>
                            <th>Asistencia</th>
                            <th>Entrenador</th>

                          </tfoot>
                        </table>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php

require 'footer.php';

?>

<script type="text/javascript" src="scripts/asistencia.js"></script>

