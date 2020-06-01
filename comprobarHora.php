<?php
if($_POST["inputHora1"]>$_POST["inputHora2"] || $_POST["inputHoraES"]>$_POST['inputHoraSS'] || $_POST["inputHoraED"] >$_POST['inputHoraSD']){

	?> 
	<h2>ES UNA PROGRAMACION NOCTURNA ?</h2>
	
	<button onclick="confirmar()">Volver</button>
	<button onclick="pasar()">Confirmar</button>
	<script>
	function confirmar(){
window.location.href = "formularioProgramacion.php";
	}
	function pasar(){
        window.location.href = "datosDeProgramacion.php";
	}
</script>
<?php
}else{
    ?>
    <script>    
    window.location.href = "datosDeProgramacion.php";
    </script>
  <?php 
}
?>