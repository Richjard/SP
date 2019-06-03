    var tabObj = new ej.navigations.Tab;
    tabObj.appendTo('#tab_html_markup');
  

    
    
    
    //CODIGO PARA DIRECTORES
    
    var id_director_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
 
    ///---------CODIGO PARA ACTORES-------///    
    var data_directores = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/configuracion/leerRegistroDirectores",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
    var clickHandler_directores = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_director') {       
            dialogObj_director.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/configuracion/form_actor",dialogObj_director,dibujar_elementos_synfusion_actor);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_director") {
            if(id_director_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{                
               dialogObj_director.show();               
               ajax_content_all(2,"administracion/configuracion/form_actor",dialogObj_director,dibujar_elementos_synfusion_actor,"administracion/configuracion/datos_json_actores",id_director_crud); 
      
            }
        }
        if (args.item.id === "eliminar_director") {
              if(id_director_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj.show();
              }
        }
    };  
    var grid_directores = new ej.grids.Grid({//GRILLA DIRECTORES
        dataSource: data_directores,
        rowSelected: rowSelected_directores,
        editSettings: { 
           llowEditOnDblClick: false
        },
        height:600,
        allowPaging: true,
        pageSettings: { 
            pageCount: 10,
            pageSize: 25
        },
        toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo simpatizante',  prefixIcon: 'e-add', id: 'nuevo_director' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_director' },
            { text: 'Eliminar', tooltipText: 'Eliminar simpatizante', prefixIcon: 'e-delete', id: 'eliminar_director' },
            'Search'
    
        ],
        toolbarClick: clickHandler_directores,
        columns: [
            {headerText: 'IMAGEN', textAlign: 'Center',template: '#template', width: 150},
            {
                field: 'directorID', isPrimaryKey: true, headerText: 'DIRECTOR ID', textAlign: 'Right',
                validationRules: { required: true }, width: 120
            },
            {
                field: 'directorNombres', headerText: 'NOMBRES',
                validationRules: { required: true },width: 120
            },
            {
                field: 'directorApellidos', headerText: 'APELLIDOS',
                validationRules: { required: true }
            } 
        ],
    });
    grid_directores.appendTo('#Grid_directores');
    $("#Grid_directores_searchbar").attr("placeholder", "Buscar");    
    function rowSelected_directores(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_director_crud=grid_directores.getSelectedRecords()[0].directorID;    
    } 
    
    
 
    var dialogObj_director = new ej.popups.Dialog({//VENTANA MODAL PARA NUEVO Y EDITAR DIRECTOR
            header: 'Nuevo registro de simpatizante',
            showCloseIcon: true,
            width: '500px',
            //height:'900px',
            target: document.getElementById('target'),
            animationSettings: { effect: 'None' },
            close: dialogClose,
            visible: false,
            content: "",
            isModal: true,            
    });
    dialogObj_director.appendTo('#dialog_director');
    function dialogClose() {
    }  
  
