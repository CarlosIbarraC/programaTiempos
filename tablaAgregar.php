<?php
/* 
------------------------------------inserta datos nuevos-------------------------- */

require_once "conexion.php";
require_once "functions.php";    

$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$estado = $_POST['estado'];
$prueba = $_POST['nombre'].$_POST['fecha'];

$sentencia = "INSERT INTO empleados (numero,nombre,fecha,estado,prueba) values ('$numero','$nombre','$fecha','$estado','$prueba')";
	 $ejecutar = mysqli_query($conexion,$sentencia);
	 seleccionarHora();
	
 	return $ejecutar;

?>