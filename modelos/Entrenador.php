<?php
require "../config/Conexion.php";
Class Entrenador
{
  public function _construct(){

  }

  public function insertar($cedula_entrenador,
  $nombre_entrenador,
  $direccion_entrenador,
  $email_entrenador,
  $telefono_entrenador,
  $celular_entrenador,
  $imagen_entrenador,
  $descripcion,
  $genero_entrenador,
  $titulo_entrenador,
  $fechanacimiento_entrenador,
  $idsucursal_categorias,
  $bandera){

    if($bandera=="true")
    {
      $sql=sprintf("INSERT INTO `entrenador`( 
        `cedula_entrenador`, 
        `nombre_entrenador`,
        `direccion_entrenador`,
        `email_entrenador`,
        `telefono_entrenador`, 
        `celular_entrenador`,
        `imagen_entrenador`,
        `usuario`,
        `clave`,
        descripcion,
        genero_entrenador,
        titulo_entrenador,
        fechanacimiento_entrenador)
         VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
         $cedula_entrenador,
         $nombre_entrenador,
         $direccion_entrenador,
         $email_entrenador,
         $telefono_entrenador,
         $celular_entrenador,
         $imagen_entrenador,
         $cedula_entrenador,
         $cedula_entrenador,
         $descripcion, 
         $genero_entrenador,
         $titulo_entrenador,
         $fechanacimiento_entrenador);

        $identrenador= ejecutarConsulta_retornarID($sql);
        $sw=true;

        $sql_ficha_entrenador=sprintf("INSERT INTO `ficha_entrenador`( `fechaApertura_entrenador`,  `entrenador_identrenador`, `sucursal_categorias_idsucursal_categorias`) VALUES (CURDATE(),'%s','%s')",$identrenador,$idsucursal_categorias);
      
       $sql_categoria=sprintf("UPDATE `sucursal_categorias` SET 
       `disponible`=1
       WHERE idsucursal_categorias='%s'",$idsucursal_categorias);
        ejecutarConsulta($sql_categoria) or $sw=false;
        ejecutarConsulta($sql_ficha_entrenador) or $sw=false;
        return $sw;
    }

    else
    {
      $sql=sprintf("INSERT INTO `entrenador`( 
        `cedula_entrenador`, 
        `nombre_entrenador`,
        `direccion_entrenador`,
        `email_entrenador`,
        `telefono_entrenador`, 
        `celular_entrenador`,
        `imagen_entrenador`,
        `usuario`,
        `clave`,
        descripcion,
        genero_entrenador,
        titulo_entrenador,
        fechanacimiento_entrenador)
         VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
         $cedula_entrenador,
         $nombre_entrenador,
         $direccion_entrenador,
         $email_entrenador,
         $telefono_entrenador,
         $celular_entrenador,
         $imagen_entrenador,
         $cedula_entrenador,
         $cedula_entrenador,
         $descripcion, 
         $genero_entrenador,
         $titulo_entrenador,
         $fechanacimiento_entrenador);
        return ejecutarConsulta($sql);

    }
   
  }

  public function editar($identrenador,
  $cedula_entrenador,
  $nombre_entrenador,
  $direccion_entrenador,
  $email_entrenador,
  $telefono_entrenador,
  $celular_entrenador,
  $imagen_entrenador,
  $descripcion,
  $genero_entrenador,
  $titulo_entrenador,
  $fechanacimiento_entrenador)
  {
  $sql=sprintf("UPDATE `entrenador` SET 
    `cedula_entrenador`='%s',
    `nombre_entrenador`='%s',
    `direccion_entrenador`='%s',
    `email_entrenador`='%s',
    `telefono_entrenador`='%s',
    `celular_entrenador`='%s',
    `imagen_entrenador`='%s',
    `descripcion`='%s',
    genero_entrenador='%s',
    titulo_entrenador='%s',
    fechanacimiento_entrenador='%s'
     WHERE `identrenador`='%s'",$cedula_entrenador,
     $nombre_entrenador,
     $direccion_entrenador,
     $email_entrenador,
     $telefono_entrenador,
     $celular_entrenador,
     $imagen_entrenador,
     $descripcion,
     $genero_entrenador,
     $titulo_entrenador,
     $fechanacimiento_entrenador,
     $identrenador);
    return ejecutarConsulta($sql);
  }
///
public function editar_movil($identrenador,
  $cedula_entrenador,
  $nombre_entrenador,
  $direccion_entrenador,
  $email_entrenador,
  $telefono_entrenador,
  $celular_entrenador,
  $descripcion,
  $genero_entrenador,
  $titulo_entrenador,
  $fechanacimiento_entrenador,
  $usuario,
  $clave)
  {
  $sql=sprintf("UPDATE `entrenador` SET 
    `cedula_entrenador`='%s',
    `nombre_entrenador`='%s',
    `direccion_entrenador`='%s',
    `email_entrenador`='%s',
    `telefono_entrenador`='%s',
    `celular_entrenador`='%s',
    `descripcion`='%s',
    genero_entrenador='%s',
    titulo_entrenador='%s',
    fechanacimiento_entrenador='%s',
    usuario='%s',
    clave='%s'
     WHERE `identrenador`='%s'",$cedula_entrenador,
     $nombre_entrenador,
     $direccion_entrenador,
     $email_entrenador,
     $telefono_entrenador,
     $celular_entrenador,
     $descripcion,
     $genero_entrenador,
     $titulo_entrenador,
     $fechanacimiento_entrenador,
     $usuario,
     $clave,
     $identrenador);
    return ejecutarConsulta($sql);
  }

//
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
      $sql="SELECT `identrenador`, `cedula_entrenador`, `nombre_entrenador`, `direccion_entrenador`, `email_entrenador`, `telefono_entrenador`, `celular_entrenador`, `imagen_entrenador`, `usuario`, `clave`, `estado`, `token`, `descripcion`, `genero_entrenador`, `titulo_entrenador`, `fechanacimiento_entrenador`,TIMESTAMPDIFF(YEAR,entrenador.fechanacimiento_entrenador,CURDATE()) AS edad FROM `entrenador`"; 
     return ejecutarConsulta($sql);

  }

   public function select(){
    $sql="SELECT * from entrenador where estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
