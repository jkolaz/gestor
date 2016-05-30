var controlador = 'seccion/bienvenida/';
jQuery(document).ready( function() {
    nuevo();
    estado();
    $('#guardar').click(function(){
        $('#txt_bie_contenido').val($('.note-editable').html());
    });
    
    $('#cancelar').click(function(){
        var url = base_url+controlador+"index.html";
        location.href = url;
    });
    
});

function eliminar(id){
    var url = base_url + controlador +"eliminar/"+id+'.html';
    location.href = url;
}

function nuevo(){
    $('#nuevo').click(function(){
        var url = base_url + controlador +'nuevo.html';
        location.href = url;
    });
}

function estado(){
    $('.icono').click(function(){
        var icon = $(this).attr('icono');
        var id = $(this).attr('id_bienvenida');
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