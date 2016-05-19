var controlador = 'configuracion/sede/';
jQuery(document).ready( function() {
    
});

function eliminar(id){
    var url = base_url + controlador +"eliminar/"+id+'.html';
    location.href = url;
}