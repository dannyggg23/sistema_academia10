<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Login extends REST_Controller {


    public function __construct(){
        
        //PARA RECIBIR PETICIONES DE DIRERENRES ORIGENES

        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

        parent::__construct();
        $this->load->database();        
        

    }
    public function index_post()

    {
    	$data=$this->post();

        if( !isset( $data['usuario'] ) OR !isset( $data['clave'] ) OR !isset( $data['tipo'] ) ) {

            $respuesta = array(
                'error' => TRUE,
                'mensaje'=>'la informacion enviada no es valida' 
            );

        $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST );

        return;
       
        }

         //CONSULTAMOS EN LA BASE DE DATOS 
        $tipo=$data['tipo'];
      

        if($tipo=="u")
        {

        $clavehash=hash("SHA256", $data['clave']);

        $condiciones=array('login_usuario'=> $data['usuario'],
                           'clave_usuario'=>$clavehash);
        $query = $this->db->get_where('usuario',$condiciones);
        $usuario=$query->row();
        //si recivimos datos del post pero son incorrectos
        if( !isset($usuario)){

            $respuesta = array(
                'error' => TRUE,
                'mensaje'=>'Usuario y/o contrasena no son validos ' 
            );

            $this->response($respuesta);
            return;

        }


        }elseif ($tipo=="e") {
        	     $condiciones=array('usuario'=> $data['usuario'],
                           'clave'=>$data['clave']);
        $query = $this->db->get_where('entrenador',$condiciones);
        $usuario=$query->row();
        //si recivimos datos del post pero son incorrectos
        if( !isset($usuario)){

            $respuesta = array(
                'error' => TRUE,
                'mensaje'=>'Usuario y/o contrasena no son validos ' 
            );

            $this->response($respuesta);
            return;

        }
        }elseif ($tipo=="r") {
        	     $condiciones=array('usuario'=> $data['usuario'],
                           'clave'=>$data['clave']);
        $query = $this->db->get_where('representante',$condiciones);
        $usuario=$query->row();
        //si recivimos datos del post pero son incorrectos
        if( !isset($usuario)){

            $respuesta = array(
                'error' => TRUE,
                'mensaje'=>'Usuario y/o contrasena no son validos ' 
            );

            $this->response($respuesta);
            return;

        }
        }

        //Todo esta bién

         $respuesta=array(
            'error'=>FALSE,
            'usuario'=>$usuario
        );

          $this->response($respuesta);
      
   }


    public function token_post()

    {
    	$data=$this->post();

            $id=$data['id'];
            
        	if(isset($data['token'])){
                $token=$data['token'];
            }else{
                $token="";
            }
            $tabla=$data['tabla'];
            


        	if($tabla=="usuario")
        	{

       			//GUARDO EN LA BASE DE DATOS EL TOKEN

      			 $this->db->reset_query();//LIMPIO EL QUERY 
      			 $actualizar_token=array('token'=>$token);//array q vamos a utilizar
      			 $this->db->where('idusuario' , $id );//al id q vamos a afectar
      			 $hecho=$this->db->update('usuario',$actualizar_token);//actualizo el token
      			 $this->response($hecho);

        	}elseif($tabla=="entrenador"){

        		//GUARDO EN LA BASE DE DATOS EL TOKEN

      			 $this->db->reset_query();//LIMPIO EL QUERY 
      			 $actualizar_token=array('token'=>$token);//array q vamos a utilizar
      			 $this->db->where('identrenador' , $id );//al id q vamos a afectar
      			 $hecho=$this->db->update('entrenador',$actualizar_token);//actualizo el token
      			 $this->response($hecho);

        	}elseif($tabla=="representante"){
        		
        		//GUARDO EN LA BASE DE DATOS EL TOKEN

      			 $this->db->reset_query();//LIMPIO EL QUERY 
      			 $actualizar_token=array('token'=>$token);//array q vamos a utilizar
      			 $this->db->where('idrepresentante' , $id );//al id q vamos a afectar
      			 $hecho=$this->db->update('representante',$actualizar_token);//actualizo el token
      			 $this->response($hecho);


        	}
        	else
        	{

      			 $this->response(FALSE);


        	}
   }
}