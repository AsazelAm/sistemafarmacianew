/**
 * SCRIPT: Usuario.js
 * Gestiona la edición de datos personales del usuario
 * Utiliza jQuery, AJAX y las validaciones existentes
 */

$(document).ready(function (){
    var funcion = ''; // Variable para almacenar la función a ejecutar
    var id_usuario = $('#id_usuario').val(); // Capturamos el ID del usuario logueado desde un input hidden
    var edit = false; // Bandera para controlar el estado de edición
    
    
    buscar_usuario(id_usuario);
    
    function buscar_usuario(dato){
        funcion = 'buscar_usuario';
        
        // Realizamos la petición AJAX al controlador
        $.post('../controlador/UsuarioController.php', {dato, funcion}, (response) => {
            // Variables para almacenar los datos
            let nombre = '';
            let apellidos = '';
            let edad = '';
            let dni = '';
            let tipo = '';
            let telefono = '';
            let residencia = '';
            let correo = '';
            let sexo = '';
            let adicional = '';
            
            // Parseamos la respuesta JSON del servidor
            const usuario = JSON.parse(response);
            
            // Asignamos los valores recibidos
            nombre += `${usuario.nombre}`;
            apellidos += `${usuario.apellidos}`;
            edad += `${usuario.edad}`;
            dni += `${usuario.dni}`;
            
            // Asignamos diferentes badges según el tipo de usuario
            if(usuario.tipo == 'Root'){
                tipo += `<h1 class="badge badge-danger">${usuario.tipo}</h1>`
            }
            if(usuario.tipo == 'AdministradorFarmacia'){
                tipo += `<h1 class="badge badge-warning">${usuario.tipo}</h1>`
            }
            if(usuario.tipo == 'Farmaceutico'){
                tipo += `<h1 class="badge badge-info">${usuario.tipo}</h1>`
            }
            if(usuario.tipo == 'Supervisor'){
                tipo += `<h1 class="badge badge-primary">${usuario.tipo}</h1>`
            }
            if(usuario.tipo == 'Cajero'){
                tipo += `<h1 class="badge badge-secondary">${usuario.tipo}</h1>`
            }
            
            // Asignamos los demás campos
            telefono = `${usuario.telefono}`;
            residencia = `${usuario.residencia}`;
            correo = `${usuario.correo}`;
            sexo = `${usuario.sexo}`;
            adicional = `${usuario.adicional}`;

            // Actualizamos el HTML con los datos del usuario
            $('#nombre_us').html(nombre);
            $('#apellidos_us').html(apellidos);
            $('#edad').html(edad);
            $('#dni_us').html(dni);
            $('#us_tipo').html(tipo);
            $('#telefono_us').html(telefono);
            $('#residencia_us').html(residencia);
            $('#correo_us').html(correo);
            $('#sexo_us').html(sexo);
            $('#adicional_us').html(adicional);
            
            // Actualizamos todas las imágenes de avatar
            $('#avatar1').attr('src', usuario.avatar);
            $('#avatar2').attr('src', usuario.avatar);
            $('#avatar3').attr('src', usuario.avatar);
            $('#avatar4').attr('src', usuario.avatar);
        });
    }
    
    /**
     * Evento para el botón editar
     * Captura los datos del usuario para prellenar el formulario de edición
     */
    $(document).on('click', '.edit', (e) => {
        funcion = 'capturar_datos';
        edit = true; // Activamos la bandera de edición
        
        // Realizamos petición AJAX para obtener los datos editables
        $.post('../controlador/UsuarioController.php', {funcion, id_usuario}, (response) => {
            const usuario = JSON.parse(response);
            
            // Prellenamos el formulario con los datos actuales
            $('#telefono').val(usuario.telefono);
            $('#residencia').val(usuario.residencia);
            $('#correo').val(usuario.correo);
            $('#sexo').val(usuario.sexo);
            $('#adicional').val(usuario.adicional);
        });
    });

    /**
     * Evento para guardar los cambios en el formulario de edición
     * Se ejecuta al hacer submit del formulario
     */
    $('#form-usuario').submit(e => {
        // Verificamos que la bandera de edición esté activa
        if(edit == true){
            // Capturamos todos los valores del formulario
            let telefono = $('#telefono').val();
            let residencia = $('#residencia').val();
            let correo = $('#correo').val();
            let sexo = $('#sexo').val();
            let adicional = $('#adicional').val();

            funcion = 'editar_usuario';
            
            // Enviamos los datos al controlador
            $.post('../controlador/UsuarioController.php', {
                id_usuario, funcion, telefono, residencia, correo, sexo, adicional
            }, (response) => {
                // Si la edición fue exitosa
                if(response == 'editado'){
                    // Mostramos alerta de éxito con animación
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#form-usuario').trigger('reset'); // Reseteamos el formulario
                }
                edit = false; // Desactivamos la bandera de edición
                buscar_usuario(id_usuario); // Actualizamos los datos mostrados
            })
        } else {
            // Si no está en modo edición, mostramos alerta
            $('#noeditado').hide('slow');
            $('#noeditado').show(1000);
            $('#noeditado').hide(2000);
            $('#form-usuario').trigger('reset');
        }
        e.preventDefault(); // Prevenimos el comportamiento por defecto del formulario (recargar página)
    });

    /**
     * Evento para cambiar la contraseña
     * Se ejecuta al hacer submit del formulario de cambio de contraseña
     */
    $('#form-pass').submit(e => {
        // Capturamos los valores del formulario
        let oldpass = $('#oldpass').val(); // Contraseña actual
        let newpass = $('#newpass').val(); // Nueva contraseña
        funcion = 'cambiar_contra';
        
        // Enviamos la petición al controlador
        $.post('../controlador/UsuarioController.php', {id_usuario, funcion, oldpass, newpass}, (response) => {
            // Verificamos la respuesta del servidor
            if(response == 'update'){
                // Contraseña cambiada exitosamente
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                $('#form-pass').trigger('reset');
            } else {
                // La contraseña actual no es correcta
                $('#noupdate').hide('slow');
                $('#noupdate').show(1000);
                $('#noupdate').hide(2000);
                $('#form-pass').trigger('reset');
            }
        });
        e.preventDefault(); // Con esto evitamos que se refresque la página
    });

    /**
     * Evento para cambiar el avatar/foto de perfil
     * Se ejecuta al hacer submit del formulario de cambio de foto
     */
    $('#form-photo').submit(e => {
        // Capturamos los datos del formulario incluyendo el archivo
        let formData = new FormData($('#form-photo')[0]);
        
        // Usamos $.ajax en lugar de $.post porque necesitamos enviar archivos
        $.ajax({
            url: '../controlador/UsuarioController.php',
            type: 'POST',
            data: formData,
            cache: false, // No cachear la petición
            processData: false, // No procesar los datos (necesario para FormData)
            contentType: false // No establecer contentType (necesario para FormData)
        }).done(function (response) {
            // Parseamos la respuesta JSON
            const json = JSON.parse(response);
            
            // Verificamos si el cambio fue exitoso
            if (json.alert == 'edit') {
                // Actualizamos la imagen del avatar inmediatamente
                $('#avatar1').attr('src', json.ruta);
                $('#avatar2').attr('src', json.ruta);
                $('#avatar3').attr('src', json.ruta);
                $('#avatar4').attr('src', json.ruta);
                
                // Mostramos alerta de éxito
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(2000);
                $('#form-photo').trigger('reset');
                
                // Actualizamos todos los datos del usuario
                buscar_usuario(id_usuario);
            } else {
                // Error al cambiar la foto (formato no válido)
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(2000);
                $('#form-photo').trigger('reset');
            }
        });
        e.preventDefault(); // Prevenimos el comportamiento por defecto
    });
});