<?php
session_start();
if($_SESSION['us_tipo']==1 ||$_SESSION['us_tipo']==3){
    include_once'layouts/header.php';
?>


    <!-- Modal para cambiar contraseña -->
    <div class="modal fade" id="cambiocontra" tabindex="-1" role="dialog" aria-labelledby="modalPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalPasswordLabel">
                        <i class="fas fa-key mr-2"></i>Cambiar Contraseña
                    </h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img id="avatar3" src="../img/avatar.png" alt="Avatar" class="rounded-circle img-thumbnail" style="width: 80px; height: 80px;">
                    </div>
                    <div class="text-center mb-3">
                        <h6 class="text-primary font-weight-bold">
                            <?php echo $_SESSION['nombre_us']; ?>
                        </h6>
                    </div>
                    
                    <!-- Alertas mejoradas -->
                    <div class="alert alert-success d-none" id="update" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>Contraseña cambiada correctamente
                    </div>
                    <div class="alert alert-danger d-none" id="noupdate" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>La contraseña actual no es correcta
                    </div>
                    
                    <form id="form-pass">
                        <div class="form-group">
                            <label for="oldpass" class="font-weight-bold">Contraseña Actual</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-unlock-alt text-muted"></i>
                                    </span>
                                </div>
                                <input id="oldpass" type="password" class="form-control" placeholder="Ingrese su contraseña actual" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="newpass" class="font-weight-bold">Nueva Contraseña</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                </div>
                                <input id="newpass" type="password" class="form-control" placeholder="Ingrese su nueva contraseña" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Guardar Cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para cambiar avatar -->
    <div class="modal fade" id="cambiophoto" tabindex="-1" role="dialog" aria-labelledby="modalAvatarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalAvatarLabel">
                        <i class="fas fa-camera mr-2"></i>Cambiar Avatar
                    </h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img id="avatar1" src="../img/avatar.png" alt="Avatar" class="rounded-circle img-thumbnail" style="width: 100px; height: 100px;">
                    </div>
                    <div class="text-center mb-3">
                        <h6 class="text-success font-weight-bold">
                            <?php echo $_SESSION['nombre_us']; ?>
                        </h6>
                    </div>
                    
                    <!-- Alertas mejoradas -->
                    <div class="alert alert-success d-none" id="edit" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>Avatar actualizado correctamente
                    </div>
                    <div class="alert alert-danger d-none" id="noedit" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Formato de imagen no soportado
                    </div>
                    
                    <form id="form-photo" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="photo" class="font-weight-bold">Seleccionar Imagen</label>
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" id="photo" accept=".jpg,.jpeg,.png,.gif">
                                <label class="custom-file-label" for="photo">Elegir archivo...</label>
                            </div>
                            <small class="form-text text-muted">Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 2MB</small>
                            <input type="hidden" name="funcion" value="cambiar_foto">
                        </div>
                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-upload mr-2"></i>Subir Imagen
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <title>Adm | Editar Datos Personales</title>

    <?php include_once'layouts/nav.php'; ?>


    <!-- Content Wrapper mejorado -->
         <div class="main-content ">
        <section class="section bg-light">
            <!-- Content Header mejorado -->
           
            <section class="section-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="h3 mb-0 text-gray-800">
                                <i class="fas fa-user-edit mr-2 text-primary"></i>Datos Personales
                            </h1>
                            <p class="text-muted mt-2">Gestiona tu información personal y configuración de cuenta</p>
                        </div>
                        <div class="col-sm-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="../vista/adm_catalogo.php" class="text-decoration-none">
                                            <i class="fas fa-home mr-1"></i>Inicio
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Datos Personales</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content mejorado -->
            <section class="section-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Columna izquierda - Perfil del usuario -->
                        <div class="col-lg-4 col-md-6">
                            <!-- Card de perfil principal -->
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-header bg-gradient-success text-white text-center py-4">
                                    <div class="position-relative d-inline-block">
                                        <img id="avatar2" src="../img/avatar.png" alt="Avatar" 
                                            class="rounded-circle border border-white img-thumbnail bg-white" 
                                            style="width: 120px; height: 120px;">
                                        <button class="btn btn-light btn-sm rounded-circle position-absolute" 
                                                style="bottom: 5px; right: 5px; width: 35px; height: 35px;"
                                                data-toggle="modal" data-target="#cambiophoto" 
                                                title="Cambiar avatar">
                                            <i class="fas fa-camera"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="card-body text-center">
                                    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['usuario']?>">
                                    <h4 class="card-title text-success font-weight-bold mb-1" id="nombre_us">Nombre</h4>
                                    <p class="text-muted mb-4" id="apellidos_us">Apellidos</p>
                                    
                                    <div class="row text-center mb-4">
                                        <div class="col-4">
                                            <div class="border-right">
                                                <h6 class="text-success font-weight-bold mb-0" id="edad">12</h6>
                                                <small class="text-muted">Años</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="border-right">
                                                <h6 class="text-success font-weight-bold mb-0" id="dni_us">12345678</h6>
                                                <small class="text-muted">DNI</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="text-success font-weight-bold mb-0" id="us_tipo">Admin</h6>
                                            <small class="text-muted">Tipo</small>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn btn-outline-warning btn-block" 
                                            data-toggle="modal" data-target="#cambiocontra">
                                        <i class="fas fa-key mr-2"></i>Cambiar Contraseña
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Card de información adicional -->
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0 text-success font-weight-bold">
                                        <i class="fas fa-info-circle mr-2"></i>Información Personal
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-phone text-success mr-3" style="width: 20px;"></i>
                                            <strong class="text-dark">Teléfono</strong>
                                        </div>
                                        <p class="text-muted mb-0 ml-4" id="telefono_us">Sin especificar</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-success mr-3" style="width: 20px;"></i>
                                            <strong class="text-dark">Residencia</strong>
                                        </div>
                                        <p class="text-muted mb-0 ml-4" id="residencia_us">Sin especificar</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-envelope text-success mr-3" style="width: 20px;"></i>
                                            <strong class="text-dark">Correo</strong>
                                        </div>
                                        <p class="text-muted mb-0 ml-4" id="correo_us">Sin especificar</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-venus-mars text-success mr-3" style="width: 20px;"></i>
                                            <strong class="text-dark">Género</strong>
                                        </div>
                                        <p class="text-muted mb-0 ml-4" id="sexo_us">Sin especificar</p>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-sticky-note text-success mr-3" style="width: 20px;"></i>
                                            <strong class="text-dark">Información Adicional</strong>
                                        </div>
                                        <p class="text-muted mb-0 ml-4" id="adicional_us">Sin información adicional</p>
                                    </div>
                                    
                                    <button class="edit btn btn-danger btn-block">
                                        <i class="fas fa-edit mr-2"></i>Editar Información
                                    </button>
                                </div>
                                <div class="card-footer bg-light">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Haz clic en "Editar Información" para modificar tus datos
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Columna derecha - Formulario de edición -->
                        <div class="col-lg-8 col-md-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-white border-bottom">
                                    <h5 class="card-title mb-0 text-success font-weight-bold">
                                        <i class="fas fa-user-cog mr-2"></i>Editar Datos Personales
                                    </h5>
                                </div>
                                
                                <!-- Alertas mejoradas -->
                                <div class="alert alert-success alert-dismissible fade show d-none mx-3 mt-3" id="editado" role="alert">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <strong>¡Éxito!</strong> Tus datos han sido actualizados correctamente.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="alert alert-warning alert-dismissible fade show d-none mx-3 mt-3" id="noeditado" role="alert">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <strong>Atención:</strong> La edición está deshabilitada temporalmente.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="card-body">
                                    <form id="form-usuario" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono" class="font-weight-bold">
                                                        <i class="fas fa-phone mr-1 text-success"></i>Teléfono
                                                    </label>
                                                    <input type="tel" id="telefono" class="form-control" 
                                                        placeholder="Ej: +591 12345678" pattern="[0-9\+\-\s\(\)]+">
                                                    <div class="invalid-feedback">
                                                        Por favor, ingresa un número de teléfono válido.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="correo" class="font-weight-bold">
                                                        <i class="fas fa-envelope mr-1 text-success"></i>Correo Electrónico
                                                    </label>
                                                    <input type="email" id="correo" class="form-control" 
                                                        placeholder="ejemplo@correo.com" required>
                                                    <div class="invalid-feedback">
                                                        Por favor, ingresa un correo electrónico válido.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="residencia" class="font-weight-bold">
                                                        <i class="fas fa-map-marker-alt mr-1 text-success"></i>Residencia
                                                    </label>
                                                    <input type="text" id="residencia" class="form-control" 
                                                        placeholder="Ciudad, País">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sexo" class="font-weight-bold">
                                                        <i class="fas fa-venus-mars mr-1 text-success"></i>Género
                                                    </label>
                                                    <select id="sexo" class="form-control">
                                                        <option value="">Seleccionar...</option>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Femenino">Femenino</option>
                                                        <option value="Otro">Otro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="adicional" class="font-weight-bold">
                                                <i class="fas fa-sticky-note mr-1 text-success"></i>Información Adicional
                                            </label>
                                            <textarea class="form-control" id="adicional" rows="4" 
                                                    placeholder="Comparte información adicional sobre ti (hobbies, intereses, etc.)"></textarea>
                                            <small class="form-text text-muted">Máximo 500 caracteres</small>
                                        </div>
                                        
                                        <div class="form-group text-right">
                                            <button type="reset" class="btn btn-outline-secondary mr-2">
                                                <i class="fas fa-undo mr-2"></i>Restablecer
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save mr-2"></i>Guardar Cambios
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="card-footer bg-light">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <small class="text-muted">
                                                <i class="fas fa-shield-alt mr-1 text-success"></i>
                                                Todos tus datos están protegidos y seguros
                                            </small>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <small class="text-muted">
                                                <i class="fas fa-clock mr-1"></i>
                                                Última actualización: <span id="ultima-actualizacion">Nunca</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </section>
        </div>
        
    

    <?php include_once'layouts/footer.php'; ?>

    <!-- JavaScript adicional para mejorar la funcionalidad -->
    <script>
        // Mostrar nombre del archivo seleccionado
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
        
        
    </script>

<?php
}else{
    header('Location:../index.php');
}
?>
<script src="../js/Usuario.js"></script>