var controlador = 'seccion/sedeEspecialidad/';
jQuery(document).ready( function() {
    menu_web();
});

function menu_web(){
    $('.especialidad').click(function(){
        var id_esp = $(this).attr('id_especialidad');
        var estado = 0;
        var id_sede = $('#txt_sed_id').val();
        if($('#txt_esp_id_'+id_esp).is(':checked')){
            estado = 1;
        }
        $.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            data:{sede:id_sede, esp: id_esp, estado:estado},
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