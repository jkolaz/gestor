var controlador = 'seguridad/permiso/';
jQuery(document).ready( function() {
    permiso();
});

function permiso(){
    $('.permiso').click(function(){
        var id_ta = $('#txt_ta_id').val();
        var estado = 0;
        var id_pag = $(this).attr('id_pagina');
        if($('#txt_pag_id_'+id_pag).is(':checked')){
            estado = 1;
        }
        $.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            data:{ta:id_ta, pagina: id_pag, estado:estado},
            url: base_url+controlador+'nuevo.html',
            error: function(){
                alert("No se pudo cambiar.");
            },
            success: function(json){
                if (json.respuesta === 1){
                    //$("#moalidatxt_" + cid).html(json.img_modalidad);
                }
            }
        });
    });
}