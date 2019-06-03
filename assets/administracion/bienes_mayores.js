    //CODIGO PARA DIRECTORES
    
    var id_bien_mayor_crud="autogenerado";//ID VARIABLE PARA DIRECTORES 
    var codigo_bien_mayor="";
    var codigo_bien_mayor_grupo="";
    var codigo_bien_mayor_clase="";
    var id_bien_mm_modal="";//para ventana modal
    var codigo_bien_mayor_modal="";//para ventana modal
    var nombre_bien_mayor_modal="";//para ventana modal
    var codigo_cuenta_con_modal="";//para ventana modal
    var nombre_cuenta_con_modal="";//para ventana modal
    var idplan_contable_modal="";//para ventana modal
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
 
    ///---------CODIGO PARA ACTORES-------///    
    var data_bien_mayor = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/bienes_mayores/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });  
    var data_grupo_combo = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/grupos/grupo_combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });  
    var data_clases_combo = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/clases/clase_combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    }); 
    var clickHandler = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_bien_mayor.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/bienes_mayores/form_",dialogObj_bien_mayor,dibujar_elementos_synfusion_bien_mayor);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_bien_mayor_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_bien_mayor.show();   
               ajax_content_all(2,"administracion/bienes_mayores/form_",dialogObj_bien_mayor,dibujar_elementos_synfusion_bien_mayor,"administracion/bienes_mayores/datos_json",id_bien_mayor_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_bien_mayor_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_bien_mayor.show();
              }
        }
    };  
    
    var grid_bien_mayor = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_bien_mayor,
        rowSelected: rowSelected_bien_mayor,
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
        recordDoubleClick: onRecordDoubleClick_bienes_mayores,
        toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo simpatizante',  prefixIcon: 'e-add', id: 'nuevo_' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_' },
            { text: 'Eliminar', tooltipText: 'Eliminar simpatizante', prefixIcon: 'e-delete', id: 'eliminar_' }
    
        ],
        toolbarClick: clickHandler,
        columns: [           
            {
                field: 'idtipo_bien', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 50
            },
             {
                field: 'codigo', headerText: 'CODIGO',
                validationRules: { required: true },width: 100
            },
            {
                field: 'descripcion', headerText: 'DESCRIPCION',
                validationRules: { required: true },width: 400
            } , 
            {
                field: 'idgrupos', headerText: 'idgrupos',
                validationRules: { required: true },width: 80,visible:false
            } ,
            {
                field: 'idClases', headerText: 'idClases',
                validationRules: { required: true },width: 80,visible:false
            } 
        ],
    });
    grid_bien_mayor.appendTo('#grid_bien_mayor');
     function onRecordDoubleClick_bienes_mayores(args) {
        if ($('#nombre_bien_mayor_modal').length) {//si le llaman por modal
            dialogObj_bienes_mayores.hide();
            $("#codigo_bien").val(codigo_bien_mayor_modal+"????");
            $("#nombre_bien").val(nombre_bien_mayor_modal);
            $("#codigo_cuenta").val(codigo_cuenta_con_modal);
            $("#nombre_cuenta").val(nombre_cuenta_con_modal);
            $("#idplan_contable").val(idplan_contable_modal);            
            $("#id_bien_mm").val(id_bien_mm_modal);
         }
        //write logic for record double click
    }
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_bien_mayor(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
       
        id_bien_mayor_crud=grid_bien_mayor.getSelectedRecords()[0].idtipo_bien; 
        codigo_bien_mayor_modal=grid_bien_mayor.getSelectedRecords()[0].codigo;//para ventana modal
        nombre_bien_mayor_modal=grid_bien_mayor.getSelectedRecords()[0].descripcion;//para ventana modal
        codigo_cuenta_con_modal=grid_bien_mayor.getSelectedRecords()[0].CUENTA_CONTABLE;//para ventana modal
        nombre_cuenta_con_modal=grid_bien_mayor.getSelectedRecords()[0].descripcion_cuenta_contable;//para ventana modal
        idplan_contable_modal=grid_bien_mayor.getSelectedRecords()[0].idplan_contable;//para ventana modal
        id_bien_mm_modal=grid_bien_mayor.getSelectedRecords()[0].idtipo_bien; 
        if ($('#nombre_bien_mayor_modal').length) {           
            $("#nombre_bien_mayor_modal").empty();
            $("#nombre_bien_mayor_modal").append(nombre_bien_mayor_modal);
          } else {
            // no existe
          }
    }
    
    //combos
    var grupo_bien = new ej.dropdowns.DropDownList({
        dataSource: data_grupo_combo,
        popupHeight: '200px',
        placeholder: 'Seleccione un grupo',
        //floatLabelType: 'Auto', 
        //value:direcotr_pelicula_id_var,
       // popupHeight: '350px',
        change: filter_grupo_grid, 
        value:'9999',
        fields: { value: 'idgrupos', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    grupo_bien.appendTo('#grupo_bien');
    function filter_grupo_grid(args) { 
         grid_bien_mayor.filterByColumn("idgrupos", 'equal', args.itemData.codigo);    
    } 
    
    var clase_bien = new ej.dropdowns.DropDownList({
        dataSource: data_clases_combo,
        popupHeight: '200px',
        placeholder: 'Seleccione una clase',
        //floatLabelType: 'Auto', 
        //value:direcotr_pelicula_id_var,
       // popupHeight: '350px',
        change: filter_clase_grid, 
        value:'9999',
        fields: { value: 'idclases', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    clase_bien.appendTo('#clase_bien');     
    function filter_clase_grid(args) { 
         grid_bien_mayor.filterByColumn("idClases", 'equal', args.itemData.codigo);
    
    } 
    var guardar_bien_mayor_modal = new ej.buttons.Button({});
    var iconTemp = '<button id="guardar_bien_mayor_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
    var message = 'Greetings Nancy! When will you share me the source files of the project';
        
    var dialogObj_bien_mayor = new ej.popups.Dialog({
            footerTemplate:  iconTemp,
            header: headerImg + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
           //	content: '<div class="dialogContent"><span class="dialogText">' + message + '</span></div>',
            showCloseIcon: true,
            target: document.getElementById('target'),
            width: '40%',
            content: "",
          //  open: dialogOpen,
           // close: dialogClose,
            visible: false,
           // height: '%',
           
    });
    dialogObj_bien_mayor.appendTo('#dialogObj_bien_mayor'); 
        ///sendButton.appendTo('#sendButton');


      
      var confirmDialogObj_bien_mayor = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes_bien_mayor,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_bien_mayor, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_bien_mayor.appendTo('#confirmDialogObj_bien_mayor');    
    function confirmDlgBtnClickYes_bien_mayor() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/bienes_mayores/eliminar/"+id_bien_mayor_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_bien_mayor_crud="autogenerado";
                     grid_bien_mayor.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_bien_mayor.hide();
    }
    function confirmDlgBtnClickNo_bien_mayor() {       
        confirmDialogObj_bien_mayor.hide();
    }


   
   function dibujar_elementos_synfusion_bien_mayor(){   
       
         
        //combos
        var grupo_bien_form = new ej.dropdowns.DropDownList({
            dataSource: data_grupo_combo,
            popupHeight: '400px',
            popupWidth: '300px',
            placeholder: 'Seleccione un grupo',
            value:$("#grupo_bien_form_h").val(),
            change: change_grupo_form_select,
            fields: { value: 'idgrupos', text: 'descripcion' } 
        });
        grupo_bien_form.appendTo('#grupo_bien_form');
        function change_grupo_form_select(args) { 
         codigo_bien_mayor_grupo=args.itemData.codigo;      
          codigo_bien_mayor=codigo_bien_mayor_grupo+codigo_bien_mayor_clase
        $("#codigo").val(codigo_bien_mayor);   
        } 
    


        var clase_bien_form = new ej.dropdowns.DropDownList({
            dataSource: data_clases_combo,
            popupHeight: '400px',
            popupWidth: '300px',
            placeholder: 'Seleccione una clase',            
            value:$("#clase_bien_form_h").val(),
            change: change_clase_form_select,            
            fields: { value: 'idclases', text: 'descripcion' }      
            //placeholder: 'Seleccione un director',  
        });
        clase_bien_form.appendTo('#clase_bien_form');   
        function change_clase_form_select(args) {      
         //codigo_bien_mayor="";
         //codigo_bien_mayor_grupo=args.itemData.codigo;
          codigo_bien_mayor_clase=args.itemData.codigo;
          codigo_bien_mayor=codigo_bien_mayor_grupo+codigo_bien_mayor_clase;
        $("#codigo").val(codigo_bien_mayor);   
        } 
    
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'codigo': {
                    required: true
                },
                'descripcion': {
                    required: true
                },
                'grupo_bien_form': {
                    required: true
                },
                'clase_bien_form': {
                    required: true
                }
                
                
                
            }
        };
        var formplan_contableObj = new ej.inputs.FormValidator('#form_bien_mayor', options);
        
        document.getElementById('guardar_bien_mayor_modal').onclick = function () { 
           if (formplan_contableObj.validate()) { 
            var data = new FormData();
            //Form data
            var form_data = $('#form_bien_mayor').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
            $.ajax({
               type: 'post',
               url: base_url+"administracion/bienes_mayores/guardar",
               processData: false,
               contentType: false,
               data: data,
               beforeSend: function() {
               },
               success: function(json) {  
                    id_bien_mayor_crud="autogenerado";//ID VARIABLE PARA DIRECTORES 
                    codigo_bien_mayor="";
                    codigo_bien_mayor_grupo="";
                    codigo_bien_mayor_clase="";                   
                    grid_bien_mayor.refresh();
                    dialogObj_bien_mayor.hide();
                    toastObj.show(toasts[1]);
               },
               error: function(resp) {
                   alert(resp);
               }
            });  
          }    
        };  
}  