<?php
 session_start();
 require 'functions.php';
 require 'conexion.php';
 
  if(isset($_SESSION['Empleado'])){
    $id=$_SESSION['Empleado'];
  }else{
      $id="";
  }
  
 ?>


</head>
<div class="container">  

    <?php
     // fechas() ;
           
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
            <i class="material-icons llave">build </i></button></caption>

    <table class='table table-striped tabledark '>
        <tr>
            <thead class=" bgTableHead text-warning text-center">
                <td>Dia</td>
                <td>Programado</td>
                <td>Edicion</td>
                <td>Eliminar</td>
            </thead>
        </tr>
        <?php       
           
            $sentencia = "SELECT * FROM empleados where numero = '$id'  order by fechaDate  ";
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
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning material-icons ">
                                <i>redo</i>
                            </button>
                        </div>
                    </form>
                </div>
            </td>
            <td>
                <div class="text-center">
                    <button type="" class="btn btn-warning material-icons"
                        onclick="preguntaSiNoTiempos(<?php echo  $fila['id']?>)"><span>delete_forever</span></button>
                </div>
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

            }
        });

    });

});
</script>