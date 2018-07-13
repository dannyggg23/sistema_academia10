<?php
require "../config/Conexion.php";
Class Imagenes
{
  public function _construct(){

  }

  public function insertar($imagen,$noticias_idnoticias){

    $sql="INSERT INTO `imagenes`( `imagen`, `noticias_idnoticias`) VALUES ('$imagen','$noticias_idnoticias')";
    return ejecutarConsulta($sql);
  }

  public function editar($idimagenes,$imagen,$noticias_idnoticias)
  {
  $sql="UPDATE `imagenes` SET 
  `imagen`='$imagen',
  `noticias_idnoticias`='$noticias_idnoticias' 
  WHERE `idimagenes`='$idimagenes'";
    return ejecutarConsulta($sql);
  }

  public function desactivar($idimagenes)
  {
    $sql=sprintf("UPDATE imagenes SET estado='0'  WHERE `idimagenes`='%s' ",$idimagenes);
    return ejecutarConsulta($sql);
  }
  public function activar($idimagenes)
  {
    $sql=sprintf("UPDATE imagenes SET estado='1'  WHERE `idimagenes`='%s' ",$idimagenes);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idimagenes)
  {
    $sql=sprintf("SELECT * FROM `imagenes` WHERE idimagenes='%s'",$idimagenes);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT imagenes.*,noticias.titulo FROM `imagenes` INNER JOIN noticias ON noticias.idnoticias=imagenes.noticias_idnoticias";
    return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * FROM `imagenes` WHERE estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
