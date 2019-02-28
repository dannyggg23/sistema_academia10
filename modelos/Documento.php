
<?php
    require "../config/Conexion.php";
    
    Class Documento
    {
      public function _construct(){
    
      }
    
      public function insertar($nombre,$descripcion,$tipo,$imagen){
        $sql="INSERT INTO documento (nombre,descripcion,tipo,imagen)
         VALUES ('$nombre','$descripcion','$tipo','$imagen')";
        return ejecutarConsulta($sql);
      }

      public function editar($id_documento,$nombre,$descripcion,$tipo,$imagen){
        $sql="UPDATE documento SET 
        nombre='$nombre',descripcion='$descripcion',tipo='$tipo',imagen='$imagen'
         WHERE id_documento= '$id_documento'";
        return ejecutarConsulta($sql);
      }

       public function desactivar($id_documento){
        $sql="UPDATE documento SET estado='0'  WHERE id_documento= '$id_documento' ";
        return ejecutarConsulta($sql);
        }

        public function activar($id_documento){
        $sql="UPDATE documento SET estado='1'  WHERE id_documento= '$id_documento' ";
        return ejecutarConsulta($sql);
        }

        public function mostrar($id_documento){
        $sql="SELECT * FROM documento WHERE id_documento= '$id_documento' ";
        return ejecutarConsultaSimpleFila($sql);
        }

        public function listar(){
        $sql="SELECT * FROM documento";
        return ejecutarConsulta($sql);
        }

        public function select(){
        $sql="SELECT * FROM documento where estado=1";
        return ejecutarConsulta($sql);
        }

        
    }
?>