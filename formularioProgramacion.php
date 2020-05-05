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
session_start();
if($_SESSION['usuario']==""){
    header("location:login.php");
}


/* 
------------------------------------inserta datos nuevos-------------------------- */

require_once("conexion.php");
require_once("functions.php");

 if(isset($_SESSION['fechaEntrada'])){
     $fechaProgramacionE=$_SESSION['fechaEntrada'];

 }else{
    $fechaProgramacionE="";
 };
 if(isset($_SESSION['fechaSalida'])){
     
    $fechaProgramacionS=$_SESSION['fechaSalida'];
    

}else{
   $fechaProgramacionS="";
};

?>

<body>
<div class="container ">
        <div class="  pl-3 portada">
            <img src="img/caratula-2.png" alt="" class="img-fluid">
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
            <div class="formDatosE  col-4">
                    <a href="horasDeTrabajoPersonal.php"><button class="btn btn-warning  my-4 px-3 btn-md">Horas de trabajo </button></a>
                </div>

        </div>
    </div>
    <h2 class="text-warning text-center p-4">Formulario para ingreso de Programacion</h2><br>
    <h2 class="text-warning text-center"><?php echo $fechaProgramacionE?>/<?php echo $fechaProgramacionS?> </h2>
    <div class="container border p-4">
    	
    		<form action="datosDeProgramacion.php" method="post" class="form-group" class="text-warning">
            <div class="row">
                <div class="col-9 col-sm-6">
        	        <label for="Inputfecha1" class="text-warning">Fecha de Arranque de programacion</label>
        		<input type="date" class="form-control " name="Inputfecha1" id="Inputfecha1" aria-describedby="fechaEntrada"  REQUIRED>
        	        <label for="Inputfecha2" class="text-warning">Fecha de Terminacion de programacion</label>
        		<input type="date" class="form-control" id="Inputfecha2" name="Inputfecha2" aria-describedby="fechaSalida" REQUIRED>
        		</div>
                <div class="col-9 col-sm-6 d-flex align-items-center">
        	        <div class="col">
                        <label for="" class="text-warning">Area de Programacion</label>
                        <?php   selectArea() ?>                      
                    </div>
        	        
        		</div>
                <div class="row col-12 mb-4">
                <div class=" col-10 col-sm-3  mt-3 ">
                <input type="radio" id="lunes-viernes" name="diasProgramacion" value="lunes-viernes" REQUIRED>
                 <label for="lunes-viernes" class="text-warning">Lunes-Viernes</label><br>
                 <input type="radio" id="lunes-sabado" name="diasProgramacion" value="lunes-sabado" REQUIRED>
                 <label for="lunes-sabado" class="text-warning">Lunes-Sabado</label><br>
                 <input type="radio" id="lunes-domingo" name="diasProgramacion" value="lunes-domingo" REQUIRED>
                 <label for="lunes-domingo" class="text-warning">Lunes-Domingo</label>                 
                </div>
               
                    <div class="col-10 col-sm-3  mt-3">
            	        <label for="Inputhora1" class="text-warning">Hora de Entrada lunes-viernes</label>
            		<input type="time" class="form-control "id="InputHora1" name="inputHora1"  REQUIRED>
            	        <label for="Inputhora2" class="text-warning">Hora de Salida lunes-viernes</label>
            		<input type="time" class="form-control " id="InputHora2" name="inputHora2"  REQUIRED>
            		</div>
                    <div id="horasSabado" class="col-10 col-sm-3 mt-3 aparecer">
                    <label for='InputhoraES' class='text-warning'>Hora de Entrada sabado</label>
        		<input type='time' class='form-control 'id='InputHoraES' name='inputHoraES'  >
        	        <label for='InputhoraSS' class='text-warning'>Hora de Salida Sabado</label>
                <input type='time' class='form-control ' id='InputHoraSS' name='inputHoraSS'  >
                    </div>
                    <div id="horasDomingo" class="col-10 col-sm-3 mt-3 aparecer">
                    <label for='InputhoraES' class='text-warning'>Hora de Entrada domingo</label>
        		<input type='time' class='form-control 'id='InputHoraED' name='inputHoraED'  >
        	        <label for='InputhoraSS' class='text-warning'>Hora de Salida domingo</label>
                <input type='time' class='form-control ' id='InputHoraSD' name='inputHoraSD'  >
                    </div>

                </div>
                <div class="col-12">
                    <input type="submit" value="ingresar" id="btnProgramacion" class="btn btn-success btn-lg mt-xs-3">
                </div>
            </div>
    		</form>
    	
    </div>
    <div id="areasProgramadas">
    </div>

<script>
$(document).ready(function() {
    $('#SelectArea').select2();
  
});
</script>
<script>
var dateControl = document.querySelector('input[type="date"]#Inputfecha1');
dateControl.value = "<?php echo $fechaProgramacionE?>";
var dateControl = document.querySelector('input[type="date"]#Inputfecha2');
dateControl.value = "<?php echo $fechaProgramacionS?>";

 
</script>
<script>
$(document).ready(function() {
    $('#areasProgramadas').load('areasProgramadas.php');
  
});
</script>
<script>

    $("#lunes-sabado").change(function() {
        $('#horasSabado').removeClass("aparecer");  
        $('#horasDomingo').addClass("aparecer");  
         });
    $("#lunes-viernes").change(function() {            
        $('#horasSabado').addClass("aparecer");
        $('#horasDomingo').addClass("aparecer");  
     	 
         });

     $("#lunes-domingo").change(function() {
        $('#horasSabado').removeClass("aparecer");  
        $('#horasDomingo').removeClass("aparecer"); 
         });   
</script>

<!-- <script>
$(document).ready(function() {
    $("#btnProgramacion").click(function() {
      var inputfecha1=$('#Inputfecha1').val();
      var inputfecha2=$('#Inputfecha2').val();      
      var SelectArea=$('#SelectArea').val();
      var diasProgramacion= $('input:radio[name=diasProgramacion]:checked').val();
      var inputHora1=$('#InputHora1').val();
      var inputHora2=$('#InputHora2').val();
      alert("The text has been changed.");
      var closable=inputfecha2;
     console.log(inputfecha1,inputfecha2,SelectArea,diasProgramacion,inputHora1,inputHora2);
      if(inputfecha1>inputfecha2){
        alertify.alert()
                .setting({
                  'label':'ok',
                  'message': 'This dialog is : ' + (closable ? ' ' : ' not ') + 'closable.' ,
                  'onok': function(){ alertify.success('Gracias');}
                }).show();
      }else{
        agregarFormulario(inputfecha1,inputfecha2,SelectArea,diasProgramacion,inputHora1,inputHora2);  

       }	 
         });
        });
    
</script>  -->
