<?php
session_start();
$id = $_POST['id'];
$periodoI=$_POST['periodoI'];
$periodoF=$_POST['periodoF'];
$_SESSION['horasEmpleado'] = $id;
$_SESSION['periodoI'] = $periodoI;
$_SESSION['periodoF'] = $periodoF;

?>