<?php
require_once "conexion.php";
$id= $_POST['id'];

$sentencia = "DELETE from nombresempleados   where id='$id' ";
 echo $ejecutar = $conexion->query($sentencia);
?>
