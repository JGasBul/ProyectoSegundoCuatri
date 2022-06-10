<?php

$serverNombre = "localhost";
$userNombre = "root";
$password = "";
$dbNombre = "mapas";

// Crear la conexión
$conn = mysqli_connect($serverNombre, $userNombre, $password, $dbNombre);

// Chequear la conexión
if (!$conn) {
    die("Error: " . mysqli_connect_error());
}

mysqli_query($conn, 'SET NAMES utf8');
