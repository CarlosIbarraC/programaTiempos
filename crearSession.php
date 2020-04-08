<?php
session_start();
$id = $_POST['id'];
$_SESSION['Empleado'] = $id;

echo $id;
?>