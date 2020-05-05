<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}
require_once "conexion.php";
$id= $_POST['id'];

$sentencia = "DELETE from nombresempleados   where id='$id' ";
 echo $ejecutar = $conexion->query($sentencia);
?>
