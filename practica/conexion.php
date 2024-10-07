<?php

class conexion extends PDO //servicio de conexion a la base de datos de PHP --- es una herencia de esta clase
{
    private $host="localhost";//direccion de la base de datos
    private $user="root";
    private $pass="";
    private $db="estudiantes";//nombre de la base de datos
    
    public function __construct()//es el constructor de la clase
    {
        try{
            parent::__construct("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass, //se crea la conexion a la base de datos
            array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));//se establece el modo de error

        }catch(PDOException $e){
            echo'ERROR: '.$e->getMessage();
            exit();
        }
    }

    //private function convertirUFt8($array){//se convierte el string a utf-8
       //array_walk_recursive($array, function (&$item, $key){
            //if(!mb_detect_encoding($item, 'UTF-8', true)){
                //$item = utf8_encode($item);
           // }
       // });
        //return $array;
    //}
}