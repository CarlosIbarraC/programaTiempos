<?php

$fecha = new DateTime('2000-01-01 13:23');
$fecha->add(new DateInterval('PT4H3M2S'));
echo $fecha->format('Y-m-d H:i:s') . "<br>";
$fecha2 = new DateTime('2000-01-01 12:23');
$fecha2->add(new DateInterval('P7Y5M4DT4H3M2S'));
echo $fecha2->format('Y-m-d H:i:s') . "\n";

if($fecha<$fecha2){
    echo "fecha dos mayor";
}else{
    echo "fecha uno mayor";
}
$cadena = "11:45pm";
$cadena = strtotime($cadena);
$cadena = date("H:i", $cadena);
echo $cadena."<br />";
// devuelve 23:45
$cadena = "13/02/2020 06:07:00 p.m.";
$cadena = strtotime($cadena);
$cadena = date("Y/m/d H:i", $cadena);
echo $cadena."<br />";
// devuelve 22:45
$cadena = "9:45 PM";
$cadena = strtotime($cadena);
$cadena = date("H:i", $cadena);
echo $cadena."<br />";
// devuelve 21:45
$cadena = "12:45 a.m.";
$cadena = strtotime($cadena);
$cadena = date("H:i", $cadena);
echo $cadena."<br />";
// devuelve 08:45 
$cadena = "20:45:00";
$cadena = strtotime($cadena);
$cadena = date("H:i", $cadena);
echo $cadena."<br />";
// sigue siendo 20:45 pero sin segundos 
?>
<form action="" name="formulario">
Fecha y hora actual: <input type="time" name="fechahora" step="1" min="00:00" max="23:59" value="">
	<input type="submit" value="enviar">
</form>