    //CODIGO PARA DIRECTORES
    
    var id_proveedor_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
    
     var ruc_form_modal="";//para modal 
     var idproveedor_form_modal="";//para modal
     var razon_social_form_modal="";//para modal
                  
    ///---------CODIGO PARA ACTORES-------///    
    var data_proveedor = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/proveedor/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   
    var clickHandler = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_proveedor.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/proveedor/form_",dialogObj_proveedor,dibujar_elementos_synfusion_proveedor);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_proveedor_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_proveedor.show();               
               ajax_content_all(2,"administracion/proveedor/form_",dialogObj_proveedor,dibujar_elementos_synfusion_proveedor,"administracion/proveedor/datos_json",id_proveedor_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_proveedor_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj.show();
              }
        }
    };  
    
    var grid_proveedores = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_proveedor,
        rowSelected: rowSelected_proveedor,
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
            { text: 'Nuevo', tooltipText: 'Agregar nuevo simpatizante',  prefixIcon: 'e-add', id: 'nuevo_' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_' },
            { text: 'Eliminar', tooltipText: 'Eliminar simpatizante', prefixIcon: 'e-delete', id: 'eliminar_' }
        ],
        recordDoubleClick: onRecordDoubleClick_proveedor_,
        toolbarClick: clickHandler,
        columns: [           
            {
                field: 'idproveedor', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 120
            },
            {
                field: 'razon_social', headerText: 'RAZON SOCIAL',
                validationRules: { required: true },width: 120
            },
            {
                field: 'ruc', headerText: 'RUC',
                validationRules: { required: true },width: 120
            },          
            {
                field: 'direccion', headerText: 'DIRECCION',
                validationRules: { required: true },width: 120
            }
        ],
    });
    grid_proveedores.appendTo('#grid_proveedores');
    function onRecordDoubleClick_proveedor_(args) {
        if ($('#nombre_proveedor_modal').length) {//si le llaman por modal
            dialogObj_proveedores_modal.hide();
            $("#ruc_form_modal").val(ruc_form_modal);
            $("#idproveedor_form_modal").val(idproveedor_form_modal);
            $("#razon_social_form_modal").val(razon_social_form_modal); 
         }
        //write logic for record double click
    }
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_proveedor(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_proveedor_crud=grid_proveedores.getSelectedRecords()[0].idproveedor;
        ruc_form_modal=grid_proveedores.getSelectedRecords()[0].ruc;//para ventana modal
        idproveedor_form_modal=grid_proveedores.getSelectedRecords()[0].idproveedor;//para ventana modal
        razon_social_form_modal=grid_proveedores.getSelectedRecords()[0].razon_social;//para ventana modal       
        if ($('#nombre_proveedor_modal').length) {
            $("#nombre_proveedor_modal").empty();
            $("#nombre_proveedor_modal").append(razon_social_form_modal);
        } else {
            // no existe
        }
    } 
    
   
    var guardar_provedor_modal = new ej.buttons.Button({});
    var iconTemp_provedor = '<button id="guardar_provedor_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg_provedor = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
    var message_provedor = 'Greetings Nancy! When will you share me the source files of the project';
        
    var dialogObj_proveedor = new ej.popups.Dialog({
            footerTemplate:  iconTemp_provedor,
            header: headerImg_provedor + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
            content: '<div class="dialogContent"><span class="dialogText">' + message_provedor + '</span></div>',
            showCloseIcon: true,
            target: document.getElementById('target'),
            width: '40%',
            content: "",
          //  open: dialogOpen,
           // close: dialogClose,
            visible: false,
           // height: '%',
           
    });
    dialogObj_proveedor.appendTo('#dialogObj_proveedor');
   
   
   
   
   
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
                url: base_url+"administracion/proveedor/eliminar/"+id_proveedor_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_proveedor_crud="autogenerado";
                     grid_proveedores.refresh();
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


   
   function dibujar_elementos_synfusion_proveedor(){    
       
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'ruc': {
                    required: true
                },
                'razon_social': {
                    required: true
                }                ,
                'direccion': {
                    required: true
                }
            }
        };
        var formProveedorObj = new ej.inputs.FormValidator('#form_proveedor', options);      
     document.getElementById('guardar_provedor_modal').onclick = function () { 
        if (formProveedorObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_proveedor').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/proveedor/guardar",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_proveedor_crud="autogenerado";
                   grid_proveedores.refresh();
                   dialogObj_proveedor.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  