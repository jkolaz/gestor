var controlador = 'configuracion/sede/';
jQuery(document).ready( function() {
    seccion_web();
    nuevo();
    estado();
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

function seccion_web(){
    $('.seccion_web').click(function(){
        var id_sec = $(this).attr('id_seccion');
        var estado = 0;
        var id_sede = $('#txt_sed_id').val();
        if($('#txt_sec_id_'+id_sec).is(':checked')){
            estado = 1;
        }
        $.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            data:{sede:id_sede, seccion: id_sec, estado:estado},
            url: base_url+controlador+'agregarSeccion.html',
            error: function(){
                alert("No se pudo cambiar.");
            },
            success: function(json){
                if (json.respuesta === 1){
                    //$("#moalidatxt_" + cid).html(json.img_modalidad);
                } else{
                    alert("No se pudo cambiar7.");
                }
            }
        });
    });
}

function estado(){
    $('.icono').click(function(){
        var icon = $(this).attr('icono');
        var id = $(this).attr('id_sede');
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