
<?php
require "../config/Conexion.php";
Class Ficha_entrenador
{
  public function _construct(){

  }

  public function insertar($entrenador_identrenador,$sucursal_categorias_idsucursal_categorias)
  {
    $sql=sprintf("INSERT INTO `ficha_entrenador`( `fechaApertura_entrenador`,
    `entrenador_identrenador`,
    `sucursal_categorias_idsucursal_categorias`) 
    VALUES (CURDATE(),'%s','%s')",$entrenador_identrenador,$sucursal_categorias_idsucursal_categorias);

$sql_categoria=sprintf("UPDATE `sucursal_categorias` SET 
`disponible`=1 
WHERE idsucursal_categorias='%s'",$sucursal_categorias_idsucursal_categorias);
 ejecutarConsulta($sql_categoria) or $sw=false;

    return ejecutarConsulta($sql);
  }


  public function desactivar($idficha_entrenador,$idsucursal_categorias)
  {

    $sql=sprintf("UPDATE ficha_entrenador SET estado='0'  WHERE `idficha_entrenador`='%s' ",$idficha_entrenador);
    $sql_categoria=sprintf("UPDATE `sucursal_categorias` SET 
       `disponible`=0 
       WHERE idsucursal_categorias='%s'",$idsucursal_categorias);
    $sw=true;
    ejecutarConsulta($sql_categoria) or $sw=false;
    return ejecutarConsulta($sql);

  }


  public function activar($idficha_entrenador,$idsucursal_categorias)
  {
    $sql=sprintf("UPDATE ficha_entrenador SET estado='1'  WHERE `idficha_entrenador`='%s' ",$idficha_entrenador);
    $sql_categoria=sprintf("UPDATE `sucursal_categorias` SET 
    `disponible`=1 
    WHERE idsucursal_categorias='%s'",$idsucursal_categorias);
    $sw=true;
    ejecutarConsulta($sql_categoria) or $sw=false;
    return ejecutarConsulta($sql);
  }


  public function mostrar($idficha_entrenador)
  {
    $sql=sprintf("SELECT * FROM `ficha_entrenador` WHERE idficha_entrenador='%s'",$idficha_entrenador);
    return ejecutarConsultaSimpleFila($sql);
  }


  public function listar(){
    $sql="SELECT entrenador.cedula_entrenador,entrenador.nombre_entrenador,ficha_entrenador.estado,ficha_entrenador.idficha_entrenador,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre,sucursal_categorias.idsucursal_categorias,horario.hora_inicio,horario.hora_fin from entrenador INNER JOIN ficha_entrenador on ficha_entrenador.entrenador_identrenador=entrenador.identrenador INNER JOIN sucursal_categorias on sucursal_categorias.idsucursal_categorias=ficha_entrenador.sucursal_categorias_idsucursal_categorias INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario";
    return ejecutarConsulta($sql);
  }


   public function select(){
    $sql="SELECT * from ficha_entrenador where estado=1";
    return ejecutarConsulta($sql);
  }
}
 ?>
