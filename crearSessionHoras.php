<?php
session_start();
$id = $_POST['id'];
$_SESSION['horasEmpleado'] = $id;

echo $id;
?>