<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}
$id = $_POST['id'];
$_SESSION['Empleado'] = $id;

echo $id;
?>