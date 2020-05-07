<?php 
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>manejo de tiempos</title>
    <meta name="viewport" content="width=device-width, user-scalable=no,
	 initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href='stylos/style.css' rel='stylesheet' type='text/css'>
    <link href='js/alertify.min.css' rel='stylesheet' type='text/css'>
    <link href='js/themes/default.min.css' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">   
    <script src="js/jquery.min.js"></script>
    <script src="js/alertify.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="funciones.js/funciones.js"></script>
    <link href='css/select2.css' rel='stylesheet' type='text/css'>
    <script src="js/select2.js"></script>
    
</head>
<div class="container ">
<div class="  pl-3 portada">
            <img src="img/caratula-2.png" alt="" class="img-fluid">
        </div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-left">
            <div class="col-4">
                <button class="btn btn-primary  my-4 px-3 mx-auto"><a href="cargarEmpleados.php"
                        class="text-warning text-left">Listado Empleados</a></button>
            </div>
            <div class="col-4">
                <button class="btn btn-primary my-4 px-3 mx-auto">
                    <a href="hojaDeProgramacion.php" class="text-warning">Programacion</a>
                </button>
            </div>
            <div class="col-4">
        <button class="btn btn-primary my-4 px-3 mx-auto"><a href="hojaDeTrabajo.php " class="text-warning">Empleados</a></button>
            </div>

        </div>
    </div>
    <div class="container mt-3 ">
        
    </div>

<?php
if (isset($_POST["enviar"])) {//nos permite recepcionar una variable que si exista y que no sea null
	require_once("conexion.php");
	require_once("functions.php");
	$archivo = $_FILES["archivo"]["name"];
	$archivo_copiado= $_FILES["archivo"]["tmp_name"];
	$archivo_guardado = "copia_".$archivo;
    
	//echo $archivo."esta en la ruta temporal: " .$archivo_copiado;

	if (!copy($archivo_copiado ,$archivo_guardado )) {
		?>
<script>
alert('Error al copiar fichero, reintentalo')
</script>
<?php
	}
    if (file_exists($archivo_guardado)) {
    	 
    	 $fp = fopen($archivo_guardado,"r");//abrir un archivo para solo lectura  'r'.
         $rows = 0;

         //------------------ validacion tabla csv --------------------//
         $datos =fgetcsv($fp , 7000 , ",");
     
         if( count($datos)!= 4){  
           ?><script> enviarAlerta();  </script>   <?php     
       
        }
        if(!preg_match("/\Nombre\b/i",$datos[1])){          
            ?><script> enviarAlerta();  </script>   <?php 
        }
        if(!preg_match("/\Tiempo\b/i",$datos[2])){            
            ?><script> enviarAlerta();  </script>   <?php 
        }
        if(!preg_match("/\Estado\b/i",$datos[3])){
            ?><script> enviarAlerta();  </script>   <?php     
        }
     
        /*  while ($datos = fgetcsv($fp , 7000 , ",")!==FALSE) {
            
          
                 $rows ++;    
				
         	if ($rows > 1) {				
				 $resultado = insertar_datos($datos[0],$datos[1],$datos[2],$datos[3],$datos[1].$datos[2]);				   		
				 if(!$resultado){
				 $alerta ='false';         	
         	}                 
    }else{
    	?>
<script>
alert('termino de ingresar')
</script>
<?php
    }	
}      */

}else{
    ?>
    <script>
        var closable = alertify.alert().setting();

       alertify.alert('tabla')
         .setting({
           'label':'Cerrar',
           'message': 'o' + (closable ? ' ' : ' no es ') + 'validada.' ,
           'onok': function(){ alertify.success('Verifica');}
         }).show();
        
        </script>
    <?php
}
?>

<?php	

}
/* 
------------------------------------inserta datos nuevos-------------------------- */


?>

<body>

    <div class=" container formulario mb-4">
       
            <form action="index.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
            <div class="row mx-0">
                <div class="col-10 col-sm-6">
                	<input type="file" name="archivo" class="form-control btn-warning" />
                </div>
                <div class="col-10 col-sm-6">
                    <button><input type="submit" value="SUBIR ARCHIVO" class="form-control btn-warning" name="enviar"></button>
                </div>
                </div>
            </form>
       
    </div>
    
    
   