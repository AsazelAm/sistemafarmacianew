<?php
//incluimos al modelos/Usuario con esto ya estamos llamando a Usuario
include_once '../modelo/Usuario.php';
session_start();
$user=$_POST['user'];//Recuperamos los valores de los inputs con el nombre del name
$pass=$_POST['pass'];
//echo $user; //con esto enprimos el valor recuperado
$usuario = new Usuario();//vamos a llamar a un usuario y vamos instanciar a un modelo Usuario, cuando instanciamos al usuario ya senos esta haciendo la conexion al pdo
if(!empty($_SESSION['us_tipo'])){//Esto me dice si hay una sesion en curso
    //le mandamos q tipo de usuario es y le direccionamos a donde tiene q redirigrse
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
}else{ //si no se ejecuta todo esta linea y me hace la consulta
    $usuario->Loguearse($user,$pass);//al hacer esto estamos llamando a loguearse y nos a retornar un objeto
    /*hacemos un if la cual nos va a permitir si encuentra un usuario y concide con la base de Datos verifiq q rol tiene */
    if(!empty($usuario->objetos)){//el !empty verifica si una varible esta vacia, en este q no este vacio si la variable usuario->objetos no este vacio
        foreach($usuario->objetos as $objeto){//al foreach accedemos a usuario vamos acceder a objetos el nos retorna de loguearse y vamos a recorre con $objeto para el ciclo
        //creamos nuestras variables $_SESSION va a contener usuario y se le va asignar el objeto, el id_usuario son los nombres de nuestra base de datos
            $_SESSION['usuario']=$objeto->id_usuario;
            $_SESSION['us_tipo']=$objeto->us_tipo;
            $_SESSION['nombre_us']=$objeto->nombre_us;
        }
        //hacemos un swicht para verificar q tipo de usuario unicio session
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
    }else{//si no exixte dicho usuario me mantiene en el index usuario
        header('Location: ../index.php');
    }
}

?>