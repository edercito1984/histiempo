<?php

$servername = "localhost";
$username = "root";
$password = "198422";
$dbname = "histiempo";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}
