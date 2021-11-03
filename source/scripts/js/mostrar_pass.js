
//al dar click en el ojito, se oculta contraseña:
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

