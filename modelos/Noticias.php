<?php
require "../config/Conexion.php";
Class Noticias
{
  public function _construct(){

  }

  public function insertar($titulo,$fecha,$descripcion,$imagen,$sucursal_categorias_idsucursal_categorias){
    
    if(empty($sucursal_categorias_idsucursal_categorias))
    {
      $sql=sprintf("INSERT INTO `noticias`( `titulo`, `fecha`, `descripcion`, `imagen`) VALUES ('%s','%s','%s','%s')",$titulo,$fecha,$descripcion,$imagen);
      return ejecutarConsulta($sql);
    }
    else
    {
      $sql=sprintf("INSERT INTO `noticias`( `titulo`, `fecha`, `descripcion`, `imagen`,sucursal_categorias_idsucursal_categorias) VALUES ('%s','%s','%s','%s','%s')",$titulo,$fecha,$descripcion,$imagen,$sucursal_categorias_idsucursal_categorias);
    return ejecutarConsulta($sql);
    }

    
  }

  public function editar($idnoticias,$titulo,$fecha,$descripcion,$imagen,$sucursal_categorias_idsucursal_categorias)
  {

    if(empty($sucursal_categorias_idsucursal_categorias))
    {
      $sql=sprintf("UPDATE `noticias` SET 
      `titulo`='%s',
      `fecha`='%s',
      `descripcion`='%s',
      `imagen`='%s'
      WHERE idnoticias='%s'",$titulo,$fecha,$descripcion,$imagen,$idnoticias);
        return ejecutarConsulta($sql);
    }
    else
    {
      $sql=sprintf("UPDATE `noticias` SET 
      `titulo`='%s',
      `fecha`='%s',
      `descripcion`='%s',
      `imagen`='%s',
      sucursal_categorias_idsucursal_categorias='%s'
      WHERE idnoticias='%s'",$titulo,$fecha,$descripcion,$imagen,$sucursal_categorias_idsucursal_categorias,$idnoticias);
        return ejecutarConsulta($sql);
    }

 
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
    $sql=sprintf("SELECT 
    `noticias`.`titulo`,
    `noticias`.`idnoticias`,
    `noticias`.`fecha`,
    `noticias`.`descripcion`,
    `noticias`.`sucursal_categorias_idsucursal_categorias`,
    `noticias`.`estado`,
    `noticias`.`imagen`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre`,
    `horario`.`hora_inicio`,
    `horario`.`hora_fin`,
    `sucursal`.`idsucursal`,
    `categoria`.`idcategoria`
  FROM
    `noticias`
    INNER JOIN `sucursal_categorias` ON (`noticias`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`) WHERE idnoticias='%s'",$idnoticias);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT 
    `noticias`.`titulo`,
    `noticias`.`idnoticias`,
    `noticias`.`fecha`,
    `noticias`.`descripcion`,
    `noticias`.`sucursal_categorias_idsucursal_categorias`,
    `noticias`.`estado`,
    `noticias`.`imagen`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre`,
    `horario`.`hora_inicio`,
    `horario`.`hora_fin`,
    `sucursal`.`idsucursal`,
    `categoria`.`idcategoria`
  FROM
    `noticias`
    INNER JOIN `sucursal_categorias` ON (`noticias`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
  ";
    return ejecutarConsulta($sql);
  }
  public function listar_todos(){
    $sql="SELECT * FROM `noticias` where noticias.todos=1";
    return ejecutarConsulta($sql);
  }

    public function select(){
    $sql="SELECT * FROM `noticias` WHERE estado=1";
    return ejecutarConsulta($sql);
  }

  public function mostrarTodos($idnoticias){
    $sql="SELECT * FROM `noticias` WHERE idnoticias='$idnoticias'";
    return ejecutarConsultaSimpleFila($sql);
  }
}
 ?>
