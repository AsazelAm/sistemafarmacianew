<?php
//incluimos al modelo Usuario
include_once '../modelo/Usuario.php';
session_start();
$user=$_POST['user'];//Recuperamos los valores de los inputs con el nombre del name
$pass=$_POST['pass'];

$usuario = new Usuario();//instanciamos el modelo Usuario
if(!empty($_SESSION['us_tipo'])){//Verificamos si hay una sesion en curso
    //redirigimos según el tipo de usuario
    switch($_SESSION['us_tipo']){
        case 1:
            header('Location:../vista/adm_catalogo.php');
            break;
        case 2:
            header('Location:../vista/tec_catalogo.php');
            break;
        case 3:
            header('Location:../vista/adm_catalogo.php');
            break;
    }
}else{ 
    $usuario->Loguearse($user,$pass);//llamamos al método loguearse
    
    if(!empty($usuario->objetos)){//verificamos si encontró un usuario
        foreach($usuario->objetos as $objeto){//recorremos el resultado
            //creamos las variables de sesión - ACTUALIZADAS para nueva estructura
            $_SESSION['usuario']=$objeto->id_usuario;
            $_SESSION['us_tipo']=$objeto->id_tipo_us;
            $_SESSION['nombre_us']=$objeto->nombre;
        }
        //redirigimos según el tipo de usuario
        switch($_SESSION['us_tipo']){
            case 1:
                header('Location:../vista/adm_catalogo.php');
                break;
            case 2:
                header('Location:../vista/tec_catalogo.php');
                break;
            case 3:
                header('Location:../vista/adm_catalogo.php');
                break;
        }
    }else{//si no existe el usuario regresamos al login
        header('Location: ../index.php');
    }
}
?>