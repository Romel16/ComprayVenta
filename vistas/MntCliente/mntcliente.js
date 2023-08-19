var empresaId = $('#sucursalEmpresa').val();

function init() {
    $("#mantenimiento_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    formData.append('clienteEmpresaId', $('#sucursalEmpresa').val());

    $.ajax({
        url:"../../controllers/clienteControllers.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#table_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            /* TODO: Mensaje de sweetalert */
            swal.fire({
                title:'Cliente Registrado Exitosamente',
                icon: 'success'
            });
        }

    });
}

$(document).ready(function(){

    /* TODO: Listar informacion en el datatable js de Cliente*/
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
            url:"../../controllers/clienteControllers.php?op=listar",
            type:"post",
            data:{idempresa:empresaId}
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

function editar(clienteId){
    $.post("../../controllers/clienteControllers.php?op=mostrar",{clienteId:clienteId},function(data){
        data = JSON.parse(data);
        $('#clienteId').val(data.clienteId);
        $('#clienteNombre').val(data.clienteNombre);
        $('#clienteRuc').val(data.clienteRuc);
        $('#clienteTelefono').val(data.clienteTelefono);
        $('#clienteDireccion').val(data.clienteDireccion);
        $('#clienteCorreo').val(data.clienteCorreo);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');


}

function eliminar(clienteId){
    /* TODO: Mensaje de sweetalert */
    swal.fire({
        title:"Cliente",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value) {
            $.post("../../controllers/clienteControllers.php?op=eliminar",{clienteId:clienteId},function(data){
                console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title: 'Cliente Eliminado',
                icon: 'success'
            });

        }
    })
    
}

$(document).on("click","#btnNuevo", function(){
    $('#clienteId').val('');
    $('#clienteNombre').val('');    
    $('#lbltitulo').html('Nuevo Registro');
    $('#mantenimiento_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});


init();