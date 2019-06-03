    //CODIGO PARA DIRECTORES
    
    var id_clase_crud="autogenerado";//ID VARIABLE PARA DIRECTORES    
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
 
    ///---------CODIGO PARA ACTORES-------///    
    var data_clase = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/clases/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   
    var clickHandler = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_clase.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/clases/form_",dialogObj_clase,dibujar_elementos_synfusion_clase);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_clase_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_clase.show();               
               ajax_content_all(2,"administracion/clases/form_",dialogObj_clase,dibujar_elementos_synfusion_clase,"administracion/clases/datos_json",id_clase_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_clase_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj.show();
              }
        }
    };  
    
    var grid_clases = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_clase,
        rowSelected: rowSelected_clase,
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
                field: 'idclases', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 120
            },
             {
                field: 'codigo', headerText: 'CODIGO',
                validationRules: { required: true },width: 120
            },
            {
                field: 'descripcion', headerText: 'DESCRIPCION',
                validationRules: { required: true },width: 120
            }
        ],
    });
    grid_clases.appendTo('#grid_clases');
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_clase(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_clase_crud=grid_clases.getSelectedRecords()[0].idclases;    
    } 
    
     var dialogObj_clase = new ej.popups.Dialog({//VENTANA MODAL PARA NUEVO Y EDITAR DIRECTOR
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
    dialogObj_clase.appendTo('#dialogObj_clase');
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
                url: base_url+"administracion/clases/eliminar/"+id_clase_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_clase_crud="autogenerado";
                     grid_clases.refresh();
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


   
   function dibujar_elementos_synfusion_clase(){    
       
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
                }
                
            }
        };
        var formclaseObj = new ej.inputs.FormValidator('#form_clase', options);      
        document.getElementById('guardar_clase').onclick = function () { 
            
           
            
        if (formclaseObj.validate()) {                              
         //  var datos = $("#form_actor").serialize();  
             var data = new FormData();
            //Form data
            var form_data = $('#form_clase').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });            
            //Custom data
            data.append('key', 'value');
           $.ajax({
              type: 'post',
              url: base_url+"administracion/clases/guardar",
              processData: false,
              contentType: false,
              data: data,
              beforeSend: function() {
              },
              success: function(json) {                                 
                   id_clase_crud="autogenerado";
                   grid_clases.refresh();
                   dialogObj_clase.hide();
                   toastObj.show(toasts[1]);
              },
              error: function(resp) {
                  alert(resp);
              }
           });  
          }
        };   
    }  