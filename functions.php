<?php
 function insertar_datos($ruc,$nombre,$fecha,$saldo,$prueba){
		 global $conexion;	
		  
		
 	$sentencia = "INSERT INTO empleados (numero,nombre,fecha,estado,prueba) values ('$ruc','$nombre','$fecha','$saldo','$prueba')";
	 $ejecutar = mysqli_query($conexion,$sentencia);
	 seleccionarHora();
	
 	return $ejecutar;
 } 
 function convertir(){
	global $conexion;		 
   
$sentencia = "UPDATE `empleados` SET `fechaDate`=  str_to_date(  `fecha`, '%d/%m/%Y %h:%i:%s')";
$ejecutar = mysqli_query($conexion,$sentencia);
return $ejecutar;
} 
function seleccionarHora(){
	global $conexion;	 
   
$sentencia = "SELECT fecha,id FROM empleados ";
$ejecutar = $conexion->query($sentencia);
while($fila = $ejecutar->fetch_assoc()) {

     $cadena=str_replace("/","-",$fila['fecha']);
	 $cadena=strtotime($cadena);
	 $fechapm=date("Y-m-d H:i", $cadena);

	 $fechaid=$fila['id'];
	 $sentenciaC = "UPDATE `empleados` SET `fechaDate`= '$fechapm' where id ='$fechaid' ";
     $ejecutarC = mysqli_query($conexion,$sentenciaC);		 


}

}  
function DatosNombre($id,$variable){
	global $conexion;
	$sentencia = "SELECT * FROM empleados where numero = '$id' ";
    $ejecutar = $conexion->query($sentencia);
	$fila = $ejecutar->fetch_assoc(); 
	switch ($variable){
		case 'id':
		echo $fila['numero'];
		break;
		case 'nombre':
		echo $fila['nombre'];
		break;
		case 'titulo':
		echo $fila['nombre'].' ('.$fila['numero'].')'; 
	}	
}

function verificador($id,$fecha){
	global $conexion;  
$sentencia = "SELECT * FROM empleados where numero = '$id' and fecha = '$fecha'";
$ejecutar = $conexion->query($sentencia);

while($fila = $ejecutar->fetch_assoc()) {	
        		
      switch ($fila['estado']) {
		  case 'Entrada':
			
			if($fila['id']%2!= 0){
				echo '
<div class="colorEntrada">'.
 $fila['estado'].
'</div>';
			}else{
				echo '
<div class="colorEntrada">'.
 $fila['estado'].
'</div>';
			}
			
			  break;
		  
		  default:
		 
		  if($fila['id']%2== 0){
			echo '
<div class="colorSalida text-warning">'.
 $fila['estado'].
'</div>';
		}else{
			echo '
			<div class="colorSalida text-warning">'.
			 $fila['estado'].
			'</div>';
		}
			  break;
	  }
      	
}
} 

function SeleccionarInsertar(){
	global $conexion;		 
    $empleado='';
	$sentencia = "SELECT numero,nombre FROM empleados group by nombre";
	$ejecutar = mysqli_query($conexion,$sentencia);

	while($fila = $ejecutar->fetch_array()) {
		
		
		$numero=$fila[0];
		$nombre=$fila[1];
		$empleado=$empleado.'-'.$numero.'-'.$nombre;	
	
	} 
	return $empleado;	
}

function insertar_nombres($id,$nombre,$area,$observaciones){
	global $conexion;		 
		
	$sentencia = "INSERT INTO nombresempleados (id_empleado,nombre,area,observaciones) values ('$id','$nombre','$area','$observaciones')";
	$ejecutar = mysqli_query($conexion,$sentencia);
	return $ejecutar;
} 
function editarEmpleado($datos){
	echo $datos;
}	
function select(){
	global $conexion;
	$sentencia = "SELECT id_empleado,nombre FROM nombresempleados ";
	$ejecutarE = mysqli_query($conexion,$sentencia);
	?>

<div class="input-group">
    <div class="row">
        <div class="col-12">
            <label for="empleado" class="text-warning">selecciona Empleado</label>
        </div>
        <div class="col-12">
            <select class=" bg-warning " id="inputGroupSelect01" name="empleado">
                <option value="">Despliegue</option>
                <?php
				   	while($fila = $ejecutarE->fetch_assoc()) {
				?>
                <option class="font-weight-bold" value="<?php echo $fila['id_empleado']?>"><?php echo $fila['nombre']?>
                </option>
                <?php				   	   		
				   	}				   	   			
				?>
            </select>
        </div>
    </div>
</div>

<?php
}   


