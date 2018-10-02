<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Notificaciones extends REST_Controller {


    public function __construct(){
        
        //PARA RECIBIR PETICIONES DE DIRERENRES ORIGENES

        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

        parent::__construct();
        $this->load->database();        
        

	}
	

//###############################################--------SUCURSAL--------############################################################

    public function index_post()

    {
    		$data=$this->post();

    		if( !isset($data['sucursal_idsucursal']) ) {

            $respuesta = array(
                'error' => TRUE,
                'mensaje'=>'la informacion enviada no es valida' 
            );

             $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST );

        return;
        }

        //#################################ID TOKEN NOTIFICACIONES#########################################

        $idsucursal=$data['sucursal_idsucursal'];
        $mensaje=$data['mensaje'];
        $titulo=$data['titulo'];
        $subtitulo=$data['subtitulo'];

    	 $query = $this->db->query("SELECT representante.token FROM `representante` 
			INNER JOIN alumno ON alumno.representante_idrepresentante=representante.idrepresentante
			INNER JOIN ficha_alumno ON ficha_alumno.alumno_idalumno=alumno.idalumno
			INNER JOIN sucursal_categorias ON sucursal_categorias.idsucursal_categorias=ficha_alumno.sucursal_categorias_idsucursal_categorias
			INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal WHERE sucursal.idsucursal='$idsucursal'");
    	

    	 $ids = array("d21ac39a-0fc2-400f-b456-64b99d8ac6f1");
       
    	

 		foreach ($query->result() as $row)
				{
        			  array_push($ids, $row->token);
				}

				//ENTRENADORES

		$this->db->reset_query();

		 $query = $this->db->query("SELECT entrenador.token FROM `entrenador`
				INNER JOIN ficha_entrenador ON ficha_entrenador.entrenador_identrenador=entrenador.identrenador
				INNER JOIN sucursal_categorias ON sucursal_categorias.idsucursal_categorias=ficha_entrenador.sucursal_categorias_idsucursal_categorias
				INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal WHERE sucursal.idsucursal='$idsucursal'");

		 foreach ($query->result() as $row)
				{
        			  array_push($ids, $row->token);
				}

		//#######################################################################################################


		$content = array(
			"en" => $mensaje
			);

		$headings=["en" => $titulo];

		$subtitle=["en" => $subtitulo];

			
		
		$fields = array(
			'app_id' => "97f28ff2-fb65-47bc-8a29-770cb14cdb9b",
			'include_player_ids' => $ids,
			'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings'=> $headings,
			'subtitle'=>$subtitle,
			'big_picture'=>'http://www.escueladel10.com/sistema/reportes/logo.jpg',
			'small_icon'=>'http://www.escueladel10.com/sistema/reportes/logo.jpg'
		);
		
		$fields = json_encode($fields);
    	//print("\nJSON sent:\n");
    	//print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic MDAyNmY0OGMtNTBiMS00OTA1LWFmZDQtYjgxOTI4MmQ0ZDkx'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);


		
		
		 $this->response($response);
		 return $response;
	
      
}

//###############################################--------TODOS--------############################################################


 public function todos_post()

    {
		$data=$this->post();
        $mensaje=$data['mensaje'];
        $titulo=$data['titulo'];
		$subtitulo=$data['subtitulo'];
		


	$content = array(
			"en" =>$mensaje
			);

		$headings=["en" => $titulo];

		$subtitle=["en" => $subtitulo];

		$fields = array(
			'app_id' => "97f28ff2-fb65-47bc-8a29-770cb14cdb9b",
			 'included_segments' => array(
            'All'
        ),
			'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings'=> $headings,
			'subtitle'=>$subtitle,
			'big_picture'=>'http://www.escueladel10.com/sistema/reportes/logo.jpg',
			'small_icon'=>'http://www.escueladel10.com/sistema/reportes/logo.jpg'
		);
		
		$fields = json_encode($fields);
    	//print("\nJSON sent:\n");
    	//print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic MDAyNmY0OGMtNTBiMS00OTA1LWFmZDQtYjgxOTI4MmQ0ZDkx'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		
		 $this->response($response);
	
}

//###############################################--------CUSO--------############################################################

public function curso_post()

    {
    		$data=$this->post();

    		if( !isset($data['sucursal_categorias_idsucursal_categorias']) ) {

            $respuesta = array(
                'error' => TRUE,
                'mensaje'=>'la informacion enviada no es valida' 
            );

             $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST );

        return;
        }

        //#################################ID TOKEN NOTIFICACIONES#########################################

        $idsucursal=$data['sucursal_categorias_idsucursal_categorias'];
        $mensaje=$data['mensaje'];
        $titulo=$data['titulo'];
        $subtitulo=$data['subtitulo'];

    	 $query = $this->db->query("SELECT representante.token FROM `representante` 
		 INNER JOIN alumno ON alumno.representante_idrepresentante=representante.idrepresentante
		 INNER JOIN ficha_alumno ON ficha_alumno.alumno_idalumno=alumno.idalumno
		 INNER JOIN sucursal_categorias ON sucursal_categorias.idsucursal_categorias=ficha_alumno.sucursal_categorias_idsucursal_categorias
		 INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal WHERE sucursal_categorias.idsucursal_categorias='$idsucursal'");
    	

    	 $ids = array("d21ac39a-0fc2-400f-b456-64b99d8ac6f1");
       
    	

 		foreach ($query->result() as $row)
				{
        			  array_push($ids, $row->token);
				}

				//ENTRENADORES

		$this->db->reset_query();

		 $query = $this->db->query("SELECT entrenador.token FROM `entrenador`
		 INNER JOIN ficha_entrenador ON ficha_entrenador.entrenador_identrenador=entrenador.identrenador
		 INNER JOIN sucursal_categorias ON sucursal_categorias.idsucursal_categorias=ficha_entrenador.sucursal_categorias_idsucursal_categorias
		 INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal WHERE sucursal_categorias.idsucursal_categorias='$idsucursal'");

		 foreach ($query->result() as $row)
				{
        			  array_push($ids, $row->token);
				}

		//#######################################################################################################


		$content = array(
			"en" => $mensaje
			);

		$headings=["en" => $titulo];

		$subtitle=["en" => $subtitulo];

			
		
		$fields = array(
			'app_id' => "97f28ff2-fb65-47bc-8a29-770cb14cdb9b",
			'include_player_ids' => $ids,
			'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings'=> $headings,
			'subtitle'=>$subtitle,
			'big_picture'=>'http://www.escueladel10.com/sistema/reportes/logo.jpg',
			'small_icon'=>'http://www.escueladel10.com/sistema/reportes/logo.jpg'
		);
		
		$fields = json_encode($fields);
    	//print("\nJSON sent:\n");
    	//print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic MDAyNmY0OGMtNTBiMS00OTA1LWFmZDQtYjgxOTI4MmQ0ZDkx'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);


		
		
		 $this->response($response);
		 return $response;
	
      
}




}