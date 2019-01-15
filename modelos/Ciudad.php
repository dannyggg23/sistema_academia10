<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ciudad
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM ciudad";
		return ejecutarConsulta($sql);
	}

	public function selectidciudad($ciudad)
	{
		$ciudad="%".$ciudad."%";
		$sql="SELECT * FROM ciudad WHERE ciudad LIKE '$ciudad'";
		return ejecutarConsultaSimpleFila($sql);
	}
}

?>
