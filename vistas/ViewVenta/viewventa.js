$(document).ready(function(){
    var venta_id = getUrlParameter('v');

    
    $.post("../../controllers/ventaControllers.php?op=mostrar",{idventa:venta_id},function(data){
       //console.log(data);
        data=JSON.parse(data);
        $('#txtdirecc').html(data.empresaDireccion);
        $('#txtruc').html(data.empresaRuc);
        $('#txtemail').html(data.empresaCorreo);
        $('#txtweb').html(data.empresaPagina);
        $('#txttelf').html(data.empresaTelefono);

        $('#vent_id').html(data.ventaId);
        $('#fech_crea').html(data.ventaFechaCreacion);
        $('#pag_nom').html(data.pagoNombre);
        $('#txttotal').html(data.ventaTotal);

        $('#vent_subtotal').html(data.ventaSubTotal);
        $('#vent_igv').html(data.ventaIgv);
        $('#vent_total').html(data.ventaTotal);

        $('#vent_coment').html(data.ventaComentario);

        $('#usu_nom').html(data.usuarioNombre +' '+ data.usuarioApellido);
        $('#rol_nom').html(data.rolNombre);
        $('#mon_nom').html(data.monedaNombre);

        $('#cli_nom').html("<b>Nombre: </b>"+data.clienteNombre);
        $('#cli_ruc').html("<b>RUC: </b>"+data.clienteRuc);
        $('#cli_direcc').html("<b>Dirección: </b>"+data.clienteDireccion);
        $('#cli_correo').html("<b>Correo: </b>"+data.clienteCorreo);
    });

    $.post("../../controllers/ventaControllers.php?op=listardetalleformato",{idventa:venta_id},function(data){
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