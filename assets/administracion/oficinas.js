    //CODIGO PARA DIRECTORES
    
    var id_oficina_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
     
    ///---------CODIGO PARA ACTORES-------///    
    var data_locales = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/oficinas/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
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
    
    var data_locales_in_oficinas2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_areas_in_oficinas2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/areas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var clickHandler_oficina = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_oficina.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/oficinas/form_",dialogObj_oficina,dibujar_elementos_synfusion_oficina);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_oficina_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_oficina.show();               
               ajax_content_all(2,"administracion/oficinas/form_",dialogObj_oficina,dibujar_elementos_synfusion_oficina,"administracion/oficinas/datos_json",id_oficina_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_oficina_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_eliminar_oficina.show();
              }
        }
    };  
    
    var grid_oficinas = new ej.grids.Grid({//GRILLA proveedor
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
        toolbarClick: clickHandler_oficina,
        columns: [           
            {
                field: 'idoficina', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 30
            },
            {
                field: 'descripcion', headerText: 'OFICINA',
                validationRules: { required: true },width: 200
            }, 
            {
                field: 'area_idarea', headerText: 'area_idarea',
                validationRules: { required: true },width: 80,visible:false
            },
            {
                field: 'idlocales', headerText: 'idlocales',
                validationRules: { required: true },width: 80,visible:false
            }
        ],
    });
    grid_oficinas.appendTo('#grid_oficinas');
    
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_local(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_oficina_crud=grid_oficinas.getSelectedRecords()[0].idoficina;
      
    } 
    
        //combos
    var locales_in_oficinas = new ej.dropdowns.DropDownList({
        dataSource: data_locales_in_oficinas,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',       
       // popupHeight: '350px',
        change: function () {
                 
                // disable the state DropDownList
                areas_in_oficinas.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', locales_in_oficinas.value);
                // set the framed query based on selected value in country DropDownList.
                areas_in_oficinas.query = tempQuery;
                // set null value to state DropDownList text property
                areas_in_oficinas.text = null;
                // bind the property changes to state DropDownList
                areas_in_oficinas.dataBind();
                // set null value to city DropDownList text property
                grid_oficinas.filterByColumn("idlocales", 'equal', locales_in_oficinas.value);   
            
        } ,        
       
        fields: { value: 'idlocales', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    locales_in_oficinas.appendTo('#locales_in_oficinas'); 
    var areas_in_oficinas = new ej.dropdowns.DropDownList({
        dataSource: data_areas_in_oficinas,
        popupHeight: '400px',
        popupWidth: '300px',
        enabled: false,
        placeholder: 'Seleccione una estado de bien',

        fields: { value: 'idarea', text: 'descripcion' },
        change: function () {
            grid_oficinas.filterByColumn("area_idarea", 'equal', areas_in_oficinas.value);
        },
    });
    areas_in_oficinas.appendTo('#areas_in_oficinas');
        
    var guardar_oficina_modal = new ej.buttons.Button({});
    var iconTemp_oficina = '<button id="guardar_oficina_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg_oficina = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
       
    var dialogObj_oficina = new ej.popups.Dialog({
            footerTemplate:  iconTemp_oficina,
            header: headerImg_oficina + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
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
    dialogObj_oficina.appendTo('#dialogObj_oficina');
   
   
   
   
   
    var confirmDialogObj_eliminar_oficina = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes_eliminar_oficina,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_eliminar_oficina, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_eliminar_oficina.appendTo('#confirmDialogObj_eliminar_oficina');    
    function confirmDlgBtnClickYes_eliminar_oficina() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/oficinas/eliminar/"+id_oficina_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_oficina_crud="autogenerado";
                     grid_oficinas.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_eliminar_oficina.hide();
    }
    function confirmDlgBtnClickNo_eliminar_oficina() {       
        confirmDialogObj_eliminar_oficina.hide();
    }


   
   function dibujar_elementos_synfusion_oficina(){ 
       
             //combos
    var local_combo_in_area = new ej.dropdowns.DropDownList({
        dataSource: data_locales_in_oficinas2,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        value:$("#idlocal_in_of").val(),
        change: function () {
                // disable the state DropDownList
                area_combo_in_oficina.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', local_combo_in_area.value);
                // set the framed query based on selected value in country DropDownList.
                area_combo_in_oficina.query = tempQuery;
                // set null value to state DropDownList text property
                area_combo_in_oficina.text = null;
                // bind the property changes to state DropDownList
                area_combo_in_oficina.dataBind();
                // set null value to city DropDownList text property
                 
            
        } ,
        fields: { value: 'idlocales', text: 'descripcion' },
         actionComplete : function (args) 
        {            
            console.log("codigo:::"+$("#idarea_in_of").val());
            if($("#idarea_in_of").val()!=""){  
                
                // disable the state DropDownList
                area_combo_in_oficina.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', local_combo_in_area.value);
                // set the framed query based on selected value in country DropDownList.
                area_combo_in_oficina.query = tempQuery;
                // set null value to state DropDownList text property                    
                area_combo_in_oficina.text = null;                    
                // bind the property changes to state DropDownList
                area_combo_in_oficina.dataBind();
                area_combo_in_oficina.value=$("#idarea_in_of").val();                   
            }                
        }, 
        //placeholder: 'Seleccione un director',  
    });
    local_combo_in_area.appendTo('#local_combo_in_area');
    
    var area_combo_in_oficina = new ej.dropdowns.DropDownList({
        dataSource: data_areas_in_oficinas2,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idarea', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    area_combo_in_oficina.appendTo('#area_combo_in_oficina');
    
    /*function filter_locales_in_areas(args) { 
         grid_areas.filterByColumn("locales_idlocales", 'equal', args.itemData.idlocales);    
    } */
    
       
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'nombre_oficina': {
                    required: true
                },
                'local_combo_in_area': {
                    required: true
                },
                'area_combo_in_oficina': {
                    required: true
                },
               
            }
        };
     var formProveedorObj = new ej.inputs.FormValidator('#form_oficina', options);      
     document.getElementById('guardar_oficina_modal').onclick = function () { 
        if (formProveedorObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_oficina').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/oficinas/guardar",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_oficina_crud="autogenerado";
                   grid_oficinas.refresh();
                   dialogObj_oficina.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  

