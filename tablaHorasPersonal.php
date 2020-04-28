<?php
 require 'functions.php';
 require 'conexion.php';
  session_start();
  if(isset($_SESSION['horasEmpleado'])){
    $id=$_SESSION['horasEmpleado'];
  }else{
      $id="";
  }
  
 ?>
 <div class="container">
    <?php
    select()           
    ?>
    
</div>
<div class="container">
    <div class="col-sm-12">
        <h2 class="text-center text-warning py-4">Horas de Trabajo <?php DatosNombre($id,'titulo')?>
        </h2>
       
        <table class='table table-striped tabledark '>
            <tr>
                <thead class=" bgTableHead text-warning text-center">
                    <td>Dia</td>
                    <td>HorasTrabajo</td>
                    <td>Diurnas</td>
                    <td>Nocturnas</td>
                    <td>Festivas</td>
                    <td>FestivasNocturnas</td>

                </thead>
            </tr>
            <?php   
                
              
                $sentencia = "SELECT * FROM empleados where numero = '$id'  order by fechaDate  ";
                $ejecutar = $conexion->query($sentencia);
                 while($fila = $ejecutar->fetch_assoc()) {                
                    
                    $arrayhoras[]=[$fila['fechaDate'],$fila['estado']];              
                                    
                }
                $longitud=count($arrayhoras);
                echo $longitud;
                for ($i=0; $i < $longitud; $i++) { 
                    
                          if($arrayhoras[$i][1]=="Entrada"){
                ?>    
            <tr>    
           <!--  ingresanos fechas de entrada  -->        
              <td><?php echo fechaLarga($arrayhoras[$i][0]) ?></td>
                <!--  restamos fecha de entrada con fecha de salida -->
              <td class="text-center"> <?php  
                          $start=date_create($arrayhoras[$i][0]);
                          $end=date_create($arrayhoras[($i+1)][0]); 
                          $interval=date_diff($start,$end);
                          $intervalH=$interval->format('%h horas ');
                          $intervalM=$interval->format('%i minutos');                          
                          $unixEntrada=date_format($start, 'U');
                          $unixSalida=date_format($end, 'U');
                          $unixHorasDia = ($unixSalida-$unixEntrada);
                          $horasDia=($unixHorasDia/3600);
                          $horasDia= floor($horasDia); 
                          $min=($unixHorasDia/3600);$min=$min-$horasDia; 
                          $min=$min*60;   
                          if($min<10){echo $horasDia.",0".$min ;
                          }else{ echo $horasDia.",".$min ;}
                          
                    ?>              
               </td>
              <td><?php  $horaEntrada=strtotime($arrayhoras[$i][0]);
                         $horaEntrada=date("H:i",$horaEntrada);
                         echo $horaEntrada;
                         echo "-". $limite6=strtotime("6:00");
                       
                         
              
              ?></td>
              <td><?php echo "hora " . strtotime($horaEntrada);  ?></td>
              <td><?php   ?></td>
              <td><?php   ?></td>             
                </tr>   
     <?php 
                          }
                }
     ?>
     <thead class=" bgTableHead text-warning text-center">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </thead>
        </table>
    </div>
    </div>
    <!-- /*  $horaS=$fila['fechaDate'];
                $horaS=strtotime($fila['fechaDate']);
                $horaS=date('y-m-d H:i',$horaS);
                $horaS=date_create($horaS);
                $cadena = $fila['fechaDate'];  
                         date_diff($horaS, $horaS); */ -->
</div>


<script>
$(document).ready(function() {
    $('#inputGroupSelect01').select2();  
    $("#inputGroupSelect01").change(function() {
        var id = $('select[id=inputGroupSelect01]').val();
        $.ajax({
            type: "POST",
            data: 'id=' + id,
            url: 'crearSessionHoras.php',
            success: function(r) {
                console.log(r);
                location.reload();              

            }
        });

    });

});
</script>

