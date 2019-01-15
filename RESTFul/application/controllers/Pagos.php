<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Pagos extends REST_Controller {


    public function __construct(){
        
        //PARA RECIBIR PETICIONES DE DIRERENRES ORIGENES
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        parent::__construct();
        $this->load->database();        
	}
	

    public function pago_post()
    {
        $data=$this->post();
        
//PAGO
        $representante_idrepresentante=$data['representante_idrepresentante'];
        $usuario_idusuario=$data['usuario_idusuario'];
        $fecha=$data['fecha'];
        $total=$data['total'];
        $tipo_documento=$data['tipo_documento'];
        $serie_comprobante=$data['serie_comprobante'];
        $num_comprobante=$data['num_comprobante'];
        $impuesto=$data['impuesto'];
        $subtotal=$data['subtotal'];

//DETALLE

        $ficha_alumno_idficha_alumno=$data['ficha_alumno_idficha_alumno'];
        $numero_meses_pago=$data['numero_meses_pago'];
        $precio_pago=$data['precio_pago'];
        $descuento_pago=$data['descuento_pago'];
        $productos_servicios_idproductos_servicios=$data['productos_servicios_idproductos_servicios'];

        $descuento=(($precio_pago*$numero_meses_pago)*$descuento_pago)/100; //CALCULO EL DESCUENTO
//INSERTAR PAGO

        $this->db->reset_query();
        $arraypago=array("representante_idrepresentante"=>$representante_idrepresentante,
        "usuario_idusuario"=>$usuario_idusuario,  
        "fecha"=>$fecha,  
        "total"=>$total,  
        "tipo_documento"=>$tipo_documento,  
        "serie_comprobante"=>$serie_comprobante,  
        "num_comprobante"=>$num_comprobante,  
        "impuesto"=>$impuesto,  
        "subtotal"=>$subtotal,
        "estado"=>"Aceptado");

        $this->db->insert('pago',$arraypago); //inserto una orden
        $pago_idpago=$this->db->insert_id();//me retorna el id insertado

        $arraydetallepago=array("pago_idpago"=>$pago_idpago,
        "ficha_alumno_idficha_alumno"=>$ficha_alumno_idficha_alumno,
        "numero_meses_pago"=>$numero_meses_pago,
        "precio_pago"=>$precio_pago,
        "descuento_pago"=>$descuento,
        "productos_servicios_idproductos_servicios"=>$productos_servicios_idproductos_servicios);

        $this->db->reset_query();
        $this->db->insert('detalle_pago',$arraydetallepago); //inserto
       
        $this->db->reset_query();

        if($pago_idpago > 0)
      {
        $this->db->reset_query();
        $query = $this->db->query("UPDATE 
        `datos_academia` SET 
        `numero_factura`= numero_factura+1 
        WHERE `iddatos_academia`=1");
      }

        $respuesta  = array('error' => FALSE,
                    'pago_idpago' => $pago_idpago );
        
        $this->response($respuesta);
    }



    //#####################################PAGOS-IMG--#######################################################3

    public function pagoImg_post()
    {
        $dataImg=$this->post();

        $fecha=$dataImg['fecha']; 
        $ficha_alumno_idficha_alumno=$dataImg['ficha_alumno_idficha_alumno']; 
        $descripcion=$dataImg['descripcion'];


        $data=['result' => FALSE];
        $Ttarget_path =time().'.jpg';

       if(isset($dataImg['file'])){
        $imgdata=$dataImg['file'];
        $imgdata=str_replace('data:image/jpeg;base64,','',$imgdata);
        $imgdata=str_replace('data:image/jpg;base64,','',$imgdata);
        $imgdata=str_replace(' ','+',$imgdata);
        $imgdata=base64_decode($imgdata);

        file_put_contents('../files/imgpagos/'.$Ttarget_path,$imgdata); 
}

        $this->db->reset_query();
        $arraydepositopago=array("imagen"=>$Ttarget_path,
        "fecha"=>$fecha,  
        "ficha_alumno_idficha_alumno"=>$ficha_alumno_idficha_alumno,  
        "descripcion"=>$descripcion);
        $this->db->insert('pagos_deposito',$arraydepositopago); 
        $respuesta  = array('error' => FALSE,
       'file' => $Ttarget_path );
        $this->response($respuesta);

    }

}