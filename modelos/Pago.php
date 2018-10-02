<?php
require "../config/Conexion.php";
Class Pago
{
  public function _construct(){
 
  }

  public function insertar($representante_idrepresentante,
  $usuario_idusuario,$fecha,$total,$tipo_documento,
  $serie_comprobante,$num_comprobante,$impuesto,$subtotal,
  $ficha_alumno_idficha_alumno,$numero_meses_pago,
  $precio_pago,$descuento_pago,$productos_servicios_idproductos_servicios){
    $sql=sprintf("INSERT INTO `pago`( `representante_idrepresentante`, 
    `usuario_idusuario`, `fecha`, `total`, `tipo_documento`, 
    `estado`, `serie_comprobante`, `num_comprobante`,impuesto,subtotal) 
    VALUES ('%s','%s','%s','%s','%s','Aceptado','%s','%s','%s','$subtotal')",
    $representante_idrepresentante,$usuario_idusuario,$fecha,$total,
    $tipo_documento,$serie_comprobante,$num_comprobante,$impuesto);
    //return ejecutarConsulta($sql);

    $idpagonew=ejecutarConsulta_retornarID($sql);

    $num_elementos=0;
    $sw=true;

    while ($num_elementos < count($ficha_alumno_idficha_alumno)) {

     
      $descuento=(($precio_pago[$num_elementos]*$numero_meses_pago[$num_elementos])*$descuento_pago[$num_elementos])/100;

      $sql_detalle=sprintf("INSERT INTO `detalle_pago`( `pago_idpago`, 
      `ficha_alumno_idficha_alumno`, `numero_meses_pago`, 
      `precio_pago`, `descuento_pago`,productos_servicios_idproductos_servicios) 
      VALUES ('%s','%s','%s','%s','%s','%s')",
      $idpagonew,
      $ficha_alumno_idficha_alumno[$num_elementos],
      $numero_meses_pago[$num_elementos],
      $precio_pago[$num_elementos],
      $descuento,
      $productos_servicios_idproductos_servicios[$num_elementos]);
      ejecutarConsulta($sql_detalle) or $sw=false;
      $num_elementos=$num_elementos+1;
      $descuento=0;
    }

    if($idpagonew > 0)
    {
      $sql=("UPDATE `datos_academia` SET 
     `numero_factura`= numero_factura+1 
     WHERE `iddatos_academia`=1");
    return ejecutarConsulta($sql);
    }

    return $idpagonew;

  }


  public function anular($idpago)
  {
    $sql=sprintf("UPDATE pago SET estado='Anulado'  WHERE `idpago`='%s' ",$idpago);
    return ejecutarConsulta($sql);
  }

  public function mostrar($idpago)
  {
    $sql=sprintf("SELECT pago.idpago,pago.fecha,representante.cedula_representante,representante.nombre_representante,representante.idrepresentante,usuario.nombre_usuario,pago.total,pago.tipo_documento,pago.estado,pago.serie_comprobante,pago.num_comprobante,pago.impuesto FROM `pago` INNER JOIN representante ON representante.idrepresentante=pago.representante_idrepresentante INNER JOIN usuario on usuario.idusuario=pago.usuario_idusuario WHERE idpago='%s'",$idpago);
    return ejecutarConsultaSimpleFila($sql);
  }

  public function listarDetalle($idpago)
  {

    $sql=sprintf("SELECT detalle_pago.iddetalle_pago,detalle_pago.pago_idpago,detalle_pago.numero_meses_pago,
    detalle_pago.precio_pago,detalle_pago.descuento_pago,
    ficha_alumno.idficha_alumno,ficha_alumno.numeroFicha_alumno,productos_servicios.nombre_productos_servicios FROM detalle_pago 
    INNER JOIN ficha_alumno ON ficha_alumno.idficha_alumno=detalle_pago.ficha_alumno_idficha_alumno 
    INNER JOIN productos_servicios ON productos_servicios.idproductos_servicios=detalle_pago.productos_servicios_idproductos_servicios WHERE detalle_pago.pago_idpago='%s'",$idpago);
    return ejecutarConsulta($sql);

  }


  public function listar(){
      $sql="SELECT pago.idpago,pago.fecha,representante.cedula_representante,representante.nombre_representante,representante.idrepresentante,usuario.nombre_usuario,pago.total,pago.tipo_documento,pago.estado,pago.serie_comprobante,pago.num_comprobante FROM `pago` INNER JOIN representante ON representante.idrepresentante=pago.representante_idrepresentante INNER JOIN usuario on usuario.idusuario=pago.usuario_idusuario ORDER BY pago.idpago desc";
     return ejecutarConsulta($sql);

  }

  public function listarFecha($finicio,$ffin){
    $sql="SELECT pago.idpago,pago.fecha,representante.cedula_representante,representante.nombre_representante,representante.idrepresentante,usuario.nombre_usuario,pago.total,pago.tipo_documento,pago.estado,pago.serie_comprobante,pago.num_comprobante FROM `pago` INNER JOIN representante ON representante.idrepresentante=pago.representante_idrepresentante INNER JOIN usuario on usuario.idusuario=pago.usuario_idusuario WHERE pago.fecha >= '$finicio'  AND pago.fecha <= '$ffin'  ORDER BY pago.idpago desc";
   return ejecutarConsulta($sql);
}

public function listarfechaRepresentante($finicio,$ffin,$idrepresentante){
  $sql="SELECT pago.idpago,pago.fecha,representante.cedula_representante,representante.nombre_representante,representante.idrepresentante,usuario.nombre_usuario,pago.total,pago.tipo_documento,pago.estado,pago.serie_comprobante,pago.num_comprobante FROM `pago` INNER JOIN representante ON representante.idrepresentante=pago.representante_idrepresentante INNER JOIN usuario on usuario.idusuario=pago.usuario_idusuario WHERE pago.fecha >= '$finicio'  AND pago.fecha <= '$ffin' AND representante.idrepresentante='$idrepresentante'  ORDER BY pago.idpago desc";
 return ejecutarConsulta($sql);
}

  //REPORTE FACTURA

  public function pagocabecera($idpago){
    $sql="SELECT pago.idpago,pago.subtotal, pago.representante_idrepresentante, pago.usuario_idusuario, pago.fecha, pago.total, pago.tipo_documento,pago.estado, pago.serie_comprobante, pago.num_comprobante, pago.impuesto,usuario.nombre_usuario,usuario.cedula_usuario,usuario.direccion_usuario,usuario.telefono_usuario,usuario.email_usuario,representante.cedula_representante,representante.nombre_representante,representante.direccion_representante,representante.email_representante,representante.telefono_representante FROM pago INNER JOIN representante on representante.idrepresentante=pago.representante_idrepresentante INNER JOIN usuario on usuario.idusuario=pago.usuario_idusuario WHERE pago.idpago='$idpago'";
   return ejecutarConsulta($sql);

}

public function pagodetalle($idpago){
  $sql="SELECT detalle_pago.iddetalle_pago, 
  detalle_pago.pago_idpago, 
  detalle_pago.ficha_alumno_idficha_alumno, 
  detalle_pago.numero_meses_pago, 
  detalle_pago.precio_pago, 
  detalle_pago.descuento_pago,
  ficha_alumno.numeroFicha_alumno,
  alumno.cedula_alumno,alumno.nombre_alumno,
  (detalle_pago.numero_meses_pago*detalle_pago.precio_pago-detalle_pago.descuento_pago) as subtotal, 
  productos_servicios.nombre_productos_servicios FROM detalle_pago 
  INNER JOIN ficha_alumno ON ficha_alumno.idficha_alumno=detalle_pago.ficha_alumno_idficha_alumno 
  INNER JOIN alumno on alumno.idalumno=ficha_alumno.alumno_idalumno 
  INNER JOIN productos_servicios ON productos_servicios.idproductos_servicios=detalle_pago.productos_servicios_idproductos_servicios 
  WHERE detalle_pago.pago_idpago='$idpago'";
 return ejecutarConsulta($sql);

}
  
}
 ?>
