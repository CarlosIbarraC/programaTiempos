<?php 
$xx= 9527334;
if (is_int($xx)){

    echo "true"; 
}else{
    echo "false";
}
if(gettype($xx)=="integer"){
    echo "true";
}else{
    echo "false";
}


?>
<?php
/* El \b en el patrón indica un límite de palabra, por lo que sólo la palabra
 * definida "web" se compara, y no una palabra parcial como "webbing" o "cobweb" */
if (preg_match("/\bweb\b/i", "PHP es el lenguaje de secuencias de comandos web preferido.")) {
    echo "Se encontró una coincidencia.";
} else {
    echo "No se encontró ninguna coincidencia.";
}

if (preg_match("/\bweb\b/i", "PHP es el lenguaje de secuencias de comandos website preferido.")) {
    echo "Se encontró una coincidencia.";
} else {
    echo "No se encontró ninguna coincidencia.";
}
?>