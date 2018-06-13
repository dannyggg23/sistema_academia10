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

        parent::__construct();
        $this->load->database();        
        

    }
    public function pagos_alumnos_get($token="0" , $idalumno="0")
    {
        if($token == '0' || $idalumno == '0')
        {
            $respuesta=array('error' => TRUE,
                             'mensaje' => 'token invalio y/o usuario invalido'
                            );
            
            $this->response($respuesta , REST_Controller::HTTP_BAD_REQUEST );

            return;


        }

        //comparo en la base de datos el id y el token
        $condiciones = array('idalumno' => $idalumno , 'token' => $token  );
        $this->db->where($condiciones);
        $query= $this->db->get('alumno');

        $existe = $query->row();

        if (!$existe) {
            $respuesta=array('error' => TRUE,
                             'mensaje' => 'usuario y/o token incorrectos'
                            );

            $this->response($respuesta  );

            return;
        }

        //retornar todas las ordenes del usuario
        $query = $this->db->query( 'SELECT pago.idpago, pago.representante_idrepresentante, pago.usuario_idusuario, pago.fecha, pago.total, pago.tipo_documento, pago.estado, pago.serie_comprobante, pago.num_comprobante, pago.impuesto FROM pago INNER JOIN
        representante ON representante.idrepresentante=pago.representante_idrepresentante INNER JOIN alumno ON alumno.representante_idrepresentante=representante.idrepresentante WHERE alumno.idalumno='.$idalumno );
       
       $ordenes = array();

        foreach ($query->result() as $row ) {

            $query_detalle=$this->db->query("SELECT ordenes_detalle.orden_id, productos.* FROM ordenes_detalle INNER JOIN productos on ordenes_detalle.producto_id=productos.codigo
            WHERE ordenes_detalle.orden_id=".$row->idpago);
            $orden = array('id' => $row->id,
                           'creado_en' => $row->creado_en,
                           'detalle' => $query_detalle->result()
                        );

            array_push( $ordenes,$orden );
        }

        $respuesta = array('error' => FALSE,
                           'ordenes' => $ordenes );

        $this->response($respuesta);
    }







}