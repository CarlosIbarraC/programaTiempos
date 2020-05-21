<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>manejo de tiempos</title>
    <meta name="viewport" content="width=device-width, user-scalable=no,
	 initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href='stylos\style.css' rel='stylesheet' type='text/css'>
    <link href='js/alertify.min.css' rel='stylesheet' type='text/css'>
    <link href='js/themes/default.min.css' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/alertify.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="funciones.js/funciones.js"></script>
    <link href='css/select2.css' rel='stylesheet' type='text/css'>
    <script src="js/select2.js"></script>
</head>

<div class="container ">
        <div class="  pl-3 portada">
            <img src="img/caratula-2.png" alt="" class="img-fluid">
        </div>
    </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-left">
            <div class="col-10 col-sm-3">
                <button class="btn btn-success my-4 px-3 mx-auto">
                    <a href="index.php" class="text-warning">INICIO</a>
                </button>
            </div>
            <div class="col-6 col-sm-3">
                <button class="btn btn-success  my-4 px-3 mx-auto"><a href="cargarEmpleados.php"
                        class="text-warning text-left">Listado Empleados</a></button>
            </div>
            <div class="col-4 col-sm-3">
                <button class="btn btn-success  my-4 px-3 mx-auto"><a href="hojaDeTrabajo.php"
                        class="text-warning text-left">Verificacion</a></button>
            </div>
            <div class="col-6 col-sm-3">
                <button class="btn btn-primary my-4 px-3 mx-auto">
                    <a href="hojaDeProgramacion.php" class="text-warning">Tabla de Programacion</a>
                </button>
            </div>
            <div class="col-4 col-sm-3">
                <button class="btn btn-primary my-4 px-3 mx-auto">
                    <a href="formularioProgramacion.php" class="text-warning">formulario de Programacion</a>
                </button>
            </div>
           

        </div>
    </div>
    
    <div id="tablaHorasPersonal">
    </div>
    <script type="text/javascript">
    $(document).ready(function () {
        $('#tablaHorasPersonal').load('tablaHorasPersonal2.php');
       
    });
</script>
    