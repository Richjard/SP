    //CODIGO PARA DIRECTORES
    
    var id_bien_menor_crud="autogenerado";//ID VARIABLE PARA DIRECTORES 
    var codigo_bien_menor="";  
    var id_bien_mmenores_modal="";//para ventana modal
    var codigo_bien_menor_con_modal="";//para ventana modal
    var nombre_bien_menor_con_modal="";//para ventana modal
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
 
    ///---------CODIGO PARA ACTORES-------///    
    var data_bien_mayor = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/bienes_menores/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
    var clickHandler_bien_menor = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_bien_menor.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/bienes_menores/form_",dialogObj_bien_menor,dibujar_elementos_synfusion_bien_menor);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_bien_menor_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_bien_menor.show();   
               ajax_content_all(2,"administracion/bienes_menores/form_",dialogObj_bien_menor,dibujar_elementos_synfusion_bien_menor,"administracion/bienes_menores/datos_json",id_bien_menor_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_bien_menor_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_bien_menor.show();
              }
        }
    };  
    
    var grid_bien_menor = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_bien_mayor,
        rowSelected: rowSelected_bien_menor,
        editSettings: { 
           llowEditOnDblClick: false
        },
        height:heingt_,
        allowPaging: true,
         allowFiltering: true,
        pageSettings: { 
            pageCount: 10,
            pageSize: 25
        },
        recordDoubleClick: onRecordDoubleClick_bienes_menores,
        toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo simpatizante',  prefixIcon: 'e-add', id: 'nuevo_' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_' },
            { text: 'Eliminar', tooltipText: 'Eliminar simpatizante', prefixIcon: 'e-delete', id: 'eliminar_' }
    
        ],
        toolbarClick: clickHandler_bien_menor,
        columns: [           
            {
                field: 'idCatalogo', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 50
            },
             {
                field: 'codigo', headerText: 'CODIGO',
                validationRules: { required: true },width: 100
            },
            {
                field: 'descripcion', headerText: 'DESCRIPCION',
                validationRules: { required: true },width: 400
            } 
        ],
    });
    grid_bien_menor.appendTo('#grid_bien_menor');
     function onRecordDoubleClick_bienes_menores(args) {
        if ($('#nombre_bien_menor_modal').length) {//si le llaman por modal
            dialogObj_bienes_menores.hide();
            $("#codigo_bien").val(codigo_bien_menor_modal+"????");
            $("#nombre_bien").val(nombre_bien_menor_modal);
            $("#id_bien_mm").val(id_bien_mmenores_modal);
            /*$("#codigo_cuenta").val(codigo_cuenta_con_modal);
            $("#nombre_cuenta").val(nombre_cuenta_con_modal);*/
         }
        //write logic for record double click
    }
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_bien_menor(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
       
        id_bien_menor_crud=grid_bien_menor.getSelectedRecords()[0].idCatalogo; 
        codigo_bien_menor_modal=grid_bien_menor.getSelectedRecords()[0].codigo;//para ventana modal
        nombre_bien_menor_modal=grid_bien_menor.getSelectedRecords()[0].descripcion;//para ventana modal
        id_bien_mmenores_modal=grid_bien_menor.getSelectedRecords()[0].idCatalogo; 
         /* codigo_cuenta_con_modal=grid_bien_menor.getSelectedRecords()[0].CUENTA_CONTABLE;//para ventana modal
        nombre_cuenta_con_modal=grid_bien_menor.getSelectedRecords()[0].descripcion_cuenta_contable;//para ventana modal
        */
        if ($('#nombre_bien_menor_modal').length) {           
            $("#nombre_bien_menor_modal").empty();
            $("#nombre_bien_menor_modal").append(nombre_bien_menor_modal);
          } else {
            // no existe
          }
    }
    
   
    var guardar_bien_menor_modal = new ej.buttons.Button({});
    var iconTemp_bien_menor = '<button id="guardar_bien_menor_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg_bien_menor = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
    var message_bien_menor = 'Greetings Nancy! When will you share me the source files of the project';
        
    var dialogObj_bien_menor = new ej.popups.Dialog({
            footerTemplate:  iconTemp_bien_menor,
            header: headerImg_bien_menor + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
            content: '<div class="dialogContent"><span class="dialogText">' + message_bien_menor + '</span></div>',
            showCloseIcon: true,
            target: document.getElementById('target'),
            width: '40%',
            content: "",
          //  open: dialogOpen,
           // close: dialogClose,
            visible: false,
           // height: '%',
           
    });
    dialogObj_bien_menor.appendTo('#dialogObj_bien_menor'); 
        ///sendButton.appendTo('#sendButton');      
    var confirmDialogObj_bien_menor = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes_bien_menor,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_bien_menor, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_bien_menor.appendTo('#confirmDialogObj_bien_menor');    
    function confirmDlgBtnClickYes_bien_menor() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/bienes_menores/eliminar/"+id_bien_menor_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_bien_menor_crud="autogenerado";
                     grid_bien_menor.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_bien_menor.hide();
    }
    function confirmDlgBtnClickNo_bien_menor() {       
        confirmDialogObj_bien_menor.hide();
    }
   function dibujar_elementos_synfusion_bien_menor(){     
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'descripcion_b_m_f': {
                    required: true
                }  
            }
        };
        var formplan_contableObj = new ej.inputs.FormValidator('#form_bien_menor', options);
        
        document.getElementById('guardar_bien_menor_modal').onclick = function () { 
           if (formplan_contableObj.validate()) { 
            var data = new FormData();
            //Form data
            var form_data = $('#form_bien_menor').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
            $.ajax({
               type: 'post',
               url: base_url+"administracion/bienes_menores/guardar",
               processData: false,
               contentType: false,
               data: data,
               beforeSend: function() {
               },
               success: function(json) {  
                    id_bien_menor_crud="autogenerado";//ID VARIABLE PARA DIRECTORES 
                    codigo_bien_menor="";                  
                    grid_bien_menor.refresh();
                    dialogObj_bien_menor.hide();
                    toastObj.show(toasts[1]);
               },
               error: function(resp) {
                   alert(resp);
               }
            });  
          }    
        };  
}  