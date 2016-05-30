var controlador = 'seccion/novedad/';
jQuery(document).ready( function() {
    nuevo();
    estado();
    destacado();
    $('#guardar').click(function(){
        $('#txt_nov_contenido').val($('.note-editable').html());
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

function destacado(){
    $('.destacado').click(function(){
        var icon = $(this).attr('icono');
        var id = $(this).attr('id_novedad');
        $.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            data:{id:id, icon:icon},
            url: base_url+controlador+'changeDestacado.html',
            success: function(json){
                if (json.respuesta === 1){
                    $('#icond_'+id).removeClass(icon);
                    $('#icond_'+id).addClass(json.icon);
                    $('#iDes_'+id).attr('icono',json.icon)
                }
            }
        });
    });
}
function estado(){
    $('.icono').click(function(){
        var icon = $(this).attr('icono');
        var id = $(this).attr('id_novedad');
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