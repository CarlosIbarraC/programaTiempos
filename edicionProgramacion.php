<?php

require_once "conexion.php";
$fecha=$_POST['fechaP'];
$id=$_POST['idP'];
$numero = $_POST['horaP'];
echo $id;
echo $numero;
$numero = strtotime($numero);
$numero = date("H:i", $numero);
 
$sentencia = "UPDATE  programacion  set fechaPrograma= '$fecha', hora = '$numero' where id='$id' ";
$ejecutar = $conexion->query($sentencia);
 
header("Location: hojaDeProgramacion.php#$id");
 ?>