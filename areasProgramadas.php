<?php
session_start();
require 'functions.php';
require 'conexion.php';
  
 ?>
<div class="container mt-4 border">
    <div class="row">
        <div class="col-6 my-3">   
            <table class="">
                <tr>
                    <td class="text-success text-center px-2 py-auto">Area Programada</td>
                    <td class="text-success text-center px-2 py-2">Fecha Ultima programacion</td>
                </tr>
                <?php              
               $fechaProgU="";
               global $conexion;
               $ultimaProg="";
               $sentencia = "SELECT MAX(fechaPrograma) as fecha,area  FROM programacion group by area ";
               $ejecutar = $conexion->query($sentencia);
                while($fila = $ejecutar->fetch_assoc()) { 

               ?>
                <tr>               
                    <td class="text-success text-center py-2"><?php echo $fila['area']?></td>
                    <td class="text-success text-center py-2"><?php echo $fila['fecha']?></td>
                   
                </tr>
                <?php
                
                $array[]=$fila['area']."/".$fila['fecha'];
               
                
                }
            ?>
            </table>
           
        </div>
        <div class="col-6 my-3">
            <table class="">
                <tr class="">
                    <td class="text-danger text-center px-2 py-2">Area sin programa</td>
                    
                </tr>
                <?php
                       
               $sentencia = "SELECT area    
               FROM nombresempleados  
               EXCEPT   
               SELECT area   
               FROM programacion" ;

               $ejecutar = $conexion->query($sentencia);
                while($fila = $ejecutar->fetch_assoc()) { 
               ?> 
                <tr>
                    <td class="text-danger text-center px-3 py-2"><?php echo $fila['area']?></td>
                   
                </tr>
                <?php
                }
            ?>
            </table>
        </div>
    </div>
</div>