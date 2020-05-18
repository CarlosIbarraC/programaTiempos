<?php 

$conexion = mysqli_connect("localhost","root","","factura");

if(!$conexion){
  ?>
<script> alert ('fallo conexiom') </script> 
<?php
}

?>

