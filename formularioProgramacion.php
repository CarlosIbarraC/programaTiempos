<meta charset="UTF-8">
<title>Programacion</title>
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
<?php
/* 
------------------------------------inserta datos nuevos-------------------------- */

require_once("conexion.php");
require_once("functions.php");


?>

<body>
<div class="container ">
        <div class="img-fluid  pl-3 portada">
            <img src="img/caratula-2.png" alt="" class="portada">
        </div>
    </div>
    <div class="container ">
        <div class="d-flex justify-content-around">
            <div class="col">
                <button class="btn btn-primary  my-4 px-3 mx-auto"><a href="cargarEmpleados.php"
                        class="text-warning text-left">Listado Empleados</a></button>
            </div>
            <div class="col">
                <button class="btn btn-primary my-4 px-3 mx-auto">
                    <a href="hojaDeTrabajo.php" class="text-warning">hoja Tiempos Reloj</a>
                </button>
            </div>

        </div>
    </div>
    <h2 class="text-warning text-center p-4">Formulario para ingreso de Programacion</h2>
    <div class="container border p-4">
    	
    		<form action="" method="post" class="form-group" class="text-warning">
            <div class="row">
                <div class="col-9 col-sm-6">
        	        <label for="Inputfecha1" class="text-warning">Fecha de Arranque de programacion</label>
        		<input type="date" class="form-control " name="Inputfecha1" id="Inputfecha1" aria-describedby="fechaEntrada" REQUIRED>
        	        <label for="Inputfecha2" class="text-warning">Fecha de Terminacion de programacion</label>
        		<input type="date" class="form-control" id="Inputfecha2" name="Inputfecha2" aria-describedby="fechaSalida" REQUIRED>
        		</div>
                <div class="col-9 col-sm-6 d-flex align-items-center">
        	        <div class="col">
                        <label for="" class="text-warning">Area de Programacion</label>
                        <?php   selectArea() ?>                      
                    </div>
        	        
        		</div>
                <div class=" col-5 col-sm-6  mt-5 ">
                <input type="radio" id="lunes-viernes" name="diasProgramacion" value="lunes-viernes" REQUIRED>
                 <label for="lunes-viernes" class="text-warning">lunes-viernes</label><br>
                 <input type="radio" id="lunes-sabado" name="diasProgramacion" value="lunes-sabado" REQUIRED>
                 <label for="lunes-sabado" class="text-warning">lunes-sabado</label><br>
                 <input type="radio" id="lunes-domingo" name="diasProgramacion" value="lunes-domingo" REQUIRED>
                 <label for="lunes-domingo" class="text-warning">lunes-domingo</label>                 
                </div>
                <div class="col-5 col-sm-4  mt-3">
        	        <label for="Inputhora1" class="text-warning">Hora de Entrada</label>
        		<input type="time" class="form-control "id="InputHora1" name="inputHora1"  REQUIRED>
        	        <label for="Inputhora2" class="text-warning">Hora de Salida</label>
        		<input type="time" class="form-control " id="InputHora2" name="inputHora2"  REQUIRED>
        		</div>
                <div class="col-12">
                    <input type="submit" value="ingresar" id="btnProgramacion" class="btn btn-success btn-lg mt-xs-3">
                </div>
            </div>
    		</form>
    	
    </div>

<script>
$(document).ready(function() {
    $('#SelectArea').select2();
  
});
</script>
<script>
$(document).ready(function() {
    $("#btnProgramacion").click(function() {
      var inputfecha1=$('#Inputfecha1').val();
      var inputfecha2=$('#Inputfecha2').val();      
      var SelectArea=$('#SelectArea').val();
      var diasProgramacion= $('input:radio[name=diasProgramacion]:checked').val();
      var inputHora1=$('#InputHora1').val();
      var inputHora2=$('#InputHora2').val();
     
      /* if(inputfecha1>inputfecha2){
        alertify.alert()
                .setting({
                  'label':'ok',
                  'message': 'This dialog is : ' + (closable ? ' ' : ' not ') + 'closable.' ,
                  'onok': function(){ alertify.success('Gracias');}
                }).show();
      }else{ */
        agregarFormulario(inputfecha1,inputfecha2,SelectArea,diasProgramacion,inputHora1,inputHora2);  

      /* }	 */ 
         });
    });
</script> 
