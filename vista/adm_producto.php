<?php
session_start();
if($_SESSION['us_tipo']==1 ||$_SESSION['us_tipo']==3){
    include_once'layouts/header.php';
?>
  <title>Adm | Editar Datos</title>

  <?php
  include_once'layouts/nav.php';
  ?>

    <div class="modal fade" id="crearproducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Crear Producto</h3>
                  <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="card-body">
                  <div class="alert alert-success text-center" id="add" style="display:none;">
                      <span><i class="fas fa-check m-1"></i>Se agrego Correctamente</span>
                  </div>
                  <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                      <span><i class="fas fa-times m-1"></i>El Producto ya existe en otro Usuario</span>
                  </div>
                  <form id="form-crear-producto">
                    <div class="form-group">
                      <label for="nombre_producto">Nombres</label>
                      <input id="nombre_producto"type="text" class="form-control" placeholder="Ingrese Nombre"required>
                    </div>
                    <div class="form-group">
                      <label for="concentracion">Concentracion</label>
                      <input id="concentracion" type="text" class="form-control"placeholder="Ingrese Concentracion">
                    </div>
                    <div class="form-group">
                      <label for="adicional">Adicional</label>
                      <input id="adicional"type="text" class="form-control"placeholder="Ingrese Adicional" >
                    </div>
                    <div class="form-group">
                      <label for="precio">Precio</label>
                      <input type="number" class="form-control" value='1' id="precio"placeholder="Ingrese el Precio" required>
                    </div>
                    <div class="form-group">
                      <label for="laboratorio">Laboratorio</label>
                      <select name="laboratorio" id="laboratorio" class="form-control select2" style="width:100%"></select>
                    </div>
                    <div class="form-group">
                      <label for="tipo">Tipo</label>
                      <select name="tipo" id="tipo" class="form-control select2"style="width:100%"></select>
                    </div>
                    <div class="form-group">
                      <label for="presentacion">Presentacion</label>
                      <select name="presentacion" id="presentacion" class="form-control select2"style="width:100%"></select>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit"class="btn bg-gradient-primary float-right m-1">Guardar</button>
                  <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Close</button>
                </form>
                </div>
              </div>
            </div>
          </div>
    </div>

<div class="main-content">
    <section class="section bg-light">
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="section-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Gestion Producto<button id="button-crear" type="button" data-toggle="modal" data-target="#crearproducto"class="btn bg-gradient-primary ml-2">Crear Producto</button></h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                    <li class="breadcrumb-item active">Gestion Producto</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
          
          <section>
          <!-- Main content 
          nueva forma para crear los divs 
          div.card.card-success>(div.card-header+div.card-body+div.card-footer)-->
          <div class="container-fluid">
              <div class="card card-success">
                  <div class="card-header">
                      <h3 class="card-title">Buscar Producto</h3>
                      <!--div.input-group>((input.form-control.float-left)+(div.input-group-append>button.btn.btn-default>i.fas.fa-search))-->
                      <div class="input-group">
                          <input type="text" id="buscar-producto"placeholder="Ingrese nombre del Producto" class="form-control float-left">
                          <div class="input-group-append">
                              <button class="btn btn-default"><i class="fas fa-search"></i></button>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div id="productos"class="row d-flex align-items-stretch">
                        
                      </div>
                  </div>
                  <div class="card-footer"></div>
              </div>
          </div>
          </section>
          <!-- /.content -->
      </div>
    <section>
<div>
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