<?php
require "../config/Conexion.php";
Class Asistencia
{
  public function _construct(){

  }

public function insertar($asistencia_alumno, $fecha_asistencia,$ficha_alumno_idficha_alumno){

    $sql_select="SELECT * FROM `asistencia` 
    WHERE asistencia.ficha_alumno_idficha_alumno='$ficha_alumno_idficha_alumno' 
    AND asistencia.fecha_asistencia='$fecha_asistencia'";

    $row=ejecutarConsulta($sql_select);
    $reg=$row->fetch_object();

    if(empty($reg))
    {
      $sql=sprintf("INSERT INTO `asistencia`(`asistencia_alumno`, `fecha_asistencia`, `ficha_alumno_idficha_alumno`) VALUES ('$asistencia_alumno','$fecha_asistencia','$ficha_alumno_idficha_alumno')");
      return ejecutarConsulta($sql);
    }
    else
    {
       $sql=sprintf("UPDATE `asistencia` SET 
        `asistencia_alumno`='$asistencia_alumno'
        WHERE fecha_asistencia='$fecha_asistencia' AND 
        ficha_alumno_idficha_alumno='$ficha_alumno_idficha_alumno' ");
      return ejecutarConsulta($sql);
    }

  }

  public function editar($idasistencia,$asistencia_alumno, $fecha_asistencia,$ficha_alumno_idficha_alumno){

      $sql=sprintf("UPDATE `asistencia` SET 
        `asistencia_alumno`='$asistencia_alumno',
        `fecha_asistencia`='$fecha_asistencia',
        `ficha_alumno_idficha_alumno`='$ficha_alumno_idficha_alumno' 
        WHERE  `idasistencia`='$idasistencia'");
      return ejecutarConsulta($sql);
   
  }


  public function listar(){
    $sql="SELECT 
    `ficha_alumno`.`numeroFicha_alumno`,
    `alumno`.`nombre_alumno`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre` as horario,
    `asistencia`.`fecha_asistencia`,
    `asistencia`.`asistencia_alumno`,
    `entrenador`.`nombre_entrenador`
  FROM
    `ficha_alumno`
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
    INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `ficha_entrenador` ON (`ficha_entrenador`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
    ORDER BY asistencia.fecha_asistencia DESC
  ";
   return ejecutarConsulta($sql);
}
public function listarAsistenciaSucursales($id){
    $sql="SELECT 
    `ficha_alumno`.`numeroFicha_alumno`,
    `alumno`.`nombre_alumno`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre` as horario,
    `asistencia`.`fecha_asistencia`,
    `asistencia`.`asistencia_alumno`,
    `entrenador`.`nombre_entrenador`
  FROM
    `ficha_alumno`
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
    INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `ficha_entrenador` ON (`ficha_entrenador`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
    WHERE sucursal.idsucursal='$id'
    ORDER BY asistencia.fecha_asistencia DESC
  ";
   return ejecutarConsulta($sql);
}

public function listarAsistenciaCategorias($id){
    $sql="SELECT 
    `ficha_alumno`.`numeroFicha_alumno`,
    `alumno`.`nombre_alumno`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre` as horario,
    `asistencia`.`fecha_asistencia`,
    `asistencia`.`asistencia_alumno`,
    `entrenador`.`nombre_entrenador`
  FROM
    `ficha_alumno`
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
    INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `ficha_entrenador` ON (`ficha_entrenador`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
    WHERE categoria.idcategoria='$id'
    ORDER BY asistencia.fecha_asistencia DESC
  ";
   return ejecutarConsulta($sql);
}
public function listarAsistenciaSucursalCategorias($idsucursal,$idcategoria){
    $sql="SELECT 
    `ficha_alumno`.`numeroFicha_alumno`,
    `alumno`.`nombre_alumno`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre` as horario,
    `asistencia`.`fecha_asistencia`,
    `asistencia`.`asistencia_alumno`,
    `entrenador`.`nombre_entrenador`
  FROM
    `ficha_alumno`
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
    INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `ficha_entrenador` ON (`ficha_entrenador`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
    WHERE sucursal.idsucursal='$idsucursal' AND categoria.idcategoria='$idcategoria'
    ORDER BY asistencia.fecha_asistencia DESC
  ";
   return ejecutarConsulta($sql);
}

public function listarAsistenciaHorario($id){
    $sql="SELECT 
    `ficha_alumno`.`numeroFicha_alumno`,
    `alumno`.`nombre_alumno`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre` as horario,
    `asistencia`.`fecha_asistencia`,
    `asistencia`.`asistencia_alumno`,
    `entrenador`.`nombre_entrenador`
  FROM
    `ficha_alumno`
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
    INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `ficha_entrenador` ON (`ficha_entrenador`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
    WHERE horario.idhorario='$id'
    ORDER BY asistencia.fecha_asistencia DESC
  ";
   return ejecutarConsulta($sql);
}

public function listarAsistenciaSucursalesCategoriaHorario($idsucursal,$idcategoria,$idhorario){
    $sql="SELECT 
    `ficha_alumno`.`numeroFicha_alumno`,
    `alumno`.`nombre_alumno`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre` as horario,
    `asistencia`.`fecha_asistencia`,
    `asistencia`.`asistencia_alumno`,
    `entrenador`.`nombre_entrenador`
  FROM
    `ficha_alumno`
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
    INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `ficha_entrenador` ON (`ficha_entrenador`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
    WHERE sucursal.idsucursal='$idsucursal' AND categoria.idcategoria='$idcategoria' AND horario.idhorario='$idhorario'
    ORDER BY asistencia.fecha_asistencia DESC
  ";
   return ejecutarConsulta($sql);
}

public function listarFecha($finicio,$ffin){
    $sql="SELECT 
    `ficha_alumno`.`numeroFicha_alumno`,
    `alumno`.`nombre_alumno`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre` as horario,
    `asistencia`.`fecha_asistencia`,
    `asistencia`.`asistencia_alumno`,
    `entrenador`.`nombre_entrenador`
  FROM
    `ficha_alumno`
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
    INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `ficha_entrenador` ON (`ficha_entrenador`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
    WHERE asistencia.fecha_asistencia >= '$finicio' AND asistencia.fecha_asistencia <= '$ffin'
    ORDER BY asistencia.fecha_asistencia DESC
  ";
   return ejecutarConsulta($sql);
}


public function listarfechaRepresentante($finicio,$ffin,$alumno){
    $sql="SELECT 
    `ficha_alumno`.`numeroFicha_alumno`,
    `alumno`.`nombre_alumno`,
    `sucursal`.`nombre_sucursal`,
    `categoria`.`nombre_categoria`,
    `horario`.`nombre` as horario,
    `asistencia`.`fecha_asistencia`,
    `asistencia`.`asistencia_alumno`,
    `entrenador`.`nombre_entrenador`
  FROM
    `ficha_alumno`
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
    INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
    INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
    INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
    INNER JOIN `ficha_entrenador` ON (`ficha_entrenador`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
    INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
    WHERE asistencia.fecha_asistencia >= '$finicio' AND asistencia.fecha_asistencia <= '$ffin' AND ficha_alumno.idficha_alumno='$alumno'
    ORDER BY asistencia.fecha_asistencia DESC
  ";
   return ejecutarConsulta($sql);
}
  
}
 ?>
