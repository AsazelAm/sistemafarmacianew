<?php
//incluimos la Conexion para poderla llamarlo 
include_once 'Conexion.php';
//Creamos una clase
class Usuario{
    var $objetos;
    /*Lo q hace es instanciamos una variable de tipo usuario automaticamente estamos haciendo la conexion pdo */
    public function __construct(){//declaramos nuestra funcion constructor
        $db=new Conexion();//vamos a crear una nueva conexion pdo 
        $this->acceso=$db->pdo;/*y le vamos asignar al this acceso q es una variable del propio modelo, al this->acceso le vamos asignar la conexion $db->pdo y le vamos a pasar el pdo*/
    }
    //creamos los metodos
    function Loguearse($dni,$pass){
        //hacemos nuestra consulta la pdo y sql
        /*hacemos la condicion q es where q dni sea igual q el dni del usuario y lo mismo q la contraseña */
        $sql="SELECT * FROM usuario inner join tipo_us on us_tipo=id_tipo_us where dni_us=:dni and contrasena_us=:pass";
        /*Declaramos un query donde vamos asignarle primero obtener el acceso pdo y le vamos a pasar un prepare($sql) y le vasamos la consulta sql como parametro */
        $query=$this->acceso->prepare($sql);
        //y levamos a pasar al query un execute(array()) y al exute le pasamos un array con nuestras variables dni,pass y les asignamos nuestras variables del parametro
        $query->execute(array(':dni'=>$dni,':pass'=>$pass));
        //le asiganmos al this objetos q se va retornar lel vamos asignar el query y acemos una busqueda de todo con el fetchal()
        $this->objetos=$query->fetchall();
        return $this->objetos;//y le retornamos el this objetos
    }

    function obtener_datos($id){
        /*le hacemos la consulta a la base de datos, hacemos un select de la tabla usuario la cual vamos a unir con la tabla tipo_us y vamos a unir mediante la sgt comparacion si us_tipo es de la tabla usuario = es igual a la llave primaria de la tabla tipo_us id_tipo_us, siempre y cuando se igual el id_usuario al =:id que estamos buscando*/
        $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();//fetchall es un metodo para busq todas las considencias de la consulta q hisimo a la base de datos
        return $this->objetos;
    }

    function editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
        $sql="UPDATE usuario SET telefono_us=:telefono,residencia_us=:residencia,correo_us=:correo,sexo_us=:sexo,adicional_us=:adicional where id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono,':residencia'=>$residencia,':correo'=>$correo,':sexo'=>$sexo,':adicional'=>$adicional));

    }

    function cambiar_contra($id_usuario,$oldpass,$newpass){
        $sql="SELECT * FROM usuario where id_usuario=:id and contrasena_us=:oldpass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $sql="UPDATE usuario SET contrasena_us=:newpass where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
            echo'update';
        }else{
            echo 'noupdate';
        }
    }

    function cambiar_photo($id_usuario,$nombre){
        $sql="SELECT avatar FROM usuario where id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos=$query->fetchall();
        
            $sql="UPDATE usuario SET avatar=:nombre where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
        
        return $this->objetos;
    }

    function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us LIKE :consulta";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us NOT LIKE '' ORDER BY id_usuario LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    }

    function crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar){
        $sql="SELECT id_usuario FROM usuario where dni_us=:dni";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':dni'=>$dni));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
        $sql="INSERT INTO usuario(nombre_us,apellidos_us,edad,dni_us,contrasena_us,us_tipo,avatar) VALUES (:nombre,:apellido,:edad,:dni,:pass,:tipo,:avatar)";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':edad'=>$edad,':dni'=>$dni,'pass'=>$pass,':tipo'=>$tipo,':avatar'=>$avatar));
        echo "add";
        }
    }
    function ascender($pass,$id_ascendido,$id_usuario){
        $sql="SELECT id_usuario FROM usuario where id_usuario =:id_usuario and contrasena_us=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $tipo=1;
            $sql=" UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
            echo 'ascendido';
        }else{
            echo "noascendido";
        }
    }

    function descender($pass,$id_descendido,$id_usuario){
        $sql="SELECT id_usuario FROM usuario where id_usuario =:id_usuario and contrasena_us=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $tipo=2;
            $sql=" UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
            echo 'descendido';
        }else{
            echo "nodescendido";
        }
    }

    function borrar($pass,$id_borrado,$id_usuario){
        $sql="SELECT id_usuario FROM usuario where id_usuario =:id_usuario and contrasena_us=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $sql="DELETE FROM usuario where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_borrado));
            echo 'borrado';
        }else{
            echo "noborrado";
        }
    }
}
?>