    
    //CODIGO PARA PELICULAS
 
    var id_pelicula_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
 
    ///---------CODIGO PARA PELICULAS-------///    
    var data_peliculas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
                 url:base_url+"administracion/peliculas/leerRegistroPeliculas",//Establece el origen de datos para crear el Administrador de datos.
                 adaptor: new ej.data.WebApiAdaptor
        }); 
    var data_generos = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
                 url:base_url+"administracion/configuracion/genero_combo",//Establece el origen de datos para crear el Administrador de datos.
                 adaptor: new ej.data.WebApiAdaptor
    });  
    var data_actores = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
                 url:base_url+"administracion/configuracion/actor_combo",//Establece el origen de datos para crear el Administrador de datos.
                 adaptor: new ej.data.WebApiAdaptor
    });
     var data_directores_combo = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/configuracion/directors_combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });  
    var clickHandler_peliculas = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_pelicula') {       
            dialogObj_pelicula.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO PELICULAS
            ajax_content_all(1,"administracion/peliculas/form_pelicula",dialogObj_pelicula,dibujar_elementos_synfusion_pelicula);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_pelicula") {
            if(id_pelicula_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{                
               dialogObj_pelicula.show();               
               ajax_content_all(2,"administracion/peliculas/form_pelicula",dialogObj_pelicula,dibujar_elementos_synfusion_pelicula,"administracion/peliculas/datos_json_pelicula",id_pelicula_crud); 
      
            }
        }
        if (args.item.id === "eliminar_pelicula") {
              if(id_pelicula_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj.show();
              }
        }
        if (args.item.id === "ver_pelicula") {
              if(id_pelicula_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{ 
                  console.log("mas detalleeeee");
                window.open(base_url+"cliente/peliculas/film/"+id_pelicula_crud, '_blank');
              }
        }
    };  

    var grid_peliculas = new ej.grids.Grid({//GRILLA DIRECTORES
        dataSource: data_peliculas,
        rowSelected: rowSelected_peliculas,
        editSettings: { 
           llowEditOnDblClick: false
        },
        height:600,
        allowPaging: true,
        pageSettings: { 
            pageCount: 10,
            pageSize: 25
        },        
       // toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo simpatizante',  prefixIcon: 'e-add', id: 'nuevo_pelicula' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_pelicula' },
            { text: 'Eliminar', tooltipText: 'Eliminar simpatizante', prefixIcon: 'e-delete', id: 'eliminar_pelicula' },
            { text: 'Ver Pelicula', tooltipText: 'Ver mas detalle', prefixIcon: 'e-view', id: 'ver_pelicula' },
            'Search'
    
        ],
        toolbarClick: clickHandler_peliculas,
        columns: [
            {headerText: 'IMAGEN', textAlign: 'Center',template: '#template', width: 150},
            {
                field: 'peliculaID', isPrimaryKey: true, headerText: 'PELICUA ID', textAlign: 'Right',
                validationRules: { required: true }, width: 120
            },
            {
                field: 'peliculaTitulo', headerText: 'TITULO',
                validationRules: { required: true },width: 120
            },
            {
                field: 'peliculaDsc', headerText: 'DESCRIPCION',
                validationRules: { required: true }
            } 
        ],
    });
    grid_peliculas.appendTo('#Grid_peliculas');
    $("#Grid_peliculas_searchbar").attr("placeholder", "Buscar");    
    function rowSelected_peliculas(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_pelicula_crud=grid_peliculas.getSelectedRecords()[0].peliculaID;    
    } 
    
    
    
 
    var dialogObj_pelicula = new ej.popups.Dialog({//VENTANA MODAL PARA NUEVO Y EDITAR DIRECTOR
            header: 'Nuevo registro de PELICULA',
            showCloseIcon: true,
            width: '500px',
            //height:'1500px',
            target: document.getElementById('target'),
            animationSettings: { effect: 'None' },
            close: dialogClose,
            visible: false,
            content: "",
            
            isModal: true,            
    });
    dialogObj_pelicula.appendTo('#dialog_pelicula');
    function dialogClose() {
    }  
  
