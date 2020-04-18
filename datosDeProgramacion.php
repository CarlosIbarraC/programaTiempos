
<?php
require_once "conexion.php";
require_once "functions.php"; 
$fechaEntrada=$_POST["Inputfecha1"];
$fechaSalida=$_POST["Inputfecha2"];
$area=$_POST["SelectArea"];
$diasProgramacion=$_POST["diasProgramacion"];
$horaEntrada=$_POST["inputHora1"];
$horaSalida=$_POST["inputHora2"];
$horaEntradaS=$_POST['inputHoraES'];
$horaSalidaS=$_POST['inputHoraSS'];
$horaEntradaD=$_POST['inputHoraED'];
$horaSalidaD=$_POST['inputHoraSD'];
$horaEntrada = strtotime($horaEntrada);
$horaEntrada = date("H:i", $horaEntrada);
$horaSalida = strtotime($horaSalida);
$horaSalida = date("H:i", $horaSalida);
$horaEntradaS = strtotime($horaEntradaS);
$horaEntradaS = date("H:i", $horaEntradaS);
$horaSalidaS = strtotime($horaSalidaS);
$horaSalidaS = date("H:i", $horaSalidaS);
$horaEntradaD = strtotime($horaEntradaD);
$horaEntradaD = date("H:i", $horaEntradaD);
$horaSalidaD = strtotime($horaSalidaD);
$horaSalidaD = date("H:i", $horaSalidaD);

$fechaSalida= strtotime($fechaSalida);
$fechaSalida= date("Y-m-d",$fechaSalida);
 
 global $conexion;	
	$sentencia = "SELECT * FROM nombresempleados where area='$area' ";
	$ejecutar = mysqli_query($conexion,$sentencia);
	while($fila = $ejecutar->fetch_array()) {
		$idEmpleado=$fila['id_empleado'];
		$areaP=$fila['area'];
		$fechaI=$fechaEntrada;
		$fechaI=strtotime('-1 day',strtotime($fechaI));;
	    $fechaI=date("Y-m-d", $fechaI); 
		$fechaS=$fechaSalida;	

	    while ( $fechaI < $fechaS) {
		
			 $fechaI=strtotime('+1 day',strtotime($fechaI));
			 $fechaLV=$fechaI;
		     $fechaI=date("Y-m-d", $fechaI); 
			 $fechaT=$fechaI;
			 $fechaLV=date("w",$fechaLV);
			 $n=0; $y=1;
            switch ($diasProgramacion) {
				case 'lunes-viernes':
					if($fechaLV==6 || $fechaLV==0){	
					}else{			
					   while($n<=$y){    
						if($n==0){
							 $entrada= "Entrada";
							 $cadena = $horaEntrada;                  
							 $seguro=$idEmpleado.$fechaT.$entrada.$areaP;
						}else if($n==1){
							$entrada="Salida";
							$cadena = $horaSalida;                
							$seguro=$idEmpleado.$fechaT.$entrada.$areaP;
									   }
								  $n=$n+1;
								  $sentencia2 = "INSERT INTO programacion (idEmpleado,fechaPrograma,estado,hora,seguro,   area) values                ('$idEmpleado','$fechaT','$entrada','$cadena','$seguro',   '$areaP')  ";
								  $ejecutar2 = mysqli_query($conexion,$sentencia2);
				   
						}
					}
					break;
				case 'lunes-sabado':
					if( $fechaLV==0){

					}else{	
						if($fechaLV==6){
							$horaE=$horaEntradaS;
							$horaS=$horaSalidaS;
						}else{
						  $horaE=$horaEntrada;
						  $horaS=$horaSalida;
						}		
					   while($n<=$y){    
						if($n==0){
							 $entrada= "Entrada";
							 $cadena = $horaE;                  
							 $seguro=$idEmpleado.$fechaT.$entrada.$areaP;
						}else if($n==1){
							$entrada="Salida";
							$cadena = $horaS;                
							$seguro=$idEmpleado.$fechaT.$entrada.$areaP;
									   }
								  $n=$n+1;
								  $sentencia2 = "INSERT INTO programacion (idEmpleado,fechaPrograma,estado,hora,seguro,   area) values                ('$idEmpleado','$fechaT','$entrada','$cadena','$seguro',   '$areaP')  ";
								  $ejecutar2 = mysqli_query($conexion,$sentencia2);
				   
						}
					}
				break;
				case'lunes-domingo':
					if($fechaLV==6){
						$horaE=$horaEntradaS;
						$horaS=$horaSalidaS;
					}elseif($fechaLV==0){
						$horaE=$horaEntradaD;
						$horaS=$horaSalidaD;
					}else{
						$horaE=$horaEntrada;
						$horaS=$horaSalida;
					  }
					

				while($n<=$y){    
					if($n==0){
						 $entrada= "Entrada";
						 $cadena = $horaE;                  
						 $seguro=$idEmpleado.$fechaT.$entrada.$areaP;
					}else if($n==1){
						$entrada="Salida";
						$cadena = $horaS;                
						$seguro=$idEmpleado.$fechaT.$entrada.$areaP;
								   }
							  $n=$n+1;
							  $sentencia2 = "INSERT INTO programacion (idEmpleado,fechaPrograma,estado,hora,seguro,   area) values                ('$idEmpleado','$fechaT','$entrada','$cadena','$seguro',   '$areaP')  ";
							  $ejecutar2 = mysqli_query($conexion,$sentencia2);
			   
					}	
					break;
			}
						
		      
            
		}
	}
	
 
	header('Location: formularioProgramacion.php');
?>
