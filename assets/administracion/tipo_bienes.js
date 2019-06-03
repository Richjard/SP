    //CODIGO PARA DIRECTORES
    
    var id_tipo_bien_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
 
    ///---------CODIGO PARA ACTORES-------///    
    var data_bien = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/tipo_bienes/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   
    var clickHandler = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_tipo_bien.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/tipo_bienes/form_",dialogObj_tipo_bien,dibujar_elementos_synfusion_bien);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_tipo_bien_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_tipo_bien.show();               
               ajax_content_all(2,"administracion/tipo_bienes/form_",dialogObj_tipo_bien,dibujar_elementos_synfusion_bien,"administracion/tipo_bienes/datos_json",id_tipo_bien_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_tipo_bien_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj.show();
              }
        }
    };  
    
    var grid_tipo_bienes = new ej.grids.Grid({//GRILLA bien
        dataSource: data_bien,
        rowSelected: rowSelected_bien,
        editSettings: { 
           llowEditOnDblClick: false
        },
        height:600,
        allowPaging: true,
        pageSettings: { 
            pageCount: 10,
            pageSize: 25
        },
        toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo simpatizante',  prefixIcon: 'e-add', id: 'nuevo_' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_' },
            { text: 'Eliminar', tooltipText: 'Eliminar simpatizante', prefixIcon: 'e-delete', id: 'eliminar_' },
            'Search'
    
        ],
        toolbarClick: clickHandler,
        columns: [           
            {
                field: 'idtipo_bien', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 120
            },
            {
                field: 'codigo', headerText: 'CODIGO',
                validationRules: { required: true },width: 120
            },
            {
                field: 'descripcion', headerText: 'DESCRIPCION',
                validationRules: { required: true },width: 120
            },          
            {
                field: 'idgrupos', headerText: 'GRUPOS',
                validationRules: { required: true },width: 120
            }
            ,          
            {
                field: 'idClases', headerText: 'CLASES',
                validationRules: { required: true },width: 120
            }
        ],
    });
    grid_tipo_bienes.appendTo('#grid_tipo_bienes');
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_bien(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_tipo_bien_crud=grid_tipo_bienes.getSelectedRecords()[0].idbien;    
    } 
    
     var dialogObj_tipo_bien = new ej.popups.Dialog({//VENTANA MODAL PARA NUEVO Y EDITAR DIRECTOR
            header: 'Nuevo registro ',
            showCloseIcon: true,
            width: '500px',
            //height:'900px',
            target: document.getElementById('target'),
            animationSettings: { effect: 'None' },
            close: dialogClose,
            visible: false,
            content: "",
            isModal: true,            
    });
    dialogObj_tipo_bien.appendTo('#dialogObj_tipo_bien');
    function dialogClose() {
    }  
   
   
   
   
   
   
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
                url: base_url+"administracion/tipo_bienes/eliminar/"+id_tipo_bien_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_tipo_bien_crud="autogenerado";
                     grid_tipo_bienes.refresh();
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


   
   function dibujar_elementos_synfusion_bien(){    
       
        var options = {
            customPlacement: function (inputElement, errorElement) {
                inputElement = inputElement.closest('.form-group').querySelector('.error');
                inputElement.parentElement.appendChild(errorElement);
            },
            rules: {
                'codigo': {
                    required: true
                },
                
            }
        };
        var formtipo_bienObj = new ej.inputs.FormValidator('#form_tipo_bien', options);      
        document.getElementById('guardar_bien').onclick = function () { 
            
           
            
        if (formtipo_bienObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_tipo_bien').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/tipo_bienes/guardar",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_tipo_bien_crud="autogenerado";
                   grid_tipo_bienes.refresh();
                   dialogObj_tipo_bien.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  


    var region_domicilioObj = new ej.dropdowns.DropDownList({
        // set the country data to dataSource property
        dataSource: data_region,
        // set the height of the popup element
        popupHeight: '350px',
        floatLabelType: 'Auto',
        enabled:false,
        value: "17",
        // map the appropriate columns to fields property
        fields: { value: 'departamentoID', text: 'departamentoNombre' },
        // bind the change event
        //cabiamos el mentod change a dataBound
        dataBound: function () {
            // disable the state DropDownList
            provincia_domicilioObj.enabled = true;
            // frame the query based on selected value in country DropDownList.
            var tempQuery = new ej.data.Query().where('departamentoID', 'equal', region_domicilioObj.value);
          //  console.log("departamento id dfsfsdf "+region_domicilioObj.value);
            document.getElementsByName("Region_domicilio_h")[0].value = region_domicilioObj.value;
            document.getElementById("Region_domicilio_h").innerHTML = "";
            // set the framed query based on selected value in country DropDownList.
            provincia_domicilioObj.query = tempQuery;
            // set null value to state DropDownList text property
            provincia_domicilioObj.text = null;
            // bind the property changes to state DropDownList
            provincia_domicilioObj.dataBind();
            // set null value to city DropDownList text property
            distrito_domicilioObj.text = null;
            // disable the city DropDownList
            distrito_domicilioObj.enabled = false;
            // bind the property changes to City DropDownList
            distrito_domicilioObj.dataBind();
        },
        placeholder: 'Seleccione una Región'
    });
    region_domicilioObj.appendTo('#region_domicilio');
    
       console.log("nuevo id provincia select::"+provincia_domicilio_id_var);
       //initiates the state DropDownList
        var provincia_domicilioObj = new ej.dropdowns.DropDownList({
            dataSource: data_provincial,
            popupHeight: '350px',
           // value:provincia_domicilio_id_var,
            fields: { value: 'provinciaID', text: 'provinciaNombre' },      
            placeholder: 'Seleccione una Provincia',        
           // query: new ej.data.Query().where('departamentoID', 'equal', region_domicilioObj.value),       
            change: function () {
                 document.getElementsByName("Provincia_domicilio_h")[0].value = provincia_domicilioObj.value;
                 document.getElementById("Provincia_domicilio_h").innerHTML = "";
                // enable the city DropDownList
                distrito_domicilioObj.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('provinciaID', 'equal', provincia_domicilioObj.value);
                // set the framed query based on selected value in city DropDownList.
                distrito_domicilioObj.query = tempQuery1;
                //clear the existing selection
                distrito_domicilioObj.text = null;
                // bind the property change to city DropDownList
                distrito_domicilioObj.dataBind();

            }
        });   
       provincia_domicilioObj.appendTo('#provincia_domicilio'); 
         var distrito_domicilioObj = new ej.dropdowns.DropDownList({
            // set the city data to dataSource property
            dataSource: data_distrito,
            // set the height of the popup element
            popupHeight: '350px',
           // value:distrito_domicilio_id_var,
            // map the appropriate columns to fields property
            fields: { text: 'distritoNombre', value: 'distritoID' },
            // disable the DropDownList by default to prevent the user interact.
            enabled: false,
            // set the placeholder to DropDownList input element
          //  query: new ej.data.Query().where('provinciaID', 'equal', provincia_domicilioObj.value),  
            placeholder: 'Seleccione un Distrito',
             change: function () {
                 document.getElementsByName("Distrito_domicilio_h")[0].value = distrito_domicilioObj.value;
                  document.getElementById("Distrito_domicilio_h").innerHTML = "";

            }
        });

  distrito_domicilioObj.appendTo('#distrito_domicilio');