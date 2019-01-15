<?php
require "../config/Conexion.php";
Class Horario
{
  public function _construct(){

  }

  public function insertar($nombre,$hora_inicio,$hora_fin){

    $sql=sprintf("INSERT INTO `horario`( `nombre`, `hora_inicio`, `hora_fin`) VALUES ('%s','%s','%s')",$nombre,$hora_inicio,$hora_fin);
    return ejecutarConsulta($sql);
  }

  public function insertar_modal($nombre,$hora_inicio,$hora_fin){

    $sql=sprintf("INSERT INTO `horario`( `nombre`, `hora_inicio`, `hora_fin`) VALUES ('%s','%s','%s')",$nombre,$hora_inicio,$hora_fin);
    return ejecutarConsulta_retornarID($sql);
  }

  public function editar($idhorario,$nombre,$hora_inicio,$hora_fin)
  {
  $sql=sprintf("UPDATE `horario` SET 
    `nombre`='%s',
    `hora_inicio`='%s',
    `hora_fin`='%s'
    WHERE `idhorario`='%s'",$nombre,$hora_inicio,$hora_fin,$idhorario);
    return ejecutarConsulta($sql);
  }
  public function desactivar($idhorario)
  {
    $sql=sprintf("UPDATE horario SET estado='0'  WHERE `idhorario`='%s' ",$idhorario);
    return ejecutarConsulta($sql);
  }
  public function activar($idhorario)
  {
    $sql=sprintf("UPDATE horario SET estado='1'  WHERE `idhorario`='%s' ",$idhorario);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idhorario)
  {
    $sql=sprintf("SELECT * FROM `horario` WHERE idhorario='%s'",$idhorario);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT * from horario";
    return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * from horario where estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
