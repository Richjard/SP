  <form id="form_bien_formato_registros" class="form-horizontal">
    <input type="hidden" id="id_bien_crud" value="autogenerado" name="id_bien_crud">
    <div class="col-lg-12 control-section">
      <div class="content-wrapper">
        <fieldset>
          <div class="legend_">[ Datos del bien ]</div>
          <div class="row bien_form">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3 label_form">
                  <label>Tipo Bien<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-in-wrap">
                    <input type="text" id="tipo_bien" name="tipo_bien">
                  </div>
                  <input type="hidden" id="tipo_bien_bien" name="tipo_bien_bien" value="1">
                </div>
              </div>
            </div>
            <div class="col-xs-5 col-sm-5 col-lg-5 col-md-5">
              <div class="row bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3 label_form">
                  <label>Codigo Bien<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9 ">
                  <div class="e-input-group e-float-icon-right readonly_">
                    <div class="e-input-in-wrap ">
                      <input class="e-input " type="text" readonly="" id="codigo_bien" name="codigo_bien">
                      <input type="hidden" id="id_bien_mm" name="id_bien_mm">
                    </div>
                    <span class="e-input-group-icon fas fa-filter " id="bienes_mayores_obj"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
              <div class="row bien_form">
                <div class="col-xs-7 col-sm-7 col-lg-7 col-md-7 label_form">
                  <label>Cantidad<label>
                    </label></label></div>
                <div class="col-xs-5 col-sm-5 col-lg-5 col-md-5">
                  <div class="e-input-group ">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="number" value="1" id="cantidad" name="cantidad">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row bien_form form-group">
            <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3 label_form">
              <label>Descripcion<label>
                </label></label></div>
            <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
              <div class="e-input-group readonly__ ">
                <div class="e-input-in-wrap">
                  <input class="e-input  " size="100%" type="text" readonly="" id="nombre_bien" name="nombre_bien" data-required-message="*Descripción del bien es requerido" required="">
                </div>
              </div>
            </div>
            <div class="error"></div>
          </div>
                <div class="row bien_form">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Cuenta<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group e-float-icon-right">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="codigo_cuenta" name="codigo_cuenta">
                      <input type="hidden" id="idplan_contable" name="idplan_contable">
                    </div>
                    <span class="e-input-group-icon fas fa-filter" id="cuentas_plan_contable"></span>
                  </div>
                </div>
              </div>
            </div>
         
            <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
              <div class="row bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Nombre cuenta<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group readonly__">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="nombre_cuenta" name="nombre_cuenta" readonly="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row bien_form">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row bien_form">
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <label>Valor adq<label>
                    </label></label></div>
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <div class="e-input-group e-float-icon-right">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="number" id="valor_adquirido" name="valor_adquirido" onkeyup="validar_plan();">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row bien_form">
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <label>Valor Neto<label>
                    </label></label></div>
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <div class="e-input-group ">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="number" name="valor_neto" id="valor_neto" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row bien_form">
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <label>Fecha Orden de Compra<label></label></label></div>
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <div class="e-input-group e-float-icon-right">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="fecha_adquisicion" name="fecha_adquisicion" dateiso="true" data-dateiso-message="Please enter valid dateISO format(YYYY-MM-DD)." data-required-message="Fecha Adquisicion es requerido" required="">
                      <input type="hidden" id="fecha_adquisicion_bien" name="fecha_adquisicion_bien">
                    </div>
                  </div>
                  <div class="error"></div>
                </div>
              </div>
            </div>
          </div>
              <div class="row bien_form">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row ">
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <label>Estado<label>
                    </label></label></div>
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <input type="text" id="combo_estado_bien" name="combo_estado_bien" data-required-message="*Estado bien requerido" required="">
                  <input type="hidden" id="idestado_bien_bien" name="idestado_bien_bien" value="1">
                </div>
                <div class="error"></div>
              </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
              <div class="row ">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Orden de compra<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group e-float-icon-right">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="orden_compra" name="orden_compra">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      
          <div class="row bien_form">
            <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
              <div class="row  form-group">
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <label>Forma de adquisición<label>
                    </label></label></div>
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <input type="text" id="combo_forma_adquisicion" name="combo_forma_adquisicion" data-required-message="*Forma de adquisición es requerido" required="">
                  <input type="hidden" id="idforma_adquicision_bien" name="idforma_adquicision_bien" value="1">
                </div>
                <div class="error"></div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
              <div class="row  form-group">
                <div class="col-xs-5 col-sm-5 col-lg-5 col-md-5">
                  <label>Fecha Pecosa<label></label><br></label></div>
                <div class="col-xs-7 col-sm-7 col-lg-7 col-md-7">
                  <input class="e-input" type="date" id="codigo_" name="codigo_">
                </div>
              </div>
            </div>
          </div>
          <div class="row bien_form">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row ">
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <label>Factura<label>
                    </label></label></div>
                <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                  <div class="e-input-group e-float-icon-right">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="factura" name="factura">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row ">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Pecosa<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group e-float-icon-right">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="pecosa" name="pecosa">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row ">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Guia de remisión<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group e-float-icon-right">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="guia_remision" name="guia_remision">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row bien_form">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row  form-group">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Local<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <input type="text" id="combo_locales" name="combo_locales" data-required-message="*Local es requerido" required="">
                  <input type="hidden" id="idlocal_bien" name="idlocal_bien">
                </div>
                <div class="error"></div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row  form-group">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Area<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <input type="text" id="combo_areas" name="combo_areas" data-required-message="*Area es requerido" required="">
                  <input type="hidden" id="idarea_bien" name="idarea_bien">
                </div>
                <div class="error"></div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row  form-group">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Oficina<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <input type="text" id="combo_oficinas" name="combo_oficinas" data-required-message="*Oficina es requerido" required="">
                  <input type="hidden" id="idoficina_bien" name="idoficina_bien">
                </div>
                <div class="error"></div>
              </div>
            </div>
          </div>
          <div class="row bien_form form-group">
            <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
              <label>Empleado<label>
                </label></label></div>
            <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
              <input type="text" id="combo_empleados" name="combo_empleados" data-required-message="*Empleado es requerido" required="">
              <input type="hidden" id="idempleado_oficina_bien" name="idempleado_oficina_bien">
            </div>
            <div class="error"></div>
          </div>
        </fieldset>
        <fieldset>
          <div class="legend_">[ Datos de proveedor ]</div>
          <div class="row bien_form">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>RUC<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group e-float-icon-right">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="ruc_form_modal" name="ruc_form_modal">
                      <input type="hidden" id="idproveedor_form_modal" name="idproveedor_form_modal">
                    </div>
                    <span class="e-input-group-icon fas fa-filter" id="proveedores_"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
              <div class="row bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>Razon Social<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group readonly__">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="razon_social_form_modal" name="razon_social_form_modal" readonly="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2">
              <input type="checkbox" name="asegurado" id="asegurado">
              <input type="hidden" id="asegurado_bien" name="asegurado_bien">
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="legend_">[ Datos técnicos ]</div>
          <div id="Tab_registro_bien">
            <div class="e-tab-header">
              <div>Detalle Técnico </div>
              <div>Detalle Técnico -Computo</div>
            </div>
            <div class="e-content">
              <div>
                <div class="control-section">
                  <div class="content-wrapper">
                    <div class="row bien_form">
                      <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
                        <div class="row bien_form">
                          <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                            <label>Marca<label>
                              </label></label></div>
                          <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dt_marca" name="dt_marca">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Modelo<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dt_modelo" name="dt_modelo">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row bien_form">
                      <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
                        <div class="row bien_form">
                          <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                            <label>Tipo<label>
                              </label></label></div>
                          <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dt_tipo" name="dt_tipo">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Color<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dt_color" name="dt_color">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row bien_form">
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <label>Serie<label>
                          </label></label></div>
                      <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                        <div class="e-input-group e-float-icon-right">
                          <div class="e-input-in-wrap">
                            <input class="e-input" type="text" id="dt_serie" name="dt_serie">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row bien_form">
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <label>Otros<label>
                          </label></label></div>
                      <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                        <textarea class="e-textarea" id="dt_otros" name="dt_otros" style="margin: 0px; width: 399px; height: 77px;"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="control-section">
                  <div class="content-wrapper">
                    <div class="row bien_form">
                      <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                        <div class="row bien_form">
                          <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
                            <label>Disco Duro<label>
                              </label></label></div>
                          <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_discoDuro" name="dtc_discoDuro">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Marca<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_discoDuroMarca" name="dtc_discoDuroMarca">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Serie<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_discoDuroSerie" name="dtc_discoDuroSerie">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row bien_form">
                      <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                        <div class="row bien_form">
                          <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
                            <label>Procesador<label>
                              </label></label></div>
                          <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_procesador" name="dtc_procesador">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Marca<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_procesadorMarca" name="dtc_procesadorMarca">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Serie<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_procesadorSerie" name="dtc_procesadorSerie">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row bien_form">
                      <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                        <div class="row bien_form">
                          <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
                            <label>Memoria RAM<label>
                              </label></label></div>
                          <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_memoriaRam" name="dtc_memoriaRam">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Marca<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_memoriaRamMarca" name="dtc_memoriaRamMarca">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Serie<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_memoriaRamSerie" name="dtc_memoriaRamSerie">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row bien_form">
                      <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                        <div class="row bien_form">
                          <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
                            <label>Tarjeta principal<label>
                              </label></label></div>
                          <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_placa" name="dtc_placa">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Marca<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_placaMarca" name="dtc_placaMarca">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                        <div class="row bien_form">
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                            <label>Serie<label>
                              </label></label></div>
                          <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                            <div class="e-input-group e-float-icon-right">
                              <div class="e-input-in-wrap">
                                <input class="e-input" type="text" id="dtc_placaSerie" name="dtc_placaSerie">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="legend_">[ Datos de baja de un bien ]</div>
          <div class="row bien_form">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
              <div class="row bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>RESOLUCION<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group ">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" disabled="" id="resolucion_baja" name="resolucion_baja">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
              <div class="row  form-group bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>FECHA <label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9 ">
                  <input class="e-input" type="text" id="fecha_baja" name="fecha_baja" dateiso="true" data-dateiso-message="Please enter valid dateISO format(YYYY-MM-DD)." data-required-message="Fecha de baja es requerido" required="">
                  <input type="hidden" id="fecha_baja_bien" name="fecha_baja_bien">
                </div>
                <div class="error"></div>
              </div>
            </div>
            <div class="col-xs-5 col-sm-5 col-lg-5 col-md-5">
              <div class="row bien_form">
                <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                  <label>CAUSAL<label>
                    </label></label></div>
                <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                  <div class="e-input-group ">
                    <div class="e-input-in-wrap">
                      <input class="e-input" type="text" id="causal" name="causal" disabled="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </form>
  <style>
    .content-wrapper div.bien_form {
      padding: 0.4px 0px;
    }

    .content-wrapper div.row {
      padding: 0.4px 0px;
    }
  </style>
