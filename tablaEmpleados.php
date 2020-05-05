<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}

 require 'functions.php';
 require 'conexion.php';

 ?>

<div class="row">
    <div class="col-sm-12">

        <h2 class="text-center text-warning my-4">Listado de Empleados<?php ?></h2>
        <div class="container">
            <div class="row mx-0 flex-row ">
                <div class="formDatosE  col-4">
                    <a href="hojaDeTrabajo.php"><button class="btn btn-warning  my-4 px-3 btn-md">volver
                            administracion</button></a>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-primary my-4 px-3 btn-md" data-toggle="modal" data-target="#IngresoNuevoE">
                        Ingreso Empleado Nuevo
                    </button>
                </div>
                <div class="formDatosE  col-4">
                    <a href="horasDeTrabajoPersonal.php"><button class="btn btn-warning  my-4 px-3 btn-md"><strong>Horas de Trabajo</strong></button></a>
                </div>
            </div>
        </div>

        <table class='table table-striped tabledark'>
            <tr>
                <thead class=" bg-dark text-warning">
                    <th scope="col">id-Empleado</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Area</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </thead>
            </tr>

            <?php    
          
            
            $sentencia = "SELECT * FROM nombresempleados  order by area asc ";
            $ejecutar = $conexion->query($sentencia);
             while($fila = $ejecutar->fetch_assoc()) {
                 $datos=
                 $fila['id']."||".
                 $fila['id_empleado']."||".
                 $fila['nombre']."||".
                 $fila['area']."||".
                 $fila['observaciones'];
            ?>
            <tr>
                <td><?php echo  $fila['id_empleado']?></td>
                <td> <?php echo $fila['nombre']?> </td>
                <td> <?php echo $fila['area']?> </td>
                <td> <?php echo $fila['observaciones']?> </td>
                <td>
                    <button class="btn btn-warning material-icons" data-toggle="modal" data-target="#modalEmpleados"
                        id="guardarRegistroE" onclick="editarEmpleado('<?php echo  $datos?>')"><i>create</i></button>
                </td>
                <td>
                    <button class="btn btn-warning material-icons"
                        onclick="preguntaSiNo(<?php echo  $fila['id']?>)"><span>delete_forever</span></button>
                </td>
            </tr>

            <?php
             }
           
            ?>
        </table>
    </div>
</div>