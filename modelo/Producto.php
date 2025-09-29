<?php
include 'Conexion.php';
class Producto{
    var $objetos;
    public function __construct(){
        $db=new Conexion();
        $this->acceso=$db->pdo;
    }
    
    function crear($codigo_barra,$nombre_generico,$nombre_comercial,$concentracion,$descripcion,$precio,$requiere_receta,$contraindicaciones,$via_administracion,$stock_minimo,$laboratorio,$tipo,$presentacion){
        $sql="SELECT id_producto FROM producto WHERE nombre_comercial=:nombre_comercial AND concentracion=:concentracion AND id_laboratorio=:laboratorio AND id_tipo_producto=:tipo AND id_presentacion=:presentacion";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre_comercial'=>$nombre_comercial,':concentracion'=>$concentracion,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
            $sql="INSERT INTO producto(codigo_barra,nombre_generico,nombre_comercial,concentracion,descripcion,precio,requiere_receta,contraindicaciones,via_administracion,stock_minimo,id_laboratorio,id_tipo_producto,id_presentacion) VALUES (:codigo_barra,:nombre_generico,:nombre_comercial,:concentracion,:descripcion,:precio,:requiere_receta,:contraindicaciones,:via_administracion,:stock_minimo,:laboratorio,:tipo,:presentacion)";
            $query=$this->acceso->prepare($sql);    
            $query->execute(array(
                ':codigo_barra'=>$codigo_barra,
                ':nombre_generico'=>$nombre_generico,
                ':nombre_comercial'=>$nombre_comercial,
                ':concentracion'=>$concentracion,
                ':descripcion'=>$descripcion,
                ':precio'=>$precio,
                ':requiere_receta'=>$requiere_receta,
                ':contraindicaciones'=>$contraindicaciones,
                ':via_administracion'=>$via_administracion,
                ':stock_minimo'=>$stock_minimo,
                ':laboratorio'=>$laboratorio,
                ':tipo'=>$tipo,
                ':presentacion'=>$presentacion
            ));
            echo "add";
        }
    }

    function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT 
                p.id_producto,
                p.codigo_barra,
                p.nombre_generico,
                p.nombre_comercial,
                p.concentracion,
                p.descripcion,
                p.precio,
                p.requiere_receta,
                p.contraindicaciones,
                p.via_administracion,
                p.stock_minimo,
                l.nombre as laboratorio,
                tp.nombre as tipo,
                pr.nombre as presentacion,
                COALESCE(SUM(lt.stock), 0) as stock_total
                FROM producto p
                JOIN laboratorio l ON p.id_laboratorio=l.id_laboratorio
                JOIN tipo_producto tp ON p.id_tipo_producto=tp.id_tipo_prod
                JOIN presentacion pr ON p.id_presentacion=pr.id_presentacion
                LEFT JOIN lote lt ON p.id_producto=lt.id_producto AND lt.Estado=1
                WHERE (p.nombre_comercial LIKE :consulta OR p.nombre_generico LIKE :consulta OR p.codigo_barra LIKE :consulta)
                AND p.Estado=1
                GROUP BY p.id_producto
                ORDER BY p.nombre_comercial
                LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            $sql="SELECT 
                p.id_producto,
                p.codigo_barra,
                p.nombre_generico,
                p.nombre_comercial,
                p.concentracion,
                p.descripcion,
                p.precio,
                p.requiere_receta,
                p.contraindicaciones,
                p.via_administracion,
                p.stock_minimo,
                l.nombre as laboratorio,
                tp.nombre as tipo,
                pr.nombre as presentacion,
                COALESCE(SUM(lt.stock), 0) as stock_total
                FROM producto p
                JOIN laboratorio l ON p.id_laboratorio=l.id_laboratorio
                JOIN tipo_producto tp ON p.id_tipo_producto=tp.id_tipo_prod
                JOIN presentacion pr ON p.id_presentacion=pr.id_presentacion
                LEFT JOIN lote lt ON p.id_producto=lt.id_producto AND lt.Estado=1
                WHERE p.Estado=1
                GROUP BY p.id_producto
                ORDER BY p.nombre_comercial
                LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    }
}
?>
