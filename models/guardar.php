<?php
include_once "conexion.php";//elimina luego de hacer la conexion
//include :hace que se quede cargado en la pagina la clase con la conexion
class crudI{
    public static function guardarEstudiantes()
    {
    $objetoconexion = new conexion();
    $conn=$objetoconexion->conectar();

    $cedula=$_POST['cedula'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $direccion=$_POST['direccion'];
    $telefono=$_POST['telefono'];

    $guardarEstudiantes="INSERT INTO estudiantes  VALUES ('$cedula','$nombre', '$apellido', '$direccion', '$telefono')";
    $result=$conn->prepare($guardarEstudiantes);
    $result->execute();
    
    //print_r("Se innserto correctamente");.
    $dataJson = json_encode("Se innserto correctamente");
    print_r($dataJson);

    }
}
