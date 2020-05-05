<?php
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}
require 'functions.php';
require 'conexion.php';
$fechaMax=$_SESSION['fechaSalida'];  
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
               $sentencia = "SELECT fechaPrograma ,area  FROM programacion where fechaPrograma = '$fechaMax' group by area ";
               $ejecutar = $conexion->query($sentencia);
                while($fila = $ejecutar->fetch_assoc()) { 
               ?>
                <tr>               
                    <td class="text-success text-center py-2"><?php echo $fila['area']?></td>
                    <td class="text-success text-center py-2"><?php echo $fila['fechaPrograma']?></td>
                   
                </tr>
                <?php            
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
               FROM programacion where fechaPrograma ='$fechaMax' group by area" ;

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