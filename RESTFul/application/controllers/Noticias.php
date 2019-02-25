<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Noticias extends REST_Controller {


    public function __construct(){
        
        //PARA RECIBIR PETICIONES DE DIRERENRES ORIGENES
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        parent::__construct();
        $this->load->database();        
	}
	
    //#####################################NOTICIAS-IMG--#######################################################3


    public function index_get()
    {
        
    }

    public function NoticiasImg_post()
    {
        $dataImg=$this->post();

        $titulo=$dataImg['titulo']; 
        $fecha=$dataImg['fecha']; 
        $descripcion=$dataImg['descripcion'];

        $data=['result' => FALSE];

        $Ttarget_path =time().'.jpg';

       if(isset($dataImg['file'])){
        $imgdata=$dataImg['file'];
        $imgdata=str_replace('data:image/jpeg;base64,','',$imgdata);
        $imgdata=str_replace('data:image/jpg;base64,','',$imgdata);
        $imgdata=str_replace(' ','+',$imgdata);
        $imgdata=base64_decode($imgdata);

        file_put_contents('../files/noticias/'.$Ttarget_path,$imgdata); 
        }

        $this->db->reset_query();

        $arrayNoticias=array("imagen"=>$Ttarget_path,
        "titulo"=>$titulo,  
        "fecha"=>$fecha,  
        "descripcion"=>$descripcion);

        $this->db->insert('noticias',$arrayNoticias); 
        $respuesta  = array('error' => FALSE,
       'file' => $Ttarget_path );
        $this->response($respuesta);
    }

    public function appmg_post()
    {
        $dataImg=$this->post();

        $data=['result' => FALSE];

        $Ttarget_path =time().'.jpg';

       if(isset($dataImg['file'])){
        $imgdata=$dataImg['file'];
        $imgdata=str_replace('data:image/jpeg;base64,','',$imgdata);
        $imgdata=str_replace('data:image/jpg;base64,','',$imgdata);
        $imgdata=str_replace(' ','+',$imgdata);
        $imgdata=base64_decode($imgdata);

        file_put_contents('../files/img_app/'.$Ttarget_path,$imgdata); 
        }

        $this->db->reset_query();

        $imgsapp=array("imagen"=>$Ttarget_path);

        $this->db->insert('imagenes_app',$imgsapp); 

        $respuesta  = array('error' => FALSE,
       'file' => $Ttarget_path );
        $this->response($respuesta);
    }

    public function borrarimagenapp_post()
     {
        $dataImg=$this->post();
        $idimagenes_app=$dataImg['idimagenes_app']; 
        $this->db->where('idimagenes_app', $idimagenes_app);
        $query=$this->db->delete('imagenes_app');

         $respuesta = array(
             'error' => FALSE,
             'notificaciones' =>"OK"
         );
         $this->response($respuesta);   
     }
    

}