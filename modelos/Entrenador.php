<?php
require "../config/Conexion.php";
Class Entrenador
{
  public function _construct(){

  }

  public function insertar($cedula_entrenador,$nombre_entrenador,$apellido_entrenador,$direccion_entrenador,$email_entrenador,$telefono_entrenador,$celular_entrenador,$imagen_entrenador,$sucursal_idsucursal,$descripcion){
    $sql=sprintf("INSERT INTO `entrenador`( `cedula_entrenador`, `nombre_entrenador`, `apellido_entrenador`, `direccion_entrenador`, `email_entrenador`, `telefono_entrenador`, `celular_entrenador`, `imagen_entrenador`, `sucursal_idsucursal`, `usuario`, `clave`,descripcion) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$cedula_entrenador,$nombre_entrenador,$apellido_entrenador,$direccion_entrenador,$email_entrenador,$telefono_entrenador,$celular_entrenador,$imagen_entrenador,$sucursal_idsucursal,$cedula_entrenador,$cedula_entrenador,$descripcion);
    return ejecutarConsulta($sql);
  }

  public function editar($identrenador,$cedula_entrenador,$nombre_entrenador,$apellido_entrenador,$direccion_entrenador,$email_entrenador,$telefono_entrenador,$celular_entrenador,$imagen_entrenador,$sucursal_idsucursal,$descripcion)
  {
  $sql=sprintf("UPDATE `entrenador` SET 
    `cedula_entrenador`='%s',
    `nombre_entrenador`='%s',
    `apellido_entrenador`='%s',
    `direccion_entrenador`='%s',
    `email_entrenador`='%s',
    `telefono_entrenador`='%s',
    `celular_entrenador`='%s',
    `imagen_entrenador`='%s',
    `sucursal_idsucursal`='%s',
    `descripcion`='%s'
     WHERE `identrenador`='%s'",$cedula_entrenador,$nombre_entrenador,$apellido_entrenador,$direccion_entrenador,$email_entrenador,$telefono_entrenador,$celular_entrenador,$imagen_entrenador,$sucursal_idsucursal,$descripcion,$identrenador);
    return ejecutarConsulta($sql);
  }

  public function desactivar($identrenador)
  {
    $sql=sprintf("UPDATE entrenador SET estado='0'  WHERE `identrenador`='%s' ",$identrenador);
    return ejecutarConsulta($sql);
  }
  public function activar($identrenador)
  {
    $sql=sprintf("UPDATE entrenador SET estado='1'  WHERE `identrenador`='%s' ",$identrenador);
    return ejecutarConsulta($sql);
  }

  public function mostrar($identrenador)
  {
    $sql=sprintf("SELECT * FROM `entrenador` WHERE identrenador='%s'",$identrenador);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
      $sql="SELECT entrenador.identrenador,
      entrenador.cedula_entrenador,
      entrenador.nombre_entrenador,
      entrenador.apellido_entrenador,
      entrenador.direccion_entrenador,
      entrenador.email_entrenador,
      entrenador.telefono_entrenador,
      entrenador.celular_entrenador,
      entrenador.imagen_entrenador,
      entrenador.estado,
      sucursal.nombre_sucursal  FROM `entrenador` INNER JOIN sucursal on sucursal.idsucursal=entrenador.sucursal_idsucursal";
     return ejecutarConsulta($sql);

  }

   public function select(){
    $sql="SELECT * from entrenador where estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
