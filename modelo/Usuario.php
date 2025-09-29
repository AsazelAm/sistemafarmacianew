<?php
// Incluimos la Conexion para poderla llamar
include_once 'Conexion.php';

/**
 * Clase Usuario
 * Gestiona todas las operaciones relacionadas con los usuarios del sistema
 */
class Usuario{
    var $objetos; // Variable que almacenará los resultados de las consultas
    private $acceso; // Variable para la conexión PDO
    
    /**
     * Constructor de la clase
     * Instancia automáticamente la conexión a la base de datos
     */
    public function __construct(){
        $db = new Conexion(); // Creamos una nueva conexión PDO
        $this->acceso = $db->pdo; // Asignamos el objeto PDO a la propiedad $acceso
    }
    

    function Loguearse($dni, $pass){
        // Consulta SQL con INNER JOIN para obtener datos del usuario y su tipo
        $sql = "SELECT u.id_usuario, u.nombre, u.apellido, u.ci, u.telefono, u.email, 
                       u.id_tipo_us, u.codigo_empleado, u.fecha_nacimiento, u.avatar,
                       u.residencia, u.sexo, u.adicional,
                       t.nombre_tipo 
                FROM usuario u 
                INNER JOIN tipo_us t ON u.id_tipo_us = t.id_tipo_us 
                WHERE u.ci = :dni AND u.constrasena = :pass AND u.Estado = 1";
        
        // Preparamos la consulta para prevenir inyección SQL
        $query = $this->acceso->prepare($sql);
        
        // Ejecutamos la consulta pasando los parámetros de forma segura
        $query->execute(array(':dni' => $dni, ':pass' => $pass));
        
        // fetchAll() recupera todas las filas que coincidan con la consulta
        $this->objetos = $query->fetchAll();
        
        return $this->objetos;
    }

  
    function obtener_datos($id){
        $sql = "SELECT u.id_usuario, u.nombre, u.apellido, u.ci, u.telefono, u.email, 
                       u.id_tipo_us, u.codigo_empleado, u.fecha_nacimiento, u.avatar,
                       u.residencia, u.sexo, u.adicional,
                       t.nombre_tipo 
                FROM usuario u 
                JOIN tipo_us t ON u.id_tipo_us = t.id_tipo_us 
                WHERE u.id_usuario = :id AND u.Estado = 1";
        
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll();
        
        return $this->objetos;
    }

  
    function editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional){
        // Actualizamos todos los campos editables
        $sql = "UPDATE usuario 
                SET telefono = :telefono, 
                    residencia = :residencia,
                    email = :correo,
                    sexo = :sexo,
                    adicional = :adicional
                WHERE id_usuario = :id";
        
        $query = $this->acceso->prepare($sql);
        
        $query->execute(array(
            ':id' => $id_usuario,
            ':telefono' => $telefono,
            ':residencia' => $residencia,
            ':correo' => $correo,
            ':sexo' => $sexo,
            ':adicional' => $adicional
        ));
        echo 'editado';
    }


    function cambiar_contra($id_usuario, $oldpass, $newpass){
        // Primero verificamos que la contraseña actual sea correcta
        $sql = "SELECT id_usuario FROM usuario 
                WHERE id_usuario = :id AND constrasena = :oldpass";
        
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_usuario, ':oldpass' => $oldpass));
        $this->objetos = $query->fetchAll();
        
        // Si la contraseña actual es correcta, actualizamos
        if(!empty($this->objetos)){
            $sql = "UPDATE usuario SET constrasena = :newpass WHERE id_usuario = :id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id_usuario, ':newpass' => $newpass));
            echo 'update';
        } else {
            echo 'noupdate';
        }
    }

   
    function cambiar_photo($id_usuario, $nombre){
        // Obtenemos el avatar anterior para eliminarlo
        $sql = "SELECT avatar FROM usuario WHERE id_usuario = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_usuario));
        $this->objetos = $query->fetchAll();
        
        // Actualizamos el avatar
        $sql = "UPDATE usuario SET avatar = :nombre WHERE id_usuario = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_usuario, ':nombre' => $nombre));
        
        return $this->objetos;
    }

    function buscar(){
        // Si hay una consulta de búsqueda, filtramos por nombre, apellido o CI
        if(!empty($_POST['consulta'])){
            $consulta = $_POST['consulta'];
            $sql = "SELECT u.id_usuario, u.nombre, u.apellido, u.ci, u.telefono, u.email, 
                           u.id_tipo_us, u.codigo_empleado, u.fecha_nacimiento, u.avatar,
                           u.residencia, u.sexo, u.adicional,
                           t.nombre_tipo 
                    FROM usuario u 
                    JOIN tipo_us t ON u.id_tipo_us = t.id_tipo_us 
                    WHERE (u.nombre LIKE :consulta OR u.apellido LIKE :consulta OR u.ci LIKE :consulta) 
                    AND u.Estado = 1";
            
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
        } else {
            // Sin búsqueda, mostramos todos los usuarios activos (limitado a 25)
            $sql = "SELECT u.id_usuario, u.nombre, u.apellido, u.ci, u.telefono, u.email, 
                           u.id_tipo_us, u.codigo_empleado, u.fecha_nacimiento, u.avatar,
                           u.residencia, u.sexo, u.adicional,
                           t.nombre_tipo 
                    FROM usuario u 
                    JOIN tipo_us t ON u.id_tipo_us = t.id_tipo_us 
                    WHERE u.Estado = 1 
                    ORDER BY u.id_usuario DESC 
                    LIMIT 25";
            
            $query = $this->acceso->prepare($sql);
            $query->execute();
        }
        
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function crear($nombre, $apellido, $fecha_nac, $dni, $pass, $tipo, $avatar){
        // Verificamos si el CI ya existe
        $sql = "SELECT id_usuario FROM usuario WHERE ci = :dni";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dni' => $dni));
        $this->objetos = $query->fetchAll();
        
        if(!empty($this->objetos)){
            echo 'noadd'; // El CI ya está registrado
        } else {
            // Insertamos el nuevo usuario con todos los campos
            $sql = "INSERT INTO usuario(nombre, apellido, ci, constrasena, id_tipo_us, 
                    id_sucursal, Estado, fecha_creacion, fecha_nacimiento, avatar) 
                    VALUES (:nombre, :apellido, :dni, :pass, :tipo, 1, 1, NOW(), :fecha_nac, :avatar)";
            
            $query = $this->acceso->prepare($sql);
            $query->execute(array(
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':dni' => $dni,
                ':pass' => $pass,
                ':tipo' => $tipo,
                ':fecha_nac' => $fecha_nac,
                ':avatar' => $avatar
            ));
            echo "add";
        }
    }
  
    function ascender($pass, $id_ascendido, $id_usuario){
        // Verificamos que quien realiza la acción tenga la contraseña correcta
        $sql = "SELECT id_usuario FROM usuario WHERE id_usuario = :id_usuario AND constrasena = :pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario' => $id_usuario, ':pass' => $pass));
        $this->objetos = $query->fetchAll();
        
        if(!empty($this->objetos)){
            $tipo = 2; // Tipo AdministradorFarmacia
            $sql = "UPDATE usuario SET id_tipo_us = :tipo WHERE id_usuario = :id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id_ascendido, ':tipo' => $tipo));
            echo 'ascendido';
        } else {
            echo "noascendido";
        }
    }

    function descender($pass, $id_descendido, $id_usuario){
        $sql = "SELECT id_usuario FROM usuario WHERE id_usuario = :id_usuario AND constrasena = :pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario' => $id_usuario, ':pass' => $pass));
        $this->objetos = $query->fetchAll();
        
        if(!empty($this->objetos)){
            $tipo = 5; // Tipo Cajero (nivel más bajo)
            $sql = "UPDATE usuario SET id_tipo_us = :tipo WHERE id_usuario = :id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id_descendido, ':tipo' => $tipo));
            echo 'descendido';
        } else {
            echo "nodescendido";
        }
    }


    function borrar($pass, $id_borrado, $id_usuario){
        $sql = "SELECT id_usuario FROM usuario WHERE id_usuario = :id_usuario AND constrasena = :pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario' => $id_usuario, ':pass' => $pass));
        $this->objetos = $query->fetchAll();
        
        if(!empty($this->objetos)){
            // Soft delete: cambiamos Estado a 0 en lugar de eliminar el registro
            $sql = "UPDATE usuario SET Estado = 0 WHERE id_usuario = :id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id_borrado));
            echo 'borrado';
        } else {
            echo "noborrado";
        }
    }
}
?>