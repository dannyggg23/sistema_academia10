<?php
require "../config/Conexion.php";
Class Representante
{
  public function _construct(){

  }

  public function insertar($cedula_representante,$nombre_representante,$email_representante,$direccion_representante,$telefono_representante,$genero_representante,$fecha_nacimiento_representante,$parentesco_respresentante,$celular_representante,$lugar_trabajo_representante,$cedula_conyugue_representante,$nombre_conyugue_representante,$barrio_representante,$ciudad_representante){
    $sql=sprintf("INSERT INTO `representante`
    ( `cedula_representante`, `nombre_representante`, `email_representante`, 
    `direccion_representante`, `telefono_representante`, `usuario`, `clave` , genero_representante,
fecha_nacimiento_representante,
parentesco_respresentante,
celular_representante,
lugar_trabajo_representante,
cedula_conyugue_representante,
nombre_conyugue_representante,
barrio_representante,
ciudad_representante
) 
    VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
    $cedula_representante,$nombre_representante,$email_representante,$direccion_representante,
    $telefono_representante,$cedula_representante,$cedula_representante,$genero_representante,
$fecha_nacimiento_representante,
$parentesco_respresentante,
$celular_representante,
$lugar_trabajo_representante,
$cedula_conyugue_representante,
$nombre_conyugue_representante,
$barrio_representante,
$ciudad_representante
);

    return ejecutarConsulta($sql);
  }

  public function insertarModal($cedula_representante,$nombre_representante,$email_representante,$direccion_representante,$telefono_representante,$genero_representante,$fecha_nacimiento_representante,$parentesco_respresentante,$celular_representante,$lugar_trabajo_representante,$cedula_conyugue_representante,$nombre_conyugue_representante,$barrio_representante,$ciudad_representante){
    $sql=sprintf("INSERT INTO `representante`
    ( `cedula_representante`, `nombre_representante`, `email_representante`, 
    `direccion_representante`, `telefono_representante`, `usuario`, `clave` , genero_representante,
fecha_nacimiento_representante,
parentesco_respresentante,
celular_representante,
lugar_trabajo_representante,
cedula_conyugue_representante,
nombre_conyugue_representante,
barrio_representante,
ciudad_representante
) 
    VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
    $cedula_representante,$nombre_representante,$email_representante,$direccion_representante,
    $telefono_representante,$cedula_representante,$cedula_representante,$genero_representante,
$fecha_nacimiento_representante,
$parentesco_respresentante,
$celular_representante,
$lugar_trabajo_representante,
$cedula_conyugue_representante,
$nombre_conyugue_representante,
$barrio_representante,
$ciudad_representante
);

    return ejecutarConsulta_retornarID($sql);
  }


  public function editar($idrepresentante,$cedula_representante,$nombre_representante,$email_representante,$direccion_representante,$telefono_representante,$genero_representante,$fecha_nacimiento_representante,$parentesco_respresentante,$celular_representante,$lugar_trabajo_representante,$cedula_conyugue_representante,
  $nombre_conyugue_representante,
  $barrio_representante,
  $ciudad_representante)
  {
  $sql=sprintf("UPDATE `representante` SET 
    `cedula_representante`='%s',
    `nombre_representante`='%s',
    `email_representante`='%s',
    `direccion_representante`='%s',
    `telefono_representante`='%s',
    `genero_representante`='%s',
    `fecha_nacimiento_representante`='%s',
    `parentesco_respresentante`='%s',
    `celular_representante`='%s',
    `lugar_trabajo_representante`='%s',
    cedula_conyugue_representante='%s',
    nombre_conyugue_representante='%s',
    barrio_representante='%s',
    ciudad_representante='%s'
   WHERE `idrepresentante`='%s'",
   $cedula_representante,
   $nombre_representante,
   $email_representante,
   $direccion_representante,
   $telefono_representante,
   $genero_representante,
   $fecha_nacimiento_representante,
   $parentesco_respresentante,
   $celular_representante,
   $lugar_trabajo_representante,
   $cedula_conyugue_representante,
   $nombre_conyugue_representante,
   $barrio_representante,
   $ciudad_representante,
   $idrepresentante);

    return ejecutarConsulta($sql);
  }




  public function editar_movil($idrepresentante,$cedula_representante,$nombre_representante,$email_representante,$direccion_representante,$telefono_representante,$genero_representante,$fecha_nacimiento_representante,$parentesco_respresentante,$celular_representante,$lugar_trabajo_representante,$cedula_conyugue_representante,
  $nombre_conyugue_representante,
  $barrio_representante,
  $ciudad_representante,$usuario,$clave)
  {
  $sql=sprintf("UPDATE `representante` SET 
    `cedula_representante`='%s',
    `nombre_representante`='%s',
    `email_representante`='%s',
    `direccion_representante`='%s',
    `telefono_representante`='%s',
    `genero_representante`='%s',
    `fecha_nacimiento_representante`='%s',
    `parentesco_respresentante`='%s',
    `celular_representante`='%s',
    `lugar_trabajo_representante`='%s',
    cedula_conyugue_representante='%s',
    nombre_conyugue_representante='%s',
    barrio_representante='%s',
    ciudad_representante='%s',
    usuario='%s',
    clave='%s'
   WHERE `idrepresentante`='%s'",
   $cedula_representante,
   $nombre_representante,
   $email_representante,
   $direccion_representante,
   $telefono_representante,
   $genero_representante,
   $fecha_nacimiento_representante,
   $parentesco_respresentante,
   $celular_representante,
   $lugar_trabajo_representante,
   $cedula_conyugue_representante,
   $nombre_conyugue_representante,
   $barrio_representante,
   $ciudad_representante,
   $usuario,
   $clave,
   $idrepresentante);

    return ejecutarConsulta($sql);
  }


  public function desactivar($idrepresentante)
  {
    $sql=sprintf("UPDATE representante SET estado='0'  WHERE `idrepresentante`='%s' ",$idrepresentante);
    return ejecutarConsulta($sql);
  }
  public function activar($idrepresentante)
  {
    $sql=sprintf("UPDATE representante SET estado='1'  WHERE `idrepresentante`='%s' ",$idrepresentante);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idrepresentante)
  {
    $sql=sprintf("SELECT * FROM `representante` WHERE idrepresentante='%s'",$idrepresentante);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT * from representante";
    return ejecutarConsulta($sql);
  }

    public function select(){
    $sql="SELECT * from representante where estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
