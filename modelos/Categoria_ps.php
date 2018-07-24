<?php
require "../config/Conexion.php";
Class Categoria_ps
{
  public function _construct(){

  }

  public function insertar($nombre_categoria_productos,$descripcion_categoria_productos){

    $sql="INSERT INTO `categorias_productos_servicios`(`nombre_categoria_productos`, `descripcion_categoria_productos`) VALUES ('$nombre_categoria_productos','$descripcion_categoria_productos')";
    return ejecutarConsulta($sql);
  }


  public function editar($idcategorias_productos_servicios,$nombre_categoria_productos,$descripcion_categoria_productos)
  {
    $sql="UPDATE `categorias_productos_servicios` SET 
    `nombre_categoria_productos`='$nombre_categoria_productos',
    `descripcion_categoria_productos`='$descripcion_categoria_productos'
    WHERE `idcategorias_productos_servicios`='$idcategorias_productos_servicios'";
    return ejecutarConsulta($sql);
  }

  public function desactivar($idcategorias_productos_servicios)
  {
    $sql=sprintf("UPDATE categorias_productos_servicios SET estado='0'  
    WHERE `idcategorias_productos_servicios`='%s' ",$idcategorias_productos_servicios);
    return ejecutarConsulta($sql);
  }
  public function activar($idcategorias_productos_servicios)
  {
    $sql=sprintf("UPDATE categorias_productos_servicios SET estado='1'  
    WHERE `idcategorias_productos_servicios`='%s' ",$idcategorias_productos_servicios);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idcategorias_productos_servicios)
  {
    $sql=sprintf("SELECT * FROM `categorias_productos_servicios` 
    WHERE idcategorias_productos_servicios='%s'",$idcategorias_productos_servicios);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT * FROM `categorias_productos_servicios`";
    return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * FROM `categorias_productos_servicios` where categorias_productos_servicios.estado=1";
    return ejecutarConsulta($sql);
  }

}
 ?>
