<?php

$servername  = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "alojamientos";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    
    die("Conexión fallida: " . $conn->connect_error);
}





