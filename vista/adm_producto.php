<?php
session_start();
if($_SESSION['us_tipo']==1 ||$_SESSION['us_tipo']==3){
    include_once'layouts/header.php';
?>
  <title>Adm | Editar Datos</title>

  <?php
  include_once'layouts/nav.php';
  ?>

    <!-- Modal Mejorado usando solo Bootstrap v4.1.3 -->
<div class="modal fade" id="crearproducto" tabindex="-1" role="dialog" aria-labelledby="crearProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow">
            
            <!-- Header del Modal -->
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title d-flex align-items-center" id="crearProductoLabel">
                    <i class="fas fa-box-open mr-2"></i>
                    Crear Producto
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body del Modal -->
            <div class="modal-body bg-light p-4">
                
                <!-- Alertas usando clases nativas de Bootstrap -->
                <div class="alert alert-success alert-dismissible fade show text-center" id="add" style="display:none;">
                    <i class="fas fa-check-circle mr-2"></i>
                    <strong>¡Éxito!</strong> Se agregó correctamente
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
                
                <div class="alert alert-danger alert-dismissible fade show text-center" id="noadd" style="display:none;">
                    <i class="fas fa-times-circle mr-2"></i>
                    <strong>Error:</strong> El Producto ya existe
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>

                <!-- Formulario con grid system de Bootstrap -->
                <form id="form-crear-producto">
                    <div class="row">
                        
                        <!-- Nombre del Producto -->
                        <div class="col-md-6 mb-3">
                            <label for="nombre_producto" class="font-weight-bold text-dark">
                                <i class="fas fa-tag text-success mr-2"></i>
                                Nombre del Producto
                            </label>
                            <input name="nombre_producto" 
                                   id="nombre_producto" 
                                   type="text" 
                                   class="form-control form-control-lg" 
                                   placeholder="Ingrese Nombre"
                                   required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre del producto.
                            </div>
                        </div>

                        <!-- Concentración -->
                        <div class="col-md-6 mb-3">
                            <label for="concentracion" class="font-weight-bold text-dark">
                                <i class="fas fa-flask text-info mr-2"></i>
                                Concentración
                            </label>
                            <input id="concentracion" 
                                   type="text" 
                                   class="form-control form-control-lg" 
                                   placeholder="Ingrese Concentración">
                        </div>

                        <!-- Información Adicional -->
                        <div class="col-md-12 mb-3">
                            <label for="adicional" class="font-weight-bold text-dark">
                                <i class="fas fa-info-circle text-warning mr-2"></i>
                                Información Adicional
                            </label>
                            <input id="adicional" 
                                   type="text" 
                                   class="form-control form-control-lg" 
                                   placeholder="Ingrese Adicional">
                        </div>

                        <!-- Precio -->
                        <div class="col-md-4 mb-3">
                            <label for="precio" class="font-weight-bold text-dark">
                                <i class="fas fa-dollar-sign text-success mr-2"></i>
                                Precio
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-success text-white">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                </div>
                                <input type="number" 
                                       class="form-control form-control-lg" 
                                       value="1" 
                                       id="precio" 
                                       placeholder="Ingrese el Precio" 
                                       required>
                                <div class="invalid-feedback">
                                    Por favor ingrese un precio válido.
                                </div>
                            </div>
                        </div>

                        <!-- Laboratorio -->
                        <div class="col-md-4 mb-3">
                            <label for="laboratorio" class="font-weight-bold text-dark">
                                <i class="fas fa-building text-primary mr-2"></i>
                                Laboratorio
                            </label>
                            <select name="laboratorio" 
                                    id="laboratorio" 
                                    class="form-control form-control-lg custom-select"
                                    required>
                                <option value="">Seleccionar laboratorio...</option>
                                <!-- Las opciones se cargarán dinámicamente -->
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un laboratorio.
                            </div>
                        </div>

                        <!-- Tipo -->
                        <div class="col-md-4 mb-3">
                            <label for="tipo" class="font-weight-bold text-dark">
                                <i class="fas fa-pills text-danger mr-2"></i>
                                Tipo
                            </label>
                            <select name="tipo" 
                                    id="tipo" 
                                    class="form-control form-control-lg custom-select"
                                    required>
                                <option value="">Seleccionar tipo...</option>
                                <!-- Las opciones se cargarán dinámicamente -->
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un tipo.
                            </div>
                        </div>

                        <!-- Presentación -->
                        <div class="col-md-12 mb-3">
                            <label for="presentacion" class="font-weight-bold text-dark">
                                <i class="fas fa-box text-secondary mr-2"></i>
                                Presentación
                            </label>
                            <select name="presentacion" 
                                    id="presentacion" 
                                    class="form-control form-control-lg custom-select"
                                    required>
                                <option value="">Seleccionar presentación...</option>
                                <!-- Las opciones se cargarán dinámicamente -->
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione una presentación.
                            </div>
                        </div>
                    </div>

                    <!-- Card de información -->
                    <div class="card border-info mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-lightbulb text-info mr-3 fa-2x"></i>
                                <div>
                                    <h6 class="card-title mb-1">Información Importante</h6>
                                    <p class="card-text mb-0 text-muted">
                                        Complete todos los campos requeridos para registrar el producto correctamente.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer del Modal -->
            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-outline-secondary btn-lg" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </button>
                <button type="submit" form="form-crear-producto" class="btn btn-success btn-lg">
                    <i class="fas fa-save mr-2"></i>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Sección principal mejorada con Bootstrap v4.1.3 -->
<div class="main-content">
    <section class="section">
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            
            <!-- Header Section con diseño mejorado -->
            <section class="section-header bg-white shadow-sm mb-4">
                <div class="container-fluid py-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-box-open text-white fa-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h1 class="h2 mb-1 font-weight-bold text-dark">Gestión de Productos</h1>
                                    <p class="text-muted mb-0">Administra tu inventario de productos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end justify-content-start mt-3 mt-md-0">
                                <button id="button-crear" type="button" data-toggle="modal" data-target="#crearproducto" class="btn btn-success btn-lg shadow-sm">
                                    <i class="fas fa-plus mr-2"></i>
                                    Crear Producto
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Breadcrumb mejorado -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-light mb-0 px-3 py-2 rounded">
                                    <li class="breadcrumb-item">
                                        <a href="adm_catalogo.php" class="text-success text-decoration-none">
                                            <i class="fas fa-home mr-1"></i>Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active text-muted" aria-current="page">
                                        <i class="fas fa-box mr-1"></i>Gestión Producto
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Main Content Section -->
            <section class="section-content">
                <div class="container-fluid">
                    
                    <!-- Card de búsqueda mejorado -->
                    <div class="card border-0 shadow-sm">
                        <!-- Header de la card con gradiente -->
                        <div class="card-header bg-success text-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-search mr-2 fa-lg"></i>
                                    <h3 class="card-title mb-0 font-weight-bold">Buscar Productos</h3>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!-- Barra de búsqueda mejorada -->
                        <div class="card-body bg-light">
                            <div class="row justify-content-center">
                                <div class="col-sm-12 ">
                                    <div class="input-group input-group-lg shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-success"></i>
                                            </span>
                                        </div>
                                        <input type="text" 
                                               id="buscar-producto" 
                                               placeholder="Ingrese nombre del Producto..." 
                                               class="form-control border-left-0 pl-0">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="button">
                                                <i class="fas fa-search mr-2"></i>
                                                Buscar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Área de resultados -->
                        <div class="card-body pt-0">
                            <!-- Stats bar -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    
                                </div>
                            </div>
                            
                            <!-- Grid de productos -->
                            <div id="productos" class="row">
                                <!-- Estado vacío mejorado -->
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <div class="mb-4">
                                            <i class="fas fa-box-open fa-4x text-muted"></i>
                                        </div>
                                        <h4 class="text-muted mb-2">No hay productos para mostrar</h4>
                                        <p class="text-muted mb-4">
                                            Comienza agregando tu primer producto o ajusta los filtros de búsqueda
                                        </p>
                                        <button type="button" data-toggle="modal" data-target="#crearproducto" class="btn btn-success btn-lg">
                                            <i class="fas fa-plus mr-2"></i>
                                            Crear mi primer producto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer de la card -->
                        <div class="card-footer bg-white border-top-0">
                            <div class="row align-items-center">
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            
        </div>
    </section>
</div>
  <!-- /.content-wrapper -->
 <?php
 include_once'layouts/footer.php';
 ?>

<?php
}else{
    header('Location:../index.php');
}
?>
<script src="../js/Producto.js"></script>