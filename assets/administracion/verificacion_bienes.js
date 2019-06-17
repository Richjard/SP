 function funcion_in_change_oficina(id_oficina){
        //ajax_show_div("administracion/verificacion_de_bienes/mostrar_grilla_bienes/"+id_oficina,"#contenedor_grilla_verificacion_bienes")
        //contenedor_grilla_verificacion_bienes
        console.log("probando fuincion.... oficina id:::"+id_oficina);

        function xdd(){
    // alert("fadfadfs");
            $.getScript( base_url+"assets/administracion/grilla_operaciones_verificacion_bienes.js", function( data, textStatus, jqxhr ) {
                console.log( data ); // Data returned
                console.log( textStatus ); // Success
                console.log( jqxhr.status ); // 200
                console.log( "Load was performed." );
              });
        }
        ajax_content_ojete_div("administracion/verificacion_de_bienes/grilla_operaciones_all/"+id_oficina,"#contenedor_grilla_verificacion_bienes",xdd);


    }
 function xd(){
    // alert("fadfadfs");
    $.getScript( base_url+"assets/administracion/ubicacion.js", function( data, textStatus, jqxhr ) {
        console.log( data ); // Data returned
        console.log( textStatus ); // Success
        console.log( jqxhr.status ); // 200
        console.log( "Load was performed." );
      });
}
ajax_content_ojete_div("administracion/ubicacion/all","#ubicacion_contenedor",xd);