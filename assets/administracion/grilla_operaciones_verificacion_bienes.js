  
 var idOficina=$("#id_oficina_grilla_vb").val();
 var data_formato_registros_bienes= new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/bienes/leerRegistro/"+idOficina,//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    }); 
 var id_bien_crud="autogenerado";//ID VARIABLE PARA DIRECTORES 
 var confirmContent_marcar_todos = '<span class=" confirmacion_text_context">Estás seguro de verificar los bienes seleccionados?</span>';    
 var confirmContent_descarmar_todos = '<span class=" confirmacion_text_context">¿Estás seguro de desverificar  los bienes seleccionados ?</span>'; 



    var clickHandler = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'verificar_todos_') {

            var dd=grid_bienes_inventarido.getSelectedRecords();  
             if(dd.length==0){
                  toastObj.show(toasts[0]);
             }else{

                 confirmDialogObj_verificacion_todos.show();
              }  
          
        }           

        
        if (args.item.id === 'desverificar_todos_') {

            var dd=grid_bienes_inventarido.getSelectedRecords();  
             if(dd.length==0){
                  toastObj.show(toasts[0]);
             }else{

                 confirmDialogObj_desverificacion_todos.show();
              }  
         
        }           

    };  



 var grid_bienes_inventarido = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_formato_registros_bienes,
        //rowSelected: rowSelected_bien,      

        enableHover: false,            
        allowExcelExport: true,
        allowPdfExport: true,
        rowHeight: 20,
        allowResizing: true,
        height:heingt_,
        allowPaging: true,
        //allowTextWrap: true,
        
        allowFiltering: true,
        selectionSettings: {checkboxMode: 'ResetOnRowClick'},
       
        pageSettings: { 
            pageCount: 10,
            pageSize: 40,
            pageSizes:true
        },
        //toolbar: ['ExcelExport', 'PdfExport'], excelexport
        
        toolbar: [           
           // { text: 'Verificar Bien por codigo', tooltipText: 'Verificar Bien por codigo',  prefixIcon: 'fas fa-check-double', id: 'verifieeeeeeeeeeeeeecar_todos_' }, 
            { text: 'Verificar ', tooltipText: 'Marcar verificado ', prefixIcon: 'fas fa-check', id: 'verificar_todos_' , enabled:true   },
            { text: 'Desverificar ', tooltipText: 'Quitar vericado  ', prefixIcon: 'fas fa-minus', id: 'desverificar_todos_' , enabled:true },

            
    
        ],
       /* contextMenuItems: [{ text: 'Nuevo', tooltipText: 'Agregar nuevo bien',  prefixIcon: 'e-add', id: 'nuevo_' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_' },
            { text: 'Eliminar', tooltipText: 'Eliminar bien', prefixIcon: 'e-delete', id: 'eliminar_' },
            { text: 'Generar Etiquetas', tooltipText: 'Generar Etiquetas', prefixIcon: 'e-new', id: 'ge_' }],
       */
    toolbarClick: clickHandler,
         
       // contextMenuClick: clickHandler,
   columns: [   
            { type: 'checkbox', width: 50 },
             {headerText: 'VB', textAlign: 'Center',template: '#template', width: 50,filter:false},
            {
                field: 'idformato_registro_bien', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 120
            },           
            {
                field: 'codigo_interno', headerText: 'CODIGO PAT.',
                validationRules: { required: true },width: 120
            },  
             {
                field: 'descripcion', headerText: 'DESCRIPCION',
                validationRules: { required: true },width: 200
            }, {
                field: 'orden_compra', headerText: 'O/C.',
                validationRules: { required: true },width: 80
            },
            {
                field: 'fecha_adquisicion', headerText: 'FECHA ADQ.',
                validationRules: { required: true },width: 100
            },
             {
                field: 'pecosa', headerText: 'PECOSA',
                validationRules: { required: true },width: 95
            }, 
            {
                field: 'codigo', headerText: 'FECHA P.',
                validationRules: { required: true },width: 120
            },
            {
                field: 'valor_adquirido', headerText: 'VALOR ADQ.',
                validationRules: { required: true },width: 100
            },
             {
                field: 'factura', headerText: 'FACTURA',
                validationRules: { required: true },width: 100
            },
            {
                field: 'local', headerText: 'LOCAL',
                validationRules: { required: true },width: 120
            }, 
            {
                field: 'area', headerText: 'AREA',
                validationRules: { required: true },width: 120
            }, 
            {
                field: 'oficina', headerText: 'OFICINA',
                validationRules: { required: true },width: 80
            }, 
            {
                field: 'estado_bien', headerText: 'EST.',
                validationRules: { required: true },width: 30
            },
            {
                field: 'codigo_cuenta', headerText: 'CUENTA',
                validationRules: { required: true },width: 90
            },           
             {
                field: 'dt_marca', headerText: 'MARCA',
                validationRules: { required: true },width: 120,visible:false
            },
             {
                field: 'dt_modelo', headerText: 'MODELO',
                validationRules: { required: true },width: 120,visible:false
            },
             {
                field: 'dt_serie', headerText: 'SERIE',
                validationRules: { required: true },width: 120,visible:false
            },
             {
                field: 'dt_color', headerText: 'COLOR',
                validationRules: { required: true },width: 120,visible:false
            },
            {
                field: 'dt_otros', headerText: 'OTROS',
                validationRules: { required: true },width: 120
            },            
           
        ],
    });
    grid_bienes_inventarido.appendTo('#grid_bienes_inventarido');


    //MODAL PARA CONFIRMACION DE VERIFICAR TODOS Y DESVERIFICAR
    var headerImg_bien_confirmDialogObj_verificacion_todos = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
    var confirmDialogObj_verificacion_todos = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
       
        header: headerImg_bien_confirmDialogObj_verificacion_todos + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> VERIFICAR  </div>',
        visible: false,
        content: confirmContent_marcar_todos,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
    
        buttons: [{
                click: confirmDlgBtnClickYes_verificacion_todos,
                buttonModel: { content: 'Si', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_verificacion_todos, buttonModel: { content: 'No' } }],
        width: '555px',
 
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_verificacion_todos.appendTo('#confirmDialogObj_verificacion_todos');    
    function confirmDlgBtnClickYes_verificacion_todos() {  
        var dd=grid_bienes_inventarido.getSelectedRecords();   
        $.ajax({
                type: 'post',
                url: base_url+"administracion/verificacion_de_bienes/verificar_todos/"+idOficina,
                data: {"data" : dd},
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                    id_bien_crud="autogenerado";                  
                     toastObj.show(toasts[1]);
                     grid_bienes_inventarido.refresh();
                    confirmDialogObj_verificacion_todos.hide();
                },
                error: function(resp) {
                    alert(resp);
                }
        });  
    }
    function confirmDlgBtnClickNo_verificacion_todos() {       
        confirmDialogObj_verificacion_todos.hide();
    }


    //MODAL PARA CONFIRMACION DE DES VERIFICAR TODOS Y DESVERIFICAR
    var headerImg_bien_confirmDialogObj_desverificacion_todos = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
    var confirmDialogObj_desverificacion_todos = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
       
        header: headerImg_bien_confirmDialogObj_desverificacion_todos + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> DESVERIFICAR  </div>',
        visible: false,
        content: confirmContent_descarmar_todos,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
    
        buttons: [{
                click: confirmDlgBtnClickYes_desverificacion_todos,
                buttonModel: { content: 'Si', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_desverificacion_todos, buttonModel: { content: 'No' } }],
        width: '555px',
 
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_desverificacion_todos.appendTo('#confirmDialogObj_desverificacion_todos');    
    function confirmDlgBtnClickYes_desverificacion_todos() { 
        var dd=grid_bienes_inventarido.getSelectedRecords();             
           $.ajax({
                type: 'post',
                url: base_url+"administracion/verificacion_de_bienes/desverificar_todos/"+idOficina,
                data: {"data" : dd},
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_bien_crud="autogenerado";                  
                     toastObj.show(toasts[1]);
                     grid_bienes_inventarido.refresh();
                    confirmDialogObj_desverificacion_todos.hide();
                },
                error: function(resp) {
                    alert(resp);
                }
            });  
    }
    function confirmDlgBtnClickNo_desverificacion_todos() {       
        confirmDialogObj_desverificacion_todos.hide();
    }