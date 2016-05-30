var controlador = 'seccion/menuweb/';
jQuery(document).ready( function() {
    menu_web();
});

function menu_web(){
    $('.menu_web').click(function(){
        var id_menu = $(this).attr('id_menu');
        var estado = 0;
        var id_sede = $('#txt_sed_id').val();
        if($('#txt_men_id_'+id_menu).is(':checked')){
            estado = 1;
        }
        $.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            data:{sede:id_sede, menu: id_menu, estado:estado},
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