<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>hoja tiempos trabajo</title>
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
<?php
/* 
------------------------------------inserta datos nuevos-------------------------- */
session_start();
require_once("conexion.php");
require_once("functions.php");

$id=$_SESSION['Empleado'];
?>

<body>
    <div class="container ">
        <div class="  pl-3 portada">
            <img src="img/caratula-2.png" alt="" class="img-fluid">
        </div>
    </div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-left">
            <div class="col">
                <button class="btn btn-primary  my-4 px-3 mx-auto"><a href="cargarEmpleados.php"
                        class="text-warning text-left">Listado Empleados</a></button>
            </div>
            <div class="col">
                <button class="btn btn-primary my-4 px-3 mx-auto">
                    <a href="hojaDeProgramacion.php" class="text-warning">Tabla de Programacion</a>
                </button>
            </div>
            <div class="col">
                <button class="btn btn-primary my-4 px-3 mx-auto">
                    <a href="formularioProgramacion.php" class="text-warning">formulario de Programacion</a>
                </button>
            </div>

        </div>
    </div>

    <!-- modal para ingreso de entradas -->
    <div class="container">
        <div id="tablaEntradas">
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Entrada/Salida Faltante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark">
                    <div class="container">
                        <form method="post" action="" class="form-group" id="FormularioEmpleados">

                            <input type="text" name="name" id="Empleado" class="form-control"
                                value="<?php  DatosNombre($id,'titulo')?>" readonly><br>
                            <input type="hidden" name="numero" id="numero" value="<?php  DatosNombre($id,'id')?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php  DatosNombre($id,'nombre')?>">
                            <label class="text-warning">dd/mm/AAAA hh:mm a.m./p.m.</label>
                            <input type="datetime-local" class="form-control" name="fecha" id="fecha"><br>


                            <div class="form-check " class="form-control">
                                <input class="form-check-input" type="radio" name="estado" id="estado1" value="Entrada"
                                    checked>
                                <label class="form-check-label text-warning" for="estadoEmpleado1">
                                    Entrada
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="estado" id="estado2" value="Salida">
                                <label class="form-check-label text-warning" for="estadoEmpleado2">
                                    Salida
                                </label>
                            </div>
                            <input type="submit" id="guardarnuevo" name="submit" value="Guardar"
                                class="btn btn-warning"><br>
                        </form>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>

</body>

</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tablaEntradas').load('tablaEntradas.php');
        $('#tdEstado').addClass('colorEntrada');
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#guardarnuevo').click(function () {
            numero = $('#numero').val();
            nombre = $('#nombre').val();
            fecha = $('#fecha').val();
            console.log(fecha);
            estado = $('#FormularioEmpleados input[type=radio]:checked').attr('id');
            if (estado == 'estado1') {
                estado = 'Entrada';
            } else {
                estado = 'Salida';
            }

            agregarDatos(numero, nombre, fecha, estado);
        });

    });
</script>