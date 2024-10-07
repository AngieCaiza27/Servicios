<?php
include '../models/acceder.php';
include '../models/guardar.php';
include '../models/borrar.php';
include '../models/editar.php';
$opc=$_SERVER['REQUEST_METHOD'];
switch($opc)
{
    case 'GET':
    crudS1:: SeleccionarEstudiantes();
    break ;

    case 'POST':
    crudI::guardarEstudiantes();
    break;

    case 'DELETE':
	$cedula=$_GET['cedula'];
    crudE::eliminarEstudiante($cedula);
    break;

    case 'PUT':
		if (isset($_GET['cedula'])) {
		crudU::modificarEstudiante($_GET['cedula']);
	}else {
		echo json_encode(['success' => false, 'errorMsg' => 'No se envió la cédula']);
	}
		break;
        
}
