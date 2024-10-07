<?php
require("conexion.php");
if (isset($_POST)) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    if (empty($_POST['idp'])){
        $query = $pdo->prepare("INSERT INTO estudiantes (id, nombre, apellido, telefono, email) VALUES (:id, :nom, :ape, :tel, :email)");
        $query->bindParam(":id", $id);
        $query->bindParam(":nom", $nombre);
        $query->bindParam(":ape", $apellido);
        $query->bindParam(":tel", $telefono);
        $query->bindParam(":email", $email);
        $query->execute();
        $pdo = null;
        echo "ok";
    
    }else{
        $id = $_POST['idp'];
        $query =$pdo->prepare("UPDATE estudiantes SET nombre=:nombre,apellido=:apellido,telefono=:telefono,email=:email WHERE id=:id");//se crea la sentencia sql
        $query->bindParam(":id", $id);
        $query->bindParam(":nombre", $nombre);
        $query->bindParam(":apellido", $apellido);
        $query->bindParam(":telefono", $telefono);
        $query->bindParam(":email", $email);
        $query->execute();
        $pdo = null;
        echo "ok";
    }
    
}
