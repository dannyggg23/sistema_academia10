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
                          <h1 class="box-title">Consultas Fichas de deudores </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">

                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Sucursal</label>
                            <select id="sucursal_idsucursal" name="sucursal_idsucursal" class="form-control selectpicker" data-live-search="true"  onchange="cargarDeudoresSucursales(this.value)" required></select>
                      </div>

                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Categoria</label>
                            <select id="categoria_idcategoria" name="categoria_idcategoria" class="form-control selectpicker" data-live-search="true"  onchange="cargarDeudoresCategorias(this.value)" required></select>
                         </div>

                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Horario</label>
                            <select id="horario_idhorario" name="horario_idhorario" class="form-control selectpicker" data-live-search="true"  onchange="cargarDeudoresHorario(this.value)" required></select>
                         </div>
 
                        <table id="tbllistadodeudores" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                          <th>Ficha</th>
                            <th>Alumno</th>
                            <th>Género</th>
                            <th>Sucursal</th>
                            <th>Categoria</th>
                            <th>Horario</th>
                            <th>Hora</th>
                            <th>Acceso</th>
                            <th>Ins</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Ficha</th>
                            <th>Alumno</th>
                            <th>Género</th>
                            <th>Sucursal</th>
                            <th>Categoria</th>
                            <th>Horario</th>
                            <th>Hora</th>
                            <th>Acceso</th>
                            <th>Ins</th>
                            <th>Imagen</th>
                            <th>Estado</th>
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

<script type="text/javascript" src="scripts/cfichas.js"></script>

