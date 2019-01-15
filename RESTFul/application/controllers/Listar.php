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
        INNER JOIN provincia WHERE provincia.idProvincia=ciudad.IDPROVINCIA AND sucursal.estado=1");
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
        $query = $this->db->query("SELECT sucursal_categorias.idsucursal_categorias,
        sucursal_categorias.disponible,sucursal_categorias.estado,
        sucursal.nombre_sucursal,categoria.nombre_categoria,
        horario.nombre,horario.hora_inicio,horario.hora_fin,
        sucursal.imagen,sucursal.idsucursal,categoria.idcategoria,horario.idhorario 
        FROM `sucursal_categorias` 
        INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal 
        INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria 
        INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario 
        WHERE sucursal_categorias.estado=1");
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
        $query = $this->db->query("SELECT entrenador.cedula_entrenador,
        entrenador.nombre_entrenador,
        ficha_entrenador.estado,ficha_entrenador.idficha_entrenador,
        sucursal.nombre_sucursal,categoria.nombre_categoria,
        horario.nombre,sucursal_categorias.idsucursal_categorias,
        horario.hora_inicio,horario.hora_fin,entrenador.imagen_entrenador 
        from entrenador 
        INNER JOIN ficha_entrenador on ficha_entrenador.entrenador_identrenador=entrenador.identrenador 
        INNER JOIN sucursal_categorias on sucursal_categorias.idsucursal_categorias=ficha_entrenador.sucursal_categorias_idsucursal_categorias 
        INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal 
        INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria 
        INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario 
        WHERE ficha_entrenador.estado=1");

        $respuesta = array(
            'error' => FALSE,
            'fichaentrenador' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   public function categoriasdisponibles_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT sucursal_categorias.idsucursal_categorias,
        sucursal_categorias.disponible,sucursal_categorias.estado,
        sucursal.nombre_sucursal,categoria.nombre_categoria,
        horario.nombre,horario.hora_inicio,
        horario.hora_fin,sucursal.imagen,
        sucursal.idsucursal,categoria.idcategoria,
        horario.idhorario FROM `sucursal_categorias` 
        INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal 
        INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria 
        INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario 
        WHERE sucursal_categorias.disponible=0 
        AND sucursal_categorias.estado=1 ");

        $respuesta = array(
            'error' => FALSE,
            'categoriadisponible' => $query->result_array()
        );
        $this->response($respuesta);   
   }

    public function categoriashorariosucursal_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT sucursal_categorias.idsucursal_categorias,sucursal_categorias.disponible,
        sucursal_categorias.estado,sucursal.nombre_sucursal,
        categoria.nombre_categoria,horario.nombre,horario.hora_inicio,horario.hora_fin,sucursal.imagen,
        sucursal.idsucursal,categoria.idcategoria,horario.idhorario 
        FROM `sucursal_categorias` INNER JOIN sucursal ON sucursal.idsucursal=sucursal_categorias.sucursal_idsucursal 
        INNER JOIN categoria ON categoria.idcategoria=sucursal_categorias.categoria_idcategoria 
        INNER JOIN horario ON horario.idhorario=sucursal_categorias.horario_idhorario
        WHERE sucursal_categorias.estado=1  ");

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
    WHERE ficha_alumno.estado=1
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

WHERE sucursal.idsucursal='$idsucursal'
AND sucursal_categorias.estado=1
");

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
WHERE sucursal_categorias.idsucursal_categorias='$idsucursal_categorias' AND
ficha_alumno.estado=1");

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
  `alumno`.`posicion_alumno`,
  `ficha_alumno`.inscripcion
  FROM
  `alumno`
  INNER JOIN `representante` ON (`alumno`.`representante_idrepresentante` = `representante`.`idrepresentante`)
  INNER JOIN `ficha_alumno` ON (`alumno`.`idalumno` = `ficha_alumno`.`alumno_idalumno`) 
  WHERE representante.idrepresentante='$representante' AND ficha_alumno.estado=1");

        $respuesta = array(
            'error' => FALSE,
            'alumnos' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   public function pagoPorRepresentante_get($representante)
   {
       //$pagina=$pagina*5;
       $query = $this->db->query("  SELECT 
       `pago`.`idpago`,
       `pago`.`representante_idrepresentante`,
       `pago`.`usuario_idusuario`,
       `pago`.`fecha`,
       `pago`.`total`,
       `pago`.`tipo_documento`,
       `pago`.`estado`,
       `pago`.`serie_comprobante`,
       `pago`.`num_comprobante`,
       `pago`.`impuesto`,
       `pago`.`subtotal`,
       `representante`.`idrepresentante`
     FROM
       `representante`
       INNER JOIN `pago` ON (`representante`.`idrepresentante` = `pago`.`representante_idrepresentante`) 
       WHERE representante.idrepresentante='$representante'
       AND pago.estado='Aceptado'
       ORDER BY pago.fecha DESC");

       $respuesta = array(
           'error' => FALSE,
           'pagos' => $query->result_array()
       );
       $this->response($respuesta);   
  }


  public function detallePago_get($idpago)
  {
      //$pagina=$pagina*5;
      $query = $this->db->query("SELECT 
      `detalle_pago`.`pago_idpago`,
      `detalle_pago`.`precio_pago`,
      `detalle_pago`.`descuento_pago`,
      `detalle_pago`.`numero_meses_pago`,
      `pago`.`idpago`,
      `detalle_pago`.`iddetalle_pago`,
      `ficha_alumno`.`idficha_alumno`,
      `detalle_pago`.`ficha_alumno_idficha_alumno`,
      `detalle_pago`.`productos_servicios_idproductos_servicios`,
      `alumno`.`idalumno`,
      `alumno`.`nombre_alumno`,
      `productos_servicios`.`nombre_productos_servicios`,
      `productos_servicios`.`idproductos_servicios`,
      `categorias_productos_servicios`.`idcategorias_productos_servicios`,
      `categorias_productos_servicios`.`nombre_categoria_productos`
    FROM
      `detalle_pago`
      INNER JOIN `pago` ON (`detalle_pago`.`pago_idpago` = `pago`.`idpago`)
      INNER JOIN `ficha_alumno` ON (`detalle_pago`.`ficha_alumno_idficha_alumno` = `ficha_alumno`.`idficha_alumno`)
      INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
      INNER JOIN `productos_servicios` ON (`detalle_pago`.`productos_servicios_idproductos_servicios` = `productos_servicios`.`idproductos_servicios`)
      INNER JOIN `categorias_productos_servicios` ON (`productos_servicios`.`categorias_productos_servicios_idcategorias_productos_servicios` = `categorias_productos_servicios`.`idcategorias_productos_servicios`)
      WHERE pago.idpago='$idpago'");

      $respuesta = array(
          'error' => FALSE,
          'detallePagos' => $query->result_array()
      );
      $this->response($respuesta);   
 }

 public function deudoresSucursal_get($id)
 {
     //$pagina=$pagina*5;
     $query = $this->db->query("SELECT ficha_alumno.*, 
     alumno.cedula_alumno,
     alumno.genero_alumno, 
     alumno.nombre_alumno,
     sucursal.nombre_sucursal, 
     categoria.nombre_categoria,
     horario.nombre as horario, 
     alumno.imagen_alumno,horario.hora_inicio,horario.hora_fin, CURDATE()
      as fecha_actual, TIMESTAMPDIFF(MONTH, ficha_alumno.fecha_acceso, CURDATE() )
       AS num_meses 
       FROM `ficha_alumno` 
       INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno 
       INNER JOIN sucursal_categorias on ficha_alumno.sucursal_categorias_idsucursal_categorias=sucursal_categorias.idsucursal_categorias 
       INNER JOIN categoria on sucursal_categorias.categoria_idcategoria=categoria.idcategoria 
       INNER JOIN sucursal ON sucursal_categorias.sucursal_idsucursal=sucursal.idsucursal 
       INNER JOIN horario on horario.idhorario=sucursal_categorias.horario_idhorario 
       WHERE ficha_alumno.fecha_acceso <= CURDATE() 
       AND sucursal_categorias.idsucursal_categorias='$id' 
       AND ficha_alumno.estado=1
       ORDER BY ficha_alumno.fechaApertura_alumno DESC");

     $respuesta = array(
         'error' => FALSE,
         'deudores' => $query->result_array()
     );
     $this->response($respuesta);   
}


public function productosServicios_get()
 {
     //$pagina=$pagina*5;
     $query = $this->db->query("SELECT * FROM `productos_servicios` 
     WHERE productos_servicios.idproductos_servicios=1 
     OR productos_servicios.idproductos_servicios=2");

     $respuesta = array(
         'error' => FALSE,
         'servicios' => $query->result_array()
     );
     $this->response($respuesta);   
}



public function busquedaAlumnos_get($nombre_alumno)
 {
     //$pagina=$pagina*5;
     $query = $this->db->query("SELECT 
     `alumno`.`idalumno`,
     `alumno`.`nombre_alumno`,
     `ficha_alumno`.`idficha_alumno`
   FROM
     `ficha_alumno`
     INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
   WHERE alumno.nombre_alumno like '$nombre_alumno'");

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
  ficha_alumno.fecha_acceso,
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
  WHERE representante.idrepresentante='$idrepresentante' AND ficha_alumno.estado=1");

        $respuesta = array(
            'error' => FALSE,
            'alumnos' => $query->result_array()
        );
        $this->response($respuesta);   
   }
  


public function AsistenciaAlumnosRepresentante_get($idalumno)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("
          SELECT 
  `asistencia`.`idasistencia`,
  `asistencia`.`asistencia_alumno`,
  `asistencia`.`fecha_asistencia`,
  `asistencia`.`ficha_alumno_idficha_alumno`,
  `alumno`.`idalumno`,
  alumno.nombre_alumno,
alumno.cedula_alumno,
  `ficha_alumno`.`idficha_alumno`
FROM
  `ficha_alumno`
  INNER JOIN `alumno` ON (`ficha_alumno`.`alumno_idalumno` = `alumno`.`idalumno`)
  INNER JOIN `asistencia` ON (`ficha_alumno`.`idficha_alumno` = `asistencia`.`ficha_alumno_idficha_alumno`)

  WHERE alumno.idalumno='$idalumno'");

        $respuesta = array(
            'error' => FALSE,
            'asistencias' => $query->result_array()
        );
        $this->response($respuesta);   
   }


   public function imagenesDepositos_get($idrepresentante)
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT pagos_deposito.*,
        alumno.nombre_alumno FROM `pagos_deposito` 
        INNER JOIN ficha_alumno ON ficha_alumno.idficha_alumno=pagos_deposito.ficha_alumno_idficha_alumno 
        INNER JOIN alumno ON alumno.idalumno=ficha_alumno.alumno_idalumno 
        INNER JOIN representante ON representante.idrepresentante=alumno.representante_idrepresentante 
        WHERE representante.idrepresentante='$idrepresentante'");

        $respuesta = array(
            'error' => FALSE,
            'depositos' => $query->result_array()
        );
        $this->response($respuesta);   
   }


   //##################informacion###################################

public function CategoriasDisponiblesInfo_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * FROM `categoria` WHERE estado=1");

        $respuesta = array(
            'error' => FALSE,
            'categorias' => $query->result_array()
        );
        $this->response($respuesta);   
   }



   public function HorariosDisponiblesInfo_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * FROM `horario` WHERE estado=1");

        $respuesta = array(
            'error' => FALSE,
            'horarios' => $query->result_array()
        );
        $this->response($respuesta);   
   }


   public function NoticiasDisponiblesInfo_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * FROM `noticias` WHERE estado=1");

        $respuesta = array(
            'error' => FALSE,
            'noticias' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   
   public function EntrenadoresDisponiblesInfo_get()
    {
        //$pagina=$pagina*5;
        $query = $this->db->query("SELECT * FROM `entrenador` WHERE entrenador.estado=1");

        $respuesta = array(
            'error' => FALSE,
            'entrenadores' => $query->result_array()
        );
        $this->response($respuesta);   
   }

   public function SucCatHorInfo_get()
   {
       //$pagina=$pagina*5;
       $query = $this->db->query("SELECT 
       `sucursal_categorias`.`idsucursal_categorias`,
       `sucursal_categorias`.`sucursal_idsucursal`,
       `sucursal_categorias`.`categoria_idcategoria`,
       `sucursal_categorias`.`horario_idhorario`,
       `sucursal`.`idsucursal`,
       `categoria`.`idcategoria`,
       `categoria`.`nombre_categoria`,
       `sucursal`.`nombre_sucursal`,
       `horario`.`nombre`,
       `horario`.`hora_inicio`,
       `horario`.`hora_fin`,
       `horario`.`idhorario`,
       `sucursal_categorias`.`estado`
     FROM
       `sucursal_categorias`
       INNER JOIN `sucursal` ON (`sucursal_categorias`.`sucursal_idsucursal` = `sucursal`.`idsucursal`)
       INNER JOIN `categoria` ON (`sucursal_categorias`.`categoria_idcategoria` = `categoria`.`idcategoria`)
       INNER JOIN `horario` ON (`sucursal_categorias`.`horario_idhorario` = `horario`.`idhorario`)
       WHERE sucursal_categorias.estado=1 ");

       $respuesta = array(
           'error' => FALSE,
           'SucCatHor' => $query->result_array()
       );
       $this->response($respuesta);   
  }



   

   //////datos academia///#########################################################

   public function datosFactura_get()
   {
       //$pagina=$pagina*5;
       $query = $this->db->query("SELECT datos_academia.*, CURDATE() AS fecha_actual 
       from datos_academia WHERE datos_academia.iddatos_academia=1 ");

       $respuesta = array(
           'error' => FALSE,
           'factura' => $query->result_array()
       );
       $this->response($respuesta);   
  }

  public function imagenesApp_get()
  {
      //$pagina=$pagina*5;
      $query = $this->db->query("SELECT * FROM `imagenes_app` WHERE estado=1");

      $respuesta = array(
          'error' => FALSE,
          'imagenes' => $query->result_array()
      );
      $this->response($respuesta);   
 }


   
}