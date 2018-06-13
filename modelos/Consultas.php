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
    $sql="SELECT COUNT(ficha_alumno.idficha_alumno) as deudores FROM `ficha_alumno` INNER JOIN alumno on alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN categoria ON ficha_alumno.categoria_idcategoria=categoria.idcategoria INNER JOIN horario ON horario.idhorario=categoria.horario_idhorario WHERE ficha_alumno.fecha_acceso <= CURDATE() AND ficha_alumno.estado=1";
    return ejecutarConsulta($sql);
  }

  public function NumAlumnos(){
    $sql="SELECT COUNT(ficha_alumno.idficha_alumno) as alumnos FROM `ficha_alumno` INNER JOIN alumno on alumno.idalumno=ficha_alumno.alumno_idalumno INNER JOIN categoria ON ficha_alumno.categoria_idcategoria=categoria.idcategoria INNER JOIN horario ON horario.idhorario=categoria.horario_idhorario where ficha_alumno.estado=1 ";
    return ejecutarConsulta($sql);
  }

  public function NumEntrenadores(){
    $sql="SELECT COUNT(ficha_entrenador.idficha_entrenador) as entrenadores from ficha_entrenador WHERE ficha_entrenador.estado=1";
    return ejecutarConsulta($sql);
  }



	
}

?>