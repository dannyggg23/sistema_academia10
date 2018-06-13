<?php
require "../config/Conexion.php";
Class Sucursal
{
  public function _construct(){

  }

  public function insertar( $nombre_sucursal,$direrccion_ducursal,$telefono_sucursal,$encargado_sucursal,$ciudad_idCiudad,$imagen){
    $sql=sprintf("INSERT INTO `sucursal`( `nombre_sucursal`, `direrccion_ducursal`, `telefono_sucursal`, `encargado_sucursal`, `ciudad_idCiudad`,imagen) VALUES ('%s','%s','%s','%s','%s','%s')",$nombre_sucursal,$direrccion_ducursal,$telefono_sucursal,$encargado_sucursal,$ciudad_idCiudad,$imagen);
    return ejecutarConsulta($sql);
  }

  public function editar($idsucursal,$nombre_sucursal,$direrccion_ducursal,$telefono_sucursal,$encargado_sucursal,$ciudad_idCiudad,$imagen)
  {
  $sql=sprintf("UPDATE `sucursal` SET
    `nombre_sucursal`='%s',
    `direrccion_ducursal`='%s',
    `telefono_sucursal`='%s',
    `encargado_sucursal`='%s',
    `ciudad_idCiudad`='%s',
    `imagen`='%s'
    WHERE `idsucursal`='%s'",$nombre_sucursal,$direrccion_ducursal,$telefono_sucursal,$encargado_sucursal,$ciudad_idCiudad,$imagen,$idsucursal);
    return ejecutarConsulta($sql);
  }
  public function desactivar($idsucursal)
  {
    $sql=sprintf("UPDATE sucursal SET estado='0'  WHERE `idsucursal`='%s' ",$idsucursal);
    return ejecutarConsulta($sql);
  }
  public function activar($idsucursal)
  {
    $sql=sprintf("UPDATE sucursal SET estado='1'  WHERE `idsucursal`='%s' ",$idsucursal);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idsucursal)
  {
    $sql=sprintf("SELECT * FROM `sucursal` WHERE idsucursal='%s'",$idsucursal);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT sucursal.idsucursal,sucursal.nombre_sucursal,sucursal.direrccion_ducursal,sucursal.telefono_sucursal,sucursal.encargado_sucursal,sucursal.estado,ciudad.ciudad,provincia.provincia,sucursal.imagen  FROM `sucursal` INNER JOIN ciudad ON sucursal.ciudad_idCiudad=ciudad.idCiudad INNER JOIN provincia where provincia.idProvincia=ciudad.IDPROVINCIA";
    return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * from sucursal where estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