function dibujar_elementos_synfusion_actor(){
     console.log("que????");
        ej.base.enableRipple(true);
        var dropElement = document.getElementsByClassName('control-fluid')[0];
        var uploadObj = new ej.inputs.Uploader({
            autoUpload: false,
            multiple: false,
			allowedExtensions: 'image/*',
            selected: onFileSelect
        });
        uploadObj.appendTo('#img_actor');
        document.getElementById('browse').onclick = function () {
            document.getElementsByClassName('e-file-select-wrap')[0].querySelector('button').click();
            return false;
        };
        function onFileSelect(args) {
            var inputElement = document.getElementById('upload');
            inputElement.value = args.filesData[0].name;
        }  
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'nombre_actor': {
                    required: true
                },
                'apellidos_actor': {
                    required: true
                },
                'upload': {
                    required: true
                }
            }
        };
        var formBaseObj = new ej.inputs.FormValidator('#form_actor', options);      
        document.getElementById('guardar_director').onclick = function () { 
            
           
            
        if (formBaseObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_actor').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            //File data
            var file_data = $('input[name="img_actor_"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("img_actor_[]", file_data[i]);
            }
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/configuracion/guardar_actor",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_director_crud="autogenerado";
                   grid_directores.refresh();
                   dialogObj_director.hide();
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
                url: base_url+"administracion/configuracion/eliminar_director/"+id_director_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_director_crud="autogenerado";
                     grid_directores.refresh();
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

//FIN CODIGO PARA DIRECTORS      





















    
    //CODIGO PARA ACTORES
    
    var id_actor_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
  
    ///---------CODIGO PARA ACTORES-------///    
    var data_actores = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/configuracion/leerRegistroActores",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
    var clickHandler_actores = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_actor') {       
            dialogObj_actor.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/configuracion/form_actor_",dialogObj_actor,dibujar_elementos_synfusion_actor_);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_actor") {
            if(id_actor_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{               
               dialogObj_actor.show();
               ajax_content_all(2,"administracion/configuracion/form_actor_",dialogObj_actor,dibujar_elementos_synfusion_actor_,"administracion/configuracion/datos_json_actores_",id_actor_crud); 
            }
        }
        if (args.item.id === "eliminar_actor") {
              if(id_actor_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogActorObj.show();
              }
        }
    };  
    var grid_actores = new ej.grids.Grid({//GRILLA ACTORES
        dataSource: data_actores,
        rowSelected: rowSelected_actores,
        editSettings: { 
           llowEditOnDblClick: false
        },
        height:600,
        allowPaging: true,
        pageSettings: { 
            pageCount: 10,
            pageSize: 25
        },
        toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo Actor',  prefixIcon: 'e-add', id: 'nuevo_actor' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_actor' },
            { text: 'Eliminar', tooltipText: 'Eliminar Actor', prefixIcon: 'e-delete', id: 'eliminar_actor' },
            'Search'
    
        ],
        toolbarClick: clickHandler_actores,
        columns: [
            {headerText: 'IMAGEN', textAlign: 'Center',template: '#template_actor', width: 150},
            {
                field: 'actorID', isPrimaryKey: true, headerText: 'ACTOR ID', textAlign: 'Right',
                validationRules: { required: true }, width: 120
            },
            {
                field: 'actorNombres', headerText: 'NOMBRES',
                validationRules: { required: true },width: 120
            },
            {
                field: 'actorApellidos', headerText: 'APELLIDOS',
                validationRules: { required: true }
            } 
        ],
    });
    grid_actores.appendTo('#Grid_actores');
    $("#Grid_actores_searchbar").attr("placeholder", "Buscar");    
    function rowSelected_actores(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_actor_crud=grid_actores.getSelectedRecords()[0].actorID;    
    } 
 
    var dialogObj_actor = new ej.popups.Dialog({//VENTANA MODAL PARA NUEVO Y EDITAR actor
            header: 'Nuevo registro de actor',
            showCloseIcon: true,
            width: '500px',
            //height:'900px',
            target: document.getElementById('target'),
            animationSettings: { effect: 'None' },
            close: dialogClose,
            visible: false,
            content: "",
            isModal: true,            
    });
    dialogObj_actor.appendTo('#dialog_actor');
    function dialogClose() {
    }  

    
    
