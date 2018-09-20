<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Listar extends REST_Controller {

    public function __construct(){
        //PARA RECIBIR PETICIONES DE DIRERENRES ORIGENES
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        parent::__construct();
        $this->load->database();        
    }


    public function sucursales_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT sucursal.*,ciudad.ciudad,provincia.provincia,sucursal.imagen  
        FROM `sucursal` 
        INNER JOIN ciudad ON sucursal.ciudad_idCiudad=ciudad.idCiudad 
        INNER JOIN provincia where provincia.idProvincia=ciudad.IDPROVINCIA");
        $respuesta = array(
            'error' => FALSE,
            'sucursales' => $query->result_array()
        );
        $this->response($respuesta);    
   }

   public function ciudades_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * from ciudad ORDER BY ciudad ASC");
        $respuesta = array(
            'error' => FALSE,
            'ciudad' => $query->result_array()
        );
        $this->response($respuesta);    
   }

    public function categorias_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT sucursal_categorias.idsucursal_categorias,sucursal_categorias.disponible,sucursal_categorias.estado,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin,sucursal.imagen,sucursal.idsucursal,categoria.idcategoria,horario.idhorario FROM `sucursal_categorias` INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario");
        $respuesta = array(
            'error' => FALSE,
            'categorias' => $query->result_array()
        );
        $this->response($respuesta);   
   }

     public function categoriassolas_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * from categoria WHERE estado=1");

        $respuesta = array(
            'error' => FALSE,
            'categoria' => $query->result_array()
        );
        $this->response($respuesta);   
   }

     public function horario_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * from horario WHERE estado=1");

        $respuesta = array(
            'error' => FALSE,
            'horario' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   public function fichaentrenador_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT entrenador.cedula_entrenador,entrenador.nombre_entrenador,ficha_entrenador.estado,ficha_entrenador.idficha_entrenador,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre,sucursal_categorias.idsucursal_categorias,horario.hora_inicio,horario.hora_fin,entrenador.imagen_entrenador from entrenador INNER JOIN ficha_entrenador on ficha_entrenador.entrenador_identrenador=entrenador.identrenador INNER JOIN sucursal_categorias on sucursal_categorias.idsucursal_categorias=ficha_entrenador.sucursal_categorias_idsucursal_categorias INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario");

        $respuesta = array(
            'error' => FALSE,
            'fichaentrenador' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   public function categoriasdisponibles_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT sucursal_categorias.idsucursal_categorias,sucursal_categorias.disponible,sucursal_categorias.estado,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin,sucursal.imagen,sucursal.idsucursal,categoria.idcategoria,horario.idhorario FROM `sucursal_categorias` INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario WHERE sucursal_categorias.disponible=0 ");

        $respuesta = array(
            'error' => FALSE,
            'categoriadisponible' => $query->result_array()
        );
        $this->response($respuesta);   
   }

    public function categoriashorariosucursal_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT sucursal_categorias.idsucursal_categorias,sucursal_categorias.disponible,sucursal_categorias.estado,sucursal.nombre_sucursal,categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin,sucursal.imagen,sucursal.idsucursal,categoria.idcategoria,horario.idhorario FROM `sucursal_categorias` INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario ");

        $respuesta = array(
            'error' => FALSE,
            'categoriashorariosucursal' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   public function entrenadores_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * from entrenador where estado=1 ");

        $respuesta = array(
            'error' => FALSE,
            'entrenador' => $query->result_array()
        );
        $this->response($respuesta);   
   }

 public function fichaalumno_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT ficha_alumno.*,
    alumno.genero_alumno,
    alumno.cedula_alumno,
    alumno.nombre_alumno,
    sucursal.nombre_sucursal,
    categoria.nombre_categoria,horario.nombre as horario,
    horario.hora_inicio,
    horario.hora_fin,
    CURDATE() as fecha_actual 
    FROM `ficha_alumno` 
    INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno 
    INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias 
    INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria 
    INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal 
    INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario 
    ORDER BY ficha_alumno.fechaApertura_alumno DESC");

        $respuesta = array(
            'error' => FALSE,
            'fichaalumno' => $query->result_array()
        );
        $this->response($respuesta);   
   }


 public function categoriasPorSucursal_get($idsucursal)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT 
  `sucursal_categorias`.`idsucursal_categorias`,
  `categoria`.`idcategoria`,
  `categoria`.`nombre_categoria`,
  `categoria`.`descripcion_categoria`,
  `categoria`.`estado`,
  `sucursal`.`idsucursal`,
  `horario`.`idhorario`,
  `horario`.`nombre`,
  `horario`.`hora_inicio`,
  `horario`.`hora_fin`,
  `horario`.`estado`
