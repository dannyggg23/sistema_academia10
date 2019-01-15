<?php
require "../config/Conexion.php";
Class Categoria
{
  public function _construct(){

  }

  public function insertar($nombre_categoria,$descripcion_categoria){

    $sql=sprintf("INSERT INTO `categoria`(`nombre_categoria`, `descripcion_categoria`) VALUES ('%s','%s')",$nombre_categoria,$descripcion_categoria);
    return ejecutarConsulta($sql);
  }

  public function insertar_modal($nombre_categoria,$descripcion_categoria){

    $sql=sprintf("INSERT INTO `categoria`(`nombre_categoria`, `descripcion_categoria`) VALUES ('%s','%s')",$nombre_categoria,$descripcion_categoria);
    return ejecutarConsulta_retornarID($sql);
  }

  public function editar($idcategoria,$nombre_categoria,$descripcion_categoria)
  {
  $sql=sprintf("UPDATE `categoria` SET 
    `nombre_categoria`='%s',
    `descripcion_categoria`='%s'
    WHERE `idcategoria`='%s'",$nombre_categoria,$descripcion_categoria,$idcategoria);
    return ejecutarConsulta($sql);
  }
  public function desactivar($idcategoria)
  {
    $sql=sprintf("UPDATE categoria SET estado='0'  WHERE `idcategoria`='%s' ",$idcategoria);
    return ejecutarConsulta($sql);
  }
  public function activar($idcategoria)
  {
    $sql=sprintf("UPDATE categoria SET estado='1'  WHERE `idcategoria`='%s' ",$idcategoria);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idcategoria)
  {
    $sql=sprintf("SELECT * FROM `categoria` WHERE idcategoria='%s'",$idcategoria);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT * FROM `categoria`";
    return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * FROM `categoria` where categoria.estado=1";
    return ejecutarConsulta($sql);
  }


}
 ?>
