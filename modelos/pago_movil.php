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
    $sw=true;
    
      $descuento=(($precio_pago*$numero_meses_pago)*$descuento_pago)/100;
      $sql_detalle=sprintf("INSERT INTO `detalle_pago`( `pago_idpago`, 
      `ficha_alumno_idficha_alumno`, `numero_meses_pago`, 
      `precio_pago`, `descuento_pago`,productos_servicios_idproductos_servicios) 
      VALUES ('%s','%s','%s','%s','%s','%s')",
      $idpagonew,
      $ficha_alumno_idficha_alumno,
      $numero_meses_pago,
      $precio_pago,
      $descuento,
      $productos_servicios_idproductos_servicios);
      ejecutarConsulta($sql_detalle) or $sw=false;

     
      if($idpagonew > 0)
      {
        $sql=("UPDATE `datos_academia` SET 
       `numero_factura`= numero_factura+1 
       WHERE `iddatos_academia`=1");
      $id= ejecutarConsulta($sql);
      }

      header("Location:../reportes/exFactura.php?id='$idpagonew'");

    return $idpagonew;

   
  }

  
}
 ?>
