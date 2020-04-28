<?php
/* 
------------------------------------inserta datos nuevos-------------------------- */

require_once "conexion.php";
require_once "functions.php";    

$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$estado = $_POST['estado'];
$date = date_create($fecha);
$date= date_format($date, 'd-m-Y H:i');

$prueba = $_POST['nombre'].$date."..";
$prueba= substr($prueba,0,-3);


$sentencia = "INSERT INTO empleados (numero,nombre,fecha,estado,prueba) values ('$numero','$nombre','$date','$estado','$prueba')";
	 $ejecutar = mysqli_query($conexion,$sentencia);
	 seleccionarHora();
	
 	return $ejecutar;

?>