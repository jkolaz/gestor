var controlador = 'seccion/menuweb/';
jQuery(document).ready( function() {
    menu_web();
    
    $('#cancelar').click(function(){
        var url = base_url+controlador+"index.html";
        location.href = url;
    });
    
    $('.configuracion').click(function(){
        var menu = $(this).attr('menu');
        var sede = $(this).attr('sede');
        var url = base_url+controlador+"configuracion/"+sede+"/"+menu;
        location.href = url;
    });
    
    $('.image-popup-no-margins').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            image: {
                    verticalFit: true
            },
            zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
            }
    });
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