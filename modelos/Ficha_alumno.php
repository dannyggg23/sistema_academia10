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
    $sql="SELECT ficha_alumno.*,alumno.genero_alumno,alumno.cedula_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,horario.hora_inicio,horario.hora_fin,CURDATE() as fecha_actual FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario ORDER BY ficha_alumno.fechaApertura_alumno DESC";
    return ejecutarConsulta($sql);
  }

   public function listarActivos(){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario where ficha_alumno.estado=1";
    return ejecutarConsulta($sql);
  }

   public function listarFicha_Representante($id){
    $sql="SELECT  ficha_alumno.*,alumno.genero_alumno,alumno.cedula_alumno,alumno.nombre_alumno,alumno.imagen_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,horario.hora_inicio,horario.hora_fin,CURDATE() as fecha_actual,representante.idrepresentante FROM `ficha_alumno` 
    INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno 
    INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias 
    INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria 
    INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal 
    INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario
    INNER JOIN representante on representante.idrepresentante=alumno.representante_idrepresentante where ficha_alumno.estado=1 and representante.idrepresentante='$id'";
    return ejecutarConsulta($sql);
  }

  public function listarDeudores(){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE()";
    return ejecutarConsulta($sql);
  }

  public function listarDeudoresSucursales($id){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE() and sucursal.idsucursal='$id'";
    return ejecutarConsulta($sql);
  }

  public function listarDeudoresCategorias($id){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE() and categoria.idcategoria='$id'";
    return ejecutarConsulta($sql);
  }

  public function listarDeudoresSucursalCategorias($idsucursal,$idcategoria){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE() AND sucursal.idsucursal='$idsucursal' AND categoria.idcategoria='$idcategoria'";
    return ejecutarConsulta($sql);
  }
  
  public function listarDeudoresHorario($id){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE() AND horario.idhorario='$id'";
    return ejecutarConsulta($sql);
  }
  
  public function listarDeudoresCategoriaHorario($idcategoria,$idhorario){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE() AND categoria.idcategoria='$idcategoria' AND horario.idhorario='$idhorario'";
    return ejecutarConsulta($sql);
  }
  
  public function listarDeudoresSucursalesCategoriaHorario($idsucursal,$idcategoria,$idhorario){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE() AND sucursal.idsucursal='$idsucursal' AND categoria.idcategoria='$idcategoria' AND horario.idhorario='$idhorario'";
    return ejecutarConsulta($sql);
  }

  ###################################################################################
  public function listarDeudoresSucursales1($id){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE sucursal.idsucursal='$id'";
    return ejecutarConsulta($sql);
  }
 
  public function listarDeudoresCategorias1($id){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE categoria.idcategoria='$id'";
    return ejecutarConsulta($sql);
  }

  public function listarDeudoresSucursalCategorias1($idsucursal,$idcategoria){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE sucursal.idsucursal='$idsucursal' AND categoria.idcategoria='$idcategoria'";
    return ejecutarConsulta($sql);
  }
  
  public function listarDeudoresHorario1($id){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE horario.idhorario='$id'";
    return ejecutarConsulta($sql);
  }
  
  public function listarDeudoresCategoriaHorario1($idcategoria,$idhorario){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE categoria.idcategoria='$idcategoria' AND horario.idhorario='$idhorario'";
    return ejecutarConsulta($sql);
  }
  
  public function listarDeudoresSucursalesCategoriaHorario1($idsucursal,$idcategoria,$idhorario){
    $sql="SELECT ficha_alumno.*,alumno.cedula_alumno,alumno.genero_alumno,alumno.nombre_alumno,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre as horario,alumno.imagen_alumno FROM `ficha_alumno` INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario WHERE sucursal.idsucursal='$idsucursal' AND categoria.idcategoria='$idcategoria' AND horario.idhorario='$idhorario'";
    return ejecutarConsulta($sql);
  }
  
  ###################################################################################
  

  public function listarfichaPDF($idficha_alumno){
    $sql=sprintf("SELECT alumno.nombre_alumno,alumno.imagen_alumno,alumno.genero_alumno,alumno.talla_alumno,alumno.peso_alumno,alumno.fecha_nacimiento,TIMESTAMPDIFF(YEAR,alumno.fecha_nacimiento,CURDATE()) AS edad,alumno.cedula_alumno,alumno.escuela_alumno,alumno.posicion_alumno,alumno.informacion_alumno,
    representante.nombre_representante,representante.cedula_representante,representante.nombre_conyugue_representante,
    representante.cedula_conyugue_representante,representante.barrio_representante,representante.telefono_representante,representante.email_representante,
    ciudad.ciudad,representante.parentesco_respresentante,representante.direccion_representante,ficha_alumno.fechaApertura_alumno,
        categoria.nombre_categoria,horario.nombre,CONCAT(horario.hora_inicio,' ',horario.hora_fin) as horario,
        entrenador.nombre_entrenador
        from alumno INNER JOIN representante ON representante.idrepresentante=alumno.representante_idrepresentante
        INNER JOIN ciudad on ciudad.idCiudad=representante.ciudad_representante
        INNER JOIN ficha_alumno ON ficha_alumno.alumno_idalumno=alumno.idalumno
        INNER JOIN sucursal_categorias ON sucursal_categorias.idsucursal_categorias=ficha_alumno.sucursal_categorias_idsucursal_categorias
        INNER JOIN categoria on categoria.idcategoria=sucursal_categorias.categoria_idcategoria
        INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario
        INNER JOIN ficha_entrenador ON ficha_entrenador.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias
        INNER JOIN entrenador ON ficha_entrenador.entrenador_identrenador=entrenador.identrenador WHERE ficha_alumno.idficha_alumno='%s'",$idficha_alumno);
    return ejecutarConsulta($sql);
  }

}
 ?>
