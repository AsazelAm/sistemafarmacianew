$(document).ready(function (){
    var funcion='';
    var id_usuario=$('#id_usuario').val();//con esto le decimo q estamos capturando el id
    var edit=false;//es una vandera para el click 
    //creamos una funcion para capturar todos los datos del usuario logueado
    buscar_usuario(id_usuario);
    function buscar_usuario(dato){
        funcion='buscar_usuario';
        //procedemos hacer el AJAX, la peticion ajax
        $.post('../controlador/UsuarioController.php',{dato,funcion},(response)=>{
            //vamos a agregar alguno template
            //console.log(response);
            let nombre='';
            let apellidos='';
            let edad='';
            let dni='';
            let tipo='';
            let telefono='';
            let residencia='';
            let correo='';
            let sexo = '';
            let adicional='';
            const usuario =JSON.parse(response);
            nombre+=`${usuario.nombre}`;
            apellidos+=`${usuario.apellidos}`;
            edad+=`${usuario.edad} `;
            dni+=`${usuario.dni}`;
            if(usuario.tipo=='Root'){
                  tipo+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`
            }
            if(usuario.tipo=='Administrador'){
                tipo+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`
            }
            if(usuario.tipo=='Tecnico'){
                tipo+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`
            }
            //tipo=`${usuario.tipo}`;
            telefono=`${usuario.telefono}`;
            residencia=`${usuario.residencia}`;
            correo=`${usuario.correo}`;
            sexo=`${usuario.sexo}`;
            adicional=`${usuario.adicional}`;

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
            $('#avatar1').attr('src',usuario.avatar);
            $('#avatar2').attr('src',usuario.avatar);
            $('#avatar3').attr('src',usuario.avatar);
            $('#avatar4').attr('src',usuario.avatar);
            

        });
    }
    //Realizamos un evento para el boton editar
    //el evento .on() para poder capturar el evnto click de una clase y ejecutar una funcion para caputurar una clase un punto . para un id una almoadilla #
    $(document).on('click','.edit',(e)=>{
        funcion='capturar_datos';
        edit=true;
        $.post('../controlador/UsuarioController.php',{funcion,id_usuario},(response)=>{
            //console.log(response);
            const usuario=JSON.parse(response);
            $('#telefono').val(usuario.telefono);//lo muestra en el fronent
            $('#residencia').val(usuario.residencia);
            $('#correo').val(usuario.correo);
            $('#sexo').val(usuario.sexo);
            $('#adicional').val(usuario.adicional);
        });
    });

    //evento para guaradar los cambios en el edit
    $('#form-usuario').submit(e=>{
        if(edit==true){
            let telefono=$('#telefono').val();
            let residencia=$('#residencia').val();
            let correo=$('#correo').val();
            let sexo=$('#sexo').val();
            let adicional =$('#adicional').val();

            funcion='editar_usuario';
            $.post('../controlador/UsuarioController.php',{id_usuario,funcion,telefono,residencia,correo,sexo,adicional},(response)=>{
                if(response=='editado'){
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#form-usuario').trigger('reset');
                }
                edit=false;
                buscar_usuario(id_usuario);
            })
        }else{
            $('#noeditado').hide('slow');
            $('#noeditado').show(1000);
            $('#noeditado').hide(2000);
            $('#form-usuario').trigger('reset');
        }
        e.preventDefault();
    });

    $('#form-pass').submit(e=>{
        let oldpass=$('#oldpass').val();
        let newpass=$('#newpass').val();
        funcion='cambiar_contra';
        $.post('../controlador/UsuarioController.php',{id_usuario,funcion,oldpass,newpass},(response)=>{
            if(response == 'update'){
                $('#update').hide('slow');
                    $('#update').show(1000);
                    $('#update').hide(2000);
                    $('#form-pass').trigger('reset');
            }else{
                $('#noupdate').hide('slow');
                    $('#noupdate').show(1000);
                    $('#noupdate').hide(2000);
                    $('#form-pass').trigger('reset');
            }
        });
        e.preventDefault();//Con esto evitamos q se refresque la pagina
    })

    $('#form-photo').submit(e => {
        let formData = new FormData($('#form-photo')[0]); //con esto capturamos los datos del formulario
        $.ajax({
            url: '../controlador/UsuarioController.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            const json = JSON.parse(response);
            if (json.alert == 'edit') {
                $('#avatar1').attr('src', json.ruta);
                
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(2000);
                $('#form-photo').trigger('reset');
                buscar_usuario(id_usuario);
            } else {
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(2000);
                $('#form-photo').trigger('reset');
            }
        });
        e.preventDefault();
    });
})