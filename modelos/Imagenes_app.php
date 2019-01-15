<?php
require "../config/Conexion.php";
Class Imagenes_app
{
  public function _construct(){

  }

  public function insertar($imagen ){
    $sql=("INSERT INTO `imagenes_app`(imagen) VALUES ('$imagen')");
    return ejecutarConsulta($sql);
  }

  public function editar($imagen,$idimagenes_app)
  {
  $sql=("UPDATE `imagenes_app` SET 
  `imagen`='$imagen'
   WHERE idimagenes_app='$idimagenes_app'");
    return ejecutarConsulta($sql);
  }
  public function desactivar($idimagenes_app)
  {
    $sql=sprintf("UPDATE imagenes_app SET estado='0'  WHERE `idimagenes_app`='%s' ",$idimagenes_app);
    return ejecutarConsulta($sql);
  }
  public function activar($idimagenes_app)
  {
    $sql=sprintf("UPDATE imagenes_app SET estado='1'  WHERE `idimagenes_app`='%s' ",$idimagenes_app);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idimagenes_app)
  {
    $sql=sprintf("SELECT * FROM `imagenes_app` WHERE idimagenes_app='%s'",$idimagenes_app);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT * FROM imagenes_app";
    return ejecutarConsulta($sql);
  }

}
 ?>
