<?php
require "../config/Conexion.php";
Class Academia
{
  public function _construct(){

  }

  public function editar($iddatos_academia,$titulo_factura,$nombre_propietario,$documento_identidad,
  $direccion_academia,$telefono_academia,$email_academia,$serie_factura,$numero_factura)
  {
  $sql=("UPDATE `datos_academia` SET 
  `titulo_factura`='$titulo_factura',
  `nombre_propietario`='$nombre_propietario',
  `documento_identidad`='$documento_identidad',
  `direccion_academia`='$direccion_academia',
  `telefono_academia`='$telefono_academia',
  `email_academia`='$email_academia',
  `serie_factura`='$serie_factura',
  `numero_factura`='$numero_factura' 
  WHERE `iddatos_academia`='$iddatos_academia'");
    return ejecutarConsulta($sql);
  }

  
  public function mostrar($iddatos_academia)
  {
    $sql=("SELECT * FROM `datos_academia` WHERE datos_academia.iddatos_academia='$iddatos_academia'");
    return ejecutarConsultaSimpleFila($sql);
  }

  public function mostrarfactura($iddatos_academia)
  {
    $sql=("SELECT * FROM `datos_academia` WHERE datos_academia.iddatos_academia='$iddatos_academia'");
    return ejecutarConsulta($sql);
  }

  

  public function mostrarSerieNumero()
  {
    $sql=("SELECT * FROM `datos_academia` WHERE datos_academia.iddatos_academia=1");
    return ejecutarConsultaSimpleFila($sql);
  }

  public function listar(){
    $sql="SELECT * FROM `datos_academia`";
    return ejecutarConsulta($sql);
  }
  
}
 ?>
