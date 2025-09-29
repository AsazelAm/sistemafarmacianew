<?php
session_start();
if($_SESSION['us_tipo']==1 ||$_SESSION['us_tipo']==3){
    include_once'layouts/header.php';
?>
  <title>Adm | Gestión de Productos</title>

  <?php
  include_once'layouts/nav.php';
  ?>

<!-- Modal Crear Producto -->
<div class="modal fade" id="crearproducto" tabindex="-1" role="dialog" aria-labelledby="crearProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title d-flex align-items-center" id="crearProductoLabel">
                    <i class="fas fa-box-open mr-2"></i>
                    Crear Producto
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body bg-light p-4">
                
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

                <form id="form-crear-producto">
                    <div class="row">
                        
                        <!-- Código de Barras -->
                        <div class="col-md-6 mb-3">
                            <label for="codigo_barra" class="font-weight-bold text-dark">
                                <i class="fas fa-barcode text-primary mr-2"></i>
                                Código de Barras
                            </label>
                            <input id="codigo_barra" type="text" class="form-control" placeholder="Ingrese código de barras">
                        </div>

                        <!-- Nombre Genérico -->
                        <div class="col-md-6 mb-3">
                            <label for="nombre_generico" class="font-weight-bold text-dark">
                                <i class="fas fa-flask text-info mr-2"></i>
                                Nombre Genérico
                            </label>
                            <input id="nombre_generico" type="text" class="form-control" placeholder="Ingrese nombre genérico" required>
                        </div>

                        <!-- Nombre Comercial -->
                        <div class="col-md-12 mb-3">
                            <label for="nombre_comercial" class="font-weight-bold text-dark">
                                <i class="fas fa-tag text-success mr-2"></i>
                                Nombre Comercial
                            </label>
                            <input id="nombre_comercial" type="text" class="form-control" placeholder="Ingrese nombre comercial" required>
                        </div>

                        <!-- Concentración -->
                        <div class="col-md-6 mb-3">
                            <label for="concentracion" class="font-weight-bold text-dark">
                                <i class="fas fa-mortar-pestle text-warning mr-2"></i>
                                Concentración
                            </label>
                            <input id="concentracion" type="text" class="form-control" placeholder="Ej: 500mg, 10ml">
                        </div>

                        <!-- Precio -->
                        <div class="col-md-6 mb-3">
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
                                <input type="number" step="0.01" class="form-control" id="precio" placeholder="0.00" required>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="col-md-12 mb-3">
                            <label for="descripcion" class="font-weight-bold text-dark">
                                <i class="fas fa-info-circle text-info mr-2"></i>
                                Descripción
                            </label>
                            <textarea id="descripcion" class="form-control" rows="2" placeholder="Descripción del producto"></textarea>
                        </div>

                        <!-- Contraindicaciones -->
                        <div class="col-md-12 mb-3">
                            <label for="contraindicaciones" class="font-weight-bold text-dark">
                                <i class="fas fa-exclamation-triangle text-danger mr-2"></i>
                                Contraindicaciones
                            </label>
                            <textarea id="contraindicaciones" class="form-control" rows="2" placeholder="Contraindicaciones del producto"></textarea>
                        </div>

                        <!-- Vía de Administración -->
                        <div class="col-md-6 mb-3">
                            <label for="via_administracion" class="font-weight-bold text-dark">
                                <i class="fas fa-syringe text-primary mr-2"></i>
                                Vía de Administración
                            </label>
                            <input id="via_administracion" type="text" class="form-control" placeholder="Ej: Oral, Tópica, etc.">
                        </div>

                        <!-- Stock Mínimo -->
                        <div class="col-md-6 mb-3">
                            <label for="stock_minimo" class="font-weight-bold text-dark">
                                <i class="fas fa-box text-warning mr-2"></i>
                                Stock Mínimo
                            </label>
                            <input id="stock_minimo" type="number" class="form-control" value="10" min="0">
                        </div>

                        <!-- Laboratorio -->
                        <div class="col-md-4 mb-3">
                            <label for="laboratorio" class="font-weight-bold text-dark">
                                <i class="fas fa-building text-primary mr-2"></i>
                                Laboratorio
                            </label>
                            <select id="laboratorio" class="form-control select2" style="width:100%" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <!-- Tipo -->
                        <div class="col-md-4 mb-3">
                            <label for="tipo" class="font-weight-bold text-dark">
                                <i class="fas fa-pills text-danger mr-2"></i>
                                Tipo
                            </label>
                            <select id="tipo" class="form-control select2" style="width:100%" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <!-- Presentación -->
                        <div class="col-md-4 mb-3">
                            <label for="presentacion" class="font-weight-bold text-dark">
                                <i class="fas fa-capsules text-secondary mr-2"></i>
                                Presentación
                            </label>
                            <select id="presentacion" style="width:100%" class="form-control select2" required>
                                <option value="">Seleccionar...</option>
                            </select>
                        </div>

                        <!-- Requiere Receta -->
                        <div class="col-md-12 mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="requiere_receta">
                                <label class="custom-control-label font-weight-bold" for="requiere_receta">
                                    <i class="fas fa-prescription text-warning mr-2"></i>
                                    Requiere Receta Médica
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="submit" form="form-crear-producto" class="btn btn-success">
                    <i class="fas fa-save mr-2"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Contenido Principal -->
<div class="main-content">
    <section class="section">
        <div class="content-wrapper">
            
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
                                <button type="button" data-toggle="modal" data-target="#crearproducto" class="btn btn-success btn-lg shadow-sm">
                                    <i class="fas fa-plus mr-2"></i>Crear Producto
                                </button>
                            </div>
                        </div>
                    </div>
                    
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
            
            <section class="section-content">
                <div class="container-fluid">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-success text-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-search mr-2 fa-lg"></i>
                                    <h3 class="card-title mb-0 font-weight-bold">Buscar Productos</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body bg-light">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <div class="input-group input-group-lg shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0">
                                                <i class="fas fa-search text-success"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="buscar-producto" placeholder="Buscar por nombre o código..." class="form-control border-left-0 pl-0">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="button">
                                                <i class="fas fa-search mr-2"></i>Buscar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body pt-0">
                            <div id="productos" class="row">
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
                                            <i class="fas fa-plus mr-2"></i>Crear mi primer producto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top-0">
                            <div class="row align-items-center">
                                <div class="col-12 text-center text-muted">
                                    <small><i class="fas fa-info-circle mr-1"></i>Mostrando productos activos</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>

<?php
include_once'layouts/footer.php';
?>

<?php
}else{
    header('Location:../index.php');
}
?>
<script src="../js/Producto.js"></script>