<?php 
session_start();
require 'functions.php';
require 'conexion.php';
if(isset($_POST['submit'])){
    $usuario= $_POST['usuario'];
    $password=$_POST['Password'];
    $_SESSION['usuario']="";
    if(!empty($usuario)){   

        $usuario=filter_var($usuario,FILTER_SANITIZE_STRING);
        
       
       
    }
    if(!empty($password)){   

        $password=filter_var($password,FILTER_SANITIZE_STRING);
        
    }  
    global $conexion;
    $sentencia = "SELECT usuario , pass  FROM usuarios WHERE usuario = '$usuario' AND pass ='$password' "; 
    $ejecutar = $conexion->query($sentencia);
    $fila = $ejecutar->fetch_assoc();
    
          if($fila!=0){
        header('location:index.php');
        $_SESSION['usuario']=$usuario;
    }
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
    <h2 class="text-center text-warning my-5">Sistema Tiempos Personal</h2>
    
    <div class="container">
        <div class="row d-flex justify-content-around col-12">
            <form action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
          <div class="form-group ">
            <label for="usuario" class="text-warning">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="emailHelp" placeholder="Enter email" REQUIRED>
            
          </div>
          <div class="form-group">
            <label for="Password" class="text-warning">Password</label>
            <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" REQUIRED>
          </div>
          <div class="form-check">
           
           
          <button type="submit " name="submit" class="btn btn-info mb-2">Entrar</button>
        </form>
        </div >
    </div>