function dibujar_elementos_synfusion_actor_(){
        ej.base.enableRipple(true);
        var dropElement = document.getElementsByClassName('control-fluid')[0];
        var uploadObj = new ej.inputs.Uploader({
            autoUpload: false,
            multiple: false,
			allowedExtensions: 'image/*',
            selected: onFileSelect
        });
        uploadObj.appendTo('#img_actor');
        document.getElementById('browse').onclick = function () {
            document.getElementsByClassName('e-file-select-wrap')[0].querySelector('button').click();
            return false;
        };
        function onFileSelect(args) {
            var inputElement = document.getElementById('upload');
            inputElement.value = args.filesData[0].name;
        }  
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'nombre_actor': {
                    required: true
                },
                'apellidos_actor': {
                    required: true
                },
                'upload': {
                    required: true
                }
            }
        };
        var formBaseObj = new ej.inputs.FormValidator('#form_actor', options);      
        document.getElementById('guardar_actor').onclick = function () { 
        if (formBaseObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_actor').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            //File data
            var file_data = $('input[name="img_actor_"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("img_actor_[]", file_data[i]);
            }
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/configuracion/guardar_actor_",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_actor_crud="autogenerado";
                   grid_actores.refresh();
                   dialogObj_actor.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  
    var confirmDialogActorObj = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYesActor,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNoActor, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogActorObj.appendTo('#confirmDialogActor');    
    function confirmDlgBtnClickYesActor() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/configuracion/eliminar_actor/"+id_actor_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_actor_crud="autogenerado";
                     grid_actores.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogActorObj.hide();
    }
    function confirmDlgBtnClickNoActor() {       
        confirmDialogActorObj.hide();
    }
//fin
//FIN CODIGO PARA DIRECTORS      





 //CODIGO PARA GENEROS
    
    var id_genero_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
  
    ///---------CODIGO PARA ACTORES-------///    
    var data_generos = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/configuracion/leerRegistroGeneros",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
    var clickHandler_generos = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_genero') {   
            dialogObj_genero.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/configuracion/form_genero_",dialogObj_genero,dibujar_elementos_synfusion_genero_);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_genero") {
            if(id_genero_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{
               dialogObj_genero.show();
               ajax_content_all(2,"administracion/configuracion/form_genero_",dialogObj_genero,dibujar_elementos_synfusion_genero_,"administracion/configuracion/datos_json_generos_",id_genero_crud); 
            }
        }
        if (args.item.id === "eliminar_genero") {
              if(id_genero_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogGeneroObj.show();
              }
        }
    };  
    var grid_generos = new ej.grids.Grid({//GRILLA ACTORES
        dataSource: data_generos,
        rowSelected: rowSelected_generos,
        editSettings: { 
           llowEditOnDblClick: false
        },
        height:600,
        allowPaging: true,
        pageSettings: { 
            pageCount: 10,
            pageSize: 25
        },
        toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo Actor',  prefixIcon: 'e-add', id: 'nuevo_genero' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_genero' },
            { text: 'Eliminar', tooltipText: 'Eliminar Actor', prefixIcon: 'e-delete', id: 'eliminar_genero' },
            'Search'
    
        ],
        toolbarClick: clickHandler_generos,
        columns: [           
            {
                field: 'generoID', isPrimaryKey: true, headerText: 'GENERO ID', textAlign: 'Right',
                validationRules: { required: true }, width: 120
            },
            {
                field: 'generoNombre', headerText: 'NOMBRES',
                validationRules: { required: true },width: 120
            }
        ],
    });
    grid_generos.appendTo('#Grid_generos');
    $("#Grid_generos_searchbar").attr("placeholder", "Buscar");    
    function rowSelected_generos(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_genero_crud=grid_generos.getSelectedRecords()[0].generoID;    
    } 
 
    var dialogObj_genero = new ej.popups.Dialog({//VENTANA MODAL PARA NUEVO Y EDITAR actor
            header: 'Nuevo registro de Genero',
            showCloseIcon: true,
            width: '500px',
            //height:'900px',
            target: document.getElementById('target'),
            animationSettings: { effect: 'None' },
            close: dialogClose,
            visible: false,
            content: "",
            isModal: true,            
    });
    dialogObj_genero.appendTo('#dialog_genero');
    function dialogClose() {
    }  

    
    
function dibujar_elementos_synfusion_genero_(){   
    console.log("=????");
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'nombre_genero': {
                    required: true
                },                               
            }
        };
        var formBaseObj = new ej.inputs.FormValidator('#form_genero', options);      
        document.getElementById('guardar_genero').onclick = function () { 
        if (formBaseObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_genero').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });           
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/configuracion/guardar_genero_",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_genero_crud="autogenerado";
                   grid_generos.refresh();
                   dialogObj_genero.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  
    var confirmDialogGeneroObj = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYesGenero,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNoGenero, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogGeneroObj.appendTo('#confirmDialog_genero');    
    function confirmDlgBtnClickYesGenero() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/configuracion/eliminar_genero/"+id_genero_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_genero_crud="autogenerado";
                     grid_generos.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogGeneroObj.hide();
    }
    function confirmDlgBtnClickNoGenero() {       
        confirmDialogActorObj.hide();
    }
//fin
//FIN CODIGO PARA DIRECTORS      


























































// FUNCIONES ALL



