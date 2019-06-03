    //CODIGO PARA DIRECTORES
    
    
	console.log("tamaño px:"+$("#menu__").height());
     
  
    var id_bien_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var op_form="";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
    var i_data=0;
    var i_data_p=0
    var i_data_bm=0;
    var i_data_bme=0;
    var tipo_bien_select_value=1;
    ///---------CODIGO PARA ACTORES-------///    
    var data_formato_registros_bienes= new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/bienes/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
    var data_forma_adquisicion = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/forma_adquisicion/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_estado_bien = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/estado_bien/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_locales = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_areas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/areas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_oficinas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/oficinas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_empleados = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/empleados/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_proveedores = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/proveedor/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var clickHandler = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {
            op_form="n";
            dialogObj_bien_formato_registros.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/bienes/form_",dialogObj_bien_formato_registros,dibujar_elementos_synfusion_bien_formato_registros);//LLAMAMOS CON JAX EL FORMUALRIO          
        
        }       
        if (args.item.id === "editar_") {
            op_form="m";
            if(id_bien_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{      
                var dd=grid_bienes.getSelectedRecords();
                if(dd.length==1){
                  dialogObj_bien_formato_registros.show();               
                  ajax_content_all(2,"administracion/bienes/form_",dialogObj_bien_formato_registros,dibujar_elementos_synfusion_bien_formato_registros,"administracion/bienes/datos_json",id_bien_crud);         
                }else{
                     toastObj.show(toasts[4]);
                }              
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_bien_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_eliminar_bien.show();
              }
        }

         if (args.item.id === 'Grid_excelexport') {
            grid_bienes.excelExport(getExcelExportProperties());
            
         }


         if (args.item.id === 'Grid_pdfexport') {
            grid_bienes.pdfExport(getPdfExportProperties());
        }
         if (args.item.id === "ge_") {
            //console.log("modificamos la clase");
            $("#editar_").addClass( "disabled_patrimonio_b");
           $( "#editar_" ).prop( "disabled", true );
             var dd=grid_bienes.getSelectedRecords();  
             if(dd.length==0){
                  toastObj.show(toasts[0]);
             }else{
                 $.ajax({
                    type: 'post',
                    url: base_url+"administracion/bienes/ge",             

                    data: {"data" : dd},
                    beforeSend: function() {

                       /* $("#guardar_bien_formato_registros").attr("disabled",true);
                        console.log("desabilitar");*/
                    },
                    success: function(data) {  

                          document.location.href = base_url+"administracion/bienes/gene_x";          

                    },
                    error: function(resp) {
                        alert(resp);
                    }
                 }); 
             }
           // dd=JSON.stringify( dd );
             
            
            // Your properties

            // document.location.href = base_url+"administracion/bienes/ge/miArray="+dd;
         }
        
    };  
     $("#editar_").addClass( "disabled_patrimonio_b");
    var grid_bienes = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_formato_registros_bienes,
        rowSelected: rowSelected_bien,
       

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
        //toolbar: ['ExcelExport', 'PdfExport'],
        
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo bien',  prefixIcon: 'e-add', id: 'nuevo_' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_'   },
            { text: 'Eliminar', tooltipText: 'Eliminar bien', prefixIcon: 'e-delete', id: 'eliminar_' },
            { text: 'Generar Etiquetas', tooltipText: 'Generar Etiquetas', prefixIcon: 'e-csvexport', id: 'ge_' },
            { text: 'Generar EXCEL', tooltipText: 'Generar EXCEL', prefixIcon: 'e-excelexport', id: 'Grid_excelexport' }
           // { text: 'Generar PDF', tooltipText: 'Generar PDF', prefixIcon: 'e-pdfexport', id: 'Grid_pdfexport' }

            
    
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
    grid_bienes.appendTo('#grid_bienes');
    var date = '';
    date += ((new Date()).getMonth().toString()) + '/' + ((new Date()).getDate().toString());
    date += '/' + ((new Date()).getFullYear().toString());
    
     
     
     

    function getExcelExportProperties() {
         
        fo = new Date();
        var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        fech = fo.getDate()+"-"+months[fo.getMonth()]+"-"+fo.getFullYear();  
       // alert(fech);
        orden_c=$("#orden_compra_filterBarcell").val();
       // alert("Descargando..");
        return {  
            includeHiddenColumn: true,
            fileName: "Registros_Para_Orden_Compra_"+orden_c+"_"+fech+".xlsx"
        };
    }
      function getPdfExportProperties() {
        return {

     fileName: "pdfdocument.pdf"
        };
    }
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_bien(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        console.log("aaa");
       id_bien_crud=grid_bienes.getSelectedRecords()[0].idformato_registro_bien;    
       rows=grid_bienes.getSelectedRowIndexes();    
       //alert(rows);
       
       
    } 
    
    /* var dialogObj_proveedor = new ej.popups.Dialog({//VENTANA MODAL PARA NUEVO Y EDITAR DIRECTOR
            header: 'Nuevo registro ',
            showCloseIcon: true,
            width: '900px',
            //height:'900px',
            target: document.getElementById('target'),
            animationSettings: { effect: 'None' },
            close: dialogClose,
            visible: false,
            content: "",
            isModal: true,            
    });
    dialogObj_proveedor.appendTo('#dialogObj_proveedor');
    function dialogClose() {
    }  */
   
   
   var guardar_bien_formato_registros = new ej.buttons.Button({});     
   var iconTemp_bien_formato_registros = '<button id="guardar_bien_formato_registros" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
   var headerImg_bien_formato_registros = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
   var message__bien_formato_registros = 'Greetings Nancy! When will you share me the source files of the project';
   var dialogObj_bien_formato_registros = new ej.popups.Dialog({
        footerTemplate:  iconTemp_bien_formato_registros,
        header: headerImg_bien_formato_registros + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
        //content: '<div class="dialogContent"><span class="dialogText">' + message__bien_formato_registros + '</span></div>',
        showCloseIcon: true,
        target: document.getElementById('target'),
        isModal: true,
        width: '60%',
      //  open: dialogOpen,
       // close: dialogClose,
        visible: false,
        height: '100%',
    });
    dialogObj_bien_formato_registros.appendTo('#dialogObj_bien_formato_registros'); 
    guardar_bien_formato_registros.appendTo('#guardar_bien_formato_registros');

        
        
        
   
   
   
   
      var confirmDialogObj_eliminar_bien = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
    
        buttons: [{
                click: confirmDlgBtnClickYes_eliminar_bien,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_eliminar_bien, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_eliminar_bien.appendTo('#confirmDialogObj_eliminar_bien');    
    function confirmDlgBtnClickYes_eliminar_bien() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/bienes/eliminar/"+id_bien_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_bien_crud="autogenerado";
                     grid_bienes.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_eliminar_bien.hide();
    }
    function confirmDlgBtnClickNo_eliminar_bien() {       
        confirmDialogObj_eliminar_bien.hide();
    }
//dialogo plan
            var ok_cuentas_modal = new ej.buttons.Button({});
            var iconTemp_ = '<label >Cuenta seleccionada: </label> <label id="nombre_plan_contable_modal">No se selecciono a un</label><button id="ok_cuentas_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'OK</button>';
            var headerImg_ = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
            var message_ = 'Greetings Nancy! When will you share me the source files of the project';

            var dialogObj_plan = new ej.popups.Dialog({
                footerTemplate:  iconTemp_,
                header: headerImg_ + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> CUENTAS DE PLAN CONTABLE </div>',
              //  content: '<div class="dialogContent"><span class="dialogText">' + message_ + '</span></div>',
                showCloseIcon: true,
                isModal: true,
                allowDragging: true,
                target: document.getElementById('target'),
                width: '70%',
              //  open: dialogOpen,
               // close: dialogClose,
                visible: false,
                height: '90%'
            });
            dialogObj_plan.appendTo('#dialogObj_plan'); 
            ok_cuentas_modal.appendTo('#ok_cuentas_modal');
            (document.getElementById('ok_cuentas_modal')).onkeydown = function(e)  {
                console.log("ok xxx");
                 if (e.keyCode === 13) { 
                      ok_modal_cuentas();
                     
                 }
                 
                 
             };
              document.getElementById('ok_cuentas_modal').onclick = function () { 
                 console.log("aaaaammm");
                ok_modal_cuentas();
              };
              function ok_modal_cuentas(){                 
                  dialogObj_plan.hide();
                  $("#codigo_cuenta").val(codigo_plan_contable_modal);
                  $("#nombre_cuenta").val(nombre_plan_contable_modal);
                  $("#idplan_contable").val(idplan_contable_modal);
              }
//fin


//fin

//dialogo bienes mayors
            var ok_bienes_mayores_modal = new ej.buttons.Button({});
            var iconTemp_bienes_mayores = '<label >Bien mayor seleccionada: </label> <label id="nombre_bien_mayor_modal">No se selecciono a un</label><button id="ok_bienes_mayores_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'OK</button>';
            var headerImg_bienes_mayores= '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
            var message_bienes_mayores = 'Greetings Nancy! When will you share me the source files of the project';

            var dialogObj_bienes_mayores = new ej.popups.Dialog({
                footerTemplate:  iconTemp_bienes_mayores,
                header: headerImg_bienes_mayores + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> BIENES MAYORES </div>',
              //  content: '<div class="dialogContent"><span class="dialogText">' + message_bienes_mayores + '</span></div>',
                showCloseIcon: true,
                isModal: true,
                allowDragging: true,
                target: document.getElementById('target'),
                width: '70%',
              //  open: dialogOpen,
               // close: dialogClose,
                visible: false,
                height: '90%'
            });
            dialogObj_bienes_mayores.appendTo('#dialogObj_bienes_mayores'); 
            ok_bienes_mayores_modal.appendTo('#ok_bienes_mayores_modal');
            (document.getElementById('ok_bienes_mayores_modal')).onkeydown = function(e)  {
                console.log("ok xxx");
                 if (e.keyCode === 13) { 
                      ok_modal_bienes_mayores();                     
                 }  
             };
              document.getElementById('ok_bienes_mayores_modal').onclick = function () {                  
                ok_modal_bienes_mayores();
              };
              function ok_modal_bienes_mayores(){
                  console.log("aaa:"+idplan_contable_modal);
                  dialogObj_bienes_mayores.hide();
                  $("#codigo_bien").val(codigo_bien_mayor_modal+"????");
                  $("#nombre_bien").val(nombre_bien_mayor_modal);
                  $("#codigo_cuenta").val(codigo_cuenta_con_modal);
                  $("#nombre_cuenta").val(nombre_cuenta_con_modal);
                  $("#idplan_contable").val(idplan_contable_modal);
                  $("#id_bien_mm").val(id_bien_mm_modal);
              }
//fin


//dialogo bienes menores
            var ok_bienes_menores_modal = new ej.buttons.Button({});
            var iconTemp_bienes_menores = '<label >Bien menor seleccionada: </label> <label id="nombre_bien_menor_modal">No se selecciono a un</label><button id="ok_bienes_menores_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'OK</button>';
            var headerImg_bienes_menores= '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
            var message_bienes_menores = 'Greetings Nancy! When will you share me the source files of the project';

            var dialogObj_bienes_menores = new ej.popups.Dialog({
                footerTemplate:  iconTemp_bienes_menores,
                header: headerImg_bienes_menores + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> BIENES MENORES </div>',
               // content: '<div class="dialogContent"><span class="dialogText">' + message_bienes_mayores + '</span></div>',
                showCloseIcon: true,
                isModal: true,
                allowDragging: true,
                target: document.getElementById('target'),
                width: '70%',
              //  open: dialogOpen,
               // close: dialogClose,
                visible: false,
                height: '90%'
            });
            dialogObj_bienes_menores.appendTo('#dialogObj_bienes_menores'); 
            ok_bienes_menores_modal.appendTo('#ok_bienes_menores_modal');
            (document.getElementById('ok_bienes_menores_modal')).onkeydown = function(e)  {
                console.log("ok xxx");
                 if (e.keyCode === 13) { 
                      ok_modal_menores_mayores();                     
                 }  
             };
              document.getElementById('ok_bienes_menores_modal').onclick = function () {                  
                ok_modal_bienes_menores();
              };
              function ok_modal_bienes_menores(){
                  //console.log("ok??");
                  dialogObj_bienes_menores.hide();
                  $("#codigo_bien").val(codigo_bien_menor_modal+"????");
                  $("#nombre_bien").val(nombre_bien_menor_modal);
                  $("#id_bien_mm").val(id_bien_mmenores_modal);
                  /*$("#codigo_cuenta").val(codigo_cuenta_con_modal);
                  $("#nombre_cuenta").val(nombre_cuenta_con_modal);*/
              }
//fin
//dialogo proveedores
            var ok_proveedores_modal = new ej.buttons.Button({});
            var iconTemp_proveedor_modal = '<label >Proveedor seleccionada: </label> <label id="nombre_proveedor_modal">No se selecciono a un</label><button id="ok_proveedores_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'OK</button>';
            var headerImg_proveedor_modal= '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
            var message_proveedor_modal = 'Greetings Nancy! When will you share me the source files of the project';

            var dialogObj_proveedores_modal = new ej.popups.Dialog({
                footerTemplate:  iconTemp_proveedor_modal,
                header: headerImg_proveedor_modal + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> PROVEEDORES </div>',
               // content: '<div class="dialogContent"><span class="dialogText">' + message_proveedor_modal + '</span></div>',
                showCloseIcon: true,
                isModal: true,
                allowDragging: true,
                target: document.getElementById('target'),
                width: '70%',
              //  open: dialogOpen,
               // close: dialogClose,
                visible: false,
                height: '90%'
            });
            dialogObj_proveedores_modal.appendTo('#dialogObj_proveedores_modal'); 
            ok_proveedores_modal.appendTo('#ok_proveedores_modal');
            (document.getElementById('ok_proveedores_modal')).onkeydown = function(e)  {
                console.log("ok xxx");
                 if (e.keyCode === 13) { 
                      ok_proveedores_modal_button();                     
                 }  
             };
              document.getElementById('ok_proveedores_modal').onclick = function () {                  
                ok_proveedores_modal_button();
              };
              function ok_proveedores_modal_button(){
                  //console.log("ok??");
                  dialogObj_proveedores_modal.hide();
                  $("#ruc_form_modal").val(ruc_form_modal);
                  $("#idproveedor_form_modal").val(idproveedor_form_modal);
                  $("#razon_social_form_modal").val(razon_social_form_modal);
                  /*$("#codigo_cuenta").val(codigo_cuenta_con_modal);
                  $("#nombre_cuenta").val(nombre_cuenta_con_modal);*/
              }
//fin

    function validar_plan(){
        
           valor = $("#valor_adquirido").val();
           $("#valor_neto").val(valor);
       

    }
   
   function dibujar_elementos_synfusion_bien_formato_registros(){  
       /*  button = new ej.buttons.Button({ iconCss: 'e-icons e-add-icon', cssClass: 'e-small e-round', isPrimary: true });
         button.appendTo('#cuentas_plan_contable');*/
      /*  var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        var fecha=dd+"/"+mm+"/"+yyyy;
       $("#fecha_adquisicion").val(fecha);*/
      // console.log("fecha"+fecha);
       //combo forma adquisicion
       //console.log("bolean::"+JSON.parse($("#asegurado_bien").val()));
       if($("#asegurado_bien").val()==""){
           check_bolean=false;
       }else{
           check_bolean=JSON.parse($("#asegurado_bien").val())
       }
        var checkBoxObj = new ej.buttons.CheckBox({ label: 'Asegurado', checked:check_bolean  });
        checkBoxObj.appendTo('#asegurado');
        var combo_forma_adquisicion = new ej.dropdowns.DropDownList({
            dataSource: data_forma_adquisicion,
            popupHeight: '400px',
            popupWidth: '300px',
            placeholder: 'Seleccione una forma de adquisición',
            value:$("#idforma_adquicision_bien").val(),           
            fields: { value: 'idforma_adquisicion', text: 'descripcion' } 
        });
        combo_forma_adquisicion.appendTo('#combo_forma_adquisicion'); 
       //fin combo adquisicion
       ////combo estado bien
        var combo_estado_bien = new ej.dropdowns.DropDownList({
            dataSource: data_estado_bien,
            popupHeight: '400px',
            popupWidth: '300px',
            placeholder: 'Seleccione una estado de bien',
             value:$("#idestado_bien_bien").val(),            
            fields: { value: 'idestado_bien', text: 'descripcion' },
            change: function () {
              if(combo_estado_bien.text=="Baja"){
                  $('#resolucion_baja').attr("disabled", false);
                  //$('#fecha_baja').attr("disabled", false);
                 // $("#fecha_baja").ejDatePicker({  enabled : false });
                   
                   $('#fecha_baja').removeAttr("disabled");
                   $('#fecha_baja').parent().removeClass("e-disabled");
                   $('#fecha_baja').removeClass("e-disabled");
                  $('#causal').attr("disabled", false);
              }else{
                 // $("#resolucion_baja").addClass("clasecss");
                  $('#resolucion_baja').val("");
                   $('#causal').val("");
                  $('#resolucion_baja').attr("disabled", true);     
                   $('#fecha_baja').attr("disabled");
                   $('#fecha_baja').parent().addClass("e-disabled");
                   $('#fecha_baja').addClass("e-disabled");
                  // $('#datepicker_fecha_baja').removeAttr("disabled");
                 // datepicker_fecha_baja.enable(true); // enables the datepicker                  
                  $('#causal').attr("disabled", true);
              }
             }
        });
        combo_estado_bien.appendTo('#combo_estado_bien'); 
       //fin estado bien
       //combo_locales        
        var combo_locales = new ej.dropdowns.DropDownList({
            dataSource: data_locales,
            popupHeight: '400px',
            popupWidth: '300px',
            placeholder: 'Seleccione una estado de bien',            
            value:$("#idlocal_bien").val(),           
            fields: { value: 'idlocales', text: 'descripcion' }, 
            actionComplete : function (args) 
            {
                console.log("completado accion"+$("#idarea_bien").val()); 
                if($("#idarea_bien").val()!=""){
                     console.log("completado eeee"+$("#idarea_bien").val()); 
                    // disable the state DropDownList
                    combo_areas.enabled = true;
                    // frame the query based on selected value in country DropDownList.
                    var tempQuery = new ej.data.Query().where('idlocales', 'equal', combo_locales.value);
                    // set the framed query based on selected value in country DropDownList.
                    combo_areas.query = tempQuery;
                    // set null value to state DropDownList text property
                    
                    combo_areas.text = null;
                    
                    // bind the property changes to state DropDownList
                    combo_areas.dataBind();
                    combo_areas.value=$("#idarea_bien").val();
                    
                    combo_oficinas.enabled = true;
                    // Query the data source based on state DropDownList selected value
                    var tempQuery1 = new ej.data.Query().where('idarea', 'equal', combo_areas.value);
                    // set the framed query based on selected value in city DropDownList.
                    combo_oficinas.query = tempQuery1;
                    //clear the existing selection
                    combo_oficinas.text = null;
                    // bind the property change to city DropDownList
                    combo_oficinas.dataBind();
                    combo_oficinas.value=$("#idoficina_bien").val();
                    
                    combo_empleados.enabled = true;
                    // Query the data source based on state DropDownList selected value
                    var tempQuery1 = new ej.data.Query().where('idoficina', 'equal', combo_oficinas.value);
                    // set the framed query based on selected value in city DropDownList.
                    combo_empleados.query = tempQuery1;
                    //clear the existing selection
                    combo_empleados.text = null;
                    // bind the property change to city DropDownList
                    combo_empleados.dataBind();
                    combo_empleados.value=$("#idempleado_oficina_bien").val();
                
                   
                }
                
            }, 
            change: function () {
                // disable the state DropDownList
                combo_areas.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', combo_locales.value);
                // set the framed query based on selected value in country DropDownList.
                combo_areas.query = tempQuery;
                // set null value to state DropDownList text property
                combo_areas.text = null;
                // bind the property changes to state DropDownList
                combo_areas.dataBind();
                // set null value to city DropDownList text property
                combo_oficinas.text = null;
                // disable the city DropDownList
                combo_oficinas.enabled = false;
                // bind the property changes to City DropDownList
                combo_oficinas.dataBind();
                // set null value to city DropDownList text property
                combo_empleados.text = null;
                // disable the city DropDownList
                combo_empleados.enabled = false;
                // bind the property changes to City DropDownList
                combo_empleados.dataBind();
            }
        });
        combo_locales.appendTo('#combo_locales'); 
        console.log("id local:"+$("#idarea_bien").val());        
        var combo_areas = new ej.dropdowns.DropDownList({
            dataSource: data_areas,
            popupHeight: '400px',
            popupWidth: '300px',
            enabled: false,
            placeholder: 'Seleccione una estado de bien',
                       
            fields: { value: 'idarea', text: 'descripcion' },
            change: function () {
                // enable the city DropDownList
                combo_oficinas.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idarea', 'equal', combo_areas.value);
                // set the framed query based on selected value in city DropDownList.
                combo_oficinas.query = tempQuery1;
                //clear the existing selection
                combo_oficinas.text = null;
                // bind the property change to city DropDownList
                combo_oficinas.dataBind();
                 // set null value to city DropDownList text property
                combo_empleados.text = null;
                // disable the city DropDownList
                combo_empleados.enabled = false;
                // bind the property changes to City DropDownList
                combo_empleados.dataBind();
            },
        });
        combo_areas.appendTo('#combo_areas');
        var combo_oficinas = new ej.dropdowns.DropDownList({
            dataSource: data_oficinas,
            popupHeight: '400px',
            popupWidth: '300px',
            placeholder: 'Seleccione una estado de bien',
            enabled: false,
           // value:"1",           
            fields: { value: 'idoficina', text: 'descripcion' },
             change: function () {
                // enable the city DropDownList
                combo_empleados.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idoficina', 'equal', combo_oficinas.value);
                // set the framed query based on selected value in city DropDownList.
                combo_empleados.query = tempQuery1;
                //clear the existing selection
                combo_empleados.text = null;
                // bind the property change to city DropDownList
                combo_empleados.dataBind();
            
            },
        });
        combo_oficinas.appendTo('#combo_oficinas');
        var combo_empleados = new ej.dropdowns.DropDownList({
            dataSource: data_empleados,
            popupHeight: '400px',
            popupWidth: '300px',
            placeholder: 'Seleccione un empleado',
            enabled: false,
           // value:"1",           
            fields: { value: 'idempleado_oficina', text: 'descripcion' } 
        });
        combo_empleados.appendTo('#combo_empleados');
      /*  var combo_proveedores = new ej.dropdowns.DropDownList({
            dataSource: data_proveedores,
            popupHeight: '400px',
            popupWidth: '300px',
            placeholder: 'Seleccione un proveedor',           
           // value:"1",           
            fields: { value: 'idproveedor', text: 'descripcion' } 
        });
        combo_proveedores.appendTo('#combo_proveedores');*/
       //fin estado bien
       //fecha adquisicon
        /*var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1; //hoy es 0!
        var yyyy = hoy.getFullYear();
        var xx="";*/
      
      // fecha_ad = new Date(date).toISOString();
     
       if($("#fecha_adquisicion_bien").val()==""){
           fecha_ad = new Date(); 
       }else{
           var d=Date.parse($("#fecha_adquisicion_bien").val());
          fecha_ad = new Date(d);
       }  
       $('input[name="fecha_adquisicion"]').mask('0000-00-00');
       var datepicker = new ej.calendars.DatePicker({
            format: 'yyyy-MM-dd',
           
            value: fecha_ad,
            showTooltip: true, //show tooltip on hovering date on DatePicker calendar
            enableStrictMode: false, //sets active strict mode
            tooltipFormat: "yy/MM/dd"// sets tooltip for dates in DatePicker calendar
         });
        datepicker.appendTo('#fecha_adquisicion');
      
 
        if($("#fecha_baja_bien").val()==""){
           fecha_bj = new Date(); 
        }else{
            var d=Date.parse($("#fecha_baja_bien").val());
           fecha_bj = new Date(d);
        }  
        $('input[name="fecha_baja"]').mask('0000-00-00');
        var datepicker_fecha_baja = new ej.calendars.DatePicker({
            format: 'yyyy-MM-dd',
            value: fecha_bj,
            enabled: false,
            showTooltip: true, //show tooltip on hovering date on DatePicker calendar
            enableStrictMode: false, //sets active strict mode
            tooltipFormat: "yy/MM/dd"// sets tooltip for dates in DatePicker calendar
        });
        datepicker_fecha_baja.appendTo('#fecha_baja');
       //fin fecha adquisicion
       
      
        //Initialize Tab component
        var tabObj = new ej.navigations.Tab();
       //Render initialized Tab component
        tabObj.appendTo('#Tab_registro_bien');

        var data_tipo_bien=[
            {id_tipo_bien: "1", nombre:"Bienes Mayores" },
            {id_tipo_bien: "2", nombre:"Bienes Menores" }
        ];
        console.log("value tipo;;"+$("#tipo_bien_bien").val());
            var tipo_bien = new ej.dropdowns.DropDownList({
                dataSource: data_tipo_bien,
                popupHeight: '200px',
                placeholder: 'Seleccione un Tipo Bien',
                value:$("#tipo_bien_bien").val(),          
                change:tipo_bien_select,              
                fields: { value: 'id_tipo_bien', text: 'nombre' }   
            });
            tipo_bien.appendTo('#tipo_bien');
            
        function tipo_bien_select(args) {
            if(args.itemData){
                if(args.itemData.id_tipo_bien==2){
                  tipo_bien_select_value=2;
                   $("#nombre_cuenta").val('BIENES NO DEPRECIABLES');
                   $("#codigo_cuenta").val('65952');
                   $("#idplan_contable").val('1764');
                  
                }else{
                    tipo_bien_select_value=1;
                } 
            }
                  
        }  
         //plan contable            
        document.getElementById('cuentas_plan_contable').onclick = function () { 
                console.log("plan");
                dialogObj_plan.show();
                if(i_data==0){
                    function xd(){
                   // alert("fadfadfs");
                    $.getScript( base_url+"assets/administracion/plan_contables.js", function( data, textStatus, jqxhr ) {
                        console.log( data ); // Data returned
                        console.log( textStatus ); // Success
                        console.log( jqxhr.status ); // 200
                        console.log( "Load was performed." );
                      });
                    }
                    ajax_content_ojete("administracion/plan_contables/all",dialogObj_plan,xd);
                }
                i_data=i_data+1;  
        };            
        //autocomplete
        (document.getElementById('codigo_cuenta')).onkeydown = function(e)  {
            if (e.keyCode === 13) {  query_cuenta(); }
        };
        
         $(document).on("blur","#codigo_cuenta",function(){
           query_cuenta();

        });
        function query_cuenta(){
             var codigo_cuenta_query = $("#codigo_cuenta").val();
             console.log(" codigo_cuenta_query : "+codigo_cuenta_query);
             base_url=$("#base_url").val();           
             console.log("base url:: "+base_url);
            $.ajax({
              url: base_url+'administracion/plan_contables/consulta_cuenta/'+codigo_cuenta_query,
              success: function(respuesta) {
                  console.log(respuesta.data);
                  if(respuesta.data != 0){   
                     $("#nombre_cuenta").val(respuesta.data.descripcion);
                     $("#idplan_contable").val(respuesta.data.idplan_contable);
                  }else{
                      $("#nombre_cuenta").val("No existe");
                      $("#idplan_contable").val("");
                      idplan_contable_modal="";
                  }
                 ;
              },
              error: function() {
                console.log("No se ha podido obtener la información");
              }
            });
        }
         //proveedor            
        document.getElementById('proveedores_').onclick = function () { 
                console.log("proveedor");
                dialogObj_proveedores_modal.show();
                if(i_data_p==0){
                    function xd(){
                   // alert("fadfadfs");
                    $.getScript( base_url+"assets/administracion/proveedor.js", function( data, textStatus, jqxhr ) {
                        console.log( data ); // Data returned
                        console.log( textStatus ); // Success
                        console.log( jqxhr.status ); // 200
                        console.log( "Load was performed." );
                      });
                    }
                    ajax_content_ojete("administracion/proveedor/all",dialogObj_proveedores_modal,xd);
                }
                i_data_p=i_data_p+1;  
        };      
        //autocomplete proveedor
        //autocomplete
        (document.getElementById('ruc_form_modal')).onkeydown = function(e)  {
            if (e.keyCode === 13) {  query_proveedor(); }
        };
        
         $(document).on("blur","#ruc_form_modal",function(){
           query_proveedor();

        });
        function query_proveedor(){
             var ruc_query = $("#ruc_form_modal").val();
             console.log(" ruc : "+ruc_query);
             base_url=$("#base_url").val(); 
            $.ajax({
              url: base_url+'administracion/proveedor/consulta_ruc/'+ruc_query,
              success: function(respuesta) {
                  console.log(respuesta.data);
                  if(respuesta.data != 0){   
                     $("#razon_social_form_modal").val(respuesta.data.razon_social);
                     $("#idproveedor_form_modal").val(respuesta.data.idproveedor);
                  }else{
                      $("#razon_social_form_modal").val("No existe");
                      $("#idproveedor_form_modal").val("");
                     // idplan_contable_modal="";
                  }
                 ;
              },
              error: function() {
                console.log("No se ha podido obtener la información");
              }
            });
        }
        //fin autocompelte proveedor
        //biens mayores}consol
        console.log("nuevo:::"+op_form);
        if(op_form=="n"){
            tipo_bien.enabled = true;
            $("#bienes_mayores_obj").removeClass("e-disabled ");
             $("#cantidad").attr("disabled",false);
             console.log("quitamos disabled");
        }else{
            console.log("agegamos disabled");
            tipo_bien.enabled = false;
            $("#bienes_mayores_obj").addClass("e-disabled ");
           
            $("#cantidad").attr("disabled",true);
            $("#cantidad").val(0);
        }
        document.getElementById('bienes_mayores_obj').onclick = function () {
             if(op_form=="n"){
                    if(tipo_bien_select_value==1){
                        //bienes mayores
                        dialogObj_bienes_mayores.show();
                        if(i_data_bm==0){
                                    function xd(){
                                   // alert("fadfadfs");
                                    $.getScript( base_url+"assets/administracion/bienes_mayores.js", function( data, textStatus, jqxhr ) {
                                        console.log( data ); // Data returned
                                        console.log( textStatus ); // Success
                                        console.log( jqxhr.status ); // 200
                                        console.log( "Load was performed." );
                                      });
                                    }
                                    ajax_content_ojete("administracion/bienes_mayores/all",dialogObj_bienes_mayores,xd);
                                }
                                i_data_bm=i_data_bm+1;
                            }else{
                                //bienes menores 
                                dialogObj_bienes_menores.show();
                                if(i_data_bme==0){
                                    function xd(){
                                      $.getScript( base_url+"assets/administracion/bienes_menores.js", function( data, textStatus, jqxhr ) {
                                        console.log( data ); // Data returned
                                        console.log( textStatus ); // Success
                                        console.log( jqxhr.status ); // 200
                                        console.log( "Load was performed." );
                                      });
                                    }
                                    ajax_content_ojete("administracion/bienes_menores/all",dialogObj_bienes_menores,xd);
                                }
                                i_data_bme=i_data_bme+1;                
                            }  

                  
                }
        
            
                 
                
        }; 
        //bton guradar
          var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'nombre_bien': {
                    required: true
                },
                'fecha_adquisicion': {
                    required: true
                },                
                'combo_locales': {
                    required: true
                },
                'combo_areas': {
                    required: true
                },
                'combo_oficinas': {
                    required: true
                },
            }
        };
        var formplan_contableObj = new ej.inputs.FormValidator('#form_bien_formato_registros', options);
  
          /* progressButton = new ej.splitbuttons.ProgressButton({
                content: 'Zoom Out', enableProgress: true, animationSettings: { effect: 'ZoomOut' },
                spinSettings: { position: 'Center' }, cssClass: 'e-small e-danger'
            });
            progressButton.appendTo('#zoomout');*/
        document.getElementById('guardar_bien_formato_registros').onclick = function () { 
            console.log("guardar?");
           if (formplan_contableObj.validate()) { 
            var data = new FormData();
            //Form data
            var form_data = $('#form_bien_formato_registros').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
            $.ajax({
               type: 'post',
               url: base_url+"administracion/bienes/guardar",
               processData: false,
               contentType: false,
               data: data,
               beforeSend: function() {
                   
                   $("#guardar_bien_formato_registros").attr("disabled",true);
                   console.log("desabilitar");
               },
               success: function(json) {  
                    grid_bienes.refresh();
                    dialogObj_bien_formato_registros.hide();
                    toastObj.show(toasts[1]);
                   document.getElementById("form_bien_formato_registros").reset();
                   $("#guardar_bien_formato_registros").attr("disabled",false);
                    id_bien_crud="autogenerado";//ID 
                    //codigo_bien_menor="";                  
                   
               },
               error: function(resp) {
                   alert(resp);
               }
            }); 
          }    
        };  
        //fin boton guardar
        
        
    }  
    
    
function isValidDate(dateString)
{
    // revisar el patrón
    if(!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(dateString))
        return false;

    // convertir los numeros a enteros
    var parts = dateString.split("/");
    var day = parseInt(parts[2], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[0], 10);

    // Revisar los rangos de año y mes
    if( (year < 1000) || (year > 3000) || (month == 0) || (month > 12) )
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Ajustar para los años bisiestos
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Revisar el rango del dia
    return day > 0 && day <= monthLength[month - 1];
};
   