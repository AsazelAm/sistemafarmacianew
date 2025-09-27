$(document).ready(function () {
    var funcion;
    $('.select2').select2(); 

    rellenar_laboratorios();
    function rellenar_laboratorios() {
        funcion = "rellenar_laboratorios"
        $.post('../controlador/LaboratorioController.php', { funcion }, (response) => {
            // console.log(response);
            const laboratorios = JSON.parse(response);
            let template = '';
            laboratorios.forEach(laboratorio => {
                template += `
                    <option value="${laboratorio.id}> ${laboratorio.nombre}</option>
                `;
            });
            $('#laboratorio').html(template);
        })
    }
});