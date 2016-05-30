var controlador = 'configuracion/especialidad/';
jQuery(document).ready( function() {
    nuevo();
    estado();
    $('.boton_eliminar').click(function(){
        var item = $(this).attr('item');
        $('#btn_eliminar').attr('item', item);
    });
    $('#btn_eliminar').click(function(){
        var id = $(this).attr('item');
        eliminar(id);
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
        var id = $(this).attr('id_especialidad');
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

function datos(i){
    console.log(i);
}