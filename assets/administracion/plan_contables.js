    //CODIGO PARA DIRECTORES
    
    var id_plan_contable_crud="autogenerado";//ID VARIABLE PARA DIRECTORES 
    var codigo_plan_contable_modal="";//para ventana modal
    var nombre_plan_contable_modal="";//para ventana modal
    var idplan_contable_modal="";
    var confirmContent = '<span>¿Estás seguro de que deseas eliminar el registro permanentemente?</span>';  //MENSAJE CUANDO SE ELMINE UN REGISTRO
 
    ///---------CODIGO PARA ACTORES-------///    
    var data_plan_contable = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/plan_contables/leerRegistro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
   
    var clickHandler = function(args){//BOTONOS PARA AGREGAR MODIFICAR ELMINIAR EVENTOS
        if (args.item.id === 'nuevo_') {       
            dialogObj_plan_contable.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR
            ajax_content_all(1,"administracion/plan_contables/form_",dialogObj_plan_contable,dibujar_elementos_synfusion_plan_contable);//LLAMAMOS CON JAX EL FORMUALRIO          
        }       
        if (args.item.id === "editar_") {
            if(id_plan_contable_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
            } else{              
               dialogObj_plan_contable.show();     
                      console.log("sadas "+id_plan_contable_crud)
               ajax_content_all(2,"administracion/plan_contables/form_",dialogObj_plan_contable,dibujar_elementos_synfusion_plan_contable,"administracion/plan_contables/datos_json",id_plan_contable_crud); 
      
            }
        }
        if (args.item.id === "eliminar_") {
              if(id_plan_contable_crud=="autogenerado"){
                 toastObj.show(toasts[0]);
              } else{                  
                confirmDialogObj.show();
              }
        }
    };  
    
    var grid_plan_contables = new ej.grids.Grid({//GRILLA proveedor
        dataSource: data_plan_contable,
        rowSelected: rowSelected_plan_contable,
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
        recordDoubleClick: onRecordDoubleClick,
        toolbar: ['Add', 'Edit', 'Delete',],
        toolbar: [           
            { text: 'Nuevo', tooltipText: 'Agregar nuevo simpatizante',  prefixIcon: 'e-add', id: 'nuevo_' }, 
            { text: 'Modificar', tooltipText: 'Modificar datos', prefixIcon: 'e-edit', id: 'editar_' },
            { text: 'Eliminar', tooltipText: 'Eliminar simpatizante', prefixIcon: 'e-delete', id: 'eliminar_' }
    
        ],
        toolbarClick: clickHandler,
        columns: [           
            {
                field: 'idplan_contable', isPrimaryKey: true, headerText: 'ID', textAlign: 'Right',
                validationRules: { required: true }, width: 50
            },
             {
                field: 'codigo', headerText: 'CODIGO',
                validationRules: { required: true },width: 100
            },
            {
                field: 'descripcion', headerText: 'DESCRIPCION',
                validationRules: { required: true },width: 400
            },
            {
                field: 'taza_depreciacion', headerText: 'TAZA DEPRECIACION',
                validationRules: { required: true }
            },
            {
                field: 'vida_util', headerText: 'VIDA UTIL',
                validationRules: { required: true }
            }
        ],
    });
    grid_plan_contables.appendTo('#grid_plan_contables');
     function onRecordDoubleClick(args) {
        if ($('#nombre_plan_contable_modal').length) {//si le llaman por modal
            dialogObj_plan.hide();
            $("#codigo_cuenta").val(codigo_plan_contable_modal);
            $("#nombre_cuenta").val(nombre_plan_contable_modal);
            $("#idplan_contable").val(idplan_contable_modal); 
         }
        //write logic for record double click
    }
   /* $("#Grid_directores_searchbar").attr("placeholder", "Buscar");   */ 
    function rowSelected_plan_contable(args) {//CUANDO SE SELECCIONA UN REGISTRO DE LA GRILLA SE LE ASIGNA EL VALOR DE ID
        id_plan_contable_crud=grid_plan_contables.getSelectedRecords()[0].idplan_contable; 
        codigo_plan_contable_modal=grid_plan_contables.getSelectedRecords()[0].codigo;//para ventana modal
        nombre_plan_contable_modal=grid_plan_contables.getSelectedRecords()[0].descripcion;//para ventana modal
        idplan_contable_modal=grid_plan_contables.getSelectedRecords()[0].idplan_contable;//para ventana modal       
        if ($('#nombre_plan_contable_modal').length) {
            console.log("existe ");
            $("#nombre_plan_contable_modal").empty();
            $("#nombre_plan_contable_modal").append(nombre_plan_contable_modal);
          } else {
            // no existe
          }
    } 
    var guardar_plan_contable_modal = new ej.buttons.Button({});
    var iconTemp_plan_contable_menor = '<button id="guardar_plan_contable_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'GUARDAR</button>';
    var headerImg_plan_contable_menor = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
    var message_plan_contable_menor = 'Greetings Nancy! When will you share me the source files of the project';
        
    var dialogObj_plan_contable = new ej.popups.Dialog({
            footerTemplate:  iconTemp_plan_contable_menor,
            header: headerImg_plan_contable_menor + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REGISTRO </div>',
            content: '<div class="dialogContent"><span class="dialogText">' + message_plan_contable_menor + '</span></div>',
            showCloseIcon: true,
            target: document.getElementById('target'),
            width: '40%',
            content: "",
          //  open: dialogOpen,
           // close: dialogClose,
            visible: false,
           // height: '%',
           
    });
    dialogObj_plan_contable.appendTo('#dialogObj_plan_contable'); 
    
      
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
                url: base_url+"administracion/plan_contables/eliminar/"+id_plan_contable_crud,
                cache: false,
               // data: datos,
                beforeSend: function() {
                /*  var html = '<div class="help-block text-center"><br/><h1>Cargando...</h1></div>';
                    $('#contenerdor_').empty().html(html);*/
                },
                success: function(json) {
                     id_plan_contable_crud="autogenerado";
                     grid_plan_contables.refresh();
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


   
   function dibujar_elementos_synfusion_plan_contable(){    
       
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
        var formplan_contableObj = new ej.inputs.FormValidator('#form_plan_contable', options);      
        document.getElementById('guardar_plan_contable_modal').onclick = function () {   
            if (formplan_contableObj.validate()) {                              
             //  var datos = $("#form_actor").serialize();  
                 var data = new FormData();
                //Form data
                var form_data = $('#form_plan_contable').serializeArray();
                $.each(form_data, function (key, input) {
                    data.append(input.name, input.value);
                });            
                //Custom data
                data.append('key', 'value');
               $.ajax({
                  type: 'post',
                  url: base_url+"administracion/plan_contables/guardar",
                  processData: false,
                  contentType: false,
                  data: data,
                  beforeSend: function() {
                  },
                  success: function(json) {                                 
                       id_plan_contable_crud="autogenerado";
                       grid_plan_contables.refresh();
                       dialogObj_plan_contable.hide();
                       toastObj.show(toasts[1]);
                  },
                  error: function(resp) {
                      alert(resp);
                  }
               });  
              }
            };   
        }  