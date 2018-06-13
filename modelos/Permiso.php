<?php
require "../config/Conexion.php";
Class Permiso
{
  public function _construct(){
  }
  public function listar(){
    $sql="SELECT * from permiso";
    return ejecutarConsulta($sql);
  }
}
 ?>
