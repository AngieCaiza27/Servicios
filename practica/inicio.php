<?php
include_once 'conexion.php';

$pdo=new conexion();//se crea la conexion a la base de datos

if($_SERVER['REQUEST_METHOD']=='GET'){//VAS SER UNA INSTRUCCION GET
    if(isset($_GET['id'])){//si el id esta presente entonces solo me trae el estudiante con ese id
        $sql =$pdo->prepare("SELECT * FROM estudiantes WHERE id=:id");//se crea la sentencia sql
        $sql->bindParam(':id',$_GET['id']);//se le asigna el valor del id para que se ejecute la sentencia sql sin error
        $sql->execute();//se ejecuta la sentencia sql
        $sql -> setFetchMode(PDO::FETCH_ASSOC);//es fetch mode de asociativo que es el que nos devuelve un array asociativo
        header("HTTP/1.1 200 OK");//se establece el header de la respuesta
        echo json_encode($sql->fetchAll());//se devuelve el json
        exit();

    }else {
        $sql =$pdo->prepare("SELECT * FROM estudiantes");//se crea la sentencia sql
        $sql->execute();//se ejecuta la sentencia sql
        $sql -> setFetchMode(PDO::FETCH_ASSOC);//es fetch mode de asociativo que es el que nos devuelve un array asociativo
        header("HTTP/1.1 200 OK");//se establece el header de la respuesta
        echo json_encode($sql->fetchAll());//se devuelve el json
        exit();
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){//VAS SER UNA INSTRUCCION POST
    $sql =$pdo->prepare("INSERT INTO estudiantes (nombre, apellido, telefono,email) 
    VALUES (:nombre,:apellido,:telefono,:email)");//se crea la sentencia sql
    $sql->bindParam(':nombre',$_POST['nombre']);
    $sql->bindParam(':apellido',$_POST['apellido']);
    $sql->bindParam(':telefono',$_POST['telefono']);
    $sql->bindParam(':email',$_POST['email']);
    $sql->execute();
    $idPost=$pdo->lastInsertId();//se obtiene el id de la sentencia sql
    if($idPost){//si el id es valido entonces se devuelve el json
        header("HTTP/1.1 200 OK");//se establece el header de la respuesta
        echo json_encode($idPost);//se devuelve el json
        exit();
    }
}

if($_SERVER['REQUEST_METHOD']=='PUT'){//VAS SER UNA INSTRUCCION PUT
    $sql =$pdo->prepare("UPDATE estudiantes SET nombre=:nombre,apellido=:apellido,telefono=:telefono,email=:email WHERE id=:id");//se crea la sentencia sql
    $sql->bindParam(':id',$_GET['id']);
    $sql->bindParam(':nombre',$_GET['nombre']);
    $sql->bindParam(':apellido',$_GET['apellido']);
    $sql->bindParam(':telefono',$_GET['telefono']);
    $sql->bindParam(':email',$_GET['email']);
    $sql->execute();
    header("HTTP/1.1 200 OK");//se establece el header de la respuesta
    exit();
  }

  if($_SERVER['REQUEST_METHOD']=='DELETE'){//VAS SER UNA INSTRUCCION PUT
    $sql =$pdo->prepare("DELETE FROM estudiantes WHERE id=:id");//se crea la sentencia sql
    $sql->bindParam(':id',$_GET['id']);
    $sql->execute();
    header("HTTP/1.1 200 OK");//se establece el header de la respuesta
    exit();
  }
