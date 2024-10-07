<?php
include_once "conexion.php"; 

class crudS {
    public static function SeleccionarEstudiantes()
     {
        $objetoconexion = new Conexion();
        $conn = $objetoconexion->conectar();
        $selectEstudiantes = "SELECT * FROM estudiantes";
        $result = $conn->prepare($selectEstudiantes);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        // Convertir los datos a JSON
        $dataJSon = json_encode($data);
        print_r($dataJSon);
    }
}
class crudS1 {
    public static function SeleccionarEstudiantes() {
        $objetoconexion = new Conexion();
        $conn = $objetoconexion->conectar();
        $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : null;

        if ($cedula) {
            $query = "SELECT * FROM estudiantes WHERE cedula = :cedula";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':cedula', $cedula);
        } else {
            $query = "SELECT * FROM estudiantes";
            $stmt = $conn->prepare($query);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response = [
            'total' => count($result), // El número total de registros encontrados
            'rows' => $result // Los registros
        ];

        echo json_encode($response);
    }
}
?>