$(document).ready(function(){

     var idcompania = getUrlParameter('c');
    //console.log(idcompania);
    
    $('#idempresa').select2();

    $('#id_sucursal').select2();

    
    $.post("controllers/empresaControllers.php?op=combo",{idcompania:idcompania}, function(data){
        //console.log(idcompania);
        $("#idempresa").html(data);
    });

    $("#idempresa").change(function(){
        $("#idempresa").each(function(){
            idempresa = $(this).val();

            $.post("controllers/sucursalControllers.php?op=combo",{idempresa:idempresa},function(data){
                $("#id_sucursal").html(data);
            });
        });
    });

});


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