function Inconsistencias(){
		global $conexion;		 
		
	$sentencia = "SELECT id_empleado FROM nombresempleados order by nombre   ";
	$ejecutar = mysqli_query($conexion,$sentencia);
	?>

<table class="table table-bordered">

    <tr>
        <td class="thead-light">
            <h3 class="text-warning">
                Listado de inconsistencias
            </h3>
        </td>
    </tr>

    <?php

	while($fila = $ejecutar->fetch_array()) {
	$id=$fila[0];
	
	$sentencia2="SELECT * FROM empleados where numero = '$id' order by fechaDate  ";
	$ejecutar2 = mysqli_query($conexion,$sentencia2);
	$estado="";
	$nombre="";
	$n=0;
	$fecha="";
	
	while($fila2 = $ejecutar2->fetch_array()) {
		
		if($n==0 && $fila2[4]=="Salida"){
          ?>
    <tr>
        <td class="text-warning">
            <?php
					echo "inconsistencia de ".$fila2[2]." el ".$fila2[3]."<br>";
             ?>
        </td>
    </tr>
    <?php
		}
		
		if ($estado == $fila2[4]){
			?>
    <tr>
        <td class="text-warning">
            <?php
   echo "inconsistencia de ".$fila2[2]." el ".$fila2[3]."<br>"; 
   ?>
        </td>
    </tr>
    <?php
		} 
	  
	    $n=$n+1;
		 $nombre=$fila2[2];
		 $estado=$fila2[4];
		 $fecha=$fila2[3];
		 
	}
	 $estado."<br>";
	if ($estado == "Entrada"){
		?>
    <tr>
        <td class="text-warning">
            <?php
		echo "inconsistencia de ".$nombre." el ".$fecha."<br>"; 
		?>
        </td>
    </tr>
    <?php
			 }
	}
	?>
</table>
<?php

	}
/* -------------funcion para crear tabla de programacion------------------- */
function fechas(){

	/* ------------------seleccionamos Empleado---------------------- */
	global $conexion;	
	$sentencia = "SELECT id_empleado,area FROM nombresempleados order by nombre   ";
	$ejecutar = mysqli_query($conexion,$sentencia);
	while($fila = $ejecutar->fetch_array()) {
		$idEmpleado=$fila[0];
		$area=$fila[1];		
		$fechaSalida=new DateTime("20-05-2020");
		$fechaEntrada= new DateTime("12-05-2020");

	     while ( $fechaEntrada < $fechaSalida) {
		
             $fechaEntrada->add(new DateInterval('P1D'));
		     $fechaEntrada->format('d-m-Y') ;
		     $fechaT= date($fechaEntrada->format('Y-m-d') );
			 $n=0; $y=1;
			 
		     while($n<=$y){
		     if($n==0){
		    	  $entrada= "Entrada";
		    	  $cadena = "12:45 a.m.";
                  $cadena = strtotime($cadena);
                  $cadena = date("H:i", $cadena);
		    	  $seguro=$idEmpleado.$fechaT.$cadena;
		     }else if($n==1){
		    	 $entrada="Salida";
		    	 $cadena = "6:45 p.m.";
                 $cadena = strtotime($cadena);
		    	 $cadena = date("H:i", $cadena);
		    	 $seguro=$idEmpleado.$fechaT.$cadena;
		     }
		$n=$n+1;
		$sentencia2 = "INSERT INTO programacion (idEmpleado,fechaPrograma,estado,hora,seguro,area) values ('$idEmpleado','$fechaT','$entrada','$cadena','$seguro','$area')  ";
		$ejecutar2 = mysqli_query($conexion,$sentencia2);
		
		 }
	    }
	}
} /* --------------fin funcion de insertar programacion ------------------------ */	

/* -----------------------------------funcin para los dias en español----------------------- */
function conversionDias($fecha){
	$fechaLarga= date(" j-m-Y",strtotime($fecha));
	$fechaDia= date("l",strtotime($fecha));
	
	switch($fechaDia){
		case "Monday":
			echo "lunes".$fechaLarga;
		break;
		case "Tuesday":
			echo "Martes".$fechaLarga;
		break;
		case "Wednesday":
			echo "Miercoles".$fechaLarga;
		break;
		case "Thursday":
			echo "Jueves".$fechaLarga;
		break;
		case "Friday":
			echo "Viernes".$fechaLarga;
		break;
		case "Saturday":
			echo "Sabado".$fechaLarga;
		break;
		case "Sunday":
			echo "Domingo".$fechaLarga;
		break;
	}
	
}
function selectArea(){
	global $conexion;
	$sentencia = "SELECT area FROM nombresempleados ";
	$ejecutarE = mysqli_query($conexion,$sentencia);
	?>

<div class="input-group">
    <div class="row">
        <div class="col-12">
            <label for="empleado" class="text-warning">selecciona el area</label>
        </div>
        <div class="col-12">
            <select class=" bg-warning " id="SelectArea" name="SelectArea" REQUIRED>
                <option value="">Despliegue</option>
                <?php
				   	while($fila = $ejecutarE->fetch_assoc()) {
				?>
                <option class="font-weight-bold" value="<?php echo $fila['area']?>"><?php echo $fila['area']?>
                </option>
                <?php				   	   		
				   	}				   	   			
				?>
            </select>
        </div>
    </div>
</div>
<?php

}   
?>