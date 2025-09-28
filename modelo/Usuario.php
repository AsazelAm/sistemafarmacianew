<?php
//incluimos la Conexion para poderla llamarlo 
include_once 'Conexion.php';
//Creamos una clase
class Usuario{
    var $objetos;
    /*Lo q hace es instanciamos una variable de tipo usuario automaticamente estamos haciendo la conexion pdo */
    public function __construct(){//declaramos nuestra funcion constructor
        $db=new Conexion();//vamos a crear una nueva conexion pdo 
        $this->acceso=$db->pdo;/*y le vamos asignar al this acceso q es una variable del propio modelo, al this->acceso le vamos a pasar el pdo*/
    }
      //creamos los metodos
    function Loguearse($dni,$pass){
        //hacemos nuestra consulta la pdo y sql - ACTUALIZADA para nueva estructura
        $sql="SELECT usuario.*, tipo_us.nombre_tipo FROM usuario INNER JOIN tipo_us ON usuario.id_tipo_us=tipo_us.id_tipo_us WHERE usuario.ci=:dni AND usuario.constrasena=:pass AND usuario.Estado=1";
        /*Declaramos un query donde vamos asignarle primero obtener el acceso pdo y le vamos a pasar un prepare($sql) */
        $query=$this->acceso->prepare($sql);
        //y levamos a pasar al query un execute(array()) y al exute le pasamos un array con nuestras variables dni,pass
        $query->execute(array(':dni'=>$dni,':pass'=>$pass));
        //le asiganmos al this objetos q se va retornar 
        $this->objetos=$query->fetchall();
        return $this->objetos;//y le retornamos el this objetos
    }


    function obtener_datos($id){
        /*Consulta actualizada para la nueva estructura de BD*/
        $sql="SELECT usuario.*, tipo_us.nombre_tipo FROM usuario JOIN tipo_us ON usuario.id_tipo_us=tipo_us.id_tipo_us WHERE usuario.id_usuario=:id AND usuario.Estado=1";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();//fetchall es un metodo para buscar todas las coincidencias
        return $this->objetos;
    }

    function editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
        // Actualizada para usar los nombres correctos de columnas
        $sql="UPDATE usuario SET telefono=:telefono, email=:correo WHERE id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono,':correo'=>$correo));
    }

    function cambiar_contra($id_usuario,$oldpass,$newpass){
        // Corregida la columna de contraseña
        $sql="SELECT * FROM usuario WHERE id_usuario=:id AND constrasena=:oldpass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $sql="UPDATE usuario SET constrasena=:newpass WHERE id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
            echo'update';
        }else{
            echo 'noupdate';
        }
    }

    function cambiar_photo($id_usuario,$nombre){
        // Esta función necesita ser adaptada ya que no existe campo avatar en la nueva estructura
        // Por ahora la deshabilitamos o necesitarías agregar este campo a la tabla usuario
        
        // Si quieres mantener avatars, deberías agregar el campo a la tabla usuario:
        // ALTER TABLE usuario ADD COLUMN avatar VARCHAR(255) DEFAULT 'default.jpg';
        
        $sql="SELECT codigo_empleado FROM usuario WHERE id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos=$query->fetchall();
        
        // Comentado hasta que agregues el campo avatar
        /*
        $sql="UPDATE usuario SET avatar=:nombre WHERE id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
        */
        
        return $this->objetos;
    }

    function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT usuario.*, tipo_us.nombre_tipo FROM usuario JOIN tipo_us ON usuario.id_tipo_us=tipo_us.id_tipo_us WHERE usuario.nombre LIKE :consulta AND usuario.Estado=1";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            $sql="SELECT usuario.*, tipo_us.nombre_tipo FROM usuario JOIN tipo_us ON usuario.id_tipo_us=tipo_us.id_tipo_us WHERE usuario.Estado=1 ORDER BY usuario.id_usuario LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    }


    function crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar){
        // Verificar si el CI ya existe
        $sql="SELECT id_usuario FROM usuario WHERE ci=:dni";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':dni'=>$dni));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
            // Necesitas especificar id_sucursal también (requerido por la FK)
            // Asumiendo sucursal por defecto = 1, ajusta según tu lógica
            $sql="INSERT INTO usuario(nombre,apellido,ci,constrasena,id_tipo_us,id_sucursal,Estado,fecha_creacion) 
                  VALUES (:nombre,:apellido,:dni,:pass,:tipo,1,1,NOW())";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(
                ':nombre'=>$nombre,
                ':apellido'=>$apellido,
                ':dni'=>$dni,
                ':pass'=>$pass,
                ':tipo'=>$tipo
            ));
            echo "add";
        }
    }
    
    function ascender($pass,$id_ascendido,$id_usuario){
        $sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND constrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $tipo=1;
            $sql="UPDATE usuario SET id_tipo_us=:tipo WHERE id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
            echo 'ascendido';
        }else{
            echo "noascendido";
        }
    }

    function descender($pass,$id_descendido,$id_usuario){
        $sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND constrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $tipo=2;
            $sql="UPDATE usuario SET id_tipo_us=:tipo WHERE id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
            echo 'descendido';
        }else{
            echo "nodescendido";
        }
    }

    function borrar($pass,$id_borrado,$id_usuario){
        $sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND constrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            // Usar soft delete en lugar de borrado físico
            $sql="UPDATE usuario SET Estado=0 WHERE id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_borrado));
            echo 'borrado';
        }else{
            echo "noborrado";
        }
    }
}
?>