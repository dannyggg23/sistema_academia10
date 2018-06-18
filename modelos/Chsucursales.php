<?php
require "../config/Conexion.php";
Class Chsucursales
{
  public function _construct(){

  }

  public function insertar($sucursal_idsucursal, $categoria_idcategoria,$horario_idhorario){

    $sql=sprintf("INSERT INTO `sucursal_categorias`( `sucursal_idsucursal`, `categoria_idcategoria`, `horario_idhorario`) 
    VALUES ('%s','%s','%s')",$sucursal_idsucursal, $categoria_idcategoria,$horario_idhorario);
    return ejecutarConsulta($sql);
  }

  public function editar($idsucursal_categorias,$sucursal_idsucursal, $categoria_idcategoria,$horario_idhorario)
  {
  $sql=sprintf("UPDATE `sucursal_categorias` SET 
 
  `sucursal_idsucursal`='%s',
  `categoria_idcategoria`='%s',
  `horario_idhorario`='%s'
   WHERE idsucursal_categorias ='%s'",$sucursal_idsucursal, $categoria_idcategoria,$horario_idhorario,$idsucursal_categorias);
    return ejecutarConsulta($sql);
  }

  public function desactivar($idsucursal_categorias)
  {
    $sql=sprintf("UPDATE sucursal_categorias SET estado='0'  WHERE `idsucursal_categorias`='%s' ",$idsucursal_categorias);
    return ejecutarConsulta($sql);
  }
  public function activar($idsucursal_categorias)
  {
    $sql=sprintf("UPDATE sucursal_categorias SET estado='1'  WHERE `idsucursal_categorias`='%s' ",$idsucursal_categorias);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idsucursal_categorias)
  {
    $sql=sprintf("SELECT * FROM `sucursal_categorias` WHERE idsucursal_categorias='%s'",$idsucursal_categorias);
    return ejecutarConsultaSimpleFila($sql);
  }

  public function listar(){

    $sql="SELECT sucursal_categorias.idsucursal_categorias,sucursal_categorias.disponible,sucursal_categorias.estado,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin FROM `sucursal_categorias` INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario";
    return ejecutarConsulta($sql);

  }

   public function select(){
    $sql="SELECT sucursal_categorias.idsucursal_categorias,sucursal_categorias.disponible,sucursal_categorias.estado,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin FROM `sucursal_categorias` INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario where sucursal_categorias.estado=1";
    return ejecutarConsulta($sql);
  }


  ///CATEGORIAS POR SUCURSALES
  public function categoriasSucursal($idsucursal){
    $sql=sprintf("SELECT sucursal_categorias.idsucursal_categorias,categoria.nombre_categoria,sucursal_categorias.categoria_idcategoria FROM `sucursal_categorias` INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal WHERE sucursal.idsucursal='%s' AND categoria.estado=1 GROUP BY categoria.nombre_categoria",$idsucursal);
    return ejecutarConsulta($sql);
  }

  public function horarioCategoriaSucursal($idsucursal,$idcategoria){
    $sql=sprintf("SELECT sucursal_categorias.idsucursal_categorias,horario.nombre,sucursal_categorias.categoria_idcategoria FROM `sucursal_categorias` INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario WHERE sucursal.idsucursal='%s' and categoria.idcategoria='%s' AND horario.estado=1 AND sucursal_categorias.disponible=0 GROUP BY horario.nombre",$idsucursal,$idcategoria);
    return ejecutarConsulta($sql);
  }

  public function selectCategoriass(){
    $sql=sprintf("SELECT sucursal_categorias.idsucursal_categorias,categoria.nombre_categoria,sucursal_categorias.categoria_idcategoria FROM `sucursal_categorias` INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal WHERE categoria.estado=1 GROUP BY categoria.nombre_categoria");
    return ejecutarConsulta($sql);
  }

  public function selectHorarios(){
    $sql=sprintf("SELECT sucursal_categorias.idsucursal_categorias,horario.nombre,sucursal_categorias.categoria_idcategoria FROM `sucursal_categorias` INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario WHERE horario.estado=1 GROUP BY horario.nombre");
    return ejecutarConsulta($sql);
  }


}
 ?>
