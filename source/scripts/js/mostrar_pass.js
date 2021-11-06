
//al dar click en el ojito, se oculta contraseña (VISTA LOGIN):
$(document).ready(function(){
    $('#show').mousedown(function(){
        $('#password').removeAttr('type');
        $('#show').addClass('fa-eye-slash');
    });

    $('#show').mouseup(function(){
        $('#password').attr('type','password');
        $('#show').removeClass('fa-eye-slash');
    });
});


//al dar click en el ojito, se oculta contraseña (VISTA REGISTRO_USSER):
$(document).ready(function(){
    $('#show').mousedown(function(){
        $('#password_usser').removeAttr('type');
        $('#show').addClass('fa-eye-slash');
    });

    $('#show').mouseup(function(){
        $('#password_usser').attr('type','password');
        $('#show').removeClass('fa-eye-slash');
    });
});
