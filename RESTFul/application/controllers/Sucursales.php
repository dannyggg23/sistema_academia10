<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Sucursales extends REST_Controller {


    public function __construct(){
        
        //PARA RECIBIR PETICIONES DE DIRERENRES ORIGENES

        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

        parent::__construct();
        $this->load->database();        
        

    }
    
    public function index_get($pagina=0)
    {
        $pagina=$pagina*5;
        $query = $this->db->query("SELECT `idsucursal`, `nombre_sucursal`, `direrccion_ducursal`, `telefono_sucursal`, `encargado_sucursal`,`imagen`, ciudad.ciudad,provincia.provincia, `estado` FROM `sucursal` INNER JOIN ciudad ON ciudad.idCiudad=sucursal.ciudad_idCiudad INNER JOIN provincia ON provincia.idProvincia=ciudad.IDPROVINCIA LIMIT " .$pagina.",5");
        $respuesta = array(
            'error' => FALSE,
            'sucursales' => $query->result_array()
        );

        $this->response($respuesta);
     
   }


}