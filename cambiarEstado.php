<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}
require_once "conexion.php";
require_once "functions.php";    

$id = $_POST['idEdicion'];
$estado = $_POST['estadoEdicion'];

if($estado=='Entrada'){

    $estado='Salida';
}else{
    $estado='Entrada';
}
echo $id,$estado;

$sentencia = "UPDATE `empleados` SET `estado` =  '$estado' where id ='$id' ";
$ejecutar = mysqli_query($conexion,$sentencia);

	
header("Location: hojaDeTrabajo.php#$id");

?> 