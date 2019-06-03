    //CODIGO PARA DIRECTORES
    
    var id_desplazamiento_de_bien_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
     
    ///---------CODIGO PARA ACTORES-------///    
    var data_desplazamiento_de_bienes = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/desplazamiento_de_bienes/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   var data_md = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/motivo_desplazamiento/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_locales_despl2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    
     var data_areas_despl2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/areas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_oficinas_despl2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/oficinas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_empleados_despl2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/empleados_as_oficina/set_registros_combo_",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    
    var clickHandler_db = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_desplazamiento.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/desplazamiento_de_bienes/form_",dialogObj_desplazamiento,dibujar_elementos_synfusion_local);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_desplazamiento_de_bien_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_local.show();               
               ajax_content_all(2,"administracion/locales/form_",dialogObj_local,dibujar_elementos_synfusion_local,"administracion/locales/datos_json",id_local_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_desplazamiento_de_bien_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_eliminar_db.show();
              }
        }
        if (args.item.id === "print_") {
              if(id_desplazamiento_de_bien_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                dialogObj_reportes.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR                            
                dialogObj_reportes.setProperties ({content: '<iframe width="100%" height="900" src="'+base_url+"administracion/reportes/re_papeleta/"+id_desplazamiento_de_bien_crud+'"></iframe>'});   
      
              }
        }
    };  
    
    var grid_desplazamiento_de_bienes = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_desplazamiento_de_bienes,
        rowSelected: rowSelected_db,
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
          
            { text: 'Eliminar', tooltipText: 'Eliminar ', prefixIcon: 'e-delete', id: 'eliminar_' },
            { text: 'Imprimir', tooltipText: 'Imprimir', prefixIcon: 'e-print', id: 'print_' }
        ],       
        toolbarClick: clickHandler_db,
        columns: [           
            {
                field: 'anio', isPrimaryKey: true, headerText: 'AÑO', textAlign: 'Right',
                validationRules: { required: true }, width: 30
            },
            {
                field: 'iddesplazamiento_bien', headerText: 'N° PAPELETA',
                validationRules: { required: true },width: 200
            },                    
            {
                field: 'fecha', headerText: 'FECHA',
                validationRules: { required: true },width: 120
            },
             {
                field: 'motivo', headerText: 'MOTIVO',
                validationRules: { required: true },width: 120
            }
        ],
    });
    grid_desplazamiento_de_bienes.appendTo('#grid_desplazamiento_de_bienes');
    
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_db(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_desplazamiento_de_bien_crud=grid_desplazamiento_de_bienes.getSelectedRecords()[0].iddesplazamiento_bien;
      
    } 
    
    
    
            
   
    var guardar_desplazamiento_modal = new ej.buttons.Button({});
    var iconTemp_desplazamiento = '<button id="guardar_desplazamiento_modal" ></button>';
    var headerImg_desplazamiento = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
       
    var dialogObj_desplazamiento = new ej.popups.Dialog({
            footerTemplate:  iconTemp_desplazamiento,
            header: headerImg_desplazamiento + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
            content: '',
            showCloseIcon: true,
            target: document.getElementById('target'),
            width: '80%',
           
            content: "",
            isModal: true,
          //  open: dialogOpen,
           // close: dialogClose,
            visible: false,
           // height: '%',
           
    });
    dialogObj_desplazamiento.appendTo('#dialogObj_desplazamiento');
   
   guardar_desplazamiento_modal = new ej.splitbuttons.ProgressButton({
                        content: 'Guardar', enableProgress: true, animationSettings: { effect: 'SlideRight' },
                        spinSettings: { position: 'Center' }, cssClass: 'e-outline e-primary'
                    });
    guardar_desplazamiento_modal.appendTo('#guardar_desplazamiento_modal');
   
   
   
      var confirmDialogObj_eliminar_db = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes_eliminar_db,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_eliminar_db, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_eliminar_db.appendTo('#confirmDialogObj_eliminar_db');    
    function confirmDlgBtnClickYes_eliminar_db() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/desplazamiento_de_bienes/eliminar/"+id_desplazamiento_de_bien_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_desplazamiento_de_bien_crud="autogenerado";
                     grid_desplazamiento_de_bienes.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_eliminar_db.hide();
    }
    function confirmDlgBtnClickNo_eliminar_db() {       
        confirmDialogObj_eliminar_db.hide();
    }


   
   function dibujar_elementos_synfusion_local(){  
      //if($("#fecha_adquisicion_bien").val()==""){
           fecha_ad = new Date(); 
       /*}else{
           var d=Date.parse($("#fecha_adquisicion_bien").val());
          fecha_ad = new Date(d);
       }  */
       $('input[name="fecha_des"]').mask('0000-00-00');
       var fecha_des = new ej.calendars.DatePicker({
            format: 'yyyy-MM-dd',
           
            value: fecha_ad,
            showTooltip: true, //show tooltip on hovering date on DatePicker calendar
            enableStrictMode: false, //sets active strict mode
            tooltipFormat: "yy/MM/dd"// sets tooltip for dates in DatePicker calendar
         });
        fecha_des.appendTo('#fecha_des');
      
    var motivo_desplazamiento_combo = new ej.dropdowns.DropDownList({
        dataSource: data_md,
        popupHeight: '250px',
        placeholder: 'Seleccione un motivo',                 
       // value:$("#idempleado_in_emp_as_of").val(),      
        fields: { value: 'idmotivo_desplazamiento', text: 'descripcion' } ,  
    });
    motivo_desplazamiento_combo.appendTo('#motivo_desplazamiento_combo');
    
    
        var combo_locales_despl = new ej.dropdowns.DropDownList({
        dataSource: data_locales_despl2,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        value:$("#idlocal_in_emp_as_of").val(),
        change: function () {
                // disable the state DropDownList
                combo_areas_despl.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', combo_locales_despl.value);
                // set the framed query based on selected value in country DropDownList.
                combo_areas_despl.query = tempQuery;
                // set null value to state DropDownList text property
                combo_areas_despl.text = null;
                // bind the property changes to state DropDownList
                combo_areas_despl.dataBind();
                // set null value to city DropDownList text property
                combo_oficinas_despl.text = null;
                // disable the city DropDownList
                combo_oficinas_despl.enabled = false;
                // bind the property changes to City DropDownList
                combo_oficinas_despl.dataBind();
                // set null value to city DropDownList text property
                combo_empleado_despl.text = null;
                // disable the city DropDownList
                combo_empleado_despl.enabled = false;
                // bind the property changes to City DropDownList
                combo_empleado_despl.dataBind();
                 
            
        } ,
        fields: { value: 'idlocales', text: 'descripcion' },
         
                
           
        //placeholder: 'Seleccione un director',  
    });
    combo_locales_despl.appendTo('#combo_locales_despl');
    
    var combo_areas_despl = new ej.dropdowns.DropDownList({
        dataSource: data_areas_despl2,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idarea', text: 'descripcion' }  ,
        change: function () {
               // enable the city DropDownList
                combo_oficinas_despl.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idarea', 'equal', combo_areas_despl.value);
                // set the framed query based on selected value in city DropDownList.
                combo_oficinas_despl.query = tempQuery1;
                //clear the existing selection
                combo_oficinas_despl.text = null;
                // bind the property change to city DropDownList
                combo_oficinas_despl.dataBind();
                 // set null value to city DropDownList text property
                combo_empleado_despl.text = null;
                // disable the city DropDownList
                combo_empleado_despl.enabled = false;
                // bind the property changes to City DropDownList
                combo_empleado_despl.dataBind();            
        },        
        //placeholder: 'Seleccione un director',  
    });
    combo_areas_despl.appendTo('#combo_areas_despl');
    var combo_oficinas_despl = new ej.dropdowns.DropDownList({
        dataSource: data_oficinas_despl2,
        popupHeight: '200px',
        placeholder: 'Seleccione un oficina',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idoficina', text: 'descripcion' },
        change: function () {
                // enable the city DropDownList
                combo_empleado_despl.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idoficina', 'equal', combo_oficinas_despl.value);
                // set the framed query based on selected value in city DropDownList.
                combo_empleado_despl.query = tempQuery1;
                //clear the existing selection
                combo_empleado_despl.text = null;
                // bind the property change to city DropDownList
                combo_empleado_despl.dataBind();
                dibujar_grilla("no",combo_oficinas_despl.value);
                
            
            },
        //placeholder: 'Seleccione un director',  
    });
    combo_oficinas_despl.appendTo('#combo_oficinas_despl');
    
    var combo_empleado_despl = new ej.dropdowns.DropDownList({
        dataSource: data_empleados_despl2,
        popupHeight: '250px',
        placeholder: 'Seleccione un empleado',
        filterBarPlaceholder: 'Buscar',
        allowFiltering: true,
         enabled: false,
         change: function () {
             dibujar_grilla(combo_empleado_despl.value,"no");
         },
        // bind the filtering event
        
       // value:$("#idempleado_in_emp_as_of").val(),
      
        fields: { value: 'idempleado_oficina', text: 'descripcion' } , 
      
         
        //placeholder: 'Seleccione un director',  
    });
    combo_empleado_despl.appendTo('#combo_empleado_despl');
    
    //para destino
    
    
    
    
    
     var combo_locales_despl_des = new ej.dropdowns.DropDownList({
        dataSource: data_locales_despl2,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        value:$("#idlocal_in_emp_as_of").val(),
        change: function () {
                // disable the state DropDownList
                combo_areas_despl_des.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', combo_locales_despl_des.value);
                // set the framed query based on selected value in country DropDownList.
                combo_areas_despl_des.query = tempQuery;
                // set null value to state DropDownList text property
                combo_areas_despl_des.text = null;
                // bind the property changes to state DropDownList
                combo_areas_despl_des.dataBind();
                // set null value to city DropDownList text property
                combo_oficinas_despl_des.text = null;
                // disable the city DropDownList
                combo_oficinas_despl_des.enabled = false;
                // bind the property changes to City DropDownList
                combo_oficinas_despl_des.dataBind();
                // set null value to city DropDownList text property
                combo_empleado_despl_des.text = null;
                // disable the city DropDownList
                combo_empleado_despl_des.enabled = false;
                // bind the property changes to City DropDownList
                combo_empleado_despl_des.dataBind();
                 
            
        } ,
        fields: { value: 'idlocales', text: 'descripcion' },
         
                
           
        //placeholder: 'Seleccione un director',  
    });
    combo_locales_despl_des.appendTo('#combo_locales_despl_des');
    
    var combo_areas_despl_des = new ej.dropdowns.DropDownList({
        dataSource: data_areas_despl2,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idarea', text: 'descripcion' }  ,
        change: function () {
               // enable the city DropDownList
                combo_oficinas_despl_des.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idarea', 'equal', combo_areas_despl_des.value);
                // set the framed query based on selected value in city DropDownList.
                combo_oficinas_despl_des.query = tempQuery1;
                //clear the existing selection
                combo_oficinas_despl_des.text = null;
                // bind the property change to city DropDownList
                combo_oficinas_despl_des.dataBind();
                 // set null value to city DropDownList text property
                combo_empleado_despl_des.text = null;
                // disable the city DropDownList
                combo_empleado_despl_des.enabled = false;
                // bind the property changes to City DropDownList
                combo_empleado_despl_des.dataBind();            
        },        
        //placeholder: 'Seleccione un director',  
    });
    combo_areas_despl_des.appendTo('#combo_areas_despl_des');
    var combo_oficinas_despl_des = new ej.dropdowns.DropDownList({
        dataSource: data_oficinas_despl2,
        popupHeight: '200px',
        placeholder: 'Seleccione un oficina',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idoficina', text: 'descripcion' },
        change: function () {
                // enable the city DropDownList
                combo_empleado_despl_des.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idoficina', 'equal', combo_oficinas_despl_des.value);
                // set the framed query based on selected value in city DropDownList.
                combo_empleado_despl_des.query = tempQuery1;
                //clear the existing selection
                combo_empleado_despl_des.text = null;
                // bind the property change to city DropDownList
                combo_empleado_despl_des.dataBind();
               
                
            
            },
        //placeholder: 'Seleccione un director',  
    });
    combo_oficinas_despl_des.appendTo('#combo_oficinas_despl_des');
    
    var combo_empleado_despl_des = new ej.dropdowns.DropDownList({
        dataSource: data_empleados_despl2,
        popupHeight: '250px',
        placeholder: 'Seleccione un empleado',
        filterBarPlaceholder: 'Buscar',
        allowFiltering: true,
         enabled: false,
         change: function () {
             //dibujar_grilla(combo_empleado_despl.value,"no");
         },
        // bind the filtering event
        
       // value:$("#idempleado_in_emp_as_of").val(),
      
        fields: { value: 'idempleado_oficina', text: 'descripcion' } , 
      
         
        //placeholder: 'Seleccione un director',  
    });
    combo_empleado_despl_des.appendTo('#combo_empleado_despl_des');
    
    /*var data_locales = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/bienes/leerRegistro_",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    }); */
 var ii=1;
 var Grid_origen_=""; 
  var  Grid_destino_="";
    function dibujar_grilla(id_empleado_ofi,idoficina_){
        
        
         $.ajax({
                type: 'post',
                url: base_url+"administracion/bienes/leerRegistro_/"+id_empleado_ofi+"/"+idoficina_,
                //cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) { 
                      var data_or=json;
                     // var gridObj = $("#Grid_origen").data("ejGrid");
                      // Grid_origen.data("ejGrid").dataSource(json); 
                      // $("#Grid_origen").ejGrid("dataSource", json); 
                      // grilllas
                      // 
                      $("#grilllas").html("");
                $("#grilllas").html(' <div id="Grid_origen">  </div><div id="Grid_destino"></div>'); 
// $("#Grid_origen").html(""); 
            //  $("#Grid_destino").html("");
             /*  Grid_origen_="Grid_origen"+ii;
              var Grid_destino_="Grid_destino_"+ii;*/
             Grid_origen_ = new ej.grids.Grid({
                 dataSource: json,
                 allowPaging: true,
                 allowRowDragAndDrop: true,
                 selectionSettings: { type: 'Multiple' },
                 rowDropSettings: { targetID: 'Grid_destino' },
                 pageSettings: { pageCount: 2 },
                 width: '49%',
                 columns: [
                     { field: 'codigo_interno', headerText: 'CODIGO ', width: 120, textAlign: 'Right' },
                     { field: 'descripcion', headerText: 'DESCRIPCIOIN', width: 135 },

                    ]
             });
             Grid_origen_.appendTo('#Grid_origen');
                     
              Grid_destino_ = new ej.grids.Grid({
                dataSource: [],
                allowPaging: true,
                allowRowDragAndDrop: true,
                selectionSettings: { type: 'Multiple' },
                rowDropSettings: { targetID: 'Grid_origen' },
                pageSettings: { pageCount: 2 },
                width: '49%',
                columns: [
                    { field: 'codigo_interno', headerText: 'CODIGO ', width: 120, textAlign: 'Right' },
                    { field: 'descripcion', headerText: 'DESCRIPCIOIN', width: 135 },

                   ]
            });
            Grid_destino_.appendTo('#Grid_destino');
           
                   // ii++;
                
                    /* var data=[
         {idformato_registro_bien: "4", codigo_interno: "042204310001", descripcion: "ARADOS EN GENERAL"},
        {idformato_registro_bien: "3", codigo_interno: "673603950002", descripcion: "ASCENSOR"},
       {idformato_registro_bien: "2", codigo_interno: "042213830001", descripcion: "CARTOSCOPIO"},
       {idformato_registro_bien: "1", codigo_interno: "673603950001", descripcion: "ASCENSOR"}];*/
       
                     
    
                },
                error: function(resp) {
                    alert(resp);
                }
            });  
    }
    /**/
 
    
       
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.fv').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
              'combo_locales_despl': {
                    required: true
                },
                'combo_areas_despl': {
                    required: true
                },
                'combo_oficinas_despl': {
                    required: true
                    },
                    
                  'combo_locales_despl_des': {
                    required: true
                },
                'combo_areas_despl_des': {
                    required: true
                },
                'combo_oficinas_despl_des': {
                    required: true
                    },  
                'motivo_desplazamiento_combo': {
                    required: true
                },
                  'fecha_des': {
                    required: true
                },
                  'anio_des': {
                    required: true
                },
               
            }
        };
     var formProveedorObj = new ej.inputs.FormValidator('#form_desplazamiento', options);      
     document.getElementById('guardar_desplazamiento_modal').onclick = function () {
        
        if (formProveedorObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_desplazamiento').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });         
            console.log(Grid_destino_.currentViewData);
            console.log("total::"+Grid_destino_.currentViewData.length);
            //Custom data
            data.append('key', 'value');
             data.append('bienes', str = JSON.stringify(Grid_destino_.currentViewData));
           if(Grid_destino_.currentViewData.length!=0) {
                $.ajax({
                type: 'post',
                url: base_url+"administracion/desplazamiento_de_bienes/guardar",
                processData: false,
                contentType: false,
                data: data,
                beforeSend: function() {
                },
                success: function(json) {                                 
                     id_desplazamiento_de_bien_crud="autogenerado";
                     grid_desplazamiento_de_bienes.refresh();
                     dialogObj_desplazamiento.hide();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
             });  
           }else{
               alert("almenos debe desplazar un bien");
           }  
          
          }
        };   
    }  



