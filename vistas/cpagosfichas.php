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
                          <h1 class="box-title">Consultas de Mensualidades </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Sucursal</label>
                            <select id="sucursal_idsucursal" name="sucursal_idsucursal" class="form-control selectpicker" data-live-search="true"  onchange="cargarDeudoresSucursales1(this.value)" required></select>
                      </div>
 
                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Categoria</label>
                            <select id="categoria_idcategoria" name="categoria_idcategoria" class="form-control selectpicker" data-live-search="true"  onchange="cargarDeudoresCategorias1(this.value)" required></select>
                         </div>

                         <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Horario</label>
                            <select id="horario_idhorario" name="horario_idhorario" class="form-control selectpicker" data-live-search="true"  onchange="cargarDeudoresHorario1(this.value)" required></select>
                         </div>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
  
                            <th>Ficha</th>
                            <th>Alumno</th>
                            <th>Ins</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Ficha</th>
                            <th>Alumno</th>
                            <th>Ins</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>

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

<script type="text/javascript" src="scripts/cpagos_fichas.js"></script>

