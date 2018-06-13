
<?php
require "../config/Conexion.php";
Class Ficha_entrenador
{
  public function _construct(){

  }

  public function insertar($numeroFicha_entrenador,$fechaApertura_entrenador,$entrenador_identrenador,$categoria_idcategoria)
{
    $sql=sprintf("INSERT INTO `ficha_entrenador`(`numeroFicha_entrenador`, `fechaApertura_entrenador`,`entrenador_identrenador`, `categoria_idcategoria`) VALUES ('%s','%s','%s','%s')",$numeroFicha_entrenador,$fechaApertura_entrenador,$entrenador_identrenador,$categoria_idcategoria);

    return ejecutarConsulta($sql);
  }

  public function editar($idficha_entrenador,$numeroFicha_entrenador, $fechaApertura_entrenador,$entrenador_identrenador,$categoria_idcategoria)
  {
  $sql=sprintf("UPDATE `ficha_entrenador` SET 
   `numeroFicha_entrenador`='%s',
   `fechaApertura_entrenador`='%s',
   `entrenador_identrenador`='%s',
   `categoria_idcategoria`='%s' 
   WHERE `idficha_entrenador`='%s'",$numeroFicha_entrenador, $fechaApertura_entrenador,$entrenador_identrenador,$categoria_idcategoria,$idficha_entrenador);
    return ejecutarConsulta($sql);

  }
  public function desactivar($idficha_entrenador)
  {
    $sql=sprintf("UPDATE ficha_entrenador SET estado='0'  WHERE `idficha_entrenador`='%s' ",$idficha_entrenador);
    return ejecutarConsulta($sql);
  }
  public function activar($idficha_entrenador)
  {
    $sql=sprintf("UPDATE ficha_entrenador SET estado='1'  WHERE `idficha_entrenador`='%s' ",$idficha_entrenador);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idficha_entrenador)
  {
    $sql=sprintf("SELECT * FROM `ficha_entrenador` WHERE idficha_entrenador='%s'",$idficha_entrenador);
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql="SELECT 
    ficha_entrenador.idficha_entrenador,
    ficha_entrenador.numeroFicha_entrenador,
    ficha_entrenador.fechaApertura_entrenador,
    ficha_entrenador.estado,
    entrenador.cedula_entrenador,
    entrenador.nombre_entrenador,
    entrenador.apellido_entrenador,
    categoria.nombre_categoria,
    horario.hora_inicio,
    horario.hora_fin 
    from ficha_entrenador INNER JOIN entrenador on entrenador.identrenador=ficha_entrenador.entrenador_identrenador INNER JOIN categoria on categoria.idcategoria=ficha_entrenador.categoria_idcategoria INNER JOIN horario on horario.idhorario=categoria.horario_idhorario";
    return ejecutarConsulta($sql);
  }

   public function select(){
    $sql="SELECT * from ficha_entrenador where estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
