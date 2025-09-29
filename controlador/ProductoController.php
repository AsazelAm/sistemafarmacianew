<?php
include '../modelo/Producto.php';
$producto=new Producto();

if($_POST['funcion']=='crear'){
    $codigo_barra=$_POST['codigo_barra'];
    $nombre_generico=$_POST['nombre_generico'];
    $nombre_comercial=$_POST['nombre_comercial'];
    $concentracion=$_POST['concentracion'];
    $descripcion=$_POST['descripcion'];
    $precio=$_POST['precio'];
    $requiere_receta=isset($_POST['requiere_receta']) ? 1 : 0;
    $contraindicaciones=$_POST['contraindicaciones'];
    $via_administracion=$_POST['via_administracion'];
    $stock_minimo=$_POST['stock_minimo'];
    $laboratorio=$_POST['laboratorio'];
    $tipo=$_POST['tipo'];
    $presentacion=$_POST['presentacion'];
    
    $producto->crear($codigo_barra,$nombre_generico,$nombre_comercial,$concentracion,$descripcion,$precio,$requiere_receta,$contraindicaciones,$via_administracion,$stock_minimo,$laboratorio,$tipo,$presentacion);
}

if($_POST['funcion']=='buscar'){
    $producto->buscar();
    $json=array();
    foreach($producto->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->id_producto,
            'codigo_barra'=>$objeto->codigo_barra,
            'nombre_generico'=>$objeto->nombre_generico,
            'nombre_comercial'=>$objeto->nombre_comercial,
            'concentracion'=>$objeto->concentracion,
            'descripcion'=>$objeto->descripcion,
            'precio'=>$objeto->precio,
            'requiere_receta'=>$objeto->requiere_receta,
            'contraindicaciones'=>$objeto->contraindicaciones,
            'via_administracion'=>$objeto->via_administracion,
            'stock_minimo'=>$objeto->stock_minimo,
            'stock'=>$objeto->stock_total,
            'laboratorio'=>$objeto->laboratorio,
            'tipo'=>$objeto->tipo,
            'presentacion'=>$objeto->presentacion
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>
