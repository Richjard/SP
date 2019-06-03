 var base_url = document.getElementById("base_url").value;
  var heingt_ = $(".div_").height();
 
 
//NOTIFICACIONES   
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
 
    var toastObj = new ej.notifications.Toast({
        position: {
            X: 'Right'
        }, target: document.body
       // close: onclose,
       // beforeOpen: onBeforeOpen
    });
    toastObj.appendTo('#toast_type');
    var toasts = [
        { title: 'Warning!', content:  'Por favor seleccione un registro.', cssClass: 'e-toast-warning', icon: 'e-warning toast-icons' },
        { title: 'Success!', content: 'Se efectuo la operación con exito.', cssClass: 'e-toast-success', icon: 'e-success toast-icons' },
        { title: 'Error!', content: 'Por favor seleccione un registro.', cssClass: 'e-toast-danger', icon: 'e-error toast-icons' },
        { title: 'Information!', content: 'Please read the comments carefully.', cssClass: 'e-toast-info', icon: 'e-info toast-icons' },
        { title: 'Warning!', content:  'Solo se puede editar un registro a la vez.', cssClass: 'e-toast-warning', icon: 'e-warning toast-icons' },
    ];   
    var editar_simpatizante = document.getElementById('editar_simpatizante');
    var nuevo_simpatizante = document.getElementById('nuevo_simpatizante');
    var successBtn = document.getElementById('success_Toast');
    var errorBtn = document.getElementById('error_Toast');    
    $(document).click(function(event) {
          if (!$(event.target).closest( "#ge_" ).length && !$(event.target).closest( "#eliminar_" ).length && !$(event.target).closest( "#editar_" ).length && !$(event.target).closest( "#nuevo_" ).length &&  !$(event.target).closest( "#eliminar_director" ).length &&  !$(event.target).closest( "#eliminar_actor" ).length &&  !$(event.target).closest( "#eliminar_genero" ).length &&  !$(event.target).closest( "#nuevo_director" ).length && !$(event.target).closest( "#nuevo_actor" ).length && !$(event.target).closest( "#nuevo_genero" ).length && !$(event.target).closest( "#editar_actor" ).length && !$(event.target).closest( "#editar_director" ).length && !$(event.target).closest( "#editar_genero" ).length) {
             toastObj.hide('All');
              }
     });
    
    //FIN NOTIFICACIONES  
    


//funciones ALL
  function ajax_content_all(op,url_form,objDialog,fun,url_json,id_json){//FUCION PARA MOSTRAR CONTENIDO EN LA VENTANA MODAL    
        var ajax = new ej.base.Ajax(base_url+url_form, 'GET', true);
        ajax.send().then();
        ajax.onSuccess = function(data) {
             objDialog.setProperties ({content: data});
           
            if(op===1){
              fun();
            } 
            if(op===2){             
              datos_json_row_all(url_json,id_json,fun );                 
            }
        };
    }
 function datos_json_row_all(url_json,id,fun){
        var info={id:id};
        $.getJSON( base_url+url_json,info, function( data ) {           
            $.each( data, function( k, v ) { 
                
                 $("#"+k).val(v);  
            });
            fun(data); 
        });
 }  
 
  function ajax_content_ojete(url_form,objDialog,fun){//FUCION PARA MOSTRAR CONTENIDO EN LA VENTANA MODAL    
       
        
        $.ajax({
                type: 'post',
                url: base_url+url_form,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {                   
                    objDialog.setProperties ({content: json});
                    fun();
                },
                error: function(resp) {
                    alert(resp);
                }
            });  
        
        
    }
//FIN FUNCIONES ALL


function search_document() {
    
    $("#icon_search_document").hide();
    $("#icon_searching_document").show();
    $(".search_document").prop('disabled', true);

 
    var numdoc = $("#ruc").val();
    
        if (numdoc.length == 12) {
       		 consultar_ruc(numdoc);
        }else{
        	consultar_ruc(numdoc);
        }
   

}
function search_document_dni() {
    
    $("#icon_search_document").hide();
    $("#icon_searching_document").show();
    $(".search_document").prop('disabled', true);
 
    var numdoc = $("#dni").val();
    
        if (numdoc.length == 8) {
       		 consultar_dni(numdoc);
        }else{
        	consultar_dni(numdoc);
        }
   

}


function consultar_dni(dni) {
    $.ajax({
        url : 'http://busca3.com/reniec/public/api/v1/dni/'+dni+'?token=abcxyz',
        //data: {num_documento: dni, tipo: 'dni'},
        method :  'GET',
        dataType : "json"
    }).then(function(data){
        if(data.respuesta == 'ok') {
            $("#nombre_empleado").val(data.nombres);
            $("#apellidos_empleado").val(data.apellidoPaterno);
        } else {
        	 $("#nombre_empleado").val(data.nombres);
            $("#apellidos_empleado").val(data.apellidoPaterno+' '+data.apellidoMaterno);
        }
        $("#icon_search_document").show();
        $("#icon_searching_document").hide();
        $(".search_document").prop('disabled', false);

        console.log(data);

    });
}

function consultar_ruc(ruc) {
	
    $.ajax({
        url : 'http://busca3.com/reniec/public/api/v1/ruc/'+ruc+'?token=abcxyz',
        //data: {num_documento: ruc, tipo: 'ruc'},
        method :  'GET',
        dataType : "json"
    }).then(function(data){
        $("#icon_search_document").show();
        $("#icon_searching_document").hide();
        $(".search_document").prop('disabled', false);

        $("#razon_social").val(data.razonSocial);
        $("#direccion").val(data.direccion);
        console.log(data);
    
    });
    
}
