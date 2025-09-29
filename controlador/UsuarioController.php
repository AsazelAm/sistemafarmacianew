<?php
// Incluimos el modelo Usuario
include_once '../modelo/Usuario.php';

// Instanciamos el objeto del modelo Usuario.php para usar sus métodos
$usuario = new Usuario();
session_start();
$id_usuario = $_SESSION['usuario']; // ID del usuario logueado

/**
 * FUNCIÓN: buscar_usuario
 * Busca un usuario específico y retorna sus datos en formato JSON
 * Se usa para mostrar el perfil del usuario
 */
if($_POST['funcion'] == 'buscar_usuario'){
    $json = array();
    $fecha_actual = new DateTime(); // Fecha actual para calcular edad
    
    // Obtenemos los datos del usuario
    $usuario->obtener_datos($_POST['dato']);
    
    // Recorremos el resultado (aunque sea un solo usuario)
    foreach($usuario->objetos as $objeto){
        // Calculamos la edad si existe fecha de nacimiento
        $edad_years = 0;
        if(isset($objeto->fecha_nacimiento) && !empty($objeto->fecha_nacimiento)){
            $nacimiento = new DateTime($objeto->fecha_nacimiento);
            $edad = $nacimiento->diff($fecha_actual); // Diferencia entre fechas
            $edad_years = $edad->y; // Años de diferencia
        }
        
        // Creamos el array JSON con los datos del usuario
        $json[] = array(
            'nombre' => $objeto->nombre,
            'apellidos' => $objeto->apellido,
            'edad' => $edad_years,
            'dni' => $objeto->ci,
            'tipo' => $objeto->nombre_tipo, // Tipo de usuario (Root, Admin, etc.)
            'telefono' => $objeto->telefono ?? 'No especificado',
            'residencia' => $objeto->residencia ?? 'No especificado',
            'correo' => $objeto->email ?? 'No especificado',
            'sexo' => $objeto->sexo ?? 'No especificado',
            'adicional' => $objeto->adicional ?? 'Sin información adicional',
            'avatar' => !empty($objeto->avatar) ? '../img/'.$objeto->avatar : '../img/default.jpg'
        );
    }
    
    // Convertimos el array a JSON y lo enviamos
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

/**
 * FUNCIÓN: capturar_datos
 * Captura los datos editables de un usuario para prellenar el formulario de edición
 */
if($_POST['funcion'] == 'capturar_datos'){
    $json = array();
    $id_usuario = $_POST['id_usuario'];
    
    // Obtenemos los datos del usuario
    $usuario->obtener_datos($id_usuario);
    
    foreach($usuario->objetos as $objeto){
        // Retornamos todos los campos editables
        $json[] = array(
            'telefono' => $objeto->telefono ?? '',
            'residencia' => $objeto->residencia ?? '',
            'correo' => $objeto->email ?? '',
            'sexo' => $objeto->sexo ?? '',
            'adicional' => $objeto->adicional ?? ''
        );
    }
    
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

/**
 * FUNCIÓN: editar_usuario
 * Actualiza los datos personales de un usuario
 */
if($_POST['funcion'] == 'editar_usuario'){
    $id_usuario = $_POST['id_usuario'];
    
    // Capturamos todos los campos del formulario
    $telefono = $_POST['telefono'];
    $residencia = $_POST['residencia'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $adicional = $_POST['adicional'];

    // Llamamos al método editar del modelo
    $usuario->editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional);
    // El método editar ya hace echo 'editado'
}

/**
 * FUNCIÓN: cambiar_contra
 * Cambia la contraseña del usuario
 */
if($_POST['funcion'] == 'cambiar_contra'){
    $id_usuario = $_POST['id_usuario'];
    $oldpass = $_POST['oldpass']; // Contraseña actual
    $newpass = $_POST['newpass']; // Nueva contraseña
    
    // El método cambiar_contra valida la contraseña actual y la cambia si es correcta
    $usuario->cambiar_contra($id_usuario, $oldpass, $newpass);
    // El método ya hace echo 'update' o 'noupdate'
}

/**
 * FUNCIÓN: cambiar_foto
 * Cambia el avatar del usuario
 */
if($_POST['funcion'] == 'cambiar_foto'){
    // Validamos que sea una imagen permitida
    if(($_FILES['photo']['type'] == 'image/jpeg') || 
       ($_FILES['photo']['type'] == 'image/jpg') || 
       ($_FILES['photo']['type'] == 'image/png') || 
       ($_FILES['photo']['type'] == 'image/gif')){
        
        // Generamos un nombre único para el archivo
        $nombre = uniqid().'-'.$_FILES['photo']['name'];
        $ruta = '../img/'.$nombre;

        // Movemos el archivo subido a la carpeta img
        move_uploaded_file($_FILES['photo']['tmp_name'], $ruta);
        
        // Actualizamos en la base de datos
        $usuario->cambiar_photo($id_usuario, $nombre);

        // Eliminamos el avatar anterior (si no es el default)
        foreach($usuario->objetos as $objeto){
            if($objeto->avatar != 'default.jpg' && file_exists('../img/'.$objeto->avatar)){
                unlink('../img/'.$objeto->avatar);
            }
        }
        
        // Retornamos respuesta exitosa
        $json = array();
        $json[] = array(
            'ruta' => $ruta,
            'alert' => 'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        // Formato de imagen no válido
        $json = array();
        $json[] = array(
            'alert' => 'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}

/**
 * FUNCIÓN: buscar_usuarios_adm
 * Busca todos los usuarios del sistema para la vista de administración
 */
if($_POST['funcion'] == 'buscar_usuarios_adm'){
    $json = array();
    $fecha_actual = new DateTime();
    
    // Buscamos todos los usuarios
    $usuario->buscar();
    
    // Recorremos cada usuario encontrado
    foreach($usuario->objetos as $objeto){
        // Calculamos edad
        $edad_years = 0;
        if(isset($objeto->fecha_nacimiento) && !empty($objeto->fecha_nacimiento)){
            $nacimiento = new DateTime($objeto->fecha_nacimiento);
            $edad = $nacimiento->diff($fecha_actual);
            $edad_years = $edad->y;
        }
        
        // Creamos el array JSON con todos los datos necesarios para la vista
        $json[] = array(
            'id' => $objeto->id_usuario,
            'nombre' => $objeto->nombre,
            'apellidos' => $objeto->apellido,
            'edad' => $edad_years,
            'dni' => $objeto->ci,
            'tipo' => $objeto->nombre_tipo,
            'telefono' => $objeto->telefono ?? 'No especificado',
            'residencia' => $objeto->residencia ?? 'No especificado',
            'correo' => $objeto->email ?? 'No especificado',
            'sexo' => $objeto->sexo ?? 'No especificado',
            'adicional' => $objeto->adicional ?? 'Sin información adicional',
            'avatar' => !empty($objeto->avatar) ? '../img/'.$objeto->avatar : '../img/default.jpg',
            'tipo_usuario' => $objeto->id_tipo_us // Para validaciones en el frontend
        );
    }
    
    // Retornamos el array completo de usuarios
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

/**
 * FUNCIÓN: crear_usuario
 * Crea un nuevo usuario en el sistema
 */
if($_POST['funcion'] == 'crear_usuario'){
    // Capturamos todos los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad']; // Esto es la fecha de nacimiento
    $dni = $_POST['dni'];
    $pass = $_POST['pass'];
    
    $tipo = 5; // Tipo por defecto: Cajero (id_tipo_us = 5)
    $avatar = 'default.jpg'; // Avatar por defecto
    
    // Llamamos al método crear del modelo
    $usuario->crear($nombre, $apellido, $edad, $dni, $pass, $tipo, $avatar);
    // El método crear ya hace echo 'add' o 'noadd'
}

/**
 * FUNCIÓN: ascender
 * Asciende un usuario (requiere contraseña del que realiza la acción)
 */
if($_POST['funcion'] == 'ascender'){
    $pass = $_POST['pass']; // Contraseña del usuario que realiza la acción
    $id_ascendido = $_POST['id_usuario']; // ID del usuario a ascender
    
    $usuario->ascender($pass, $id_ascendido, $id_usuario);
    // El método ya hace echo 'ascendido' o 'noascendido'
}

/**
 * FUNCIÓN: descender
 * Desciende un usuario (requiere contraseña del que realiza la acción)
 */
if($_POST['funcion'] == 'descender'){
    $pass = $_POST['pass'];
    $id_descendido = $_POST['id_usuario'];
    
    $usuario->descender($pass, $id_descendido, $id_usuario);
    // El método ya hace echo 'descendido' o 'nodescendido'
}

/**
 * FUNCIÓN: borrar_usuario
 * Elimina (desactiva) un usuario del sistema (requiere contraseña)
 */
if($_POST['funcion'] == 'borrar_usuario'){
    $pass = $_POST['pass'];
    $id_borrado = $_POST['id_usuario'];
    
    $usuario->borrar($pass, $id_borrado, $id_usuario);
    // El método ya hace echo 'borrado' o 'noborrado'
}
?>