
<?php
require_once "conexion.php";
require_once "functions.php"; 
$fechaEntrada=$_POST["Inputfecha1"];
$fechaSalida=$_POST["Inputfecha2"];
$area=$_POST["SelectArea"];
$diasProgramacion=$_POST["diasProgramacion"];
$horaEntrada=$_POST["inputHora1"];
$horaSalida=$_POST["inputHora2"];
$horaEntrada = strtotime($horaEntrada);
$horaEntrada = date("H:i", $horaEntrada);
$horaSalida = strtotime($horaSalida);
$horaSalida = date("H:i", $horaSalida);



/* echo ($fechaSalida.",".$fechaEntrada.",".$area.",".$horaEntrada.",".$horaSalida.",".$diasProgramacion);
echo ($r="realizado"); */
global $conexion;	
	$sentencia = "SELECT id_empleado,area FROM nombresempleados order by nombre   ";
	$ejecutar = mysqli_query($conexion,$sentencia);
	while($fila = $ejecutar->fetch_array()) {
		$idEmpleado=$fila[0];
		$area=$fila[1];		
		$fechaSalida=new DateTime($fechaSalida);
		$fechaEntrada= new DateTime($fechaEntrada);

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

return $ejecutar2;
?>
