<?php
$host = "localhost";
$user = "root";
$pass = "d3bora2008";
$db = "biblioteca";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
