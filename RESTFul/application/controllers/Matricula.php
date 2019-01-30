<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Matricula extends REST_Controller {


    public function __construct(){
        
        //PARA RECIBIR PETICIONES DE DIRERENRES ORIGENES
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        parent::__construct();
        $this->load->database();        
	}
	

    public function matriculaConRepr_post()
    {
        $data=$this->post();
        
//Matriculacon representante

        //Alumno
        $cedula_alumno=$data['cedula_alumno'];
        $nombre_alumno=$data['nombre_alumno'];
        $genero_alumno=$data['genero_alumno'];
        $imagen_alumno=$data['imagen_alumno'];
        $representante_idrepresentante=$data['representante_idrepresentante'];
        $tipo_sangre_alumno=$data['tipo_sangre_alumno'];
        $escuela_alumno=$data['escuela_alumno'];
        $fecha_nacimiento=$data['fecha_nacimiento'];
        $posicion_alumno=$data['posicion_alumno'];
        $peso_alumno=$data['peso_alumno'];
        $talla_alumno=$data['talla_alumno'];
        $informacion_alumno=$data['informacion_alumno'];
        //Matricula
        $idsucursal_categorias=$data['idsucursal_categorias'];
        $descuento_ficha_alumno=$data['descuento_ficha_alumno'];

        //Insertar alumno

       
        $arrayalumno=array("cedula_alumno"=>$cedula_alumno,
        "nombre_alumno"=>$nombre_alumno,  
        "genero_alumno"=>$genero_alumno,  
        "imagen_alumno"=>$imagen_alumno,  
        "representante_idrepresentante"=>$representante_idrepresentante,  
        "tipo_sangre_alumno"=>$tipo_sangre_alumno,  
        "escuela_alumno"=>$escuela_alumno,  
        "fecha_nacimiento"=>$fecha_nacimiento,  
        "posicion_alumno"=>$posicion_alumno,
        "peso_alumno"=>$peso_alumno,
        "talla_alumno"=>$talla_alumno,
        "informacion_alumno"=>$informacion_alumno);
        $this->db->reset_query();
        $this->db->insert('alumno',$arrayalumno); //inserto un alumno
        $idalumno=$this->db->insert_id();//me retorna el id insertado

        $fecha='CURDATE()';
        //insertar fiha
        $arrayFichaAlumno=array("numeroFicha_alumno"=>$cedula_alumno,
        "fechaApertura_alumno"=>date("Y-m-d"),
        "alumno_idalumno"=>$idalumno,
        "sucursal_categorias_idsucursal_categorias"=>$idsucursal_categorias,
        "fecha_acceso"=>date("Y-m-d"),
        "descuento_ficha_alumno"=>$descuento_ficha_alumno,
    );
        $this->db->reset_query();
        $this->db->insert('ficha_alumno',$arrayFichaAlumno); //inserto una ficha
        $idFicha=$this->db->insert_id();//me retorna el id insertado

        $respuesta  = array('error' => FALSE,
        'idFicha' => $idFicha );

        $this->response($respuesta);

    }

    public function matriculaSinRepr_post()
    {
        $data=$this->post();
        
        //Matriculacon representante

        //Representante

        $cedula_representante=$data['cedula_representante'];
        $nombre_representante=$data['nombre_representante'];
        $email_representante=$data['email_representante'];
        $direccion_representante=$data['direccion_representante'];
        $telefono_representante=$data['telefono_representante'];
        $genero_representante=$data['genero_representante'];
        $fecha_nacimiento_representante=$data['fecha_nacimiento_representante'];
        $parentesco_respresentante=$data['parentesco_respresentante'];
        $celular_representante=$data['celular_representante'];
        $lugar_trabajo_representante=$data['lugar_trabajo_representante'];
        $cedula_conyugue_representante=$data['cedula_conyugue_representante'];
        $nombre_conyugue_representante=$data['nombre_conyugue_representante'];
        $barrio_representante=$data['barrio_representante'];
        $ciudad_representante=$data['ciudad_representante'];

        $arrarepre=array(
        "cedula_representante"=>$cedula_representante,
        "nombre_representante"=>$nombre_representante,  
        "email_representante"=>$email_representante,  
        "direccion_representante"=>$direccion_representante,  
        "telefono_representante"=>$telefono_representante,  
        "usuario"=>$cedula_representante,  
        "clave"=>$cedula_representante,  
        "genero_representante"=>$genero_representante,  
        "fecha_nacimiento_representante"=>$fecha_nacimiento_representante,
        "parentesco_respresentante"=>$parentesco_respresentante,
        "celular_representante"=>$celular_representante,
        "lugar_trabajo_representante"=>$lugar_trabajo_representante,
        "cedula_conyugue_representante"=>$cedula_conyugue_representante,
        "nombre_conyugue_representante"=>$nombre_conyugue_representante,
        "barrio_representante"=>$barrio_representante,
        "ciudad_representante"=>$ciudad_representante
        );


        $this->db->reset_query();
        $this->db->insert('representante',$arrarepre); //inserto un alumno
        $representante_idrepresentante=$this->db->insert_id();//me retorna el id insertado


        //Alumno
        $cedula_alumno=$data['cedula_alumno'];
        $nombre_alumno=$data['nombre_alumno'];
        $genero_alumno=$data['genero_alumno'];
        $imagen_alumno=$data['imagen_alumno'];

        $tipo_sangre_alumno=$data['tipo_sangre_alumno'];
        $escuela_alumno=$data['escuela_alumno'];
        $fecha_nacimiento=$data['fecha_nacimiento'];
        $posicion_alumno=$data['posicion_alumno'];
        $peso_alumno=$data['peso_alumno'];
        $talla_alumno=$data['talla_alumno'];
        $informacion_alumno=$data['informacion_alumno'];
        
    
        //Matricula
        $idsucursal_categorias=$data['idsucursal_categorias'];
        $descuento_ficha_alumno=$data['descuento_ficha_alumno'];

        //Insertar alumno

       
        $arrayalumno=array("cedula_alumno"=>$cedula_alumno,
        "nombre_alumno"=>$nombre_alumno,  
        "genero_alumno"=>$genero_alumno,  
        "imagen_alumno"=>$imagen_alumno,  
        "representante_idrepresentante"=>$representante_idrepresentante,  
        "tipo_sangre_alumno"=>$tipo_sangre_alumno,  
        "escuela_alumno"=>$escuela_alumno,  
        "fecha_nacimiento"=>$fecha_nacimiento,  
        "posicion_alumno"=>$posicion_alumno,
        "peso_alumno"=>$peso_alumno,
        "talla_alumno"=>$talla_alumno,
        "informacion_alumno"=>$informacion_alumno);
        $this->db->reset_query();
        $this->db->insert('alumno',$arrayalumno); //inserto un alumno
        $idalumno=$this->db->insert_id();//me retorna el id insertado

        $fecha='CURDATE()';
        //insertar fiha
        $arrayFichaAlumno=array("numeroFicha_alumno"=>$cedula_alumno,
        "fechaApertura_alumno"=>date("Y-m-d"),
        "alumno_idalumno"=>$idalumno,
        "sucursal_categorias_idsucursal_categorias"=>$idsucursal_categorias,
        "fecha_acceso"=>date("Y-m-d"),
        "descuento_ficha_alumno"=>$descuento_ficha_alumno,
    );
        $this->db->reset_query();
        $this->db->insert('ficha_alumno',$arrayFichaAlumno); //inserto una ficha
        $idFicha=$this->db->insert_id();//me retorna el id insertado

        $respuesta  = array('error' => FALSE,
        'idFicha' => $idFicha );

        $this->response($respuesta);

    }


}