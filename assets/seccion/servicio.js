var controlador = 'seccion/servicio/';
jQuery(document).ready( function() {
    nuevo();
    estado();
    $('#guardar').click(function(){
        $('#txt_ser_descripcion').val($('#editable_txt_ser_descripcion').html());
        $('#txt_ser_listado').val($('#editable_txt_ser_listado').html());
    });
    
    $('#cancelar').click(function(){
        var url = base_url+controlador+"index.html";
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
        var id = $(this).attr('id_servicio');
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