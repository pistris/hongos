<?php
    @session_start();
    require('php/conexion.php');
    
    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
    
    $idUsuario = $_SESSION['id_usuario'];
    
  $sql = "SELECT u.id, p.nombre, p.apellidos FROM usuarios AS u INNER JOIN personal AS p ON u.id_personal=p.id WHERE u.id = '$idUsuario'";
  


// primero conectamos siempre a la base de datos mysql
    $mysqli = new mysqli("localhost","root", "", "hongo");
$query = $mysqli->prepare("SELECT * FROM hongos WHERE ID='$idUsuario'");
$query->execute();
$query->store_result();

$rows = $query->num_rows;

echo $rows;


?>