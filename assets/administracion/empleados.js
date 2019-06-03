    //CODIGO PARA DIRECTORES
    
    var id_empleado_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
     
    ///---------CODIGO PARA ACTORES-------///    
    var data_empleados = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/empleados/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   
    var clickHandler_local = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_empleado.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/empleados/form_",dialogObj_empleado,dibujar_elementos_synfusion_empleado);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_empleado_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_empleado.show();               
               ajax_content_all(2,"administracion/empleados/form_",dialogObj_empleado,dibujar_elementos_synfusion_empleado,"administracion/empleados/datos_json",id_empleado_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_empleado_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_eliminar_empleado.show();
              }
        }
    };  
    
    var grid_empleados = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_empleados,
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
                field: 'idempleado', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 30
            },
            {
                field: 'nombres', headerText: 'NOMBRES',
                validationRules: { required: true },width: 200
            },                    
            {
                field: 'apellidos', headerText: 'apellidos',
                validationRules: { required: true },width: 120
            },
            {
                field: 'condicion', headerText: 'CONDICION',
                validationRules: { required: true },width: 120
            }
        ],
    });
    grid_empleados.appendTo('#grid_empleados');
    
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_local(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_empleado_crud=grid_empleados.getSelectedRecords()[0].idempleado;
      
    } 
    
   
    var guardar_empleado_modal = new ej.buttons.Button({});
    var iconTemp_empleado = '<button id="guardar_empleado_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg_empleado = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
       
    var dialogObj_empleado = new ej.popups.Dialog({
            footerTemplate:  iconTemp_empleado,
            header: headerImg_empleado + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
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
    dialogObj_empleado.appendTo('#dialogObj_empleado');
   
   
   
   
   
      var confirmDialogObj_eliminar_empleado = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes_eliminar_empleado,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_eliminar_empleado, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_eliminar_empleado.appendTo('#confirmDialogObj_eliminar_empleado');    
    function confirmDlgBtnClickYes_eliminar_empleado() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/empleados/eliminar/"+id_empleado_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_empleado_crud="autogenerado";
                     grid_empleados.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_eliminar_empleado.hide();
    }
    function confirmDlgBtnClickNo_eliminar_empleado() {       
        confirmDialogObj_eliminar_empleado.hide();
    }


   
   function dibujar_elementos_synfusion_empleado(){    
       
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'nombre_empleado': {
                    required: true
                },
                'apellidos_empleado': {
                    required: true
                },
                'condicion_empleado': {
                    required: true
                }
               
            }
        };
     var formProveedorObj = new ej.inputs.FormValidator('#form_empleado', options);      
     document.getElementById('guardar_empleado_modal').onclick = function () { 
        if (formProveedorObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_empleado').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/empleados/guardar",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_empleado_crud="autogenerado";
                   grid_empleados.refresh();
                   dialogObj_empleado.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  


