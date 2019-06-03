    //CODIGO PARA DIRECTORES
    
    var id_area_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
     
    ///---------CODIGO PARA ACTORES-------///    
    var data_locales = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/areas/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   var data_locales_in_areas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_locales_in_areas2 = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/combo2",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var clickHandler_area = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_area.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/areas/form_",dialogObj_area,dibujar_elementos_synfusion_area);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_area_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_area.show();               
               ajax_content_all(2,"administracion/areas/form_",dialogObj_area,dibujar_elementos_synfusion_area,"administracion/areas/datos_json",id_area_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_area_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj_eliminar_area.show();
              }
        }
    };  
    
    var grid_areas = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_locales,
        rowSelected: rowSelected_local,
        editSettings: { 
           llowEditOnDblClick: false
        },
        height:600,
        allowPaging: true,
        allowFiltering: true,
        allowSorting : true,
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
        toolbarClick: clickHandler_area,
        columns: [           
            {
                field: 'idarea', isPrimaryKey: true, headerText: 'ID', headerTextAlign : 'center', textAlign : 'center',
                validationRules: { required: true }, width: 30
            },
            {
                field: 'descripcion', headerText: 'LOCAL',
                validationRules: { required: true },width: 200
            },                    
            {
                field: 'abre', headerText: 'ABRE', 
                validationRules: { required: true },width: 120
            },
            {
                field: 'locales_idlocales', headerText: 'idlocales', 
                validationRules: { required: true },width: 120,visible:false
            } 
        ],
    });
    grid_areas.appendTo('#grid_areas');
    
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_local(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_area_crud=grid_areas.getSelectedRecords()[0].idarea;
      
    } 
    
        //combos
    var locales_in_areas = new ej.dropdowns.DropDownList({
        dataSource: data_locales_in_areas2,
        popupHeight: '150px',
        placeholder: 'Seleccione un local',
        //floatLabelType: 'Auto', 
        //value:direcotr_pelicula_id_var,
       // popupHeight: '350px',
        change: filter_locales_in_areas, 
        value:'9999',
        fields: { value: 'idlocales', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    locales_in_areas.appendTo('#locales_in_areas');
    function filter_locales_in_areas(args) { 
         grid_areas.filterByColumn("locales_idlocales", 'equal', args.itemData.idlocales);    
    } 
   
    var guardar_area_modal = new ej.buttons.Button({});
    var iconTemp_area = '<button id="guardar_area_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg_area = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
       
    var dialogObj_area = new ej.popups.Dialog({
            footerTemplate:  iconTemp_area,
            header: headerImg_area + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO DE AREAS </div>',
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
    dialogObj_area.appendTo('#dialogObj_area');
   
   
   
   
   
      var confirmDialogObj_eliminar_area = new ej.popups.Dialog({//ventan de confirmacion de eliminacion para actores
        header: 'Eliminar registro',
        visible: false,
        content: confirmContent,
        showCloseIcon: true,
        closeOnEscape: false,
        isModal: true,
        buttons: [{
                click: confirmDlgBtnClickYes_eliminar_area,
                buttonModel: { content: 'Yes', isPrimary: true }
            },
            { click: confirmDlgBtnClickNo_eliminar_area, buttonModel: { content: 'No' } }],
        width: '400px',
        target: document.getElementById('target'),
        animationSettings: { effect: 'None' },
     //   open: dialogOpen,
      //  close: dialogClose
    });
    confirmDialogObj_eliminar_area.appendTo('#confirmDialogObj_eliminar_area');    
    function confirmDlgBtnClickYes_eliminar_area() {       
           $.ajax({
                type: 'post',
                url: base_url+"administracion/areas/eliminar/"+id_area_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_area_crud="autogenerado";
                     grid_areas.refresh();
                     toastObj.show(toasts[1]);
                },
                error: function(resp) {
                    alert(resp);
                }
            });                            
        confirmDialogObj_eliminar_area.hide();
    }
    function confirmDlgBtnClickNo_eliminar_area() {       
        confirmDialogObj_eliminar_area.hide();
    }


   
   function dibujar_elementos_synfusion_area(){ 
       
             //combos
    var local_combo_in_area = new ej.dropdowns.DropDownList({
        dataSource: data_locales_in_areas,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',
        value:$("#idlocal").val(),
        //floatLabelType: 'Auto', 
        //value:direcotr_pelicula_id_var,
       // popupHeight: '350px',
       // change: filter_locales_in_areas,
        fields: { value: 'idlocales', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    local_combo_in_area.appendTo('#local_combo_in_area');
    /*function filter_locales_in_areas(args) { 
         grid_areas.filterByColumn("locales_idlocales", 'equal', args.itemData.idlocales);    
    } */
    
       
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'nombre_area': {
                    required: true
                },
                 'local_combo_in_area': {
                    required: true
                },
               
            }
        };
     var formProveedorObj = new ej.inputs.FormValidator('#form_area', options);      
     document.getElementById('guardar_area_modal').onclick = function () { 
        if (formProveedorObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_area').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/areas/guardar",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_area_crud="autogenerado";
                   grid_areas.refresh();
                   dialogObj_area.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  

