var usuarioId =$('#usuario').val();

$(document).on("click","#btnguardar", function(){
    var pass = $("#txtpass").val();
    var newpass = $("#txtpassconfirm").val();

    if(pass.length ==0 || newpass.length ==0){
        swal.fire({
            title: 'Error',
            text: 'Campos vacios',
            icon: 'error'
        });

    }else{
        if (pass == newpass) {
            $.post("../../controllers/usuarioControllers.php?op=actualizar",{usuarioId:usuarioId,passusuario:newpass},function(data){
                
            });

            swal.fire({
                title: 'Correcto',
                text: 'Contraseña Actualizada',
                icon: 'success'
            });

        $('#txtpass').val('');
        $('#txtpassconfirm').val('');
        }else{
            swal.fire({
                title: 'Error',
                text: 'La contraseña no coincide',
                icon: 'error'
            });
    
        }
    }
});