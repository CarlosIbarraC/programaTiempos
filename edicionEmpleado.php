<?php

require_once "conexion.php";

$id=$_POST['idE'];
$numero = $_POST['identificacionE'];
$nombre = $_POST['nombreE'];
$area = $_POST['areaE'];
$observaciones = $_POST['observacionesE'];

 
$sentencia = "UPDATE  nombresempleados  set id_empleado='$numero',nombre='$nombre',area='$area',observaciones='$observaciones' where id='$id' ";
 echo $ejecutar = $conexion->query($sentencia);
 

 ?>
