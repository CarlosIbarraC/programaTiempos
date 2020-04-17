

<div class="container">
   
</div>
<div class="col-sm-12">

    <h2 class="text-center text-warning py-4">Tabla de programacion Area de </h2>

   <!--  <caption><button class="btn btn-warning mb-4" data-toggle="modal" data-target="#exampleModal"> Agregar Faltante
            <span class="material-icons">build </span></button></caption> -->

    <table class='table table-striped tabledark '>
        <tr>
            <thead class="bgTableHead text-warning">
                <td>id-empleado</td>
                <td>Nombre</td>
                <td>area</td>
                <td>fecha </td>
                <td>Estado</td>
                <td>Hora</td>
                <td>Edicion</td>
            </thead>
        </tr>
        <?php   
           session_start();
            require 'functions.php';
            require 'conexion.php';
            /* -----------------fecha en español--------------------- */
            /* setlocale(LC_TIME,"es_ES");	
            echo strftime("Hoy es %A y son las %H:%M");
            echo strftime("El año es %Y y el mes es %B"); */
           
           global $conexion;
           
            $sentencia = "SELECT * FROM nombresempleados,programacion where nombresempleados.id_empleado = programacion.idEmpleado  and programacion.area = 'CARDAS'";
            $ejecutar = $conexion->query($sentencia);
             while($fila = $ejecutar->fetch_assoc()) { 
                 
                $horaA=date("g:i a",strtotime($fila['hora']));
                
                $datosP=
                $fila['id']."||".                
                $fila['nombre']."||".
                $fila['area']."||".
                $fila['estado']."||".
                $fila['fechaPrograma']."||".
                $horaA;                   

            ?>

        <tr>
            <td><?php echo  $fila['id_empleado']?></td>            
            <td > <?php echo $fila['nombre'] ?> </td>
            <td><?php echo  $fila['area']; ?></td>
            <td> <?php conversionDias($fila['fechaPrograma']) ?> </td>
            <td>  <?php echo $fila['estado'] ?> </td>
            <td>  <?php echo date("g:i a",strtotime($fila['hora'])) ?></td>
            <td> <button class="btn btn-warning material-icons"  data-toggle="modal" data-target="#modificarHora" id="guardarTiemposE"onclick="editarTiempos('<?php echo  $datosP?>')"><i>create</i></button></td>
          
           
        </tr>

        <?php
             }
           
            ?>
    </table>
</div>
</div>
<script>
function editarTiempos(datosP){
  d=datosP.split('||');
  $('#idP').val(d[0]);
  $('#nombreP').val(d[1]);
  $('#areaP').val(d[2]);
  $('#fechaP').val(d[4]);
  $('#estadoP').val(d[3]);  
  var k=$('#horaP').val(d[5]);
  console.log(k);
}
</script>
<!-- <script>
$(document).ready(function() {
$('#guardarTiemposE').click(function(){
        editarTiempos();

    });
});

</script> -->

