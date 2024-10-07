<?php
$json = file_get_contents('movies.json');
$movies = json_decode($json, true);

echo "1. Listar el título, año y duración de todas las películas.\n";
for ($i = 0; $i < count($movies); $i++) {
    echo ("<br>");
    echo "Título de la película: " . $movies[$i]['title'] . " - Año: " . $movies[$i]['year'] . " - Duración: " . $movies[$i]['duration'];
}

echo ("<br>");
echo ("-----------------------------------------------------------------------------------------------");
echo ("<br>");

echo "2. Mostrar los títulos de las películas y el número de actores/actrices que tiene cada una.\n";
for ($i = 0; $i < count($movies); $i++) {
    echo ("<br>");
    echo "Título de la película: " . $movies[$i]['title'] . " - Número de actores: " . count($movies[$i]['actors']) ;
}

echo ("<br>");
echo ("-----------------------------------------------------------------------------------------------");
echo ("<br>");

echo "3.Mostrar las películas que contengan en la sinopsis dos palabras dadas.\n";
echo ("<br>");
$palabra1 = "prosecution";
$palabra2 = "guilty";
echo "Películas que contienen en la sinopsis: $palabra1 y $palabra2\n";
for ($i = 0; $i < count($movies); $i++) {
    echo ("<br>");
    if (strpos($movies[$i]['storyline'], $palabra1) !== false && strpos($movies[$i]['storyline'], $palabra2) !== false) {
        echo "Título con las palabras claves: " . $movies[$i]['title'];
    }
}
echo ("<br>");
echo ("-----------------------------------------------------------------------------------------------");
echo ("<br>");

$actorDado = "Morgan Freeman";
echo "Películas en las que ha trabajado: $actorDado";
for ($i = 0; $i < count($movies); $i++) {
    echo ("<br>");
    if (in_array($actorDado, $movies[$i]['actors'])) {
        echo "Título de la película: " . $movies[$i]['title'];
    }
}

?>