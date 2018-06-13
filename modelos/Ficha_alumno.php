<?php
require "../config/Conexion.php";
Class Ficha_alumno
{
  public function _construct(){

  }


  public function insertar($numeroFicha_alumno,$fechaApertura_alumno,$alumno_idalumno,$sucursal_categorias_idsucursal_categorias,$descuento_ficha_alumno){
    $sql=sprintf("INSERT INTO `ficha_alumno`( `numeroFicha_alumno`, `fechaApertura_alumno`,`alumno_idalumno`,sucursal_categorias_idsucursal_categorias,descuento_ficha_alumno,fecha_acceso) VALUES ('%s','%s','%s','%s','%s',CURDATE())",$numeroFicha_alumno,$fechaApertura_alumno,$alumno_idalumno,$sucursal_categorias_idsucursal_categorias,$descuento_ficha_alumno);

    return ejecutarConsulta($sql);

  }

  public function editar($idficha_alumno,$numeroFicha_alumno,$fechaApertura_alumno,$alumno_idalumno,$sucursal_categorias_idsucursal_categorias,$descuento_ficha_alumno)
  {
  $sql=sprintf("UPDATE `ficha_alumno` SET 
   
    `numeroFicha_alumno`='%s',
    `fechaApertura_alumno`='%s',
    `alumno_idalumno`='%s',
    `sucursal_categorias_idsucursal_categorias`='%s',
    descuento_ficha_alumno='%s' 
    WHERE  `idficha_alumno`='%s'",$numeroFicha_alumno,$fechaApertura_alumno,$alumno_idalumno,$sucursal_categorias_idsucursal_categorias,$descuento_ficha_alumno,$idficha_alumno);
    return ejecutarConsulta($sql);

  }
  public function desactivar($idficha_alumno)
  {
    $sql=sprintf("UPDATE ficha_alumno SET estado='0'  WHERE `idficha_alumno`='%s' ",$idficha_alumno);
    return ejecutarConsulta($sql);
  }


  public function activar($idficha_alumno)
  {
    $sql=sprintf("UPDATE ficha_alumno SET estado='1'  WHERE `idficha_alumno`='%s' ",$idficha_alumno);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idficha_alumno)
  {
    $sql=sprintf("SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,sucursal_categorias.sucursal_idsucursal,sucursal_categorias.categoria_idcategoria FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.idficha_alumno='%s'",$idficha_alumno);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario";
    return ejecutarConsulta($sql);
  }

   public function listarActivos(){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario where ficha_alumno.estado=1";
    return ejecutarConsulta($sql);
  }

  public function listarDeudores(){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE()";
    return ejecutarConsulta($sql);
  }
}
 ?>
