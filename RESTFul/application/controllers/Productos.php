<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Productos extends REST_Controller {


    public function __construct(){
        
        //PARA RECIBIR PETICIONES DE DIRERENRES ORIGENES

        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

        parent::__construct();
        $this->load->database();        
        

    }
    public function todos_get( $pagina = 0 )
    {
        $pagina=$pagina*10;
        $query = $this->db->query('SELECT * FROM `productos` LIMIT '.$pagina.',10');

        $respuesta = array(
            'error' => FALSE,
            'productos' => $query->result_array()
    
        );

        $this->response($respuesta);

        
   }

   public function por_tipo_get( $tipo=0, $pagina = 0 )
    {
        $pagina=$pagina*10;

        if($tipo==0){

            $respuesta = array('error' => TRUE , 'mensaje'=> 'Falta el parametro de tipo' );

            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST );

            return;

        }

        $query = $this->db->query('SELECT * FROM `productos` WHERE linea_id='.$tipo.'  LIMIT '.$pagina.',10');

        $respuesta = array(
            'error' => FALSE,
            'productos' => $query->result_array()
    
        );

        $this->response($respuesta);
        
   }

   public function buscar_get( $termino = 'Sin termino' )
    {
       
        $query = $this->db->query("SELECT * FROM `productos` WHERE producto like '%".$termino."%' ");

        $respuesta = array(
            'error' => FALSE,
            'termino' => $termino,
            'productos' => $query->result_array()
    
        );

        $this->response($respuesta);

        
   }

}