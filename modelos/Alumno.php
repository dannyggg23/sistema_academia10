<?php
require "../config/Conexion.php";
Class Alumno
{
  public function _construct(){

  }

  public function insertar($cedula_alumno,
  $nombre_alumno
  ,$genero_alumno,
  $imagen_alumno,
  $representante_idrepresentante,
  $tipo_sangre_alumno,
  $escuela_alumno,
  $fecha_nacimiento,
  $posicion_alumno,
  $peso_alumno,
  $talla_alumno,
  $informacion_alumno,
  $idsucursal_categorias,
  $descuento_ficha_alumno,
  $bandera){

    if($bandera=="true")
    {
      $sql=sprintf("INSERT INTO `alumno`
    (`cedula_alumno`, `nombre_alumno`, `genero_alumno`, `imagen_alumno`, `representante_idrepresentante`,
    `tipo_sangre_alumno`, `escuela_alumno`, `fecha_nacimiento`, `posicion_alumno`,peso_alumno,talla_alumno,informacion_alumno) 
     VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$cedula_alumno,$nombre_alumno,$genero_alumno,$imagen_alumno,$representante_idrepresentante,$tipo_sangre_alumno,$escuela_alumno,$fecha_nacimiento,$posicion_alumno,$peso_alumno,$talla_alumno,$informacion_alumno);
  //GUARDO EL ID DEL ALUMNO

  $idalumno=ejecutarConsulta_retornarID($sql);

 $sw=true;

 //INSERTO EN LA FICHA DEL ALUMNO

 if($cedula_alumno=="")
 {
   $cedula_alumno=$idalumno;
 }

  $sql_ficha_alumno=sprintf("INSERT INTO `ficha_alumno`
  ( `numeroFicha_alumno`,
   `fechaApertura_alumno`,
   `alumno_idalumno`, 
   `sucursal_categorias_idsucursal_categorias`,
   fecha_acceso,descuento_ficha_alumno)
    VALUES ('%s',CURDATE(),'%s','%s',CURDATE(),'%s')"
    ,$cedula_alumno,
    $idalumno,$idsucursal_categorias,
    $descuento_ficha_alumno);
    
  $idfich=ejecutarConsulta_retornarID($sql_ficha_alumno);
  
  
  return $idfich;

    }
    else
    {
      if($representante_idrepresentante=="")
      {
        $representante_idrepresentante=5;
      }

      $sql=sprintf("INSERT INTO `alumno`
      (`cedula_alumno`, `nombre_alumno`, `genero_alumno`, `imagen_alumno`, `representante_idrepresentante`,
      `tipo_sangre_alumno`, `escuela_alumno`, `fecha_nacimiento`, `posicion_alumno`,peso_alumno,talla_alumno,informacion_alumno) 
       VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$cedula_alumno,$nombre_alumno,$genero_alumno,$imagen_alumno,$representante_idrepresentante,$tipo_sangre_alumno,$escuela_alumno,$fecha_nacimiento,$posicion_alumno,$peso_alumno,$talla_alumno,$informacion_alumno);
    
    return ejecutarConsulta($sql);

    }

    

  }

  public function editar($idalumno,$cedula_alumno,$nombre_alumno,
  $genero_alumno,$imagen_alumno,$representante_idrepresentante,
  $tipo_sangre_alumno,$escuela_alumno,$fecha_nacimiento,$posicion_alumno,$peso_alumno,$talla_alumno,$informacion_alumno)
  {
    if($representante_idrepresentante=="")
      {
        $representante_idrepresentante=5;
      }

  $sql=sprintf("UPDATE `alumno` 
  SET `cedula_alumno`='%s',
  `nombre_alumno`='%s',
  `genero_alumno`='%s',
  `imagen_alumno`='%s',
  `representante_idrepresentante`='%s',
  `tipo_sangre_alumno`='%s',
  `escuela_alumno`='%s',
  `fecha_nacimiento`='%s',
  `posicion_alumno`='%s',
   peso_alumno='%s',
   talla_alumno='%s',
   informacion_alumno='%s' 
  WHERE `idalumno`='%s'",$cedula_alumno,$nombre_alumno,$genero_alumno,$imagen_alumno,$representante_idrepresentante,$tipo_sangre_alumno,$escuela_alumno,$fecha_nacimiento,$posicion_alumno,$peso_alumno,$talla_alumno,$informacion_alumno,$idalumno);

 return ejecutarConsulta($sql); 

  }

  public function desactivar($idalumno)
  {
    $sql=sprintf("UPDATE alumno SET estado='0'  WHERE `idalumno`='%s' ",$idalumno);
    return ejecutarConsulta($sql);
  }
  public function activar($idalumno)
  {
    $sql=sprintf("UPDATE alumno SET estado='1'  WHERE `idalumno`='%s' ",$idalumno);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idalumno)
  {
    $sql=sprintf("SELECT alumno.*,representante.cedula_representante,representante.nombre_representante from alumno INNER JOIN representante on representante.idrepresentante=alumno.representante_idrepresentante WHERE idalumno='%s'",$idalumno);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
      $sql="SELECT alumno.*,representante.cedula_representante,representante.nombre_representante,TIMESTAMPDIFF(YEAR,alumno.fecha_nacimiento,CURDATE()) AS edad FROM `alumno` INNER JOIN representante on representante.idrepresentante=alumno.representante_idrepresentante";
     return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * from alumno where estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
