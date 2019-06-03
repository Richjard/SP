var menuTemplate = '<ul id="menu"></ul>';
    var searchTemplate = '<div class="e-input-group"><input class="e-input" type="text" placeholder="Search" /><span class="em-icons e-search"></span></div>';
    var dropDownBtnTemplate = '<button id="userDBtn">Usuario: '+$("#user__").val()+'';

    //Initialize Toolbar component
    var toolbarObj = new ej.navigations.Toolbar({
        created: create,
        items: [
            { template: menuTemplate },
           // { template: searchTemplate, align: 'right' },
            { template: dropDownBtnTemplate, align: 'right' },
            //{ prefixIcon: 'em-icons e-shopping-cart', align: 'right' },
        ]
    });

    //Render initialized Toolbar component
    toolbarObj.appendTo('#shoppingtoolbar');

    function create() {
        //Menu items definition 
        var menuItems = [
            { 
                text: 'APP PATRIMONIO',
                id: "app", 
                url:base_url+"administracion/principal",
                
            },
            { 
                text: 'Tablas',
                items: [
                    { 
                      
                        text: 'LOCALES',
                       // enabled:true,
                        id: "locales_menu", 
                        url:base_url+"administracion/locales",
                        
                    },
                    { 
                        text: 'AREAS',
                        id: "areas_menu", 
                        url:base_url+"administracion/areas",
                        
                    },
                    { 
                        text: 'OFICINAS',  
                        id: "oficinas_menu", 
                        url:base_url+"administracion/oficinas",
                    },
                    { separator: true },
                    { 
                        text: 'EMPLEADOS',  
                        id: "empleados_menu", 
                        url:base_url+"administracion/empleados",
                    },
                    { 
                        text: 'ASIGNAR EMPLEADOS A OFICINA',  
                        id: "empleados_oficina_menu", 
                        url:base_url+"administracion/empleados_as_oficina",
                    },
                    { 
                        text: 'PROVEEDORES',  
                        id: "proveedores_menu", 
                        url:base_url+"administracion/proveedor",
                    },
                    { separator: true },
                    { 
                        text: 'PLAN CONTABLE',   
                        id: "plan_contables", 
                        url:base_url+"administracion/plan_contables",
                    },
                    { 
                        text: 'CATALOGO BIENES MAYORES', 
                        id: "bienes_mayores",
                        url:base_url+"administracion/bienes_mayores",
                    },
                    { 
                        text: 'CATALOGO BIENES MENORES', 
                        id: "bienes_menores",
                        url:base_url+"administracion/bienes_menores",
                    }
                ]
            },
            { 
                text: 'BIENES',
                items: [
                    { 
                        text: 'REGISTRO DE BIENES',
                         id: "bienes",
                         url:base_url+"administracion/bienes",
                    },
                    { 
                        text: 'DESPLAZATAMIENTO DE BIENES', 
                        url:base_url+"administracion/desplazamiento_de_bienes",
                    }
                ]
            },
            { 
                text: 'CONSULTAS Y REPORTES',
                items: [
                    { 
                        text: 'BIENES',
                        items: [
                            { text: 'GENERAL',
                            items: [
                            { text: 'TODOS',id:"report_"  },
                            { text: 'BIENES DEPRECIABLES' },
                            { text: 'BIENES NO DEPRECIABLES' }
                            ]},
                            { text: 'GENERAL AGRUPADOS POR CUENTAS' },
                            { text: 'DETALLADO' }
                        ]
                    },
                     { 
                        text: 'BIENES POR UBICACION',
                        items: [
                            { 
                                text: 'REPORTES POR LOCALES',
                                id: "por_locales", 
                            },
                            { 
                                text: 'REPORTES POR AREAS',
                                id: "por_areas", 
                            },
                            { 
                                text: 'REPORTES POR OFICINAS',
                                id: "por_oficinas", 
                            },
                           
                        ]
                    },
                    { 
                        text: 'BIENES POR EMPLEADO',
                        id: "por_empleado", 
                        /*items: [
                            { text: 'Kurtas' },
                            { text: 'Salwars' },
                            { text: 'Sarees' }
                        ]*/
                    }
                ]
            },
            { 
                text: 'AYUDA',
                items: [
                    { 
                      text: 'MANUAL',
                       
                    },
                    { 
                      text: 'ACERCA DEL APLICATIVO',
                       
                    }
                ]
            }
        ];
        function xxx_(){
            alert("aaa");
        }
        var userData = [
            //{ text: 'Configurar cuenta', iconCss: 'e-ddb-icons e-settings', },
            /*{ text: 'Orders' },
            { text: 'Rewards' },*/
            { text: 'SALIR DEL APLICATIVO',  iconCss: 'e-ddb-icons e-logout', url:base_url+"login/login/salir", }
        ];

        //Menu model definition 
       /* var menuOptions = {
            items: menuItems,
            animationSettings: { effect: 'none' }
              
        };*/

        //Initialize Menu component
        var menuObj = new ej.navigations.Menu(
                {
                    items: menuItems,
                    animationSettings: { effect: 'none' },
                    beforeOpen: function (args){
                        //Handling sub menu items
                        for (i = 0; i  < args.items.length; i++) {
                            if (disableItems.indexOf(args.items[i].text) > -1) {
                                menuObj.enableItems([args.items[i].text], false, false);
                            }
                        }
                    },
                    select: function (args)  {
                        if(args.item.properties.id=="report_"){
                             dialogObj_reportes.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR                            
                            dialogObj_reportes.setProperties ({content: '<iframe width="100%" height="900" src="'+base_url+"administracion/bienes/re"+'"></iframe>'});                         
                       
                        }
                        if(args.item.properties.id=="por_locales"){
                            $.ajax({
                                type: 'post',
                                url: base_url+"administracion/reportes/v_por_locales", 
                                //data: {"data" : dd},
                                beforeSend: function() {

                                   /* $("#guardar_bien_formato_registros").attr("disabled",true);
                                    console.log("desabilitar");*/
                                },
                                success: function(resp) {  
                                    //cargamos su js
                                    $.getScript( base_url+"assets/administracion/report/por_locales.js", function( data, textStatus, jqxhr ) {});
                                    var buttoN__ = ' <button id="ok_por_local"></button>';
                                    
                                    dialogObj_reportes_modal.show();//MOSTRAMOS UNA VENTANA MODAL 
                                    dialogObj_reportes_modal.setProperties ({content: resp});
                                    dialogObj_reportes_modal.setProperties({footerTemplate:buttoN__});
                                    
                                    ok_por_local = new ej.splitbuttons.ProgressButton({
                                        content: 'Generar reporte', enableProgress: true, animationSettings: { effect: 'SlideRight' },
                                        spinSettings: { position: 'Center' }, cssClass: 'e-outline e-primary'
                                    });
                                    ok_por_local.appendTo('#ok_por_local');
                                   
                                   
                                   var options = {
                                        customPlacement: function (inputElement, errorElement) {
                                            inputElement = inputElement.closest('.fv').querySelector('.error');
                                            inputElement.parentElement.appendChild(errorElement);
                                        },
                                        rules: {
                                                'combo_por_local_report': {
                                                    required: true
                                                },                                       
                                            }
                                    };
                                    var form_por_local_report = new ej.inputs.FormValidator('#form_por_local_report', options);

  
                                   
                                    document.getElementById('ok_por_local').onclick = function () { 
                                       if (form_por_local_report.validate()) { 
                                        var data = new FormData();
                                        //Form data
                                        var form_data = $('#form_por_local_report').serializeArray();
                                        $.each(form_data, function (key, input) {
                                            data.append(input.name, input.value);
                                        });            
                                        //Custom data
                                        data.append('key', 'value');
                                        $.ajax({
                                           type: 'post',
                                           url: base_url+"administracion/reportes/temp_datos_por_locales",
                                           processData: false,
                                           contentType: false,
                                           data: data,
                                           beforeSend: function() {
                                            //$("#ok_por_local").attr("disabled",true); 
                                          },                                   
                                           success: function(json) {                                                                  
                                          //  $("#ok_por_local").attr("disabled",false); 
                                            dialogObj_reportes.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR                            
                                            dialogObj_reportes.setProperties ({content: '<iframe width="100%" height="900" src="'+base_url+"administracion/reportes/r_por_locales"+'"></iframe>'});                         

                                           },
                                           error: function(resp) {
                                               alert(resp);
                                           }
                                        }); 
                                      }    
                                    };  
        
                        
                                },
                                error: function(resp) {
                                    alert(resp);
                                }
                             }); 
                           /* var buttoN__ = '<button id="ok_cuentas_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'OK</button>';
                            
                             dialogObj_reportes.show();//MOSTRAMOS UNA VENTANA MODAL 
                             dialogObj_reportes.setProperties ({content: 'POR LOCALES'});
                             dialogObj_reportes.setProperties({footerTemplate:buttoN__});
                          */
                          //  dialogObj_reportes.setProperties ({content: '<iframe width="100%" height="900" src="'+base_url+"administracion/bienes/re"+'"></iframe>'});                         
                       
                        }
                        
                        //por area por_oficinas
                         if(args.item.properties.id=="por_areas"){
                            $.ajax({
                                type: 'post',
                                url: base_url+"administracion/reportes/v_por_areas", 
                                //data: {"data" : dd},
                                beforeSend: function() {

                                   /* $("#guardar_bien_formato_registros").attr("disabled",true);
                                    console.log("desabilitar");*/
                                },
                                success: function(resp) {  
                                    //cargamos su js
                                    $.getScript( base_url+"assets/administracion/report/por_areas.js", function( data, textStatus, jqxhr ) {});
                                    var buttoN__ = ' <button id="ok_por_area"></button>';
                                    
                                    dialogObj_reportes_modal.show();//MOSTRAMOS UNA VENTANA MODAL 
                                    dialogObj_reportes_modal.setProperties ({content: resp});
                                    dialogObj_reportes_modal.setProperties({footerTemplate:buttoN__});
                                    
                                    ok_por_area = new ej.splitbuttons.ProgressButton({
                                        content: 'Generar reporte', enableProgress: true, animationSettings: { effect: 'SlideRight' },
                                        spinSettings: { position: 'Center' }, cssClass: 'e-outline e-primary'
                                    });
                                    ok_por_area.appendTo('#ok_por_area');
                                   
                                   
                                   var options = {
                                        customPlacement: function (inputElement, errorElement) {
                                            inputElement = inputElement.closest('.fv').querySelector('.error');
                                            inputElement.parentElement.appendChild(errorElement);
                                        },
                                        rules: {
                                                'combo_por_area_local_report': {
                                                    required: true
                                                },  
                                                'combo_por_area_area_report': {
                                                    required: true
                                                }, 
                                            }
                                    };
                                    var form_por_local_report = new ej.inputs.FormValidator('#form_por_area_report', options);

  
                                   
                                    document.getElementById('ok_por_area').onclick = function () { 
                                       if (form_por_local_report.validate()) { 
                                        var data = new FormData();
                                        //Form data
                                        var form_data = $('#form_por_area_report').serializeArray();
                                        $.each(form_data, function (key, input) {
                                            data.append(input.name, input.value);
                                        });    
                                        data.append('key', 'value');
                                        $.ajax({
                                           type: 'post',
                                           url: base_url+"administracion/reportes/temp_datos_por_areas",
                                           processData: false,
                                           contentType: false,
                                           data: data,
                                           beforeSend: function() {
                                          },                                   
                                           success: function(json) {                      
                                            dialogObj_reportes.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR                            
                                            dialogObj_reportes.setProperties ({content: '<iframe width="100%" height="900" src="'+base_url+"administracion/reportes/r_por_areas"+'"></iframe>'});                         

                                           },
                                           error: function(resp) {
                                               alert(resp);
                                           }
                                        }); 
                                      }  
                                    };  
        
                        
                                },
                                error: function(resp) {
                                    alert(resp);
                                }
                             });                        
                        }
                        
                        
                         //por_oficinas por_empleado
                         if(args.item.properties.id=="por_oficinas"){
                            $.ajax({
                                type: 'post',
                                url: base_url+"administracion/reportes/v_por_oficinas", 
                                //data: {"data" : dd},
                                beforeSend: function() {

                                   /* $("#guardar_bien_formato_registros").attr("disabled",true);
                                    console.log("desabilitar");*/
                                },
                                success: function(resp) {  
                                    //cargamos su js
                                    $.getScript( base_url+"assets/administracion/report/por_oficinas.js", function( data, textStatus, jqxhr ) {});
                                    var buttoN__ = ' <button id="ok_por_oficina"></button>';
                                    
                                    dialogObj_reportes_modal.show();//MOSTRAMOS UNA VENTANA MODAL 
                                    dialogObj_reportes_modal.setProperties ({content: resp});
                                    dialogObj_reportes_modal.setProperties({footerTemplate:buttoN__});
                                    
                                    ok_por_area = new ej.splitbuttons.ProgressButton({
                                        content: 'Generar reporte', enableProgress: true, animationSettings: { effect: 'SlideRight' },
                                        spinSettings: { position: 'Center' }, cssClass: 'e-outline e-primary'
                                    });
                                    ok_por_area.appendTo('#ok_por_oficina');
                                   
                                   
                                   var options = {
                                        customPlacement: function (inputElement, errorElement) {
                                            inputElement = inputElement.closest('.fv').querySelector('.error');
                                            inputElement.parentElement.appendChild(errorElement);
                                        },
                                        rules: {
                                                'combo_por_oficina_local_report': {
                                                    required: true
                                                },  
                                                'combo_por_oficina_area_report': {
                                                    required: true
                                                }, 
                                                'combo_por_oficina_oficina_report': {
                                                    required: true
                                                }, 
                                            }
                                    };
                                    var form_por_local_report = new ej.inputs.FormValidator('#form_por_oficina_report', options);

  
                                   
                                    document.getElementById('ok_por_oficina').onclick = function () { 
                                       if (form_por_local_report.validate()) { 
                                        var data = new FormData();
                                        //Form data
                                        var form_data = $('#form_por_oficina_report').serializeArray();
                                        $.each(form_data, function (key, input) {
                                            data.append(input.name, input.value);
                                        });    
                                        data.append('key', 'value');
                                        $.ajax({
                                           type: 'post',
                                           url: base_url+"administracion/reportes/temp_datos_por_oficinas",
                                           processData: false,
                                           contentType: false,
                                           data: data,
                                           beforeSend: function() {
                                          },                                   
                                           success: function(json) {                      
                                            dialogObj_reportes.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR                            
                                            dialogObj_reportes.setProperties ({content: '<iframe width="100%" height="900" src="'+base_url+"administracion/reportes/r_por_oficinas"+'"></iframe>'});                         

                                           },
                                           error: function(resp) {
                                               alert(resp);
                                           }
                                        }); 
                                      }  
                                    }; 
        
                        
                                },
                                error: function(resp) {
                                    alert(resp);
                                }
                             });                        
                        }
                        
                        //por_empleado
                         if(args.item.properties.id=="por_empleado"){
                            $.ajax({
                                type: 'post',
                                url: base_url+"administracion/reportes/v_por_empleado", 
                                //data: {"data" : dd},
                                beforeSend: function() {

                                   /* $("#guardar_bien_formato_registros").attr("disabled",true);
                                    console.log("desabilitar");*/
                                },
                                success: function(resp) {  
                                    //cargamos su js
                                    $.getScript( base_url+"assets/administracion/report/por_empleado.js", function( data, textStatus, jqxhr ) {});
                                    var buttoN__ = ' <button id="ok_por_empleado"></button>';
                                    
                                    dialogObj_reportes_modal.show();//MOSTRAMOS UNA VENTANA MODAL 
                                    dialogObj_reportes_modal.setProperties ({content: resp});
                                    dialogObj_reportes_modal.setProperties({footerTemplate:buttoN__});
                                    
                                    ok_por_empleado = new ej.splitbuttons.ProgressButton({
                                        content: 'Generar reporte', enableProgress: true, animationSettings: { effect: 'SlideRight' },
                                        spinSettings: { position: 'Center' }, cssClass: 'e-outline e-primary'
                                    });
                                    ok_por_empleado.appendTo('#ok_por_empleado');
                                   
                                   
                                   var options = {
                                        customPlacement: function (inputElement, errorElement) {
                                            inputElement = inputElement.closest('.fv').querySelector('.error');
                                            inputElement.parentElement.appendChild(errorElement);
                                        },
                                        rules: {
                                                'combo_por_empleado_local_report': {
                                                    required: true
                                                },  
                                                'combo_por_empleado_area_report': {
                                                    required: true
                                                }, 
                                                'combo_por_empleado_oficina_report': {
                                                    required: true
                                                },
                                                'combo_por_empleado_empleado_report': {
                                                    required: true
                                                }, 
                                            }
                                    };
                                    var form_por_local_report = new ej.inputs.FormValidator('#form_por_empleado_report', options);

  
                                   
                                    document.getElementById('ok_por_empleado').onclick = function () { 
                                       if (form_por_local_report.validate()) { 
                                        var data = new FormData();
                                        //Form data
                                        var form_data = $('#form_por_empleado_report').serializeArray();
                                        $.each(form_data, function (key, input) {
                                            data.append(input.name, input.value);
                                        });    
                                        data.append('key', 'value');
                                        $.ajax({
                                           type: 'post',
                                           url: base_url+"administracion/reportes/temp_datos_por_empleado",
                                           processData: false,
                                           contentType: false,
                                           data: data,
                                           beforeSend: function() {
                                          },                                   
                                           success: function(json) {                      
                                            dialogObj_reportes.show();//MOSTRAMOS LA VENTANA MODAL PARA REGISTRAR NUEVO DIRECOTOR                            
                                            dialogObj_reportes.setProperties ({content: '<iframe width="100%" height="900" src="'+base_url+"administracion/reportes/r_por_empleado"+'"></iframe>'});                         

                                           },
                                           error: function(resp) {
                                               alert(resp);
                                           }
                                        }); 
                                      }  
                                    }; 
        
                        
                                },
                                error: function(resp) {
                                    alert(resp);
                                }
                             });                        
                        }
                    }
               
                }       
        , '#menu');
        function report_g (){
            //alert("aaa");
        }
         /* var menu = new ej.navigations.Menu({ 
                
                 }); 
        menu.appendTo("#menu");*/

    // menuObj = new ej.navigations();
             
         //      menuObj.appendTo('#menu');
        disableItems = ['DETALLADO','BIENES DEPRECIABLES','BIENES NO DEPRECIABLES','GENERAL AGRUPADOS POR CUENTAS','MANUAL','ACERCA DEL APLICATIVO'];
        //Disable items
      //  menuObj.enableItems(disableItems, false, false);

        //Initialize DropDownButton component
        var btnObj = new ej.splitbuttons.DropDownButton({ items: userData,align: 'right' });
        btnObj.appendTo('#userDBtn');

        this.refreshOverflow();
    }
    
         /* document.getElementById('app').onclick = function () { 
            
                    document.location.href = base_url+"administracion/principal";
          }; 
          document.getElementById('bienes').onclick = function () { 
            
                    document.location.href = base_url+"administracion/bienes";
          }; 
          document.getElementById('plan_contables').onclick = function () { 
            
                    document.location.href = base_url+"administracion/plan_contables";
          }; 
          document.getElementById('bienes_mayores').onclick = function () { 
            
                    document.location.href = base_url+"administracion/bienes_mayores";
          }; 
          document.getElementById('bienes_menores').onclick = function () { 
            
                    document.location.href = base_url+"administracion/bienes_menores";
          }; */