    //CODIGO PARA DIRECTORES
    
    var id_empleado_as_oficina_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
     
    ///---------CODIGO PARA ACTORES-------///    
    var data_empleados_as_oficinas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/empleados_as_oficina/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   var data_locales_in_oficinas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/combo2",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_areas_in_oficinas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/areas/combo2",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    
    var datao_oficinas_in_empleados_as_ofi = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/oficinas/combo2",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_locales_in_empleados_as_ofi2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_areas_in_empleados_as_ofi2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/areas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_oficinas_in_empleados_as_ofi2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/oficinas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_empleados_in_empleados_as_ofi2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/empleados/set_registros_combo_",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var clickHandler_empleados_as_oficina = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_empleado_as_oficina.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/empleados_as_oficina/form_",dialogObj_empleado_as_oficina,dibujar_elementos_synfusion_empleado_as_oficina);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_empleado_as_oficina_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_empleado_as_oficina.show();               
               ajax_content_all(2,"administracion/empleados_as_oficina/form_",dialogObj_empleado_as_oficina,dibujar_elementos_synfusion_empleado_as_oficina,"administracion/empleados_as_oficina/datos_json",id_empleado_as_oficina_crud);      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_empleado_as_oficina_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_eliminar_empleado_as_ofi.show();
              }
        }
    };  
    
    var grid_empleados_as_oficina = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_empleados_as_oficinas,
        rowSelected: rowSelected_empleados_as_oficina,
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
        toolbarClick: clickHandler_empleados_as_oficina,
        columns: [           
            {
                field: 'idempleado_oficina', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 30
            },
            {
                field: 'apellidos', headerText: 'APELLIDOS',
                validationRules: { required: true },width: 200
            }, 
            {
                field: 'nombres', headerText: 'NOMBRES',
                validationRules: { required: true },width: 200
            }, 
            {
                field: 'condicion', headerText: 'CONDICION',
                validationRules: { required: true },width: 200
            },
            {
                field: 'cargo', headerText: 'CARGO',
                validationRules: { required: true },width: 200
            },
             {
                field: 'idlocales', headerText: 'idlocales',
                validationRules: { required: true },width: 80,visible:false
            },
            {
                field: 'idarea', headerText: 'idarea',
                validationRules: { required: true },width: 80,visible:false
            },
            {
                field: 'idempleado', headerText: 'idempleado',
                validationRules: { required: true },width: 80,visible:false
            },
            {
                field: 'idoficina', headerText: 'idoficina',
                validationRules: { required: true },width: 80,visible:false
            }
        ],
    });
    grid_empleados_as_oficina.appendTo('#grid_empleados_as_oficina');
    
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_empleados_as_oficina(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_empleado_as_oficina_crud=grid_empleados_as_oficina.getSelectedRecords()[0].idempleado_oficina;
      
    } 
    
        //combos
    var locales_in_empleados_as_ofi = new ej.dropdowns.DropDownList({
        dataSource: data_locales_in_oficinas,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',       
       // popupHeight: '350px',
        change: function () {
                 
                // disable the state DropDownList
                areas_in_empleados_as_ofi.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', locales_in_empleados_as_ofi.value);
                // set the framed query based on selected value in country DropDownList.
                areas_in_empleados_as_ofi.query = tempQuery;
                // set null value to state DropDownList text property
                areas_in_empleados_as_ofi.text = null;
                // bind the property changes to state DropDownList
                areas_in_empleados_as_ofi.dataBind();
                // set null value to city DropDownList text property
                // 
                oficinas_in_empleas_as_of.text = null;
                // disable the city DropDownList
                oficinas_in_empleas_as_of.enabled = false;
                // bind the property changes to City DropDownList
                oficinas_in_empleas_as_of.dataBind();
                grid_empleados_as_oficina.filterByColumn("idlocales", 'equal', locales_in_empleados_as_ofi.value);   
               
        } ,        
       
        fields: { value: 'idlocales', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    locales_in_empleados_as_ofi.appendTo('#locales_in_empleados_as_ofi'); 
    var areas_in_empleados_as_ofi = new ej.dropdowns.DropDownList({
        dataSource: data_areas_in_oficinas,
        popupHeight: '400px',
        popupWidth: '300px',
        enabled: false,
        placeholder: 'Seleccione una Area',

        fields: { value: 'idarea', text: 'descripcion' },
        change: function () {
             // enable the city DropDownList
                oficinas_in_empleas_as_of.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idarea', 'equal', areas_in_empleados_as_ofi.value);
                // set the framed query based on selected value in city DropDownList.
                oficinas_in_empleas_as_of.query = tempQuery1;
                //clear the existing selection
                oficinas_in_empleas_as_of.text = null;
                // bind the property change to city DropDownList
                oficinas_in_empleas_as_of.dataBind();
                grid_empleados_as_oficina.filterByColumn("idarea", 'equal', areas_in_empleados_as_ofi.value);
       
        },
    });
    areas_in_empleados_as_ofi.appendTo('#areas_in_empleados_as_ofi');
    
    
    var oficinas_in_empleas_as_of = new ej.dropdowns.DropDownList({
        dataSource: datao_oficinas_in_empleados_as_ofi,
        popupHeight: '400px',
        popupWidth: '300px',
        enabled: false,
        placeholder: 'Seleccione una Oficina',

        fields: { value: 'idoficina', text: 'descripcion' },
        change: function () {
            grid_empleados_as_oficina.filterByColumn("idoficina", 'equal', oficinas_in_empleas_as_of.value);
        },
    });
    oficinas_in_empleas_as_of.appendTo('#oficinas_in_empleas_as_of');
    
    var guardar_empleado_as_oficina_modal = new ej.buttons.Button({});
    var iconTemp_empleado_as_oficina = '<button id="guardar_empleado_as_oficina_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg_empleado_as_oficina = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
       
    var dialogObj_empleado_as_oficina = new ej.popups.Dialog({
            footerTemplate:  iconTemp_empleado_as_oficina,
            header: headerImg_empleado_as_oficina + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
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
    dialogObj_empleado_as_oficina.appendTo('#dialogObj_empleado_as_oficina');
   
   
   
   
   
    var confirmDialogObj_eliminar_empleado_as_ofi = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes_eliminar_empleado_as_ofi,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_eliminar_empleado_as_ofi, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_eliminar_empleado_as_ofi.appendTo('#confirmDialogObj_eliminar_empleado_as_ofi');    
    function confirmDlgBtnClickYes_eliminar_empleado_as_ofi() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/empleados_as_oficina/eliminar/"+id_empleado_as_oficina_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_empleado_as_oficina_crud="autogenerado";
                     grid_empleados_as_oficina.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_eliminar_empleado_as_ofi.hide();
    }
    function confirmDlgBtnClickNo_eliminar_empleado_as_ofi() {       
        confirmDialogObj_eliminar_empleado_as_ofi.hide();
    }


   
   function dibujar_elementos_synfusion_empleado_as_oficina(){ 
       
             //combos
    var local_combo_in_empleado_as_ofi = new ej.dropdowns.DropDownList({
        dataSource: data_locales_in_empleados_as_ofi2,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        value:$("#idlocal_in_emp_as_of").val(),
        change: function () {
                // disable the state DropDownList
                area_combo_in_empleado_as_ofi.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', local_combo_in_empleado_as_ofi.value);
                // set the framed query based on selected value in country DropDownList.
                area_combo_in_empleado_as_ofi.query = tempQuery;
                // set null value to state DropDownList text property
                area_combo_in_empleado_as_ofi.text = null;
                // bind the property changes to state DropDownList
                area_combo_in_empleado_as_ofi.dataBind();
                // set null value to city DropDownList text property
                // set null value to city DropDownList text property
                oficina_combo_in_empleado_as_ofi.text = null;
                // disable the city DropDownList
                oficina_combo_in_empleado_as_ofi.enabled = false;
                // bind the property changes to City DropDownList
                oficina_combo_in_empleado_as_ofi.dataBind();
                 
            
        } ,
        fields: { value: 'idlocales', text: 'descripcion' },
         actionComplete : function (args) 
            {
               
                if($("#idarea_in_emp_as_of").val()!=""){ 
                    // disable the state DropDownList
                    area_combo_in_empleado_as_ofi.enabled = true;
                    // frame the query based on selected value in country DropDownList.
                    var tempQuery = new ej.data.Query().where('idlocales', 'equal', local_combo_in_empleado_as_ofi.value);
                    // set the framed query based on selected value in country DropDownList.
                    area_combo_in_empleado_as_ofi.query = tempQuery;
                    // set null value to state DropDownList text property
                    
                    area_combo_in_empleado_as_ofi.text = null;
                    
                    // bind the property changes to state DropDownList
                    area_combo_in_empleado_as_ofi.dataBind();
                    area_combo_in_empleado_as_ofi.value=$("#idarea_in_emp_as_of").val();
                    
                    oficina_combo_in_empleado_as_ofi.enabled = true;
                    // Query the data source based on state DropDownList selected value
                    var tempQuery1 = new ej.data.Query().where('idarea', 'equal', area_combo_in_empleado_as_ofi.value);
                    // set the framed query based on selected value in city DropDownList.
                    oficina_combo_in_empleado_as_ofi.query = tempQuery1;
                    //clear the existing selection
                    oficina_combo_in_empleado_as_ofi.text = null;
                    // bind the property change to city DropDownList
                    oficina_combo_in_empleado_as_ofi.dataBind();
                    oficina_combo_in_empleado_as_ofi.value=$("#idoficina_in_emp_as_of").val();
                    
                    
                
                   
                }
                
            }, 
        //placeholder: 'Seleccione un director',  
    });
    local_combo_in_empleado_as_ofi.appendTo('#local_combo_in_empleado_as_ofi');
    
    var area_combo_in_empleado_as_ofi = new ej.dropdowns.DropDownList({
        dataSource: data_areas_in_empleados_as_ofi2,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idarea', text: 'descripcion' }  ,
        change: function () {
                // enable the city DropDownList
                oficina_combo_in_empleado_as_ofi.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idarea', 'equal', area_combo_in_empleado_as_ofi.value);
                // set the framed query based on selected value in city DropDownList.
                oficina_combo_in_empleado_as_ofi.query = tempQuery1;
                //clear the existing selection
                oficina_combo_in_empleado_as_ofi.text = null;
                // bind the property change to city DropDownList
                oficina_combo_in_empleado_as_ofi.dataBind();
                 // set null value to city DropDownList text property               
        },
        
        //placeholder: 'Seleccione un director',  
    });
    area_combo_in_empleado_as_ofi.appendTo('#area_combo_in_empleado_as_ofi');
    
    
    var oficina_combo_in_empleado_as_ofi = new ej.dropdowns.DropDownList({
        dataSource: data_oficinas_in_empleados_as_ofi2,
        popupHeight: '200px',
        placeholder: 'Seleccione un oficina',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idoficina', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    oficina_combo_in_empleado_as_ofi.appendTo('#oficina_combo_in_empleado_as_ofi');
    
    var empleado_combo_in_empleado_as_ofi = new ej.dropdowns.DropDownList({
        dataSource: data_empleados_in_empleados_as_ofi2,
        popupHeight: '250px',
        placeholder: 'Seleccione un empleado',
        filterBarPlaceholder: 'Buscar',
        allowFiltering: true,
        // bind the filtering event
        
        value:$("#idempleado_in_emp_as_of").val(),
      
        fields: { value: 'idempleado', text: 'descripcion' } ,
        filtering: function (e) {
            var dropdown_query = new ej.data.Query();
            // frame the query based on search string with filter type.
            dropdown_query = (e.text !== '') ? dropdown_query.where('descripcion', 'equal', e.text, true) : dropdown_query;
            // pass the filter data source, filter query to updateData method.
            e.updateData(data_empleados_in_empleados_as_ofi2, dropdown_query);
        },
         
        //placeholder: 'Seleccione un director',  
    });
    empleado_combo_in_empleado_as_ofi.appendTo('#empleado_combo_in_empleado_as_ofi');
    
    
    /*function filter_locales_in_areas(args) { 
         grid_areas.filterByColumn("locales_idlocales", 'equal', args.itemData.idlocales);    
    } */
    
       
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'local_combo_in_empleado_as_ofi': {
                    required: true
                },
                'area_combo_in_empleado_as_ofi': {
                    required: true
                },
                'oficina_combo_in_empleado_as_ofi': {
                    required: true
                },
                'empleado_combo_in_empleado_as_ofi': {
                    required: true
                },
                'cargo_empleado_as_ofi': {
                    required: true
                },
               
            }
        };
     var formProveedorObj = new ej.inputs.FormValidator('#form_empleado_as_oficina', options);      
     document.getElementById('guardar_empleado_as_oficina_modal').onclick = function () { 
        if (formProveedorObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_empleado_as_oficina').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/empleados_as_oficina/guardar",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_empleado_as_oficina_crud="autogenerado";
                   grid_empleados_as_oficina.refresh();
                   dialogObj_empleado_as_oficina.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  

