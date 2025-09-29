<?php
session_start();
if($_SESSION['us_tipo']==1 ||$_SESSION['us_tipo']==3){ // Verifica que el usuario sea de tipo administrador
    include_once'layouts/header.php';
?>
  <title>Adm | Atributos</title>
  <?php
  include_once'layouts/nav.php';
  ?>

  <!-- Modal de Cambio de Logo Mejorado -->
  <div class="modal fade" id="cambiologo" tabindex="-1" role="dialog" aria-labelledby="cambioLogoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Centra el modal verticalmente -->
            <div class="modal-content shadow-lg border-0"> <!-- Agrega sombra y quita borde -->
                <div class="modal-header bg-primary text-white border-0"> <!-- Quita el borde inferior del header -->
                    <h5 class="modal-title font-weight-bold" id="cambioLogoLabel"> <!-- Hace el título más prominente -->
                        <i class="fas fa-image mr-2"></i>Cambiar Logo
                    </h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> <!-- Hace el botón de cerrar más grande -->
                    </button>
                </div>
                <div class="modal-body p-4"> <!-- Aumenta el padding del cuerpo -->
                    <div class="text-center mb-4"> <!-- Centra el contenido y agrega margen inferior -->
                        <img id="logoactual" src="../img/avatar.png" alt="Logo actual" 
                             class="rounded-circle img-fluid shadow" style="width: 120px; height: 120px; object-fit: cover;"> <!-- Mejora la imagen -->
                    </div>
                    <div class="text-center mb-4">
                        <h6 class="font-weight-bold text-muted" id="nombre_logo"></h6> <!-- Estiliza el nombre del logo -->
                    </div>
                    
                    <!-- Alertas mejoradas -->
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" id="edit" style="display:none;">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>El logo se editó correctamente</span>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" id="noedit" style="display:none;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>Formato no soportado</span>
                    </div>
                    
                    <form id="form-logo" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="font-weight-bold text-dark mb-3">Seleccionar nueva imagen:</label> <!-- Mejora la etiqueta -->
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" id="inputGroupFile01" accept="image/*">
                                <label class="custom-file-label border-primary" for="inputGroupFile01">Elegir archivo</label> <!-- Agrega borde de color -->
                            </div>
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_logo_lab" id="id_logo_lab">
                        </div>       
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0"> <!-- Quita borde superior y padding top -->
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4" data-dismiss="modal">Cancelar</button> <!-- Botones más grandes -->
                    <button type="submit" class="btn btn-primary btn-lg px-4" form="form-logo">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Crear Laboratorio Mejorado -->
    <div class="modal fade" id="crearlaboratorio" tabindex="-1" role="dialog" aria-labelledby="crearLaboratorioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
              <div class="card border-0"> <!-- Quita el borde de la tarjeta -->
                <div class="card-header bg-success text-white border-0"> <!-- Mejora el color y quita borde -->
                  <h3 class="card-title font-weight-bold mb-0"> <!-- Mejora el título -->
                    <i class="fas fa-flask mr-2"></i>Crear Laboratorio
                  </h3>
                  <button data-dismiss="modal" aria-label="close" class="close text-white">
                    <!--<span aria-hidden="true">&times;</span>-->
                  </button>
                </div>
                <div class="card-body p-4"> <!-- Aumenta el padding -->
                  <!-- Alertas mejoradas -->
                  <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" id="add-laboratorio" style="display:none;">
                      <i class="fas fa-check-circle mr-2"></i>
                      <span>Se agregó correctamente</span>
                  </div>
                  <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" id="noadd-laboratorio" style="display:none;">
                      <i class="fas fa-exclamation-triangle mr-2"></i>
                      <span>El laboratorio ya existe</span>
                  </div>
                  <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" id="edit-lab" style="display:none;">
                      <i class="fas fa-edit mr-2"></i>
                      <span>Se editó correctamente</span>
                  </div>
                  
                  <form id="form-crear-laboratorio">
                    <div class="form-group">
                      <label for="nombre-laboratorio" class="font-weight-bold text-dark">
                        <i class="fas fa-flask mr-2 text-success"></i>Nombre del Laboratorio
                      </label>
                      <input id="nombre-laboratorio" type="text" 
                             class="form-control form-control-lg border-success" 
                             placeholder="Ingrese el nombre del laboratorio" required> <!-- Form control más grande -->
                      <input type="hidden" id="id_editar_lab">
                    </div>
                </div>
                <div class="card-footer bg-light border-0"> <!-- Mejora el color de fondo -->
                  <button type="submit" class="btn btn-success btn-lg px-4 float-right ml-2" form="form-crear-laboratorio">
                    <i class="fas fa-save mr-2"></i>Guardar
                  </button>
                  <button type="button" data-dismiss="modal" class="btn btn-outline-secondary btn-lg px-4 float-right">
                    <i class="fas fa-times mr-2"></i>Cancelar
                  </button>
                </form>
                </div>
              </div>
            </div>
          </div>
    </div>

    <!-- Modal de Crear Tipo Mejorado -->
    <div class="modal fade" id="creartipo" tabindex="-1" role="dialog" aria-labelledby="crearTipoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
              <div class="card border-0">
                <div class="card-header bg-info text-white border-0"> <!-- Cambia el color para diferenciarlo -->
                  <h3 class="card-title font-weight-bold mb-0">
                    <i class="fas fa-tags mr-2"></i>Crear Tipo
                  </h3>
                  <button data-dismiss="modal" aria-label="close" class="close text-white">
                    <!--<span aria-hidden="true">&times;</span>-->
                  </button>
                </div>
                <div class="card-body p-4">
                  <!-- Alertas mejoradas -->
                  <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" id="add-tipo" style="display:none;">
                      <i class="fas fa-check-circle mr-2"></i>
                      <span>Se agregó correctamente</span>
                  </div>
                  <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" id="noadd-tipo" style="display:none;">
                      <i class="fas fa-exclamation-triangle mr-2"></i>
                      <span>El tipo ya existe</span>
                  </div>
                  <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" id="edit-tip" style="display:none;">
                      <i class="fas fa-edit mr-2"></i>
                      <span>Se editó correctamente</span>
                  </div>
                  
                  <form id="form-crear-tipo">
                    <div class="form-group">
                      <label for="nombre-tipo" class="font-weight-bold text-dark">
                        <i class="fas fa-tag mr-2 text-info"></i>Nombre del Tipo
                      </label>
                      <input id="nombre-tipo" type="text" 
                             class="form-control form-control-lg border-info" 
                             placeholder="Ingrese el nombre del tipo" required>
                      <input type="hidden" id="id_editar_tip">
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                  <button type="submit" class="btn btn-info btn-lg px-4 float-right ml-2" form="form-crear-tipo">
                    <i class="fas fa-save mr-2"></i>Guardar
                  </button>
                  <button type="button" data-dismiss="modal" class="btn btn-outline-secondary btn-lg px-4 float-right">
                    <i class="fas fa-times mr-2"></i>Cancelar
                  </button>
                </form>
                </div>
              </div>
            </div>
          </div>
    </div>

    <!-- Modal de Crear Presentación Mejorado -->
    <div class="modal fade" id="crearpresentacion" tabindex="-1" role="dialog" aria-labelledby="crearPresentacionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
              <div class="card border-0">
                <div class="card-header bg-warning text-dark border-0"> <!-- Color amarillo con texto oscuro -->
                  <h3 class="card-title font-weight-bold mb-0">
                    <i class="fas fa-presentation mr-2"></i>Crear Presentación
                  </h3>
                  <button data-dismiss="modal" aria-label="close" class="close text-dark">
                    <!--<span aria-hidden="true">&times;</span>-->
                  </button>
                </div>
                <div class="card-body p-4">
                  <!-- Alertas mejoradas -->
                  <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" id="add-pre" style="display:none;">
                      <i class="fas fa-check-circle mr-2"></i>
                      <span>Se agregó correctamente</span>
                  </div>
                  <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" id="noadd-pre" style="display:none;">
                      <i class="fas fa-exclamation-triangle mr-2"></i>
                      <span>La presentación ya existe</span>
                  </div>
                  <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" id="edit-pre" style="display:none;">
                      <i class="fas fa-edit mr-2"></i>
                      <span>Se editó correctamente</span>
                  </div>
                  
                  <form id="form-crear-presentacion">
                    <div class="form-group">
                      <label for="nombre-presentacion" class="font-weight-bold text-dark">
                        <i class="fas fa-file-powerpoint mr-2 text-warning"></i>Nombre de la Presentación
                      </label>
                      <input id="nombre-presentacion" type="text" 
                             class="form-control form-control-lg border-warning" 
                             placeholder="Ingrese el nombre de la presentación" required>
                      <input type="hidden" id="id_editar_pre">
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                  <button type="submit" class="btn btn-warning btn-lg px-4 float-right ml-2" form="form-crear-presentacion">
                    <i class="fas fa-save mr-2"></i>Guardar
                  </button>
                  <button type="button" data-dismiss="modal" class="btn btn-outline-secondary btn-lg px-4 float-right">
                    <i class="fas fa-times mr-2"></i>Cancelar
                  </button>
                </form>
                </div>
              </div>
            </div>
          </div>
    </div>

    <!-- Contenido principal de la página (sin cambios) -->
    <div class="main-content">
      <section class="section bg-light">
      <div class="content-wrapper">
        <section class="section-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Gestión atributos</h1>
              </div>
              <div class="col-sm-6">    
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Gestión Atributos</li>
                </ol>
              </div>
            </div>
          </div>
        </section>
        
        <!-- Resto del contenido de la página permanece igual -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratorio</a></li>
                                <li class="nav-item"><a href="#tipo" class="nav-link" data-toggle="tab">Tipo</a></li>
                                <li class="nav-item"><a href="#presentacion" class="nav-link" data-toggle="tab">Presentación</a></li>
                            </ul>
                        </div>
                        <div class="card-body p-0">
                            <div class="tab-content">
                                <div class="tab-pane active"  id="laboratorio">
                                    <div class="card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Laboratorio 
                                                <button type="button" data-toggle="modal" data-target="#crearlaboratorio" class="btn btn-success btn-sm ml-2">
                                                    <i class="fas fa-plus mr-1"></i>Crear Laboratorio
                                                </button>
                                            </div>
                                            <div class="input-group">
                                                <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Ingrese Nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-success"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-responsive">
                                          <table class="table table-hover text-nowrap">
                                            <thead class="table-success">
                                              <tr>
                                                <th>Acción</th>
                                                <th>Logo</th>
                                                <th>Laboratorio</th>
                                              </tr>
                                            </thead>
                                            <tbody class="table-active" id="laboratorios">
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Tabs para Tipo y Presentación permanecen iguales -->
                                <div class="tab-pane" id="tipo">
                                    <div class="card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Tipo 
                                                <button type="button" data-toggle="modal" data-target="#creartipo" class="btn btn-info btn-sm ml-2">
                                                    <i class="fas fa-plus mr-1"></i>Crear Tipo
                                                </button>
                                            </div>
                                            <div class="input-group">
                                                <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Ingrese Nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-info"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-responsive">
                                          <table class="table table-hover text-nowrap">
                                            <thead class="table-info">
                                              <tr>
                                                <th>Acción</th>
                                                <th>Tipos</th>
                                              </tr>
                                            </thead>
                                            <tbody class="table-active" id="tipos">
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane" id="presentacion">
                                    <div class="card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Presentación 
                                                <button type="button" data-toggle="modal" data-target="#crearpresentacion" class="btn btn-warning btn-sm ml-2">
                                                    <i class="fas fa-plus mr-1"></i>Crear Presentación
                                                </button>
                                            </div>
                                            <div class="input-group">
                                                <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Ingrese Nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-responsive">
                                          <table class="table table-hover text-nowrap">
                                            <thead class="table-warning">
                                              <tr>
                                                <th>Acción</th>
                                                <th>Presentación</th>
                                              </tr>
                                            </thead>
                                            <tbody class="table-active" id="presentaciones">
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
}else{ // Si no es administrador, redirige al login
    header('Location:../index.php');
}
?>

<!-- Scripts JavaScript (sin cambios) -->
<script src="../js/Laboratorio.js"></script> <!-- Maneja la funcionalidad de laboratorios -->
<script src="../js/Tipo.js"></script> <!-- Maneja la funcionalidad de tipos -->
<script src="../js/Presentacion.js"></script> <!-- Maneja la funcionalidad de presentaciones -->