FROM
  `sucursal_categorias`
  INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
  INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
  INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)

WHERE sucursal.idsucursal='$idsucursal'");

        $respuesta = array(
            'error' => FALSE,
            'categoriashorarios' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   public function alumnosCategoria_get($idsucursal_categorias)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT 
  `sucursal_categorias`.`idsucursal_categorias`,
  `alumno`.`idalumno`,
  `alumno`.`cedula_alumno`,
  `alumno`.`nombre_alumno`,
  `alumno`.`genero_alumno`,
  `alumno`.`imagen_alumno`,
  `alumno`.`representante_idrepresentante`,
  `alumno`.`tipo_sangre_alumno`,
  `alumno`.`escuela_alumno`,
  `alumno`.`fecha_nacimiento`,
  `alumno`.`posicion_alumno`,
  `alumno`.`peso_alumno`,
  `alumno`.`talla_alumno`,
  `alumno`.`informacion_alumno`,
  `ficha_alumno`.`idficha_alumno`,
  `ficha_alumno`.`numeroFicha_alumno`,
  `ficha_alumno`.`fechaApertura_alumno`,
  `ficha_alumno`.`alumno_idalumno`,
  `ficha_alumno`.`fecha_acceso`,
  `ficha_alumno`.`sucursal_categorias_idsucursal_categorias`,
  `ficha_alumno`.`descuento_ficha_alumno`,
  `ficha_alumno`.`inscripcion`,
  `ficha_alumno`.`estado`,
  `representante`.`cedula_representante`,
  `representante`.`nombre_representante`,
  `representante`.`email_representante`,
  `representante`.`telefono_representante`,
  `representante`.`celular_representante`
FROM
  `ficha_alumno`
  INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
  INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
  INNER JOIN `representante` ON (`alumno`.`representante_idrepresentante` = `representante`.`idrepresentante`)
WHERE sucursal_categorias.idsucursal_categorias='$idsucursal_categorias'");

        $respuesta = array(
            'error' => FALSE,
            'alumnosCategoria' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   public function representantes_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * from representante where estado=1 ");

        $respuesta = array(
            'error' => FALSE,
            'representantes' => $query->result_array()
        );
        $this->response($respuesta);   
   }

    public function buscarrepresentantes_get($representante)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * FROM `representante` 
            WHERE representante.nombre_representante like '%$representante%' 
            OR representante.cedula_representante like '%$representante%' 
            AND representante.estado=1");

        $respuesta = array(
            'error' => FALSE,
            'representantes' => $query->result_array()
        );
        $this->response($respuesta);   
   }

    public function alumnoPorRepresentante_get($representante)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query(" SELECT 
  `representante`.`idrepresentante`,
  `alumno`.`cedula_alumno`,
  `alumno`.`nombre_alumno`,
  `alumno`.`imagen_alumno`,
  `ficha_alumno`.`idficha_alumno`,
  `alumno`.`idalumno`,
  `ficha_alumno`.`fecha_acceso`,
  `ficha_alumno`.`descuento_ficha_alumno`,
  `alumno`.`posicion_alumno`
  FROM
  `alumno`
  INNER JOIN `representante` ON (`alumno`.`representante_idrepresentante` = `representante`.`idrepresentante`)
  INNER JOIN `ficha_alumno` ON (`alumno`.`idalumno` = `ficha_alumno`.`alumno_idalumno`) WHERE representante.idrepresentante='$representante'");

        $respuesta = array(
            'error' => FALSE,
            'alumnos' => $query->result_array()
        );
        $this->response($respuesta);   
   }


  //########################--ENTRENADORES--#######################//

    public function cursosEntrenador_get($identrenador)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT 
  `ficha_entrenador`.`idficha_entrenador`,
  `entrenador`.`identrenador`,
  `sucursal`.`idsucursal`,
  `sucursal`.`nombre_sucursal`,
  `ciudad`.`ciudad`,
  `sucursal`.`imagen`,
  `sucursal_categorias`.`idsucursal_categorias`,
  `categoria`.`idcategoria`,
  `categoria`.`nombre_categoria`,
  `horario`.`idhorario`,
  `horario`.`nombre`,
  `horario`.`hora_inicio`,
  `horario`.`hora_fin`
  FROM
  `sucursal_categorias`
  INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
  INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
  INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
  INNER JOIN `ficha_entrenador` ON (`sucursal_categorias`.`idsucursal_categorias` = `ficha_entrenador`.`sucursal_categorias_idsucursal_categorias`)
  INNER JOIN `entrenador` ON (`ficha_entrenador`.`entrenador_identrenador` = `entrenador`.`identrenador`)
  INNER JOIN `ciudad` ON (`sucursal`.`ciudad_idCiudad` = `ciudad`.`idCiudad`)
  WHERE entrenador.identrenador='$identrenador'");

        $respuesta = array(
            'error' => FALSE,
            'cursos' => $query->result_array()
        );
        $this->response($respuesta);   
   }


 public function AsistenciaCursosEntrenador_get($idsucursalCategoria,$fecha)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT 
  `asistencia`.`idasistencia`,
  `asistencia`.`asistencia_alumno`,
  `asistencia`.`fecha_asistencia`,
  `asistencia`.`ficha_alumno_idficha_alumno`,
  `ficha_alumno`.`idficha_alumno`,
  `alumno`.`idalumno`,
  `sucursal_categorias`.`idsucursal_categorias`,
  `alumno`.`nombre_alumno`,
  `alumno`.`imagen_alumno`,
  `alumno`.`cedula_alumno`
