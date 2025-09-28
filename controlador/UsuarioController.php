<?php
//incluimos el modelo usuario
include_once '../modelo/Usuario.php';
//Instanciamos al objeto del modelo Usuario.php para usar sus metodos
$usuario=new Usuario();
session_start();
$id_usuario=$_SESSION['usuario'];

//necesitamos comparar con un if cual funcion se esta realizando
if($_POST['funcion']=='buscar_usuario'){
    $json=array();
    $fecha_actual=new DateTime();
    $usuario->obtener_datos($_POST['dato']);
    
    //hacemos un foreach para recorrer todos los datos
    foreach($usuario->objetos as $objeto){
        // Calcular edad si existe fecha de nacimiento, sino usar un valor por defecto
        $edad_years = 0;
        if(isset($objeto->fecha_nacimiento) && !empty($objeto->fecha_nacimiento)){
            $nacimiento=new DateTime($objeto->fecha_nacimiento);
            $edad=$nacimiento->diff($fecha_actual);
            $edad_years=$edad->y;
        }
        
        //vamos hacer nuestro json - ACTUALIZADO para nueva estructura
        $json[]=array(
            'nombre'=>$objeto->nombre,
            'apellidos'=>$objeto->apellido,
            'edad'=> $edad_years,
            'dni'=>$objeto->ci,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono,
            'residencia'=>$objeto->residencia, // Campo no existe en nueva BD
            'correo'=>$objeto->email,
            'sexo'=>$objeto->sexo, // Campo no existe en nueva BD
            'adicional'=>$objeto->adicional, // Campo no existe en nueva BD
            'avatar'=>'../img/default.jpg' // Avatar por defecto hasta que agregues el campo
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='capturar_datos'){
    $json=array();
    $id_usuario=$_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);
    
    //hacemos un foreach para recorrer todos los datos
    foreach($usuario->objetos as $objeto){
        //JSON actualizado para nueva estructura
        $json[]=array(
            'telefono'=>$objeto->telefono ?? '',
            'residencia'=>$objeto->residencia, // Campo no existe, dejar vacío
            'correo'=>$objeto->email ?? '',
            'sexo'=>$objeto->sexo, // Campo no existe, dejar vacío
            'adicional'=>$objeto->adicional // Campo no existe, dejar vacío
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='editar_usuario'){
    $json=array();
    $id_usuario=$_POST['id_usuario'];
    
    //Solo campos que existen en la nueva estructura
    $telefono=$_POST['telefono'];
    $residencia=$_POST['residencia']; // Este campo no se guardará hasta que agregues la columna
    $correo=$_POST['correo'];
    $sexo=$_POST['sexo']; // Este campo no se guardará hasta que agregues la columna
    $adicional=$_POST['adicional']; // Este campo no se guardará hasta que agregues la columna

    $usuario->editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional);

    echo 'editado';
}

if($_POST['funcion']=='cambiar_contra'){
    $id_usuario=$_POST['id_usuario'];
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    
    $usuario->cambiar_contra($id_usuario,$oldpass,$newpass);
}

if($_POST['funcion']=='cambiar_foto'){
    // Esta función está comentada hasta que agregues el campo avatar a la tabla usuario
    
    if(($_FILES['photo']['type']=='image/jpeg') || ($_FILES['photo']['type']=='image/jpg') || ($_FILES['photo']['type']=='image/png')|| ($_FILES['photo']['type']=='image/gif')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/'.$nombre;

        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $usuario->cambiar_photo($id_usuario,$nombre);

        foreach($usuario->objetos as $objeto){
            unlink('../img/'.$objeto->avatar);
        }
        $json=array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }else{
        $json=array();
        $json[]=array(
            'alert'=>'noedit'
        );
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
    
    
    // Respuesta temporal hasta que implementes avatars
    $json=array();
    $json[]=array(
        'alert'=>'noedit'
    );
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='buscar_usuarios_adm'){
    $json=array();
    $fecha_actual=new DateTime();
    $usuario->buscar();
    
    //hacemos un foreach para recorrer todos los datos
    foreach($usuario->objetos as $objeto){
        // Calcular edad si existe, sino valor por defecto
        $edad_years = 0;
        if(isset($objeto->fecha_nacimiento) && !empty($objeto->fecha_nacimiento)){
            $nacimiento=new DateTime($objeto->fecha_nacimiento);
            $edad=$nacimiento->diff($fecha_actual);
            $edad_years=$edad->y;
        }
        
        //JSON actualizado para nueva estructura
        $json[]=array(
            'id'=>$objeto->id_usuario,
            'nombre'=>$objeto->nombre,
            'apellidos'=>$objeto->apellido,
            'edad'=> $edad_years,
            'dni'=>$objeto->ci,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono ?? 'No especificado',
            'residencia'=>$objeto->residencia,
            'correo'=>$objeto->email ?? 'No especificado',
            'sexo'=>$objeto->sexo,
           'adicional'=>$objeto->adicional,
            'avatar'=>'../img/default.jpg', // Avatar por defecto
            'tipo_usuario'=>$objeto->id_tipo_us
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='crear_usuario'){
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $edad=$_POST['edad']; // En la nueva estructura no necesitas edad como parámetro
    $dni=$_POST['dni'];
    $pass=$_POST['pass'];
    $tipo=2; // Tipo por defecto
    $avatar='default.jpg'; // Avatar por defecto
    $usuario->crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar);
}

if($_POST['funcion']=='ascender'){
    $pass=$_POST['pass'];
    $id_ascendido=$_POST['id_usuario'];
    $usuario->ascender($pass,$id_ascendido,$id_usuario);
}

if($_POST['funcion']=='descender'){
    $pass=$_POST['pass'];
    $id_descendido=$_POST['id_usuario'];
    $usuario->descender($pass,$id_descendido,$id_usuario);
}

if($_POST['funcion']=='borrar_usuario'){
    $pass=$_POST['pass'];
    $id_borrado=$_POST['id_usuario'];
    $usuario->borrar($pass,$id_borrado,$id_usuario);
}
?>