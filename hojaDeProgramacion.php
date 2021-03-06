<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}

?>
<meta charset="UTF-8">
<title>manejo de tiempos</title>
<meta name="viewport" content="width=device-width, user-scalable=no,
	 initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'>
<link href='stylos/style.css' rel='stylesheet' type='text/css'>
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
<?php
/* 
------------------------------------inserta datos nuevos-------------------------- */

require_once("conexion.php");
require_once("functions.php");


?>

<body>
<div class="container ">
<div class="  pl-3 portada">
            <img src="img/caratula-2.png" alt="" class="img-fluid">
        </div>
    </div>
    <div class="container ">
        <div class="d-flex justify-content-around">
            <div class="col">
                <button class="btn btn-primary  my-4 px-3 mx-auto"><a href="cargarEmpleados.php"
                        class="text-warning text-left">Listado Empleados</a></button>
            </div>
            <div class="col">
                <button class="btn btn-primary my-4 px-3 mx-auto">
                    <a href="hojaDeTrabajo.php" class="text-warning">hoja Tiempos Reloj</a>
                </button>
            </div>
            <div class="col">
                <button class="btn btn-primary my-4 px-3 mx-auto">
                    <a href="formularioProgramacion.php" class="text-warning">Formulario de Programacion</a>
                </button>
            </div>
            <div class="col">
                <button class="btn btn-warning my-4 px-3 mx-auto">
                    <a href="horasDeTrabajoPersonal.php" class="text-dark"><strong>Horas de Trabajo</strong></a>
                </button>
            </div>

        </div>
    </div>




    <!-- modal para ingreso de entradas -->
    <div class="container">
        <div id="tablaDeProgramacion">
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modificarHora" tabindex="-1" role="dialog" aria-labelledby="examplemodificarHora"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examplemodificarHora">Cambiar Hora de Programacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="container">
                        <form method="post" action="edicionProgramacion.php" class="form-group"
                            id="FormularioEmpleados">
                            <input type="hidden" name="idP" id="idP" class="form-control" value="" readonly><br>

                            <input type="text" name="nombreP" id="nombreP" class="form-control" value="" readonly><br>
                            <input type="text" name="areaP" id="areaP" value="" class="form-control" readonly><br>
                            <input type="date" name="fechaP" id="fechaP" value="" class="form-control"><br>
                            <input type="text" name="estadoP" id="estadoP" value="" class="form-control" readonly><br>
                            <label class="text-warning">Ajuste de hora:</label>
                            <input type="time" class="form-control" name="horaP" id="horaP"><br>

                            <input type="submit" id="guardarPrograma" name="submit" value="Guardar"
                                class="btn btn-warning"><br>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>

            </div>
        </div>

</body>

</html>
<script type="text/javascript">
$(document).ready(function() {
    $('#tablaDeProgramacion').load('tablaDeProgramacion.php');

});
</script>