<?php

require_once "conexion.php";

$id=$_POST['idP'];
$numero = $_POST['horaP'];
$

 
$sentencia = "UPDATE  programacion  set hora='$numero' where id='$id' ";
 echo $ejecutar = $conexion->query($sentencia);
 

 ?>