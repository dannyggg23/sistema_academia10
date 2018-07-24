<?php
require "../config/Conexion.php";
Class Productos_servicios
{
  public function _construct(){

  }

  public function insertar($nombre_productos_servicios,
  $precio_productos_servicios,
  $descripcion_productos_servicios,
  $categorias_productos_servicios_idcategorias_productos_servicios){

    $sql="INSERT INTO `productos_servicios`(`nombre_productos_servicios`, `precio_productos_servicios`, `descripcion_productos_servicios`, `categorias_productos_servicios_idcategorias_productos_servicios`) 
    VALUES ('$nombre_productos_servicios','$precio_productos_servicios','$descripcion_productos_servicios','$categorias_productos_servicios_idcategorias_productos_servicios')";
    return ejecutarConsulta($sql);
  }


  public function editar($idproductos_servicios,
  $nombre_productos_servicios,
  $precio_productos_servicios,
  $descripcion_productos_servicios,
  $categorias_productos_servicios_idcategorias_productos_servicios)
  {
    $sql="UPDATE `productos_servicios` SET 

    `nombre_productos_servicios`='$nombre_productos_servicios',
    `precio_productos_servicios`='$precio_productos_servicios',
    `descripcion_productos_servicios`='$descripcion_productos_servicios',
    `categorias_productos_servicios_idcategorias_productos_servicios`='$categorias_productos_servicios_idcategorias_productos_servicios'
    WHERE `idproductos_servicios`='$idproductos_servicios'";
    return ejecutarConsulta($sql);
  }

  public function desactivar($idproductos_servicios)
  {
    $sql=sprintf("UPDATE productos_servicios SET estado='0'  
    WHERE `idproductos_servicios`='%s' ",$idproductos_servicios);
    return ejecutarConsulta($sql);
  }
  public function activar($idproductos_servicios)
  {
    $sql=sprintf("UPDATE productos_servicios SET estado='1'  
    WHERE `idproductos_servicios`='%s'",$idproductos_servicios);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idproductos_servicios)
  {
    $sql=sprintf("SELECT * FROM `productos_servicios` 
    WHERE idproductos_servicios='%s'",$idproductos_servicios);
    return ejecutarConsultaSimpleFila($sql);
  }

  public function listar(){
    $sql="SELECT productos_servicios.*,categorias_productos_servicios.nombre_categoria_productos FROM `productos_servicios` 
    INNER JOIN categorias_productos_servicios 
    ON categorias_productos_servicios.idcategorias_productos_servicios=productos_servicios.categorias_productos_servicios_idcategorias_productos_servicios";
    return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * FROM `productos_servicios` where productos_servicios.estado=1";
    return ejecutarConsulta($sql);
  }

}
 ?>
