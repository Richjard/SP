   ///---------CODIGO PARA VERIFICACION DE BEINES  11/06/2019-------///    
    var data_para_seleccionar_locales = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA EL COMBO
             url:base_url+"administracion/locales/combo",//Establece el origen de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_para_seleccionar_areas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA EL COMBO
             url:base_url+"administracion/areas/combo",//Establece el origen de datos .
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_para_Seleccionar_oficinas = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA EL COMBO
             url:base_url+"administracion/oficinas/combo",//Establece el origen de datos.
             adaptor: new ej.data.WebApiAdaptor
    });   
    
    

    //codigo QUE SE PUEDE ENCAPSULAR ---revizar para su encapsulacion
    //combos
    var locales_in_verificacion_bienes = new ej.dropdowns.DropDownList({
        dataSource: data_para_seleccionar_locales,
        popupHeight: '200px',
        placeholder: 'Seleccione un local',       
       // popupHeight: '350px',
        change: function () {
                 
                // disable the state DropDownList
                areas_in_verificacion_bienes.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', locales_in_verificacion_bienes.value);
                // set the framed query based on selected value in country DropDownList.
                areas_in_verificacion_bienes.query = tempQuery;
                // set null value to state DropDownList text property
                areas_in_verificacion_bienes.text = null;
                // bind the property changes to state DropDownList
                areas_in_verificacion_bienes.dataBind();
                // set null value to city DropDownList text property
                // 
                oficinas_in_erificacion_bienes.text = null;
                // disable the city DropDownList
                oficinas_in_erificacion_bienes.enabled = false;
                // bind the property changes to City DropDownList
                oficinas_in_erificacion_bienes.dataBind();
               // grid_empleados_as_oficina.filterByColumn("idlocales", 'equal', locales_in_empleados_as_ofi.value);   
               
        } ,        
       
        fields: { value: 'idlocales', text: 'descripcion' }      
        //placeholder: 'Seleccione un director',  
    });
    locales_in_verificacion_bienes.appendTo('#locales_in_verificacion_bienes'); 
    var areas_in_verificacion_bienes = new ej.dropdowns.DropDownList({
        dataSource: data_para_seleccionar_areas,
        popupHeight: '400px',
        popupWidth: '300px',
        enabled: false,
        placeholder: 'Seleccione una Area',

        fields: { value: 'idarea', text: 'descripcion' },
        change: function () {
             // enable the city DropDownList
                oficinas_in_erificacion_bienes.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idarea', 'equal', areas_in_verificacion_bienes.value);
                // set the framed query based on selected value in city DropDownList.
                oficinas_in_erificacion_bienes.query = tempQuery1;
                //clear the existing selection
                oficinas_in_erificacion_bienes.text = null;
                // bind the property change to city DropDownList
                oficinas_in_erificacion_bienes.dataBind();
               // grid_empleados_as_oficina.filterByColumn("idarea", 'equal', areas_in_empleados_as_ofi.value);
       
        },
    });
    areas_in_verificacion_bienes.appendTo('#areas_in_verificacion_bienes'); 
    var oficinas_in_erificacion_bienes = new ej.dropdowns.DropDownList({
        dataSource: data_para_Seleccionar_oficinas,
        popupHeight: '400px',
        popupWidth: '300px',
        enabled: false,
        placeholder: 'Seleccione una Oficina',

        fields: { value: 'idoficina', text: 'descripcion' },
        change: function () {          
           // cargar_grilla_verificacion_bienes_Obterner_bienes(oficinas_in_erificacion_bienes.value)
           if(typeof funcion_in_change_oficina === 'function') {
                //Es seguro ejecutar la función
                console.log("ddes:"+oficinas_in_erificacion_bienes.text);
                $("#dsc_oficina_selec").html(oficinas_in_erificacion_bienes.text);
                funcion_in_change_oficina(oficinas_in_erificacion_bienes.value);
            }
        },
    });
    oficinas_in_erificacion_bienes.appendTo('#oficinas_in_erificacion_bienes');

    



