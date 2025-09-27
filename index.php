<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Los estilos-->
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/css/all.min.css"><!--son los iconos-->
    <title>login</title>
</head>
<?php
session_start();//para poder usar las variables sessiones si no podremos usar las variables sesiones
if(!empty($_SESSION['us_tipo'])){//si existe una sesion q me mande directamente al controlador para q este se encarge de enrutarme
    header('Location:controlador/LoginController.php');
}else{
    session_destroy();//en caso de q no vea ninguna sesion en curso vamos a borarlas para no tener ningun problema en curso
?>
<body>
    <img src="img/wave.png" alt="" class="wave">
    <div class="contenedor">
        <div class="img">
            <img src="img/bg.svg" alt="">
        </div>
        <div class="contenido-login">
            <form action="controlador/LoginController.php" method="POST">
                <img src="img/logo.png" alt="">
                <h2>Farmacia</h2>
                <div class="input-div dni"> <!--creamos un div para el DNI-->
                    <div class="i"> <!--i es de icono de la clase icono-->
                        <i class="fas fa-user"></i> <!--colocamos el icono-->
                    </div>
                    <div class="div">
                        <h5>Carnet Identidad</h5>
                        <input type="text" name="user" class="input">
                    </div>
                </div>
                <div class="input-div pass"><!--creamos un div para la contraseña-->
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" name="pass" class="input">
                    </div>
                </div>
                <a href="">Created Warpiece</a>
                <input type="submit" class="btn" value="iniciar Sesion"><!--creamos un input de tipo submit para poder enviar el contenido de los inputs-->
            </form>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>
<?php
}
?>