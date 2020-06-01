<?php
session_start();
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


//------------------------------conversion a unix----------------------------------//

$horaEntradaUnix=Existe($horaEntrada);
$horaSalidaUnix= Existe($horaSalida);
$horaEntradaSUnix=Existe($horaEntradaS);
$horaSalidaSUnix= Existe($horaSalidaS);
$horaEntradaDUnix= Existe($horaEntradaD);
$horaSalidaDUnix= Existe($horaSalidaD);
//echo $horaSalidaDUnix."<br>";
$_SESSION['fechaEntrada']=$fechaEntrada;
$_SESSION['fechaSalida']=$fechaSalida;
 
 global $conexion;	
	$sentencia = "SELECT * FROM nombresempleados where area='$area' ";
	$ejecutar = mysqli_query($conexion,$sentencia);
	while($fila = $ejecutar->fetch_array()) {
		$idEmpleado=$fila['id_empleado'];
		$areaP=$fila['area'];
		$fechaI=$fechaEntrada;				
		$fechaS=$fechaSalida;	      
	    while ( $fechaI <=$fechaS) {
					 
			 $fechaLV=strtotime($fechaI);		    
			 			
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
							 $seguro=$idEmpleado.$fechaI.$entrada.$areaP;
						}else if($n==1){
							$entrada="Salida";
							$cadena = $horaSalida;                
							$seguro=$idEmpleado.$fechaI.$entrada.$areaP;
									   }
								  $n=$n+1;
								  $sentencia2 = "INSERT INTO programacion (idEmpleado,fechaPrograma,estado,hora,seguro,   area) values                ('$idEmpleado','$fechaI','$entrada','$cadena','$seguro',   '$areaP')  ";
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
							 $seguro=$idEmpleado.$fechaI.$entrada.$areaP;
						}else if($n==1){
							$entrada="Salida";
							$cadena = $horaS;                
							$seguro=$idEmpleado.$fechaI.$entrada.$areaP;
									   }
								  $n=$n+1;
								  $sentencia2 = "INSERT INTO programacion (idEmpleado,fechaPrograma,estado,hora,seguro,   area) values                ('$idEmpleado','$fechaI','$entrada','$cadena','$seguro',   '$areaP')  ";
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
						 $seguro=$idEmpleado.$fechaI.$entrada.$areaP;
					}else if($n==1){
						$entrada="Salida";
						$cadena = $horaS;                
						$seguro=$idEmpleado.$fechaI.$entrada.$areaP;
								   }
							  $n=$n+1;
							  $sentencia2 = "INSERT INTO programacion (idEmpleado,fechaPrograma,estado,hora,seguro,   area) values                ('$idEmpleado','$fechaI','$entrada','$cadena','$seguro',   '$areaP')  ";
							  $ejecutar2 = mysqli_query($conexion,$sentencia2);
							 
					}	
					break;
			}
						
			$fechaI=strtotime('+1 day',strtotime($fechaI));      
			$fechaI=date("Y-m-d", $fechaI); 
			//echo "*".$fechaI;
		}
		
	}
	
	
 
	//header('Location: formularioProgramacion.php');
?>