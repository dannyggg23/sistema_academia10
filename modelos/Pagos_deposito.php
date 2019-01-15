<?php
require "../config/Conexion.php";
Class Pagos_deposito
{
  public function _construct(){

  }
 

  public function desactivar($idpagos_deposito)
  {
    $sql=sprintf("UPDATE pagos_deposito SET estado_aprobada='0'  WHERE `idpagos_deposito`='%s' ",$idpagos_deposito);
    return ejecutarConsulta($sql);
  }
  public function activar($idpagos_deposito)
  {
    $sql=sprintf("UPDATE pagos_deposito SET estado_aprobada='1'  WHERE `idpagos_deposito`='%s' ",$idpagos_deposito);
    return ejecutarConsulta($sql);
  }

  public function listar(){
    $sql="SELECT 
    `pagos_deposito`.`idpagos_deposito`,
    `pagos_deposito`.`imagen`,
    `pagos_deposito`.`fecha`,
    `pagos_deposito`.`ficha_alumno_idficha_alumno`,
    `pagos_deposito`.`descripcion`,
    `pagos_deposito`.`estado_aprobada`,
    `alumno`.`cedula_alumno`,
    `alumno`.`nombre_alumno`,
    `ficha_alumno`.`fecha_acceso`,
    `representante`.`cedula_representante`,
    `representante`.`nombre_representante`
  FROM
    `pagos_deposito`
    INNER JOIN `ficha_alumno` ON (`pagos_deposito`.`ficha_alumno_idficha_alumno` = `ficha_alumno`.`idficha_alumno`)
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `representante` ON (`alumno`.`representante_idrepresentante` = `representante`.`idrepresentante`)
    ORDER BY pagos_deposito.fecha DESC
  ";
    return ejecutarConsulta($sql);
  }

  public function mostrar($idpagos_deposito)
  {
    $sql=sprintf("SELECT 
    `pagos_deposito`.`idpagos_deposito`,
    `pagos_deposito`.`imagen`,
    `pagos_deposito`.`fecha`,
    `pagos_deposito`.`ficha_alumno_idficha_alumno`,
    `pagos_deposito`.`descripcion`,
    `pagos_deposito`.`estado_aprobada`,
    `alumno`.`cedula_alumno`,
    `alumno`.`nombre_alumno`,
    `ficha_alumno`.`fecha_acceso`,
    `representante`.`cedula_representante`,
    `representante`.`nombre_representante`
  FROM
    `pagos_deposito`
    INNER JOIN `ficha_alumno` ON (`pagos_deposito`.`ficha_alumno_idficha_alumno` = `ficha_alumno`.`idficha_alumno`)
    INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
    INNER JOIN `representante` ON (`alumno`.`representante_idrepresentante` = `representante`.`idrepresentante`)
     WHERE idpagos_deposito='%s'",$idpagos_deposito);
    return ejecutarConsultaSimpleFila($sql);
  }

}
 ?>
