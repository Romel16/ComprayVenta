var emp_id = $('#empresa').val();
var suc_id = $('#sucursal').val();
//console.log(suc_id);
var usu_id = $('#usuario').val();
//console.log(usu_id);


$(document).ready(function() {


    $.post("../../controllers/compraControllers.php?op=registrar",{idsucursal:suc_id,idusuario:usu_id},function(data){
        //console.log(data)
        data=JSON.parse(data);
        $('#compr_id').val(data.compraId);
    });

    $('#prov_id').select2();
    
    $('#cat_id').select2();

    $('#prod_id').select2();

    $('#pag_id').select2();

    $('#mon_id').select2();

    $('#doc_id').select2();


    $.post("../../controllers/proveedorControllers.php?op=combo",{proveedorEmpresaId:emp_id},function(data){
        $("#prov_id").html(data);
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

    
    $("#prov_id").change(function(){
        $("#prov_id").each(function(){
            prov_id = $(this).val();
            $.post("../../controllers/proveedorControllers.php?op=mostrar",{proveedorId:prov_id},function(data){
                data=JSON.parse(data);
                $('#prov_ruc').val(data.proveedorRuc);
                $('#prov_telf').val(data.proveedorTelefono);
                $('#prov_direcc').val(data.proveedorDireccion);
                $('#prov_correo').val(data.proveedorCorreo);
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
                $('#prod_pcompra').val(data.productoPrecioCompra);
                $('#prod_stock').val(data.productoStock);
                $('#und_nom').val(data.unidadNombre);
            });

        });
    });


});

$(document).on("click","#btnagregar",function(){

    var compr_id = $("#compr_id").val();
    var prod_id = $("#prod_id").val();
    var prod_pcompra = $("#prod_pcompra").val();
    var detc_cant = $("#detc_cant").val();

    if($("#prod_id").val()=='' || $("#prod_pcompra").val()=='' || $("#detc_cant").val()=='' ){

        swal.fire({
            title:'Compra',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{


        $.post("../../controllers/compraControllers.php?op=guardardetalle",{
            compraId:compr_id,
            productoId:prod_id,
            precioCompra:prod_pcompra,
            cantidad:detc_cant
        },function(data){
            console.log(data);
        });

        $.post("../../controllers/compraControllers.php?op=calculo",{idcompra:compr_id},function(data){
            //console.log(data);
            data = JSON.parse(data);
            $('#txtsubtotal').html(data.compraSubTotal);
            $('#txtigv').html(data.compraIgv);
            $('#txttotal').html(data.compraTotal);
        });

        $("#prod_pcompra").val('');
        $("#detc_cant").val('');

        listar(compr_id);   
    }

});


function eliminar(detc_id,compr_id){

    swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controllers/compraControllers.php?op=eliminardetalle",{detallecompraId:detc_id},function(data){
                console.log(data);
            }); 

           $.post("../../controllers/compraControllers.php?op=calculo",{idcompra:compr_id},function(data){
                data=JSON.parse(data);
                $('#txtsubtotal').html(data.compraSubTotal);
                $('#txtigv').html(data.compraIgv); 
                $('#txttotal').html(data.compraTotal);
            });

            listar(compr_id);

            swal.fire({
                title:'Compra',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });

}

function listar(compr_id){
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
            url:"../../controllers/compraControllers.php?op=listardetalle",
            type:"post",
            data:{idcompra:compr_id}
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
    var compr_id = $("#compr_id").val();
    var doc_id = $("#doc_id").val();
    var pag_id = $("#pag_id").val();
    var prov_id = $("#prov_id").val();
    var prov_ruc = $("#prov_ruc").val();
    var prov_direcc = $("#prov_direcc").val();
    var prov_correo = $("#prov_correo").val();
    var compr_coment = $("#compr_coment").val();
    var mon_id = $("#mon_id").val();
    

    if($("#doc_id").val()=='0' || $("#pag_id").val()=='0' || $("#prov_id").val()=='0' || $("#mon_id").val()=='0'){
        /* TODO:Validacion de Pago , Proveedor , Moneda */
        swal.fire({
            title:'Compra',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{

        


        $.post("../../controllers/compraControllers.php?op=calculo",{idcompra:compr_id},function(data){
            data=JSON.parse(data);
            //console.log(data);
            if (data.compraTotal==null){
                /* TODO:Validacion de Detalle */
                swal.fire({
                    title:'Compra',
                    text: 'Error No Existe Detalle de Compra',
                    icon: 'error'
                });

            }else{
                /* TODO: Guardar la compra con todos los campos */
                $.post("../../controllers/compraControllers.php?op=guardar",{
                    compraId:compr_id,
                    pagoId:pag_id,
                    idProveedor:prov_id,
                    rucProveedor:prov_ruc,
                    direccionProveedor:prov_direcc,
                    correoProveedor:prov_correo,
                    comentarios:compr_coment, 
                    monedaId:mon_id
                },function(data){
                    /* TODO:Mensaje de Sweetalert */
                    swal.fire({
                        title:'Compra',
                        text: 'Compra registrada Correctamente con Nro: C-' + compr_id,
                        icon: 'success',
                        /* TODO: Ruta para mostrar documento de compra */
                        footer: "<a href='../ViewCompra/?c="+compr_id+"' target='_blank'>Desea ver el Documento?</a>"
                    });
            
               });
            }

        });

    }

});



$(document).on("click","#btnlimpiar",function(){
    location.reload();
});