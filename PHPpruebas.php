<?php

$objeto = new stdClass();//instancia de PHP
$objeto->nombre="Angie";
$objeto->apellido="Caiza";
print_r($objeto->nombre);//acceder a un atributo
echo(gettype($objeto));//tipo de dato
echo("<br>");

//array
$colores=array("azul","verde","rojo");
print_r($colores[0]);

echo("<br>");

//array asociativo clave valor
$arrayasociativo=array("nombre"=>"Angie","apellido"=>"Caiza");
print_r($arrayasociativo["nombre"]);
echo(gettype($arrayasociativo));//tipo de dato
echo("<br>");

//TRANSFORMACIONES
//JSON_ENCODE > CONVIERTE CUALQUIER TIPO DE PHP A JSON
$MIJSON=json_encode($arrayasociativo);
print_r($MIJSON);
echo(gettype($MIJSON));//tipo de dato
echo("<br>");

//Lista 
$lista='{"nombre"=>"Angie1","apellido"=>"Caiza1"}';
echo(gettype($lista));//tipo de dato
print_r($lista);
echo("<br>");

//JSON_DECOE > CONVIERTE CUALQUIER JSON A PHP
$lista1='{"nombre":"Angie2","apellido":"Caiza2"}';
$miphp=json_decode($lista1);
print_r($miphp->nombre);
echo(gettype($miphp));//tipo de dato

//TRANSFORMACIONES
//JSON_DECOE > CONVIERTE CUALQUIER JSON A PHP 
