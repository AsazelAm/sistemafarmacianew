$(document).ready(function () {
    var funcion;
    
    rellenar_laboratorios();
    rellenar_tipos();
    rellenar_presentaciones();
    buscar_producto();
    
    function rellenar_laboratorios() {
        funcion = "rellenar_laboratorios";
        $.post('../controlador/LaboratorioController.php', { funcion }, (response) => {
            const laboratorios = JSON.parse(response);
            let template = '<option value="">Seleccione un laboratorio</option>';
            laboratorios.forEach((laboratorio) => {
                template += `<option value="${laboratorio.id}">${laboratorio.nombre}</option>`;
            });
            $('#laboratorio').html(template);
        })
    }

    function rellenar_tipos() {
        funcion = "rellenar_tipos";
        $.post('../controlador/TipoController.php', { funcion }, (response) => {
            const tipos = JSON.parse(response);
            let template = '<option value="">Seleccione un tipo</option>';
            tipos.forEach((tipo) => {
                template += `<option value="${tipo.id}">${tipo.nombre}</option>`;
            });
            $('#tipo').html(template);
        })
    }

    function rellenar_presentaciones() {
        funcion = "rellenar_presentaciones";
        $.post('../controlador/PresentacionController.php', { funcion }, (response) => {
            const presentaciones = JSON.parse(response);
            let template = '<option value="">Seleccione la presentacion</option>';
            presentaciones.forEach((presentacion) => {
                template += `<option value="${presentacion.id}">${presentacion.nombre}</option>`;
            });
            $('#presentacion').html(template);
        })
    }

    // Inicializar Select2
    $('.select2').select2({
        dropdownParent: $('#crearproducto'),
      allowClear: true,
       dropdownAutoWidth:true,
       dropdownPosition:'bow',
      containerCssClass: 'select2ntainer-elow',
       dropdownCssClass:'select2-dropdown-below'
    });

    $('#form-crear-producto').submit(e => {
        let codigo_barra = $('#codigo_barra').val();
        let nombre_generico = $('#nombre_generico').val();
        let nombre_comercial = $('#nombre_comercial').val();
        let concentracion = $('#concentracion').val();
        let descripcion = $('#descripcion').val();
        let precio = $('#precio').val();
        let requiere_receta = $('#requiere_receta').is(':checked') ? 1 : 0;
        let contraindicaciones = $('#contraindicaciones').val();
        let via_administracion = $('#via_administracion').val();
        let stock_minimo = $('#stock_minimo').val();
        let laboratorio = $('#laboratorio').val();
        let tipo = $('#tipo').val();
        let presentacion = $('#presentacion').val();

        funcion = "crear";
        $.post('../controlador/ProductoController.php', { 
            funcion, 
            codigo_barra, 
            nombre_generico, 
            nombre_comercial, 
            concentracion, 
            descripcion, 
            precio, 
            requiere_receta, 
            contraindicaciones, 
            via_administracion, 
            stock_minimo, 
            laboratorio, 
            tipo, 
            presentacion 
        }, (response) => {
            if (response == 'noadd') { 
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form-crear-producto').trigger('reset');
            }
            if(response=='add') {
                $('#add').hide('slow');
                $('#add').show(1000);
                $('#add').hide(2000);
                $('#form-crear-producto').trigger('reset');
                $('#crearproducto').modal('hide');
            }
            buscar_producto();
        });
        e.preventDefault();
    })
       
    function buscar_producto(consulta) {
        funcion = "buscar";
        $.post('../controlador/ProductoController.php', { consulta, funcion }, (response) => {
            const productos = JSON.parse(response);
            let template = '';
            productos.forEach(producto => {
                let recetaBadge = producto.requiere_receta == 1 ? '<span class="badge badge-warning">Requiere Receta</span>' : '';
                let stockClass = producto.stock < producto.stock_minimo ? 'text-danger' : 'text-success';
                let stockIcon = producto.stock < producto.stock_minimo ? 'fa-exclamation-triangle' : 'fa-check-circle';
                
                template += `
                <div prodId="${producto.id}" prodStock="${producto.stock}" prodNombre="${producto.nombre_comercial}" prodGenerico="${producto.nombre_generico}" prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodDescripcion="${producto.descripcion}" prodLaboratorio="${producto.laboratorio}" prodTipo="${producto.tipo}" prodPresentacion="${producto.presentacion}" prodCodigo="${producto.codigo_barra}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="${stockClass}"><i class="fas ${stockIcon}"></i> Stock: ${producto.stock}</span>
                                ${recetaBadge}
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="lead"><b>${producto.nombre_comercial}</b></h2>
                                    <p class="text-muted text-sm"><i class="fas fa-flask"></i> ${producto.nombre_generico}</p>
                                    <h3 class="lead"><b><i class="fas fa-dollar-sign"></i> ${producto.precio}</b></h3>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-barcode"></i></span> Código: ${producto.codigo_barra || 'N/A'}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-mortar-pestle"></i></span> Concentración: ${producto.concentracion || 'N/A'}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-flask"></i></span> Laboratorio: ${producto.laboratorio}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-copyright"></i></span> Tipo: ${producto.tipo}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-pills"></i></span> Presentación: ${producto.presentacion}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-box"></i></span> Stock Mínimo: ${producto.stock_minimo}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <button class="editar btn btn-sm btn-success">
                                    <i class="fas fa-pencil-alt"></i> 
                                </button>
                                <button class="lote btn btn-sm btn-primary">
                                    <i class="fas fa-plus-square"></i> 
                                </button>
                                <button class="borrar btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            });
            $('#productos').html(template);
        })
    }
    
    $(document).on('keyup','#buscar-producto',function(){
        let valor=$(this).val();
        if(valor!=""){
            buscar_producto(valor);
        }else{
            buscar_producto();
        }
    });
});
