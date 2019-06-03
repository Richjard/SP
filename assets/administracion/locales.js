    //CODIGO PARA DIRECTORES
    
    var id_local_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
     
    ///---------CODIGO PARA ACTORES-------///    
    var data_locales = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   
    var clickHandler_local = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_local.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/locales/form_",dialogObj_local,dibujar_elementos_synfusion_local);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_local_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_local.show();               
               ajax_content_all(2,"administracion/locales/form_",dialogObj_local,dibujar_elementos_synfusion_local,"administracion/locales/datos_json",id_local_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_local_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_eliminar_local.show();
              }
        }
    };  
    
    var grid_locales = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_locales,
        rowSelected: rowSelected_local,
        editSettings: { 
           llowEditOnDblClick: false
        },
        height:600,
        allowPaging: true,
        allowFiltering: true,
        pageSettings: { 
            pageCount: 10,
            pageSize: 25
        },
        toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo ',  prefixIcon: 'e-add', id: 'nuevo_' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_' },
            { text: 'Eliminar', tooltipText: 'Eliminar ', prefixIcon: 'e-delete', id: 'eliminar_' }
        ],       
        toolbarClick: clickHandler_local,
        columns: [           
            {
                field: 'idlocales', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 30
            },
            {
                field: 'descripcion', headerText: 'LOCAL',
                validationRules: { required: true },width: 200
            },                    
            {
                field: 'direccion', headerText: 'DIRECCION',
                validationRules: { required: true },width: 120
            }
        ],
    });
    grid_locales.appendTo('#grid_locales');
    
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_local(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_local_crud=grid_locales.getSelectedRecords()[0].idlocales;
      
    } 
    
   
    var guardar_local_modal = new ej.buttons.Button({});
    var iconTemp_local = '<button id="guardar_local_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg_local = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
       
    var dialogObj_local = new ej.popups.Dialog({
            footerTemplate:  iconTemp_local,
            header: headerImg_local + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
            content: '',
            showCloseIcon: true,
            target: document.getElementById('target'),
            width: '40%',
            content: "",
            isModal: true,
          //  open: dialogOpen,
           // close: dialogClose,
            visible: false,
           // height: '%',
           
    });
    dialogObj_local.appendTo('#dialogObj_local');
   
   
   
   
   
      var confirmDialogObj_eliminar_local = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes_eliminar_local,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_eliminar_local, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_eliminar_local.appendTo('#confirmDialogObj_eliminar_local');    
    function confirmDlgBtnClickYes_eliminar_local() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/locales/eliminar/"+id_local_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_local_crud="autogenerado";
                     grid_locales.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_eliminar_local.hide();
    }
    function confirmDlgBtnClickNo_eliminar_local() {       
        confirmDialogObj_eliminar_local.hide();
    }


   
   function dibujar_elementos_synfusion_local(){    
       
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'nombre_local': {
                    required: true
                }
               
            }
        };
     var formProveedorObj = new ej.inputs.FormValidator('#form_local', options);      
     document.getElementById('guardar_local_modal').onclick = function () { 
        if (formProveedorObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_local').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/locales/guardar",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_local_crud="autogenerado";
                   grid_locales.refresh();
                   dialogObj_local.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  