function dibujar_elementos_synfusion_pelicula(data){
     console.log("que????");
     if(data){
         var direcotr_pelicula_id_var;
         var generos_multi_select=[];
         var actores_multi_select=[];
            $.each( data, function( k, v ) {  
              
                 if(k==="generos_multiselect"){//caso especial cuando se modifca en el formulario pelicula
                    // provincia_base_id_var=v; 
                       generos_multi_select=[];//caso especial para editar peliculas 
                      $.each( v, function( kk, vv ) {  
                           console.log("generos ::"+vv.generoID);                           
                           $('select[name=Generos_multi]').append($('<option>', { 
                                value: vv.generoID,
                                text : vv.generoID 
                            }));
                            generos_multi_select.push(vv.generoID);
                       });
                   }
                   if(k==="actores_multiselect"){//caso especial cuando se modifca en el formulario pelicula
                    // provincia_base_id_var=v; 
                       actores_multi_select=[];//caso especial para editar peliculas 
                      $.each( v, function( kk, vv ) {  
                           //console.log("generos ::"+vv.generoID);                           
                           $('select[name=Actores_multi]').append($('<option>', { 
                                value: vv.actorID,
                                text : vv.actorID 
                            }));
                            actores_multi_select.push(vv.actorID);
                       });
                   }
                   
                   if(k==="director_pelicula_h"){
                       direcotr_pelicula_id_var=v;
                   }
            });
            
             console.log("modifica:: "+generos_multi_select);
            var listObj = new ej.dropdowns.MultiSelect({
                dataSource:data_generos,    
                value:generos_multi_select,
                fields: { text: 'generoNombre', value: 'generoID' },
                // set the placeholder to MultiSelect input element
                placeholder: 'Seleccione los generos a la que pertenece la pelicula',
                // sort the resulted items
                sortOrder: 'Ascending'
            });
            listObj.appendTo('#generos_multi');
            
            var listObjActores = new ej.dropdowns.MultiSelect({
                dataSource:data_actores,
                 value:actores_multi_select,
                fields: { text: 'actorNombre', value: 'actorID' },
                // set the placeholder to MultiSelect input element
                placeholder: 'Seleccione los Actores',
                // sort the resulted items
                sortOrder: 'Ascending'
            });
            listObjActores.appendTo('#actores_multi');
            
            var positions = new ej.dropdowns.DropDownList({
                dataSource: data_directores_combo,
                popupHeight: '200px',
                placeholder: 'Seleccione un Director',
                floatLabelType: 'Auto', 
                value:direcotr_pelicula_id_var,
               // popupHeight: '350px',
               // value:provincia_domicilio_id_var,
                fields: { value: 'directorID', text: 'directorNombre' }      
                //placeholder: 'Seleccione un director',  
            });
            positions.appendTo('#director');
         
         
     }else{
          console.log("modifica:: "+generos_multi_select);
            var listObj = new ej.dropdowns.MultiSelect({
                dataSource:data_generos,
                fields: { text: 'generoNombre', value: 'generoID' },
                // set the placeholder to MultiSelect input element
                placeholder: 'Seleccione los generos a la que pertenece la pelicula',
                // sort the resulted items
                sortOrder: 'Ascending'
            });
            listObj.appendTo('#generos_multi');
            
            var listObjActores = new ej.dropdowns.MultiSelect({
                dataSource:data_actores,
                fields: { text: 'actorNombre', value: 'actorID' },
                // set the placeholder to MultiSelect input element
                placeholder: 'Seleccione los Actores',
                // sort the resulted items
                sortOrder: 'Ascending'
            });
            listObjActores.appendTo('#actores_multi');
            
            var positions = new ej.dropdowns.DropDownList({
                dataSource: data_directores_combo,
                popupHeight: '200px',
                placeholder: 'Seleccione un Director',
                floatLabelType: 'Auto', 
               // popupHeight: '350px',
               // value:provincia_domicilio_id_var,
                fields: { value: 'directorID', text: 'directorNombre' }      
                //placeholder: 'Seleccione un director',  
            });
            positions.appendTo('#director');
     }
        
        
           
        
 
      
        
        var dropElement = document.getElementsByClassName('control-fluid')[0];
        var uploadObj = new ej.inputs.Uploader({
            autoUpload: false,
            multiple: false,
			//allowedExtensions: 'video/mp4,video/x-m4v,video',
            selected: onFileSelect
        });
        uploadObj.appendTo('#mp4_pelicula');
        document.getElementById('browse').onclick = function () {
            document.getElementsByClassName('e-file-select-wrap')[0].querySelector('button').click();
            return false;
        };
        function onFileSelect(args) {
             console.log("qqqqqqqqqqqqqqqqqq");
            var inputElement = document.getElementById('upload');
            inputElement.value = args.filesData[0].name;
        }  
        
        
        
        //var dropElement = document.getElementsByClassName('control-fluid')[1];
        var uploadObjPoster = new ej.inputs.Uploader({
            autoUpload: false,
            multiple: false,
			//allowedExtensions: 'image/x-png,image/gif,image/jpeg',
            selected: onFileSelectPoster
        });
        uploadObjPoster.appendTo('#poster_pelicula');
        document.getElementById('browse_poster').onclick = function () {           
            document.getElementsByClassName('e-file-select-wrap')[1].querySelector('button').click();
            return false;
        };
        function onFileSelectPoster(args) {            
            var inputElement = document.getElementById('upload_poster');
            inputElement.value = args.filesData[0].name;
        } 
        
        
          //var dropElement = document.getElementsByClassName('control-fluid')[1];
        var uploadObjTraile = new ej.inputs.Uploader({
            autoUpload: false,
            multiple: false,
			//allowedExtensions: 'image/x-png,image/gif,image/jpeg',
            selected: onFileSelectTrailer
        });
        uploadObjTraile.appendTo('#trailer_pelicula');
        document.getElementById('browse_trailer').onclick = function () {          
            document.getElementsByClassName('e-file-select-wrap')[2].querySelector('button').click();
            return false;
        };
        function onFileSelectTrailer(args) {             
            var inputElement = document.getElementById('upload_trailer');
            inputElement.value = args.filesData[0].name;
        } 
        
        //var dropElement = document.getElementsByClassName('control-fluid')[1];
        var uploadObjSub = new ej.inputs.Uploader({
            autoUpload: false,
            multiple: false,
			//allowedExtensions: 'image/x-png,image/gif,image/jpeg',
            selected: onFileSelectSub
        });
        uploadObjSub.appendTo('#sub_pelicula');
        document.getElementById('browse_sub').onclick = function () {          
            document.getElementsByClassName('e-file-select-wrap')[3].querySelector('button').click();
            return false;
        };
        function onFileSelectSub(args) {             
            var inputElement = document.getElementById('upload_sub');
            inputElement.value = args.filesData[0].name;
        } 
        
        
        
        
         //var dropElement = document.getElementsByClassName('control-fluid')[1];
        var uploadObjBaner = new ej.inputs.Uploader({
            autoUpload: false,
            multiple: false,
			//allowedExtensions: 'image/x-png,image/gif,image/jpeg',
            selected: onFileSelectBaner
        });
        uploadObjBaner.appendTo('#baner_pelicula');
        document.getElementById('browse_baner').onclick = function () {          
            document.getElementsByClassName('e-file-select-wrap')[4].querySelector('button').click();
            return false;
        };
        function onFileSelectBaner(args) {             
            var inputElement = document.getElementById('upload_baner');
            inputElement.value = args.filesData[0].name;
        } 
     
        
        
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'titulo_pelicula': {
                    required: true
                },
                'dsc_pelicula': {
                    required: true
                },
                'year_pelicula': {
                    required: true
                },
                'Generos_multi': {
                    required: true
                },
                'upload': {
                    required: true
                },
                'upload_poster': {
                    required: true
                },
                'upload_trailer': {
                    required: true
                },
                /*'upload_sub': {
                    required: true
                },*/
                'Director': {
                    required: true
                },
            }
        };
        var formBaseObj = new ej.inputs.FormValidator('#form_pelicula', options);      
        document.getElementById('guardar_pelicula').onclick = function () { 
            
            //console.log("yyyyy");
           
            
            
           // var x = document.getElementsByName("Generos_multi").option.length;
            /*var sel = document.getElementsByName("Generos_multi").option; 
	
                for (var i = 0; i < sel.length; i++) 
                {
                        var opt = sel[i];
                        alert(opt.value);
                       //document.write(opt.value);
                }*/
            
            
           /* var concatValor = '';
            $("select[name=Generos_multi] ").each(function(){
                console.log("selectttt "+this.value());
              
               
             
            });*/
            
            
           

        if (formBaseObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_pelicula').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            //File data
            var file_data = $('input[name="mp4_pelicula_"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("mp4_pelicula_[]", file_data[i]);
            }
            
            var file_data = $('input[name="poster_pelicula_"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("poster_pelicula_[]", file_data[i]);
            }
            
            var file_data = $('input[name="trailer_pelicula_"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("trailer_pelicula_[]", file_data[i]);
            }
            
            var file_data = $('input[name="sub_pelicula_"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("sub_pelicula_[]", file_data[i]);
            }
            
            var file_data = $('input[name="baner_pelicula_"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("baner_pelicula_[]", file_data[i]);
            }
            
           var options = $('select[name=Generos_multi] option');//obtenemos los generos por id
          //  var vals_generos = [];
           $.map(options ,function(option) {
                //console.log("aaaaa"+ option.value);
               // vals_generos.push(option.value);
                data.append("generos[][valor]", option.value);
            });
           // console.log("generos :"+vals_generos);
            var options = $('select[name=Actores_multi] option');//obtenemos los generos por id
          //  var vals_generos = [];
           $.map(options ,function(option) {
                //console.log("aaaaa"+ option.value);
               // vals_generos.push(option.value);
                data.append("actores[][valor]", option.value);
            });
            //Custom data
            data.append('key', 'value');
            $.ajax({
              type: 'post',
              url: base_url+"administracion/peliculas/guardar_pelicula",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_pelicula_crud="autogenerado";
                   grid_peliculas.refresh();
                   dialogObj_pelicula.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  
    
    
    
    
    
    
    var confirmDialogObj = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj.appendTo('#confirmDialog');    
    function confirmDlgBtnClickYes() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/peliculas/eliminar_pelicula/"+id_pelicula_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_pelicula_crud="autogenerado";
                     grid_peliculas.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj.hide();
    }
    function confirmDlgBtnClickNo() {       
        confirmDialogObj.hide();
    }

//FIN CODIGO PARA PELICULAS      













// FUNCIONES ALL



