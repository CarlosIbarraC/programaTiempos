<?php
 session_start();
 require 'functions.php';
 require 'conexion.php';

 $fechaI=$_SESSION['periodoI'];
 $fechaF=$_SESSION['periodoF'];

 
 
  if(isset($_SESSION['horasEmpleado'])){
    $id=$_SESSION['horasEmpleado'];
  }else{
      $id="";
  }
  
 ?>
 <div class="container my-4 ">
        <div class="col-12 ">
        <h3 class= "text-center text-warning py-4">PERIODO DE VISUALIZACION</h3>
            <div class="d-flex justify-content-center">
                <form action="tablaHorasPersonal.php" method="POST" class="text-center form-control col-4 bg-warning">
                <label for="periodoI">FECHA INICIAL</label>
                <input type="date" name="periodoI" id="periodoI" class="form-control mb-4 bg-secondary" value="">
                <label for="periodof">FECHA FINAL</label>
                <input type="date" name="periodoF" id="periodoF" class="form-control bg-secondary" value="">
              
                </form>
            </div>
        </div>
    </div>
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
                
              
                $sentencia = "SELECT * FROM empleados where numero = '$id' AND fechaDate BETWEEN '$fechaI' AND '$fechaF'  order by fechaDate  ";
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
                          $horasDia= floor($horasDia); //horas de trabajo por dia.
                          $min=($unixHorasDia/3600);$min=$min-$horasDia; 
                          $min=$min*60;                // minutos de trabajo por dia.
                          $horaEntrada=strtotime($arrayhoras[$i][0]);  //unix dia del registro.                      
                          $horaEntrada2=date("Y-m-d",$horaEntrada);//dia del registro.                          
                          $limiteEntrada= strtotime('+6 hour',strtotime($horaEntrada2));//limite 6 am. 
                          $horasNocturnas=$limiteEntrada-$horaEntrada;//tiempo nocturno unix.
                          if($min<9.9){echo $horasDia.":0".$min."'" ;
                          }else{ echo $horasDia.":".$min."'" ;}
                          
                    ?>              
               </td>
              <td class="text-center"><?php 
                            if($limiteEntrada<$horaEntrada){
                         echo floor(($unixSalida-$unixEntrada)/3600);
                         }else{
                              echo floor(($unixSalida-$limiteEntrada)/3600);
                         }          
                       
                         
              
              ?></td>
              <td class="text-center">
                <?php ;                       
                        if($limiteEntrada>$horaEntrada){                                      
                            $horasNocturnas=$limiteEntrada-$horaEntrada;                        
                            if( $horasNocturnas>3300 && $horasNocturnas<5400){
                                echo "1";
                            }else{
                                if(($horasNocturnas-1800)<0){
                                
                                 }else{
                                    echo "min".date("i",$horasNocturnas);
                                 }
                            }         
               
                        } ?></td>
              <td><?php 
              
              
              ?></td>
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
        var periodoI=$('#periodoI').val();
        var periodoF=$('#periodoF').val();
        
           
        $.ajax({
            type: "POST",
            data: 'id=' + id
            + '&periodoI=' + periodoI
            + '&periodoF=' + periodoF,
            url: 'crearSessionHoras.php',
            success: function(r) {
                console.log(r);
                location.reload();              

            }
        });

    });

});
</script>
<script>
var dateControl = document.querySelector('input[type="date"]#periodoI');
dateControl.value = "<?php echo $fechaI?>";
var dateControl = document.querySelector('input[type="date"]#periodoF');
dateControl.value = "<?php echo $fechaF?>";
</script>

<!-- "idE=" + idE + 
            "&identificacionE=" + id_empleado + 
            "&nombreE=" + nombre + 
            "&areaE=" + area + 
            "&observacionesE=" + observaciones; -->