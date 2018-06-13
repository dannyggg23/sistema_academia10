<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class LoginEntrenador extends REST_Controller {


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


        //Si no vienen datos por post mostramos el error
        $data=$this->post();

        if( !isset( $data['usuario'] ) OR !isset( $data['clave'] )){

            $respuesta = array(
                'error' => TRUE,
                'mensaje'=>'la informacion enviada no es valida' 
            );

            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST );

            return;
       
        }

        
        //CONSULTAMOS EN LA BASE DE DATOS 

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

       //aqui ya tenemos el usuario y contraseña validos

       //TOKEN

       $token=bin2hex(openssl_random_pseudo_bytes(20));
       $oken=hash('ripemd160' ,$data['usuario']);

       //GUARDO EN LA BASE DE DATOS EL TOKEN

       $this->db->reset_query();//LIMPIO EL QUERY 

       $actualizar_token=array('token'=>$token);//array q vamos a utilizar

       $this->db->where('identrenador' , $usuario -> identrenador );//al id q vamos a afectar

       $hecho=$this->db->update('entrenador',$actualizar_token);//actualizo el token

       if($usuario->estado==1)
       {
        $respuesta=array(
            'error'=>FALSE,
            'token'=>$token,
            'usuario'=>$usuario
        );

       }
       else
       {
        $respuesta=array(
            'error'=>TRUE,
            'mensaje'=>'No se encuentra Activo'
        );

       }



     


       $this->response($respuesta);


   }

}