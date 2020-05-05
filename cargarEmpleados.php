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
    <link href='stylos\style.css' rel='stylesheet' type='text/css'>
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
</head>
<?php
require_once("conexion.php");
require_once("functions.php");
if (isset($_POST["enviarE"])) {//nos permite recepcionar una variable que si exista y que no sea null
	
	$archivo = $_FILES["archivoE"]["name"];
	$archivo_copiado= $_FILES["archivoE"]["tmp_name"]; //archivo copiado    
	//echo $archivo."esta en la ruta temporal: " .$archivo_copiado;

	if (!$archivo_copiado ) {
		?>
<script>
alert('Error al copiar fichero, reintentalo')
</script>
<?php
	}
    if (file_exists($archivo_copiado)) {
    	 
    	 $fp = fopen($archivo_copiado,"r");//abrir un archivo para solo lectura  'r'.
         $rows = 0;
         while ($datos = fgetcsv($fp , 3000 , ",")) {
				 $rows ++;
				
         	if ($rows > 1) {				
				
				 $resultado = insertar_nombres($datos[0],$datos[1],$datos[2],$datos[3]);				   		
				 if(!$resultado){
				 $alerta ='false';         	
         	}
                 
    }

	
} 

}




	?>
<script>
alert('tabla copiada exitosamente')
</script>
<?php

}
/* 
------------------------------------guardar empleado nuevo-------------------------- */
if(isset($_POST['submit-E'])) 
{
$idEmpleado= $_POST['identificacion'];
$nombreE= $_POST['nombre'];
$areaE= $_POST['area'];
$observacionesE= $_POST['observaciones'];
insertar_nombres($idEmpleado,$nombreE,$areaE,$observacionesE);
}



?>

<!-- ------------------------------------inserta datos nuevos--------------------------  -->

<body>
    <div class="container ">
    <div class="  pl-3 portada">
            <img src="img/caratula-2.png" alt="" class="img-fluid">
        </div>
    </div>

    <div class="container portada">

        <form action="cargarEmpleados.php" class="form-group" method="post" enctype="multipart/form-data">
            <div class="row mx-0">
                <div class="col-12 col-sm-6 my-2">
                <p class="text-warning">⚠</p>    
                <input type="file" name="archivoE" class="form-control tn btn-success  mb-4 px-3 py-1" />
                    <label for="" class="text-warning">⚠ Si desea subir de un archivo CSV separado por comas, por favor
                        siga el orden de la tabla (id-empleado, nombre, area, observaciones)</label>
                   
                </div>
                <div class="col mx-auto">
                   
                        <input type="submit" value="SUBIR ARCHIVO" class=" btn btn-success form-group  ml-5"
                            name="enviarE">
                    
                </div>
            </div>
        </form>

    </div> 
   

    <div class="container">

        <div id="tablaEmpleados">
        </div>
    </div>
   <!--  -------------------------------------Modal Ingreso nuevo empleado---------------------- -->
  


<!-- Modal -->
<div class="modal fade" id="IngresoNuevoE" tabindex="-1" role="dialog" aria-labelledby="IngresoNuevoELabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="IngresoNuevoELabel">Ingreso de Empleados Nuevos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="container" id="forEmpleados">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class=" form-group" method="post">
            
            <div class="col-8 pt-4 pb-2 formDatosE">
                <label for="identificacion">Identificacion *</label>
            </div>
            <div class="col-8 py-2 formDatosE">
                <input type="number" name="identificacion" class="form-control" placeholder="Nº  identificacion"
                    require>
            </div>
            <div class="col-8 py-2 formDatosE">
                <label for="identificacion">Nombre *</label>
            </div>
            <div class="col-8 py-2 formDatosE">
                <input type="text" name="nombre" class=" form-control" placeholder="Nombre del Empleado" require>
            </div>
            <div class="col-8 py-2 formDatosE">
                <label for="identificacion">Area *</label>
            </div>
            <div class="col-8 py-2 formDatosE">
                <input type="text" name="area" class="form-control" placeholder="Area a la que pertenece" require>
            </div>
            <div class="col-8 py-2 formDatosE">
                <label for="identificacion">Observaciones </label>
            </div>
            <div class="col-8 pt-2 pb-4 formDatosE">
                <input type="texttarea" name="observaciones" class="form-control lg">
            </div>
            <div class="col-8 py-2 formDatosE">
                <h5>* campos obligatorios</h5>
            </div>
           <!--  <div class="col-8 pt-2 pb-4 formDatosE">
                <input type="submit" name="submit-E" class="btn btn-success sm">
            </div> -->
       
    

    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit-E"class="btn btn-primary">Guardar Ingreso</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <!--   ----------------------------------inicio modal Edicion--------------------------- -->



    <!-- Modal -->
    <div class="modal fade" id="modalEmpleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edicion Empleados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-8 pt-4 pb-2 formDatosE">
                        <label for="identificacion">Identificacion *</label>
                    </div>
                    <div class="col-8 py-2 formDatosE">
                        <input type="hidden" name="idE" id="idE" class="form-control" placeholder="Nº  identificacion">
                        <input type="text" name="identificacionE" id="identificacionE" class="form-control"
                            placeholder="Nº  identificacion">
                    </div>
                    <div class="col-8 py-2 formDatosE">
                        <label for="identificacion">Nombre *</label>
                    </div>
                    <div class="col-8 py-2 formDatosE">
                        <input type="text" name="nombreE" id="nombreE" class=" form-control"
                            placeholder="Nombre del Empleado">
                    </div>
                    <div class="col-8 py-2 formDatosE">
                        <label for="identificacion">Area *</label>
                    </div>
                    <div class="col-8 py-2 formDatosE">
                        <input type="text" name="areaE" id="areaE" class="form-control"
                            placeholder="Area a la que pertenece">
                    </div>
                    <div class="col-8 py-2 formDatosE">
                        <label for="identificacion">Observaciones </label>
                    </div>
                    <div class="col-8 pt-2 pb-4 formDatosE">
                        <input type="texttarea" name="observacionesE" id="observacionesE" class="form-control lg">
                    </div>
                    <div class="col-8 py-2 formDatosE">
                        <p>* campos obligatorios</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="editardatos">Guardar Ingreso</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tablaEmpleados').load('tablaEmpleados.php');



    });
    </script>
    <script>
    $(document).ready(function() {
        $('#editardatos').click(function() {
            guardarEdicionEmpleado();

        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#empleadosN').click(function() {
            $('#forEmpleados').removeClass("aparecer");
            $('#empleadosN').addClass("aparecer");

        });
    });
    </script>