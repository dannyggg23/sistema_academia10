<?php
require "../config/Conexion.php";
Class Usuario
{
  public function _construct(){

  }

  public function insertar($nombre_usuario,$cedula_usuario,$direccion_usuario,$telefono_usuario,$celular_usuario,$email_usuario,$cargo_usuario,$login_usuario,$clave_usuario,$imagen_usuario,$permisos){
    $sql=sprintf("INSERT INTO `usuario`(`nombre_usuario`, `cedula_usuario`, `direccion_usuario`, `telefono_usuario`, `celular_usuario`, `email_usuario`, `cargo_usuario`, `login_usuario`, `clave_usuario`, `imagen_usuario`) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$nombre_usuario,$cedula_usuario,$direccion_usuario,$telefono_usuario,$celular_usuario,$email_usuario,$cargo_usuario,$login_usuario,$clave_usuario,$imagen_usuario);
    //return ejecutarConsulta($sql);

    $idusuarionew=ejecutarConsulta_retornarID($sql);

    $num_elementos=0;
    $sw=true;

    while ($num_elementos < count($permisos)) {
      $sql_detalle=sprintf("INSERT INTO `usuario_permiso`(`permiso_idpermiso`, `usuario_idusuario`) VALUES ('%s','%s')",$permisos[$num_elementos],$idusuarionew);


      ejecutarConsulta($sql_detalle) or $sw=false;


      $num_elementos=$num_elementos+1;

    }
    return $sw;

  }

  public function editar($idusuario,$nombre_usuario,$cedula_usuario,$direccion_usuario,$telefono_usuario,$celular_usuario,$email_usuario,$cargo_usuario,$login_usuario,$clave_usuario,$imagen_usuario,$permisos)
  {
  $sql=sprintf("UPDATE `usuario` SET 
    `nombre_usuario`='%s',
    `cedula_usuario`='%s',
    `direccion_usuario`='%s',
    `telefono_usuario`='%s',
    `celular_usuario`='%s',
    `email_usuario`='%s',
    `cargo_usuario`='%s',
    `login_usuario`='%s',
    `clave_usuario`='%s',
    `imagen_usuario`='%s'
    WHERE  `idusuario`='%s'",$nombre_usuario,$cedula_usuario,$direccion_usuario,$telefono_usuario,$celular_usuario,$email_usuario,$cargo_usuario,$login_usuario,$clave_usuario,$imagen_usuario,$idusuario);
     ejecutarConsulta($sql);

     //Eiminar todos los permisos asisgnados poara volverlos a insertar

     $sqldel=sprintf("DELETE FROM usuario_permiso WHERE usuario_idusuario='%s'",$idusuario);
     ejecutarConsulta($sqldel);

     $num_elementos=0;
     $sw=true;

    while ($num_elementos < count($permisos)) {
      $sql_detalle=sprintf("INSERT INTO `usuario_permiso`(`permiso_idpermiso`, `usuario_idusuario`) VALUES ('%s','%s')",$permisos[$num_elementos],$idusuario);
      ejecutarConsulta($sql_detalle) or $sw=false;
      $num_elementos=$num_elementos+1;
    }
    return $sw;

  }

  public function desactivar($idusuario)
  {
    $sql=sprintf("UPDATE usuario SET estado='0'  WHERE `idusuario`='%s' ",$idusuario);
    return ejecutarConsulta($sql);
  }
  public function activar($idusuario)
  {
    $sql=sprintf("UPDATE usuario SET estado='1'  WHERE `idusuario`='%s' ",$idusuario);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idusuario)
  {
    $sql=sprintf("SELECT * FROM `usuario` WHERE idusuario='%s'",$idusuario);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
      $sql="SELECT * from usuario";
     return ejecutarConsulta($sql);

  }

   public function select(){
    $sql="SELECT * from usuario where estado=1";
    return ejecutarConsulta($sql);
  }

  //listar los permisos marcados
  public function listarmarcados($idusuario){
     $sql=sprintf("SELECT * FROM `usuario_permiso` WHERE usuario_idusuario='%s'",$idusuario);
     return ejecutarConsulta($sql);
  }

  //Funcion para verificar el acceso al sistema

  public function verificar($login,$clave){

    $sql=sprintf("SELECT `idusuario`, `nombre_usuario`, `cedula_usuario`, `direccion_usuario`, `telefono_usuario`, `celular_usuario`, `email_usuario`, `cargo_usuario`,`imagen_usuario` FROM `usuario` WHERE  login_usuario = '%s' AND clave_usuario='%s' AND estado='1'",$login,$clave);
      return ejecutarConsulta($sql);
  }
}
 ?>
