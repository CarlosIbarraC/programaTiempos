<?php
 require 'functions.php';
 require 'conexion.php';
  session_start();
  $id=$_SESSION['Empleado'];
 ?>


</head>
<div class="container">

    <?php
                  fechas() ;
           
        ?>

</div>


<div class="container">

    <?php
                   select() 
           
        ?>

</div>
<div class="container mt-3">
    <?php
    inconsistencias();
    ?>
</div>

<div class="col-sm-12">

    <h2 class="text-center text-warning py-4">Tabla dinamica Tiempos de <?php DatosNombre($id,'titulo')?>
    </h2>
    <caption><button class="btn btn-warning mb-4" data-toggle="modal" data-target="#exampleModal"> Agregar Faltante
            <span class="material-icons">build </span></button></caption>

    <table class='table table-striped table-dark table-bordered'>
        <tr>
            <thead class=" bg-dark text-warning">
                <td>Dia</td>
                <td>Programado</td>
                <td>Edicion</td>
                <td>Eliminar</td>
            </thead>
        </tr>
        <?php   
          
           
            $sentencia = "SELECT * FROM empleados where numero = '$id' order by fechaDate  ";
            $ejecutar = $conexion->query($sentencia);
             while($fila = $ejecutar->fetch_assoc()) {             
                                     

            ?>

        <tr>
            <td><?php echo  $fila['fecha']?></td>
            <td <?php verificador($fila['numero'],$fila['fecha'])?> </td>
            <td>
                <div class="" id="<?php echo  $fila['id']?>">
                    <form action="cambiarEstado.php" method="post">
                        <input type="hidden" name="idEdicion" value="<?php echo  $fila['id']?>" />
                        <input type="hidden" name="estadoEdicion" value="<?php echo $fila['estado']?>" />
                        <button type="submit" class="btn btn-warning material-icons">
                            <i>redo</i>
                        </button>
                    </form>
                </div>
            </td>
            <td>
                <button type="" class="btn btn-warning material-icons"
                    onclick="preguntaSiNoTiempos(<?php echo  $fila['id']?>)"><span>delete_forever</span></button>
            </td>
        </tr>

        <?php
             }
           
            ?>
    </table>
</div>
</div>

<script>
$(document).ready(function() {
    $('#inputGroupSelect01').select2();
    $("#inputGroupSelect01").change(function() {
        var id = $('select[id=inputGroupSelect01]').val();
        $.ajax({
            type: "POST",
            data: 'id=' + id,
            url: 'crearSession.php',
            success: function(r) {
                console.log(r);
                location.reload();
                /* $('#fotoreferencia').load('fotorreferencia.php');
                document.location.href = 'fotoreferencia.php#fot'; */

            }
        });

    });

});
