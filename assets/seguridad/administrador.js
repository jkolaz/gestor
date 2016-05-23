var controlador = 'seguridad/administrador/';
jQuery(document).ready( function() {
    nuevo();
    estado();
});
function nuevo(){
    $('.nuevo_adm').click(function(){
        var ta = $(this).attr('id_ta');
        var url = base_url + controlador +'nuevo/'+ta+'.html';
        location.href = url;
    });
}

function estado(){
    $('.icono').click(function(){
        var icon = $(this).attr('icono');
        var id = $(this).attr('id_adm');
        $.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            data:{id:id, icon:icon},
            url: base_url+controlador+'changeEstado.html',
            success: function(json){
                if (json.respuesta === 1){
                    $('#icon_'+id).removeClass(icon);
                    $('#icon_'+id).addClass(json.icon);
                    $('#lIcono_'+id).attr('icono',json.icon)
                }
            }
        });
    });
}