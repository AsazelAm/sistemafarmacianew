<?php
/**
 * CONTROLADOR: LoginController.php
 * Gestiona el proceso de autenticación de usuarios
 * Valida credenciales y crea sesiones según el tipo de usuario
 */

// Incluimos el modelo Usuario para poder usar sus métodos
include_once '../modelo/Usuario.php';

// Iniciamos la sesión
session_start();

// Recuperamos los valores de los inputs del formulario de login
$user = $_POST['user']; // CI del usuario
$pass = $_POST['pass']; // Contraseña del usuario

// Instanciamos el modelo Usuario
$usuario = new Usuario();

/**
 * Verificamos si ya existe una sesión activa
 * Si existe, redirigimos según el tipo de usuario
 */
if(!empty($_SESSION['us_tipo'])){
    // Redirigimos según el tipo de usuario logueado
    switch($_SESSION['us_tipo']){
        case 1: // Root
            header('Location:../vista/adm_catalogo.php');
            break;
        case 2: // AdministradorFarmacia
            header('Location:../vista/adm_catalogo.php');
            break;
        case 3: // Farmaceutico
            header('Location:../vista/tec_catalogo.php');
            break;
        case 4: // Supervisor
            header('Location:../vista/adm_catalogo.php');
            break;
        case 5: // Cajero
            header('Location:../vista/tec_catalogo.php');
            break;
        default:
            // Si el tipo no es reconocido, cerramos sesión
            session_destroy();
            header('Location: ../index.php');
            break;
    }
} else {
    /**
     * No hay sesión activa, intentamos loguearnos
     * Llamamos al método Loguearse del modelo Usuario
     */
    $usuario->Loguearse($user, $pass);
    
    // Verificamos si se encontró un usuario con esas credenciales
    if(!empty($usuario->objetos)){
        // Recorremos el resultado (aunque sea un solo usuario)
        foreach($usuario->objetos as $objeto){
            /**
             * Creamos las variables de sesión con los datos del usuario
             * Estas variables estarán disponibles en todas las páginas
             */
            $_SESSION['usuario'] = $objeto->id_usuario; // ID del usuario
            $_SESSION['us_tipo'] = $objeto->id_tipo_us; // Tipo de usuario
            $_SESSION['nombre_us'] = $objeto->nombre; // Nombre del usuario
            $_SESSION['apellido_us'] = $objeto->apellido; // Apellido del usuario (nuevo)
            $_SESSION['avatar'] = $objeto->avatar; // Avatar del usuario (nuevo)
        }
        
        /**
         * Redirigimos según el tipo de usuario
         * Cada tipo tiene acceso a diferentes vistas del sistema
         */
        switch($_SESSION['us_tipo']){
            case 1: // Root - Acceso completo al sistema
                header('Location:../vista/adm_catalogo.php');
                break;
            case 2: // AdministradorFarmacia - Gestión de farmacia
                header('Location:../vista/adm_catalogo.php');
                break;
            case 3: // Farmaceutico - Gestión de productos y ventas
                header('Location:../vista/tec_catalogo.php');
                break;
            case 4: // Supervisor - Supervisión y reportes
                header('Location:../vista/adm_catalogo.php');
                break;
            case 5: // Cajero - Solo ventas
                header('Location:../vista/tec_catalogo.php');
                break;
            default:
                // Si el tipo no es reconocido, regresamos al login
                header('Location: ../index.php');
                break;
        }
    } else {
        /**
         * No se encontró el usuario o las credenciales son incorrectas
         * Regresamos al formulario de login
         */
        header('Location: ../index.php');
    }
}
?>