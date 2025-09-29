
$(document).ready(function(){
    var tipo_usuario = $('#tipo_usuario').val();
    var funcion;
    if(tipo_usuario == 2 || tipo_usuario == 1){
        $('#button-crear').hide();
    }
    

    buscar_datos();
    
    function buscar_datos(consulta){
        funcion = 'buscar_usuarios_adm';
        
        // Realizamos la petición AJAX al controlador
        $.post('../controlador/UsuarioController.php', {consulta, funcion}, (response) => {
            // Parseamos la respuesta JSON con todos los usuarios
            const usuarios = JSON.parse(response);
            let template = ''; // Variable para construir el HTML
            
            // Recorremos cada usuario para crear su tarjeta
            usuarios.forEach(usuario => {
                // Iniciamos la estructura de la tarjeta con el atributo usuarioId para identificarlo
                template += `<div usuarioId="${usuario.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">`;
                
                // Asignamos el badge según el tipo de usuario
                // tipo_usuario: 1=Root, 2=AdministradorFarmacia, 3=Farmaceutico, 4=Supervisor, 5=Cajero
                if(usuario.tipo_usuario == 1){
                    template += `<h1 class="badge badge-danger">${usuario.tipo}</h1>`
                }
                if(usuario.tipo_usuario == 2){
                    template += `<h1 class="badge badge-warning">${usuario.tipo}</h1>`
                }
                if(usuario.tipo_usuario == 3){
                    template += `<h1 class="badge badge-info">${usuario.tipo}</h1>`
                }
                if(usuario.tipo_usuario == 4){
                    template += `<h1 class="badge badge-primary">${usuario.tipo}</h1>`
                }
                if(usuario.tipo_usuario == 5){
                    template += `<h1 class="badge badge-secondary">${usuario.tipo}</h1>`
                }
                
                // Continuamos con el cuerpo de la tarjeta
                template += `</div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>${usuario.nombre} ${usuario.apellidos}</b></h2>
                                <p class="text-muted text-sm"><b>Sobre mi:</b> ${usuario.adicional}</p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span>DNI: ${usuario.dni}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span>Edad: ${usuario.edad}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>Residencia: ${usuario.residencia}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>Telefono: ${usuario.telefono}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span>Correo: ${usuario.correo}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span>Sexo: ${usuario.sexo}</li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="${usuario.avatar}" alt="user-avatar" class="img-circle img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">`;
                
                /**
                 * Lógica de permisos para los botones de acción
                 * Solo Root (tipo 1) puede gestionar todos los usuarios excepto otros Root
                 */
                if(tipo_usuario == 1){
                    // Root puede eliminar cualquier usuario excepto otros Root
                    if(usuario.tipo_usuario != 1){
                        template += `
                            <button class="borrar-usuario btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirmar">
                                <i class="fas fa-window-close mr-1"></i>Eliminar
                            </button>`;
                    }
                    // Root puede ascender a Cajeros (5) a AdministradorFarmacia (2)
                    if(usuario.tipo_usuario == 5){
                        template += `
                            <button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                                <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                            </button>`;
                    }
                    // Root puede descender a AdministradorFarmacia (2) a Cajero (5)
                    if(usuario.tipo_usuario == 2){
                        template += `
                            <button class="descender btn btn-secondary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                                <i class="fas fa-sort-amount-down mr-1"></i>Descender
                            </button>`;
                    }
                } else {
                    /**
                     * Otros tipos de usuario tienen permisos limitados
                     * AdministradorFarmacia solo puede ver, no modificar
                     */
                    if(tipo_usuario == 2 && usuario.tipo_usuario != 1 && usuario.tipo_usuario != 2){
                        template += `
                            <button class="borrar-usuario btn btn-danger" type="button" data-toggle="modal" data-target="#confirmar">
                                <i class="fas fa-window-close mr-1"></i>Eliminar
                            </button>`;
                    }
                }
                
                // Cerramos la estructura de la tarjeta
                template += `
                        </div>
                    </div>
                </div>
            </div>`;
            });
            
            // Insertamos todas las tarjetas en el contenedor
            $('#usuarios').html(template);
        });
    }
    
    /**
     * Evento para buscar usuarios en tiempo real
     * Se ejecuta cada vez que el usuario escribe en el campo de búsqueda
     */
    $(document).on('keyup', '#buscar', function(){
        let valor = $(this).val(); // Capturamos el valor del input
        
        if(valor != ""){
            // Si hay texto, buscamos con filtro
            buscar_datos(valor);
        } else {
            // Si está vacío, mostramos todos los usuarios
            buscar_datos();
        }
    });
    
    /**
     * Evento para crear un nuevo usuario
     * Se ejecuta al hacer submit del formulario de creación
     */
    $('#form-crear').submit(e => {
        // Capturamos todos los valores del formulario
        let nombre = $('#nombre').val();
        let apellido = $('#apellido').val();
        let edad = $('#edad').val(); // Este campo ahora es fecha de nacimiento
        let dni = $('#dni').val();
        let pass = $('#pass').val();
        funcion = 'crear_usuario';
        
        // Enviamos los datos al controlador
        $.post('../controlador/UsuarioController.php', {nombre, apellido, edad, dni, pass, funcion}, (response) => {
            // Verificamos la respuesta del servidor
            if(response == 'add'){
                // Usuario creado exitosamente
                $('#add').hide('slow');
                $('#add').show(1000);
                $('#add').hide(2000);
                $('#form-crear').trigger('reset'); // Limpiamos el formulario
                buscar_datos(); // Recargamos la lista de usuarios
            } else {
                // Error al crear (CI duplicado)
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form-crear').trigger('reset');
            }
        });
        e.preventDefault(); // Prevenimos el comportamiento por defecto
    });

    /**
     * Evento para ascender un usuario
     * Captura el ID del usuario al hacer click en el botón ascender
     */
    $(document).on('click', '.ascender', (e) => {
        // Navegamos por el DOM para encontrar el contenedor con el atributo usuarioId
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId'); // Obtenemos el ID del usuario
        funcion = 'ascender';
        
        // Guardamos los datos en inputs hidden del modal de confirmación
        $('#id_user').val(id);
        $('#funcion').val(funcion);
    });

    /**
     * Evento para descender un usuario
     * Captura el ID del usuario al hacer click en el botón descender
     */
    $(document).on('click', '.descender', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        funcion = 'descender';
        
        $('#id_user').val(id);
        $('#funcion').val(funcion);
    });

    /**
     * Evento para eliminar un usuario
     * Captura el ID del usuario al hacer click en el botón eliminar
     */
    $(document).on('click', '.borrar-usuario', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        funcion = 'borrar_usuario';
        
        $('#id_user').val(id);
        $('#funcion').val(funcion);
    });
    
    /**
     * Evento para confirmar las acciones (ascender, descender, eliminar)
     * Se ejecuta al hacer submit del formulario de confirmación
     * Requiere que el usuario ingrese su contraseña para confirmar
     */
    $('#form-confirmar').submit(e => {
        // Capturamos los datos del formulario de confirmación
        let pass = $('#oldpass').val(); // Contraseña del usuario que confirma
        let id_usuario = $('#id_user').val(); // ID del usuario a modificar
        funcion = $('#funcion').val(); // Función a ejecutar (ascender/descender/borrar)
        
        // Enviamos la petición al controlador
        $.post('../controlador/UsuarioController.php', {pass, id_usuario, funcion}, (response) => {
            // Verificamos si la acción fue exitosa
            if(response == 'ascendido' || response == 'descendido' || response == 'borrado'){
                // Acción confirmada y ejecutada
                $('#confirmado').hide('slow');
                $('#confirmado').show(1000);
                $('#confirmado').hide(2000);
                $('#form-confirmar').trigger('reset');
            } else {
                // Contraseña incorrecta o error
                $('#rechazado').hide('slow');
                $('#rechazado').show(1000);
                $('#rechazado').hide(2000);
                $('#form-confirmar').trigger('reset');
            }
            // Recargamos la lista de usuarios para ver los cambios
            buscar_datos();
        });
        e.preventDefault();
    });
});