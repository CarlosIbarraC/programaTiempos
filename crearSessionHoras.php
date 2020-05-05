<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}

$id = $_POST['id'];
$periodoI=$_POST['periodoI'];
$periodoF=$_POST['periodoF'];
$_SESSION['horasEmpleado'] = $id;
$_SESSION['periodoI'] = $periodoI;
$_SESSION['periodoF'] = $periodoF;

?>