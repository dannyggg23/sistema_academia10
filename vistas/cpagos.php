<?php
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
                          <h1 class="box-title">Consultar Facturas</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
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
                            <label>Representante(*):</label>
                            <input type="hidden" name="idpago" id="idpago">
                            <select id="representante" name="representante" class="form-control selectpicker" data-live-search="true" onchange="listarfechaRepresentante()" required></select>
                          </div>
                        

                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Reprecentante</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th>Numero</th>
                            <th>Total</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                           <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Reprecentante</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th>Numero</th>
                            <th>Total</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Representante(*):</label>
                            <input type="hidden" name="idpago" id="idpago">
                            <select id="representante_idrepresentante" name="representante_idrepresentante" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                      
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                              <input type="date" class="form-control" name="fecha" id="fecha" required disabled>
                          </div>

                          

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Comprobante(*):</label>
                            <select id="tipo_documento" name="tipo_documento" class="form-control selectpicker" data-live-search="true" required disabled>
                              <option value="Boleta">Boleta</option>
                              <option value="Factura">Factura</option>
                              <option value="Ticket">Ticket</option>
                            </select>
                          </div>


                         <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Serie:</label>
                              <input type="text" class="form-control" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie" required="" disabled>
                          </div>

                           <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Número:</label>
                              <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required="" disabled>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Impuesto:</label>
                              <input type="text" class="form-control" name="impuesto" id="impuesto" maxlength="10" placeholder="Impuesto" required="" disabled>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                           <a data-toggle="modal" href="#myModal">
                           </a>
                          </div>

                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color: #A9D0F5">
                                <th>Opciones</th>
                                <th>Ficha</th>
                                <th>N° Meses</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                              </thead>
                              <tfoot>
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total_compra">$/. 0.00/</h4> <input type="hidden" name="total" id="total"></th>
                              </tfoot>

                              <tbody>
                                
                              </tbody>

                            </table>

                          </div>



                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                           
                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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

require 'footer.php';
?>

<script type="text/javascript" src="scripts/cpagos.js"></script>

