var controlador = 'seccion/home/';
jQuery(document).ready( function() {
    nuevo();
    estado();
    visible();
    
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
        var id = $(this).attr('id_home');
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
function visible(){
    $('.visible').click(function(){
        var icon = $(this).attr('icono');
        var id = $(this).attr('id_home');
        $.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            data:{id:id, icon:icon},
            url: base_url+controlador+'changeVisible.html',
            success: function(json){
                if (json.respuesta === 1){
                    $('#vis_'+id).removeClass(icon);
                    $('#vis_'+id).addClass(json.icon);
                    $('#lVis_'+id).attr('icono',json.icon)
                }
            }
        });
    });
}