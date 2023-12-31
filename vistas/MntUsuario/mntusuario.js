var sucursalId =$('#sucursal').val();
//console.log(sucursalId);

function init() {
    $("#mantenimiento_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    formData.append('usuarioSucursalId', $('#sucursal').val());

    $.ajax({
        url:"../../controllers/usuarioControllers.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#table_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            /* TODO: Mensaje de sweetalert */
            swal.fire({
                title:'Usuario Registrado Exitosamente',
                icon: 'success'
            });
        }

    });
}

$(document).ready(function(){

    $.post("../../controllers/rolControllers.php?op=combo",{idsucursal:sucursalId},function(data){
        $("#usuarioRolId").html(data);
    });

    /* TODO: Listar informacion en el datatable js de Usuario*/
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
            url:"../../controllers/usuarioControllers.php?op=listar",
            type:"post",
            data:{idsucursal:sucursalId}
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

function editar(usuarioId){
    $.post("../../controllers/usuarioControllers.php?op=mostrar",{usuarioId:usuarioId},function(data){
        data = JSON.parse(data);
        $('#usuarioId').val(data.usuarioId);
        $('#usuarioCorreo').val(data.usuarioCorreo);
        $('#usuarioNombre').val(data.usuarioNombre);
        $('#usuarioApellido').val(data.usuarioApellido);
        $('#usuarioDni').val(data.usuarioDni);
        $('#usuarioTelefono').val(data.usuarioTelefono);
        $('#usuarioPassword').val(data.usuarioPassword);
        $('#usuarioRolId').val(data.usuarioRolId).trigger('change');
        $('#pre_imagen').val(data.usuarioImagen);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');


}

function eliminar(usuarioId){
    /* TODO: Mensaje de sweetalert */
    swal.fire({
        title:"Usuario",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value) {
            $.post("../../controllers/usuarioControllers.php?op=eliminar",{usuarioId:usuarioId},function(data){
                //console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title: 'Usuario Eliminado',
                icon: 'success'
            });

        }
    })
    
}

$(document).on("click","#btnNuevo", function(){
    $('#usuarioId').val('');
    $('#usuarioCorreo').val('');
    $('#usuarioNombre').val('');
    $('#usuarioApellido').val('');
    $('#usuarioDni').val('');
    $('#usuarioTelefono').val('');
    $('#usuarioPassword').val('');
    $('#usuarioRolId').val('').trigger('change');    
    $('#pre_imagen').html('<img src="../../assets/usuario/no_imagen.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_usuario_imagen" value="" />');
    $('#lbltitulo').html('Nuevo Registro');
    $('#mantenimiento_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});



function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#pre_imagen').html('<img src='+e.target.result+' class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on('change','#usuarioImagen',function(){
    filePreview(this);
});

$(document).on("click","#btnremovephoto",function(){
    $('#usuarioImagen').val('');
    $('#pre_imagen').html('<img src="../../assets/usuario/no_imagen.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_usuario_imagen" value="" />');
});



init();