var sucursalId = $('#sucursal').val();
//console.log(sucursalId);

function init() {
    $("#mantenimiento_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    formData.append('productoSucursalId', $('#sucursal').val());

    $.ajax({
        url:"../../controllers/productoControllers.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            /* TODO: Mensaje de sweetalert */
            $('#table_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');
            swal.fire({
                title:'Producto Registrado Exitosamente',
                icon: 'success'
            });
        }

    });
}

$(document).ready(function(){


    $.post("../../controllers/categoriaControllers.php?op=combo",{sucursalId:sucursalId},function(data){
        $("#productoCategoriaId").html(data);
    });

    $.post("../../controllers/unidadControllers.php?op=combo",{idsucursal:sucursalId},function(data){
        $("#productoUnidadId").html(data);
    });

    $.post("../../controllers/monedaControllers.php?op=combo",{monedaSucursalId:sucursalId},function(data){
        $("#productoMonedaId").html(data);
    });

    /* TODO: Listar informacion en el datatable js de producto*/
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
            url:"../../controllers/productoControllers.php?op=listar",
            type:"POST",
            data:{sucursalId:sucursalId}
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

function editar(productoId){
    $.post("../../controllers/productoControllers.php?op=mostrar",{productoId:productoId},function(data){
        data = JSON.parse(data);
        $('#productoId').val(data.productoId);
        $('#productoCategoriaId').val(data.productoCategoriaId).trigger('change');
        $('#productoNombre').val(data.productoNombre);
        $('#productoDescripcion').val(data.productoDescripcion);
        $('#productoPrecioCompra').val(data.productoPrecioCompra);
        $('#productoPrecioVenta').val(data.productoPrecioVenta);
        $('#productoStock').val(data.productoStock);
        $('#productoUnidadId').val(data.productoUnidadId).trigger('change');
        $('#productoMonedaId').val(data.productoMonedaId).trigger('change');
        $('#pre_imagen').html(data.productoImagen);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');


}

function eliminar(productoId){
    /* TODO: Mensaje de sweetalert */
    swal.fire({
        title:"Producto",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value) {
            $.post("../../controllers/productoControllers.php?op=eliminar",{productoId:productoId},function(data){
                //console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title: 'producto Eliminado',
                icon: 'success'
            });

        }
    })
    
}

$(document).on("click","#btnNuevo", function(){
    $('#productoId').val('');
    $('#productoNombre').val('');
    $('#productoDescripcion').val('');
    $('#productoPrecioCompra').val('');
    $('#productoPrecioVenta').val('');
    $('#productoStock').val('');
    $('#productoCategoriaId').val('').trigger('change');
    $('#productoUnidadId').val('').trigger('change');
    $('#productoMonedaId').val('').trigger('change');
    $('#lbltitulo').html('Nuevo Registro');
    $('#pre_imagen').html('<img src="../../assets/producto/no_imagen.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="" />');
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

$(document).on('change','#productoImagen',function(){
    filePreview(this);
});

$(document).on("click","#btnremovephoto",function(){
    $('#productoImagen').val('');
    $('#pre_imagen').html('<img src="../../assets/producto/no_imagen.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="" />');
});


init();