FROM
  `ficha_alumno`
  INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
  INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
  INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)
WHERE sucursal_categorias.idsucursal_categorias='$idsucursalCategoria' AND asistencia.fecha_asistencia like '$fecha' ");

        $respuesta = array(
            'error' => FALSE,
            'alumnos' => $query->result_array()
        );
        $this->response($respuesta);   
   }
   

/////########################REPRESENTANTES//#########################

public function AlumnosRepresentante_get($idrepresentante)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT 
  `representante`.`idrepresentante`,
  `alumno`.`idalumno`,
  `alumno`.`cedula_alumno`,
  `alumno`.`nombre_alumno`,
  `ficha_alumno`.`idficha_alumno`,
  `sucursal`.`idsucursal`,
  `sucursal`.`nombre_sucursal`,
  `categoria`.`idcategoria`,
  `categoria`.`nombre_categoria`,
  `sucursal_categorias`.`idsucursal_categorias`,
  `horario`.`idhorario`,
  `horario`.`nombre`,
  `horario`.`hora_inicio`,
  `horario`.`hora_fin`,
  `alumno`.`genero_alumno`,
  `alumno`.`imagen_alumno`,
  `alumno`.`representante_idrepresentante`,
  `alumno`.`estado`,
  `alumno`.`tipo_sangre_alumno`,
  `alumno`.`escuela_alumno`,
  `alumno`.`fecha_nacimiento`,
  `alumno`.`posicion_alumno`,
  `alumno`.`peso_alumno`,
  `alumno`.`talla_alumno`,
  `alumno`.`informacion_alumno`
  FROM
  `alumno`
  INNER JOIN `representante` ON (`alumno`.`representante_idrepresentante` = `representante`.`idrepresentante`)
  INNER JOIN `ficha_alumno` ON (`alumno`.`idalumno` = `ficha_alumno`.`alumno_idalumno`)
  INNER JOIN `sucursal_categorias` ON (`ficha_alumno`.`sucursal_categorias_idsucursal_categorias` = `sucursal_categorias`.`idsucursal_categorias`)
  INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
  INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
  INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
  WHERE representante.idrepresentante='$idrepresentante'");

        $respuesta = array(
            'error' => FALSE,
            'alumnos' => $query->result_array()
        );
        $this->response($respuesta);   
   }
  

   
}