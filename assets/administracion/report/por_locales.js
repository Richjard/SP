
    var data_combo_por_local_report = new ej.data.DataManager({//DATOS PARA OBTERNET DEL SERVIDOR PARA LA GRILLA
             url:base_url+"administracion/locales/set_registros_combo_con_filtro",//Establece el origen de datos para crear el Administrador de datos.
             adaptor: new ej.data.WebApiAdaptor
    });
    var combo_por_local_report = new ej.dropdowns.DropDownList({
        dataSource: data_combo_por_local_report,
        popupHeight: '250px',
        placeholder: 'Seleccione un empleado',
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
    });
    combo_por_local_report.appendTo('#combo_por_local_report');
    

