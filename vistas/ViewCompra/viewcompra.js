$(document).ready(function(){
    var compr_id = getUrlParameter('c');

    $.post("../../controllers/compraControllers.php?op=mostrar",{compraId:compr_id},function(data){
       console.log(data);
        data=JSON.parse(data);
        $('#txtdirecc').html(data.empresaDireccion);
        $('#txtruc').html(data.empresaRuc);
        $('#txtemail').html(data.empresaCorreo);
        $('#txtweb').html(data.empresaPagina);
        $('#txttelf').html(data.empresaTelefono);

        $('#compr_id').html(data.compraId);
        $('#fech_crea').html(data.compraFechaCreacion);
        $('#pag_nom').html(data.pagoNombre);
        $('#txttotal').html(data.compraTotal);

        $('#compr_subtotal').html(data.compraSubTotal);
        $('#compr_igv').html(data.compraIgv);
        $('#compr_total').html(data.compraTotal);

        $('#compr_coment').html(data.compraComentario);

        $('#usu_nom').html(data.usuarioNombre +' '+ data.usuarioApellido);
        $('#mon_nom').html(data.monedaNombre);

        $('#prov_nom').html("<b>Nombre: </b>"+data.proveedorNombre);
        $('#prov_ruc').html("<b>RUC: </b>"+data.compraProveedorRuc);
        $('#prov_direcc').html("<b>Dirección: </b>"+data.compraProveedorDireccion);
        $('#prov_correo').html("<b>Correo: </b>"+data.compraProveedorCorreo);

    });

    /* TODO: Metodo pos para el formato compra para la vista del documento */
    $.post("../../controllers/compraControllers.php?op=listardetalleformato",{idcompra:compr_id},function(data){
        $('#listdetalle').html(data);
    });

});
/* TODO: Obtener parametro de URL */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};