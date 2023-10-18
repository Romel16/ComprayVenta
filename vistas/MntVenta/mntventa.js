var emp_id = $('#empresa').val();
var suc_id = $('#sucursal').val();
//console.log(suc_id);
var usu_id = $('#usuario').val();
//console.log(usu_id);


$(document).ready(function(){

    $.post("../../controllers/ventaControllers.php?op=registrar",{idsucursal:suc_id,idusuario:usu_id},function(data){
        //console.log(data)
        data=JSON.parse(data);
        $('#vent_id').val(data.ventaId);
    });

    $('#cli_id').select2();
    
    $('#cat_id').select2();

    $('#prod_id').select2();

    $('#pag_id').select2();

    $('#mon_id').select2();

    $('#doc_id').select2();


    $.post("../../controllers/clienteControllers.php?op=combo",{clienteEmpresaId:emp_id},function(data){
        $("#cli_id").html(data);
    });


    $.post("../../controllers/categoriaControllers.php?op=combo",{sucursalId:suc_id},function(data){
        $("#cat_id").html(data);
    });

    $.post("../../controllers/pagoControllers.php?op=combo",function(data){
        $("#pag_id").html(data);
    });


    $.post("../../controllers/monedaControllers.php?op=combo",{monedaSucursalId:suc_id},function(data){
        $("#mon_id").html(data);
    });

    
    $("#cli_id").change(function(){
        $("#cli_id").each(function(){
            prov_id = $(this).val();
            $.post("../../controllers/clienteControllers.php?op=mostrar",{clienteId:prov_id},function(data){
                data=JSON.parse(data);
                $('#cli_ruc').val(data.clienteRuc);
                $('#cli_direcc').val(data.clienteDireccion);
                $('#cli_telf').val(data.clienteTelefono);
                $('#cli_correo').val(data.clienteCorreo);
            });
        });
    });


    $("#cat_id").change(function(){
        $("#cat_id").each(function(){
            cat_id = $(this).val();
            
            
            $.post("../../controllers/productoControllers.php?op=combo",{categoriaId:cat_id},function(data){
                $("#prod_id").html(data);
            });       

        });

    });

    $("#prod_id").change(function(){
        $("#prod_id").each(function(){
            prod_id = $(this).val();

            $.post("../../controllers/productoControllers.php?op=mostrar",{productoId:prod_id},function(data){
                data=JSON.parse(data);
                $('#prod_pventa').val(data.productoPrecioCompra);
                $('#prod_stock').val(data.productoStock);
                $('#und_nom').val(data.unidadNombre);
            });

        });
    });


});


$(document).on("click","#btnagregar",function(){
    var vent_id = $("#vent_id").val();
    var prod_id = $("#prod_id").val();
    var prod_pventa = $("#prod_pventa").val();
    var detv_cant = $("#detv_cant").val();

    if($("#prod_id").val()=='' || $("#prod_pventa").val()=='' || $("#detv_cant").val()=='' ){

        swal.fire({
            title:'Venta',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{

        
         $.post("../../controllers/ventaControllers.php?op=guardardetalle",{
        ventaId:vent_id,
        productoId:prod_id,
        precioVenta:prod_pventa,
        cantidad:detv_cant        
        },function(data){
            console.log(data);
        });

        

        $.post("../../controllers/ventaControllers.php?op=calculo",{idventa:vent_id},function(data){
            data=JSON.parse(data);
            $('#txtsubtotal').html(data.ventaSubTotal);
            $('#txtigv').html(data.ventaIgv);
            $('#txttotal').html(data.ventaTotal);
        });

        $("#prod_pventa").val('');
        $("#detv_cant").val('');

        listar(vent_id);

    } 

});


function eliminar(detv_id,vent_id){

    swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controllers/ventaControllers.php?op=eliminardetalle",{detalleventaId:detv_id},function(data){
                console.log(data);
            });

            $.post("../../controllers/ventaControllers.php?op=calculo",{idventa:vent_id},function(data){
                data=JSON.parse(data);
                $('#txtsubtotal').html(data.ventaSubTotal);
                $('#txtigv').html(data.ventaIgv);
                $('#txttotal').html(data.ventaTotal);
            });

            listar(vent_id);

            swal.fire({
                title:'Venta',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });

}

function listar(vent_id){
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
            url:"../../controllers/ventaControllers.php?op=listardetalle",
            type:"post",
            data:{idventa:vent_id}
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
}

$(document).on("click","#btnguardar",function(){
    var vent_id = $("#vent_id").val();
    var doc_id = $("#doc_id").val();
    var pag_id = $("#pag_id").val();
    var cli_id = $("#cli_id").val();
    var cli_ruc = $("#cli_ruc").val();
    var cli_direcc = $("#cli_direcc").val();
    var cli_correo = $("#cli_correo").val();
    var vent_coment = $("#vent_coment").val();
    var mon_id = $("#mon_id").val();

    if($("#doc_id").val()=='0' || $("#pag_id").val()=='0' || $("#cli_id").val()=='0' || $("#mon_id").val()=='0'){
        /* TODO:Validacion de Pago , Proveedor , Moneda */
        swal.fire({
            title:'Venta',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{
        $.post("../../controllers/ventaControllers.php?op=calculo",{idventa:vent_id},function(data){
            data=JSON.parse(data);
            //console.log(data);
            if (data.ventaTotal==null){
                /* TODO:Validacion de Detalle */
                swal.fire({
                    title:'Venta',
                    text: 'Error No Existe Detalle',
                    icon: 'error'
                });

            }else{
                $.post("../../controllers/ventaControllers.php?op=guardar",{
                    ventaId:vent_id,
                    pagoId:pag_id,
                    idCliente:cli_id,
                    rucCliente:cli_ruc,
                    direccionCliente:cli_direcc,
                    correoCliente:cli_correo,
                    comentarios:vent_coment,
                    monedaId:mon_id,
                    /* doc_id:doc_id */
                },function(data){

                    swal.fire({
                        title:'Venta',
                        text: 'Venta registrada Correctamente con Nro: V-'+vent_id,
                        icon: 'success',
                        footer: "<a href='../ViewVenta/?v="+vent_id+"' target='_blank'>Desea ver el Documento?</a>"
                    });

                });
            }

        });

    }

});

$(document).on("click","#btnlimpiar",function(){
    location.reload();
});

