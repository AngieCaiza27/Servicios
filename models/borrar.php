<?php
include_once "conexion.php";
class crudE{   
    public static function eliminarEstudiante()
    {
        $objetoconexion = new conexion();
        $conn=$objetoconexion->conectar();
        $cedula=$_GET['cedula'];
        $selectEstudiantes = "DELETE FROM estudiantes WHERE cedula='$cedula'";
        $result = $conn->prepare($selectEstudiantes);
        $result->execute();
        $dataJson = json_encode("Se borró correctamente");
        print_r($dataJson);
    }     
    
}

