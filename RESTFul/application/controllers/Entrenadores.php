<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Entrenadores extends REST_Controller {


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

        $query = $this->db->query("SELECT ficha_entrenador.idficha_entrenador, ficha_entrenador.numeroFicha_entrenador,ficha_entrenador.fechaApertura_entrenador, ficha_entrenador.estado, ficha_entrenador.entrenador_identrenador, ficha_entrenador.categoria_idcategoria,entrenador.cedula_entrenador,entrenador.nombre_entrenador,entrenador.apellido_entrenador,entrenador.direccion_entrenador,entrenador.email_entrenador,entrenador.telefono_entrenador,entrenador.celular_entrenador,entrenador.imagen_entrenador,categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin,sucursal.nombre_sucursal,sucursal.direrccion_ducursal,ciudad.ciudad,entrenador.descripcion  FROM ficha_entrenador INNER JOIN entrenador ON ficha_entrenador.entrenador_identrenador=entrenador.identrenador INNER JOIN sucursal ON sucursal.idsucursal=entrenador.sucursal_idsucursal INNER JOIN categoria ON ficha_entrenador.categoria_idcategoria=categoria.idcategoria INNER JOIN horario ON horario.idhorario=categoria.horario_idhorario INNER JOIN  ciudad on ciudad.idCiudad=sucursal.ciudad_idCiudad LIMIT " .$pagina.",5  ");

        $respuesta = array(
            'error' => FALSE,
            'entrenadores' => $query->result_array()
    
        );

        $this->response($respuesta);

        
   }
    
    public function entrenadoresSucursal_get($idsucursal)
    {
        $query = $this->db->query("SELECT ficha_entrenador.idficha_entrenador, ficha_entrenador.numeroFicha_entrenador,ficha_entrenador.fechaApertura_entrenador, ficha_entrenador.estado, ficha_entrenador.entrenador_identrenador, ficha_entrenador.categoria_idcategoria,entrenador.cedula_entrenador,entrenador.nombre_entrenador,entrenador.apellido_entrenador,entrenador.direccion_entrenador,entrenador.email_entrenador,entrenador.telefono_entrenador,entrenador.celular_entrenador,entrenador.imagen_entrenador,categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin,sucursal.nombre_sucursal,sucursal.direrccion_ducursal,ciudad.ciudad,entrenador.descripcion FROM ficha_entrenador INNER JOIN entrenador ON ficha_entrenador.entrenador_identrenador=entrenador.identrenador INNER JOIN sucursal ON sucursal.idsucursal=entrenador.sucursal_idsucursal INNER JOIN categoria ON ficha_entrenador.categoria_idcategoria=categoria.idcategoria INNER JOIN horario ON horario.idhorario=categoria.horario_idhorario
            INNER JOIN  ciudad on ciudad.idCiudad=sucursal.ciudad_idCiudad WHERE sucursal.idsucursal= '$idsucursal'");

        $respuesta = array(
            'error' => FALSE,
            'entrenadores' => $query->result_array()
    
        );

        $this->response($respuesta);

        
   }

   public function entrenadoresCategoria_get($idcategoria)
   {
       $query = $this->db->query("SELECT ficha_entrenador.idficha_entrenador, ficha_entrenador.numeroFicha_entrenador,ficha_entrenador.fechaApertura_entrenador, ficha_entrenador.estado, ficha_entrenador.entrenador_identrenador, ficha_entrenador.categoria_idcategoria,entrenador.cedula_entrenador,entrenador.nombre_entrenador,entrenador.apellido_entrenador,entrenador.direccion_entrenador,entrenador.email_entrenador,entrenador.telefono_entrenador,entrenador.celular_entrenador,entrenador.imagen_entrenador,categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin,sucursal.nombre_sucursal,sucursal.direrccion_ducursal,ciudad.ciudad,entrenador.descripcion  FROM ficha_entrenador INNER JOIN entrenador ON ficha_entrenador.entrenador_identrenador=entrenador.identrenador INNER JOIN sucursal ON sucursal.idsucursal=entrenador.sucursal_idsucursal INNER JOIN categoria ON ficha_entrenador.categoria_idcategoria=categoria.idcategoria INNER JOIN horario ON horario.idhorario=categoria.horario_idhorario INNER JOIN  ciudad on ciudad.idCiudad=sucursal.ciudad_idCiudad WHERE categoria.idcategoria= '$idcategoria'");

       $respuesta = array(
           'error' => FALSE,
           'entrenadores' => $query->result_array()
   
       );

       $this->response($respuesta);

       
  }



  public function actualizarDatos_post($identrenador="0",$token="0")
  {
    $data=$this->post();

    if($token == '0' || $identrenador == '0')
    {
        $respuesta=array('error' => TRUE,
                         'mensaje' => 'token invalio y/o usuario invalido'
                        );
        
        $this->response($respuesta , REST_Controller::HTTP_BAD_REQUEST );

        return;


    }

    if( (!isset($data['usuario'] ) || strlen( $data['usuario'] ) == 0) 
    and (!isset($data['clave'] ) || strlen( $data['clave'] ) == 0) 
    and (!isset($data['cedula_entrenador'] ) || strlen( $data['cedula_entrenador'] ) == 0) 
    and (!isset($data['clave'] ) || strlen( $data['clave'] ) == 0) 
    and (!isset($data['nombre_entrenador'] ) || strlen( $data['nombre_entrenador'] ) == 0)
    and (!isset($data['apellido_entrenador'] ) || strlen( $data['apellido_entrenador'] ) == 0)
    and (!isset($data['direccion_entrenador'] ) || strlen( $data['direccion_entrenador'] ) == 0)
    and (!isset($data['email_entrenador'] ) || strlen( $data['email_entrenador'] ) == 0)
    and (!isset($data['telefono_entrenador'] ) || strlen( $data['telefono_entrenador'] ) == 0) 
    and (!isset($data['descripcion'] ) || strlen( $data['descripcion'] ) == 0) ){
       
        $respuesta=array('error' => TRUE,
        'mensaje' => 'Faltan los items en el post'

       );

    $this->response($respuesta , REST_Controller::HTTP_BAD_REQUEST );

    return;
    }

     //TENEMOS ITEMS USUARIOS Y TOKEN

        //comparo en la base de datos el id y el token
        $condiciones = array('identrenador' => $identrenador , 'token' => $token  );
        $this->db->where($condiciones);
        $query= $this->db->get('entrenador');

        $existe = $query->row();

        if (!$existe) {
            $respuesta=array('error' => TRUE,
                             'mensaje' => 'usuario y/o token incorrectos'
                            );

            $this->response($respuesta  );

            return;
        }

        $this->db->reset_query();//LIMPIO EL QUERY 

        $actualizar_datos=array('cedula_entrenador'=>$data['cedula_entrenador'],
                                'nombre_entrenador'=>$data['nombre_entrenador'],
                                'apellido_entrenador'=>$data['apellido_entrenador'],
                                'direccion_entrenador'=>$data['direccion_entrenador'],
                                'email_entrenador'=>$data['email_entrenador'],
                                'telefono_entrenador'=>$data['telefono_entrenador'],
                                'celular_entrenador'=>$data['celular_entrenador'],
                                'usuario'=>$data['usuario'],
                                'clave'=>$data['clave'], 
                                'descripcion'=>$data['descripcion']
                            );//array q vamos a utilizar
 
        $this->db->where('identrenador' , $identrenador );//al id q vamos a afectar
 
        $hecho=$this->db->update('entrenador',$actualizar_datos);//actualizo el token

        $respuesta=array(
            'error'=>FALSE,
            'mensaje'=>'Datos Actualizados'
        );

        $this->response($respuesta);
 
 }







}