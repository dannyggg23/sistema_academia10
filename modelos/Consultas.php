<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    
    public function NumDeudores(){
    $sql="SELECT COUNT(ficha_alumno.idficha_alumno) as deudores FROM `ficha_alumno` INNER JOIN sucursal_categorias on sucursal_categorias.idsucursal_categorias=ficha_alumno.sucursal_categorias_idsucursal_categorias WHERE ficha_alumno.fecha_acceso <= CURDATE() AND ficha_alumno.estado=1";
    return ejecutarConsulta($sql);
  }

  public function NumAlumnos(){
    $sql="SELECT COUNT(ficha_alumno.idficha_alumno) as alumnos FROM `ficha_alumno` INNER JOIN sucursal_categorias on sucursal_categorias.idsucursal_categorias=ficha_alumno.sucursal_categorias_idsucursal_categorias";
    return ejecutarConsulta($sql);
  }

  public function NumEntrenadores(){
    $sql="SELECT COUNT(ficha_entrenador.idficha_entrenador) as entrenadores from ficha_entrenador WHERE ficha_entrenador.estado=1";
    return ejecutarConsulta($sql);
  }



	
}

?>