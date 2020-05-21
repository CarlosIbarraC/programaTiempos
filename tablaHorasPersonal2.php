<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}
 require 'functions.php';
 require 'conexion.php';

 if(isset($_SESSION['periodoI'])){
    $fechaI=$_SESSION['periodoI'];
    $fechaF=$_SESSION['periodoF'];
    
    } else{
        $fechaI='';
        $fechaF='';
    }    
   
   if(isset($_SESSION['horasEmpleado'])){
    $id=$_SESSION['horasEmpleado'];
    
}else{
    $id="";}
  
 ?>
 <div class="container my-4 ">
        <div class="col-12 mx-0 col-sm-mx-auto">
        <h3 class= "text-center text-warning py-4">PERIODO DE VISUALIZACION</h3>
            <div class="d-flex justify-content-center">
                <form action="tablaHorasPersonal.php" method="POST" class="text-center form-control col-4 bg-warning">
                <label for="periodoI">FECHA INICIAL</label>
                <input type="date" name="periodoI" id="periodoI" class="form-control mb-4 bg-secondary" value=""REQUIRED>
                <label for="periodof">FECHA FINAL</label>
                <input type="date" name="periodoF" id="periodoF" class="form-control bg-secondary" value=""REQUIRED>
              
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
                    <td>Dia*<p>
                        <small> hora entrada>horaSalida=>nocturno</small>
                    </p></td>
                    <td>HorasTimbradas</td>
                    <td>Diurnas</td>
                    <td>minutos/nc</td>
                    <td>Nocturnas</td>
                    <td>Programacion</td>
                   
                </thead>
            </tr>
            <?php   
                $acumuladoUnixD=0;
                $horasDA=0;
                $minDA=0;
                $acumuladoN=0;
                $noche=0;
              if($fechaF!=""||$fechaI!=""){
                $sentencia = "SELECT * FROM empleados where numero = '$id' AND fechaDate BETWEEN '$fechaI' AND '$fechaF' group by fechaDate ";
                
                $ejecutar = $conexion->query($sentencia);
                 while($fila = $ejecutar->fetch_assoc()) {                
                    
                    $arrayhoras[]=[$fila['fechaDate'],$fila['estado']];  
                             
                                    
                }
                
                $longitud=count($arrayhoras);
               
                for ($i=0; $i < $longitud; $i++) { 
                    
                          if($arrayhoras[$i][1]=="Entrada"){
                              

                            $start=date_create($arrayhoras[$i][0]);
                            $end=date_create($arrayhoras[($i+1)][0]);
                         
                            $unixEntrada=date_format($start, 'U');
                            $unixSalida=date_format($end, 'U');
                           // echo $arrayhoras[$i][0]."/".$unixEntrada."/".$arrayhoras[$i+1][0]."/".$unixSalida;
                              
                ?>          
            <tr>    
           <!--  ingresanos fechas de entrada  -->        
              <td><?php echo fechaLarga($arrayhoras[$i][0])." (".date('H:i',$unixEntrada)."-".date("H:i",$unixSalida).")" ?></td>
                <!--  restamos fecha de entrada con fecha de salida -->
              <td class="text-center"> <?php  
                                                                   
                           //unix dia del registro.
                          $unixHorasDia = ($unixSalida-$unixEntrada);
                          $horasDia=($unixHorasDia/3600);
                          $horasDia= floor($horasDia); //horas de trabajo por dia.
                          $min=$unixHorasDia/3600-$horasDia; 
                          $min=$min*60;             // minutos de trabajo por dia.                           
                          $diaEntrada=date("Y-m-d",$unixEntrada);//dia del registro.
                          $diaSalida=date("Y-m-d",$unixSalida);                          
                          $entrada6am= strtotime('+6 hour',strtotime($diaEntrada));//limite 6 am. 
                          $entrada10pm= strtotime('+22 hour',strtotime($diaEntrada));//limite 10 pm. 
                          $salida6am=strtotime('+30 hour',strtotime($diaEntrada));          
                          $horasNocturnas=$entrada6am-$unixEntrada;//tiempo nocturno unix.
                          //le coloca un cero alos minutos-------------//
                          if($min<9.9){echo $horasDia.":0".$min."'" ;
                           
                          }else{ echo $horasDia.":".$min."'" ;}

                          $acumuladoUnixD= $acumuladoUnixD+$unixHorasDia;
                        
                          
                          
                    ?>              
               </td>
              <td class="text-center"> <?php 
               //echo $horasDia;
              
                           if($unixEntrada+1200>$entrada6am && $unixSalida< $entrada10pm){
                                $horasDia=floor(($unixSalida-$unixEntrada)/3600);
                           }//caso3 con timbrada 20 MIN antes y despues de 6am
                           if($unixEntrada+300<$entrada6am && $unixSalida<$entrada10pm){
                              $horasDia=floor(($unixSalida+300-$entrada6am)/3600);
                           }//caso 2 entra antes de las 5:05 de la mañana y sale antes de las 10 de la noche
                           if ($unixEntrada>$entrada6am && $unixSalida>$entrada10pm && $unixSalida<$salida6am){
                              $horasDia=floor(($entrada10pm-$unixEntrada)/3600);
                            
                           }//caso 4 entra despues de las 6am y sale despues de las 11pm

                       if($unixEntrada-1200<$entrada10pm && $unixSalida>$salida6am ){
                                            
                                 $yy=floor(($entrada10pm-$unixEntrada)/3600);
                                 $xx=floor(($unixSalida-$salida6am)/3600);
                                
                                  $horasDia=($xx+$yy);                                 
                            }  //caso 5 entra una hora antes de las 10 pm y salida una hora despues de las 6 am
                           if($unixEntrada>$entrada10pm && $unixSalida>$salida6am+3600){
                               $horasDia=floor(($salida6am-$unixSalida)/3600)+$horasDia;

                           }
                           if($unixEntrada>$entrada10pm && $unixSalida<$salida6am){
                               $horasDia=0;
                           }
                           echo $horasDia; 
                                               
                         $horasDA=$horasDA+$horasDia;
              ?> </td>
              <td class="text-center">
              <?php 

               if( $min<59){
                echo $min."'";
                $minDA=$minDA+$min;
            }
               
              
              ?>
              </td>
              <td class="text-center">
                <?php ;                       
                        if($entrada6am>$unixEntrada){                                      
                            $horasNocturnas=$entrada6am-$unixEntrada;                        
                            if( $horasNocturnas>3300 && $horasNocturnas<5400){
                                echo $noche=1;
                            }else{
                                if(($horasNocturnas-1800)<0){
                                
                                 }else{
                                    echo  date("i",$horasNocturnas)."'";
                                 }
                            }         
               
                        } 
                        if(($unixHorasDia+$unixEntrada)>$entrada10pm && ($unixSalida)>$salida6am){
                            echo $noche=8;
                        }
                        if(($unixHorasDia+$unixEntrada)>$entrada10pm && $unixSalida<$salida6am){
                            echo $noche= floor(($unixSalida+540-$entrada10pm)/3600);
                        }
                        /* if($unixEntrada>$entrada10pm-900 && $unixSalida<$salida6am){
                            echo $noche=$horasDia;
                        } */

                        $acumuladoN=$acumuladoN+$noche;
                        
                        
                        ?></td>
              <td></td>
                       
                </tr>   
     <?php 
                          }
                         
                }
            }
     ?>
     <thead class=" bgTableHead text-warning text-center">
                    <td>TOTALES</td>
                    <td><?php 
                    $horasDiaA=($acumuladoUnixD/3600);
                    $horasDiaA= floor($horasDiaA); //horas de trabajo por dia.
                    $minA=($acumuladoUnixD/3600);$minA=$minA-$horasDiaA; 
                    $minA= floor($minA*60); 
                    if($minA<9.9){ echo $horasDiaA.":"."0".$minA;}
                    else{ echo $horasDiaA.":".$minA;}
                   
                 ?> </td>
                    <td><?php echo floor($horasDA) ?></td>
                    <td><?php echo $minDA ?></td>
                    <td><?php echo $acumuladoN ?></td>
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
<script>
$(document).ready(function() {
    $("#periodoF").change(function() {
 if($('#periodoI').val()>$('#periodoF').val()){
     alert("fecha final menor")
 }
});
});

</script>

<!-- "idE=" + idE + 
            "&identificacionE=" + id_empleado + 
            "&nombreE=" + nombre + 
            "&areaE=" + area + 
            "&observacionesE=" + observaciones; -->