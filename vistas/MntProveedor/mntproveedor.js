var empresaId = $('#empresa').val();
console.log(empresaId);

function init() {
    $("#mantenimiento_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    formData.append('proveedorEmpresaId', $('#empresa').val());

    $.ajax({
        url:"../../controllers/proveedorControllers.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#table_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            /* TODO: Mensaje de sweetalert */
            swal.fire({
                title:'Proveedor Registrado Exitosamente',
                icon: 'success'
            });
        }

    });
}

$(document).ready(function(){

    /* TODO: Listar informacion en el datatable js de Proveedor*/
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
            url:"../../controllers/proveedorControllers.php?op=listar",
            type:"post",
            data:{proveedorEmpresaId:empresaId}
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

function editar(proveedorId){
    $.post("../../controllers/proveedorControllers.php?op=mostrar",{proveedorId:proveedorId},function(data){
        data = JSON.parse(data);
        $('#proveedorId').val(data.proveedorId);
        $('#proveedorNombre').val(data.proveedorNombre);
        $('#proveedorRuc').val(data.proveedorRuc);
        $('#proveedorTelefono').val(data.proveedorTelefono);
        $('#proveedorDireccion').val(data.proveedorDireccion);
        $('#proveedorCorreo').val(data.proveedorCorreo);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');


}

function eliminar(proveedorId){
    /* TODO: Mensaje de sweetalert */
    swal.fire({
        title:"Proveedor",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value) {
            $.post("../../controllers/proveedorControllers.php?op=eliminar",{proveedorId:proveedorId},function(data){
                console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title: 'Proveedor Eliminado',
                icon: 'success'
            });

        }
    })
    
}

$(document).on("click","#btnNuevo", function(){
    $('#proveedorId').val('');
    $('#proveedorNombre').val('');    
    $('#lbltitulo').html('Nuevo Registro');
    $('#mantenimiento_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});


init();