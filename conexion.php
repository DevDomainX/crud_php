<?php
// coneccion base de datos

$servidor = "localhost";
$usuario = "root";
$password = "";
$db = "eventos";

$conexion = new mysqli($servidor, $usuario, $password, $db);
if ($conexion){
    echo "<center><h1>conexion establecida</h1></center><br>";
}else{
    die("<center><h1>Error de coneccon</h1></center><br>".$conexion->connect_error);
}


?>