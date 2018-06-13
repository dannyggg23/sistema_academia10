<?php
require "../config/Conexion.php";
Class Noticias
{
  public function _construct(){

  }

  public function insertar($titulo,$fecha,$descripcion,$imagen){

    $sql=sprintf("INSERT INTO `noticias`( `titulo`, `fecha`, `descripcion`, `imagen`) VALUES ('%s','%s','%s','%s')",$titulo,$fecha,$descripcion,$imagen);
    return ejecutarConsulta($sql);
  }

  public function editar($idnoticias,$titulo,$fecha,$descripcion,$imagen)
  {
  $sql=sprintf("UPDATE `noticias` SET 
  `titulo`='%s',
  `fecha`='%s',
  `descripcion`='%s',
  `imagen`='%s' WHERE idnoticias='%s'",$titulo,$fecha,$descripcion,$imagen);
    return ejecutarConsulta($sql);
  }
  public function desactivar($idnoticias)
  {
    $sql=sprintf("UPDATE noticias SET estado='0'  WHERE `idnoticias`='%s' ",$idnoticias);
    return ejecutarConsulta($sql);
  }
  public function activar($idnoticias)
  {
    $sql=sprintf("UPDATE noticias SET estado='1'  WHERE `idnoticias`='%s' ",$idnoticias);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idnoticias)
  {
    $sql=sprintf("SELECT * FROM `noticias` WHERE idnoticias='%s'",$idnoticias);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT * FROM `noticias`";
    return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * FROM `noticias` WHERE estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
