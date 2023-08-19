function init() {
    $("#mantenimiento_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    formData.append('empresaCompaniaId', $('#empresacompania').val());

    $.ajax({
        url:"../../controllers/empresaControllers.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#table_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            /* TODO: Mensaje de sweetalert */
            swal.fire({
                title:'Empresa Registrado Exitosamente',
                icon: 'success'
            });
        }

    });
}

$(document).ready(function(){

    /* TODO: Listar informacion en el datatable js de Empresa*/
    $('#table_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controllers/empresaControllers.php?op=listar",
            type:"POST",
            data:{idcompania:1}
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });


} );

function editar(empresaId){
    $.post("../../controllers/empresaControllers.php?op=mostrar",{empresaId:empresaId},function(data){
        data = JSON.parse(data);
        $('#empresaId').val(data.empresaId);
        $('#empresaRuc').val(data.empresaRuc);
        $('#empresaNombre').val(data.empresaNombre);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');


}

function eliminar(empresaId){
    /* TODO: Mensaje de sweetalert */
    swal.fire({
        title:"Empresa",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value) {
            $.post("../../controllers/empresaControllers.php?op=eliminar",{empresaId:empresaId},function(data){
                console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title: 'Empresa Eliminado',
                icon: 'success'
            });

        }
    })
    
}

$(document).on("click","#btnNuevo", function(){
    $('#empresaId').val('');
    $('#empresaRuc').val('');
    $('#empresaNombre').val('');    
    $('#lbltitulo').html('Nuevo Registro');
    $('#mantenimiento_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});


init();