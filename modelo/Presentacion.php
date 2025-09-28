<?php
include 'Conexion.php';
class Presentacion{
    var $objetos;
    public function __construct(){
        $db=new Conexion();
        $this->acceso=$db->pdo;

    }
    function crear($nombre){
        $sql="SELECT id_presentacion FROM presentacion WHERE nombre=:nombre AND Estado=1";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
        $sql="INSERT INTO presentacion(nombre) VALUES (:nombre)";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        echo "add";
        }
    }

    
    function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM presentacion WHERE nombre LIKE :consulta AND Estado=1";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            $sql="SELECT * FROM presentacion WHERE Estado=1 ORDER BY id_presentacion LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    }

    function borrar($id){
        $sql="DELETE FROM presentacion WHERE id_presentacion=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
    }

    function editar($nombre,$id_editado){
        $sql="UPDATE presentacion SET nombre=:nombre WHERE id_presentacion=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
        echo 'edit';
    }

    function rellenar_presentaciones(){
        $sql="SELECT * FROM presentacion WHERE Estado=1 ORDER BY nombre ASC";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}

?>