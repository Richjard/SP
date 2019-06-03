
    var data_combo_por_local_report = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/set_registros_combo_con_filtro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var data_combo_por_area_report = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/areas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
     var data_combo_por_oficina_report = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/oficinas/combo",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var combo_por_oficina_local_report = new ej.dropdowns.DropDownList({
        dataSource: data_combo_por_local_report,
        popupHeight: '250px',
        placeholder: 'Seleccione un local',
        filterBarPlaceholder: 'Buscar',
        allowFiltering: true,
        value:$("#idempleado_in_emp_as_of").val(),      
        fields: { value: 'idlocales', text: 'descripcion' } ,
        filtering: function (e) {
            var dropdown_query = new ej.data.Query();
            // frame the query based on search string with filter type.
            dropdown_query = (e.text !== '') ? dropdown_query.where('descripcion', 'equal', e.text, true) : dropdown_query;
            // pass the filter data source, filter query to updateData method.
            e.updateData(data_combo_por_local_report, dropdown_query);
        },
        change: function () {
                // disable the state DropDownList
                combo_por_oficina_area_report.enabled = true;
                // frame the query based on selected value in country DropDownList.
                var tempQuery = new ej.data.Query().where('idlocales', 'equal', combo_por_oficina_local_report.value);
                // set the framed query based on selected value in country DropDownList.
                combo_por_oficina_area_report.query = tempQuery;
                // set null value to state DropDownList text property
                combo_por_oficina_area_report.text = null;
                // bind the property changes to state DropDownList
                combo_por_oficina_area_report.dataBind();
                // set null value to city DropDownList text property
                // set null value to city DropDownList text property
                combo_por_oficina_oficina_report.text = null;
                // disable the city DropDownList
                combo_por_oficina_oficina_report.enabled = false;
                // bind the property changes to City DropDownList
                combo_por_oficina_oficina_report.dataBind();
                 
            
        } ,
    });
    combo_por_oficina_local_report.appendTo('#combo_por_oficina_local_report');
    
    var combo_por_oficina_area_report = new ej.dropdowns.DropDownList({
        dataSource: data_combo_por_area_report,
        popupHeight: '200px',
        placeholder: 'Seleccione una Area',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idarea', text: 'descripcion' }  ,
        change: function () {
                // enable the city DropDownList
                combo_por_oficina_oficina_report.enabled = true;
                // Query the data source based on state DropDownList selected value
                var tempQuery1 = new ej.data.Query().where('idarea', 'equal', combo_por_oficina_area_report.value);
                // set the framed query based on selected value in city DropDownList.
                combo_por_oficina_oficina_report.query = tempQuery1;
                //clear the existing selection
                combo_por_oficina_oficina_report.text = null;
                // bind the property change to city DropDownList
                combo_por_oficina_oficina_report.dataBind();
                 // set null value to city DropDownList text property               
        }, 
    });
    combo_por_oficina_area_report.appendTo('#combo_por_oficina_area_report');
    
    var combo_por_oficina_oficina_report = new ej.dropdowns.DropDownList({
        dataSource: data_combo_por_oficina_report,
        popupHeight: '200px',
        placeholder: 'Seleccione una Oficina',
        //value:$("#idlocal").val(),
        enabled: false,
        fields: { value: 'idoficina', text: 'descripcion' }  ,
       /* change: function () {
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
        },*/
        
        //placeholder: 'Seleccione un director',  
    });
    combo_por_oficina_oficina_report.appendTo('#combo_por_oficina_oficina_report');
