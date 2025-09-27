<?php
session_start();
if($_SESSION['us_tipo']==1 ||$_SESSION['us_tipo']==3){
    include_once'layouts/header.php';
?>
  <title>Adm | Editar Datos</title>

  <?php
  include_once'layouts/nav.php';
  ?>

 <!-- Modal de confirmación estético -->
<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-gradient-warning text-dark border-0">
                <h5 class="modal-title font-weight-bold" id="confirmarModalLabel">
                    <i class="fas fa-shield-alt mr-2"></i>Verificación de Seguridad
                </h5>
                <button class="close text-dark" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body px-4 py-4">
                <div class="text-center mb-4">
                    <div class="position-relative d-inline-block">
                        <img id="avatar3" src="../img/avatar.png" alt="Avatar" 
                             class="rounded-circle shadow-sm border border-white" 
                             style="width: 70px; height: 70px;">
                        <span class="position-absolute badge badge-warning rounded-circle p-2" 
                              style="top: -5px; right: -5px;">
                            <i class="fas fa-lock text-white"></i>
                        </span>
                    </div>
                </div>
                
                <div class="text-center mb-4">
                    <h6 class="text-dark font-weight-bold mb-1">
                        <?php echo $_SESSION['nombre_us']; ?>
                    </h6>
                    <small class="text-muted">Administrador del Sistema</small>
                </div>
                
                <div class="alert alert-light border-left-warning shadow-sm" role="alert">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ml-3">
                            <h6 class="alert-heading mb-1">Confirmación Requerida</h6>
                            <p class="mb-0 small">Para continuar con esta operación crítica, confirme su identidad ingresando su contraseña actual.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Alertas de respuesta -->
                <div class="alert alert-success d-none shadow-sm" id="confirmado" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    <strong>Operación exitosa</strong> - Los cambios se aplicaron correctamente
                </div>
                
                <div class="alert alert-danger d-none shadow-sm" id="rechazado" role="alert">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>Acceso denegado</strong> - Contraseña incorrecta
                </div>
                
                <form id="form-confirmar">
                    <div class="form-group">
                        <label for="oldpass" class="font-weight-bold text-dark mb-2">
                            <i class="fas fa-key text-warning mr-2"></i>Contraseña Actual
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                            </div>
                            <input id="oldpass" type="password" 
                                   class="form-control border-left-0 shadow-sm" 
                                   placeholder="••••••••••" 
                                   style="padding-left: 0;">
                        </div>
                        <small class="form-text text-muted mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Esta verificación protege operaciones sensibles del sistema
                        </small>
                    </div>
                    <input type="hidden" id="id_user">
                    <input type="hidden" id="funcion">
            </div>
            
            <div class="modal-footer bg-light border-0 px-4 py-3">
                <button type="button" class="btn btn-light border mr-2" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-warning text-dark font-weight-bold shadow-sm">
                    <i class="fas fa-shield-alt mr-2"></i>Confirmar Operación
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal crear usuario estético -->
<div class="modal fade" id="crearusuario" tabindex="-1" role="dialog" aria-labelledby="crearUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-gradient-success text-white border-0">
                <h4 class="modal-title font-weight-bold" id="crearUsuarioLabel">
                    <i class="fas fa-user-plus mr-2"></i>Nuevo Usuario
                </h4>
                <button class="close text-black" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body px-4 py-4">
                <!-- Header con ícono grande -->
                <div class="text-center mb-4">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-user-plus fa-2x text-black"></i>
                    </div>
                    <h5 class="mt-3 mb-1 text-success font-weight-bold">Crear Nueva Cuenta</h5>
                    <p class="text-muted small mb-0">Complete la información para crear un nuevo usuario</p>
                </div>
                
                <!-- Alertas mejoradas -->
                <div class="alert alert-success alert-dismissible fade show d-none shadow-sm" id="add" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-lg mr-3 text-success"></i>
                        <div>
                            <strong>¡Usuario creado exitosamente!</strong><br>
                            <small>El nuevo usuario ya puede acceder al sistema</small>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="alert alert-danger alert-dismissible fade show d-none shadow-sm" id="noadd" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fa-lg mr-3 text-danger"></i>
                        <div>
                            <strong>Error al crear usuario</strong><br>
                            <small>El documento de identidad ya está registrado en el sistema</small>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form id="form-crear">
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body py-3">
                            <h6 class="card-title text-success mb-3">
                                <i class="fas fa-user-circle mr-2"></i>Información Personal
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="font-weight-bold text-dark">
                                            <i class="fas fa-user text-success mr-1"></i>Nombres
                                        </label>
                                        <input id="nombre" type="text" 
                                               class="form-control border-0 shadow-sm bg-white" 
                                               placeholder="Ej: Juan Carlos" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido" class="font-weight-bold text-dark">
                                            <i class="fas fa-user text-success mr-1"></i>Apellidos
                                        </label>
                                        <input id="apellido" type="text" 
                                               class="form-control border-0 shadow-sm bg-white" 
                                               placeholder="Ej: García López" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edad" class="font-weight-bold text-dark">
                                            <i class="fas fa-calendar-alt text-success mr-1"></i>Fecha de Nacimiento
                                        </label>
                                        <input id="edad" type="date" 
                                               class="form-control border-0 shadow-sm bg-white" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dni" class="font-weight-bold text-dark">
                                            <i class="fas fa-id-card text-success mr-1"></i>Documento de Identidad
                                        </label>
                                        <input type="text" 
                                               class="form-control border-0 shadow-sm bg-white" 
                                               id="dni" placeholder="Ej: 12345678" required>
                                        <small class="form-text text-muted mt-1">
                                            <i class="fas fa-info-circle mr-1"></i>Solo números, entre 7 y 10 dígitos
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0 bg-light">
                        <div class="card-body py-3">
                            <h6 class="card-title text-success mb-3">
                                <i class="fas fa-shield-alt mr-2"></i>Configuración de Acceso
                            </h6>
                            
                            <div class="form-group">
                                <label for="pass" class="font-weight-bold text-dark">
                                    <i class="fas fa-key text-success mr-1"></i>Contraseña
                                </label>
                                <input type="password" id="pass" 
                                       class="form-control border-0 shadow-sm bg-white" 
                                       placeholder="Mínimo 6 caracteres" required>
                                <small class="form-text text-muted mt-1">
                                    <i class="fas fa-lock mr-1"></i>
                                    Recomendamos usar al menos 8 caracteres con números y letras
                                </small>
                            </div>
                            
                            <div class="alert alert-info border-0 shadow-sm mt-3" role="alert">
                                <i class="fas fa-lightbulb mr-2"></i>
                                <strong>Tip de seguridad:</strong> 
                                El usuario recibirá sus credenciales y podrá cambiar la contraseña en su primer acceso.
                            </div>
                        </div>
                    </div>
            </div>
            
            <div class="modal-footer bg-light border-0 px-4 py-3">
                <button type="button" class="btn btn-light border mr-2" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-success font-weight-bold shadow-sm">
                    <i class="fas fa-user-plus mr-2"></i>Crear Usuario
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <section class="section bg-light">
      <div class="content-wrapper  bg-light">
          <!-- Content Header (Page header) -->
          <section class="section-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Gestion usuario<button id="button-crear" type="button" data-toggle="modal" data-target="#crearusuario"class="btn bg-blue ml-2">Crear Usuario</button></h1>
                  <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['us_tipo']?>">
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                    <li class="breadcrumb-item active">Gestion usuarios</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
          
          <section>
          <!-- Main content 
          nueva forma para crear los divs 
          div.card.card-success>(div.card-header+div.card-body+div.card-footer)-->
          <div class="container-fluid bg-light">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Buscar Usuario</h3>
                      <!--div.input-group>((input.form-control.float-left)+(div.input-group-append>button.btn.btn-default>i.fas.fa-search))-->
                      <div class="input-group">
                          <input type="text" id="buscar"placeholder="Ingrese nombre del Usuario" class="form-control float-left">
                          <div class="input-group-append">
                              <button class="btn btn-default"><i class="fas fa-search"></i></button>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div id="usuarios"class="row d-flex align-items-stretch">
                        
                      </div>
                  </div>
                  <div class="card-footer"></div>
              </div>
          </div>

          </section>
          <!-- /.content -->
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
<script src="../js/Gestion_usuario.js"></script>